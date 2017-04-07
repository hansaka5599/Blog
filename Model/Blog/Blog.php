<?php
/**
 * Netstarter Pty Ltd.
 *
 * @category    CameraHouse
 *
 * @author      Netstarter Team <contact@netstarter.com>
 * @copyright   Copyright (c) 2016 Netstarter Pty Ltd. (http://www.netstarter.com.au)
 */

namespace CameraHouse\Blog\Model\Blog;

use CameraHouse\Blog\Helper\Data;
use Magento\Framework\View\Element\Template\Context;
use Zend\Feed\Reader\Reader;
use CameraHouse\Blog\Model\BlogContentProcessorFactory;
use CameraHouse\Blog\Model\BlogMediaInterface;

/**
 * Class Blog.
 */
class Blog implements BlogMediaInterface
{
    /**
     * Variable context.
     *
     * @var Context
     */
    protected $context;

    /**
     * Feed reader.
     *
     * @var \Zend\Feed\Reader\Reader
     */
    protected $feedReader;

    /**
     * Feed Data.
     *
     * @var FeedData
     */
    protected $feedHelper;

    /**
     * Blog contentProcessorFactory.
     *
     * @var BlogContentProcessorFactory
     */
    protected $contentProcessorFactory;

    /**
     * Blog constructor.
     *
     * @param Context                     $context
     * @param Reader                      $reader
     * @param Data                        $feedHelper
     * @param BlogContentProcessorFactory $contentProcessorFactory
     */
    public function __construct(
        Context $context,
        Reader $reader,
        Data $feedHelper,
        BlogContentProcessorFactory $contentProcessorFactory
    ) {
        $this->context = $context;
        $this->feedReader = $reader;
        $this->feedHelper = $feedHelper;
        $this->contentProcessorFactory = $contentProcessorFactory;
    }

    /**
     * Function getFeeds.
     *
     * @param bool $regenerate
     *
     * @return \CameraHouse\Blog\Model\Blog\Blog
     *
     * @throws \Exception
     */
    public function getFeeds($regenerate = false)
    {
        $provider = $this->contentProcessorFactory->create();
        if (!$regenerate && $content = $provider->extract()) {
            return $content;
        }

        return $this->retrieveFeeds();
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Retrieve Data function.
     *
     * @return string
     *
     * @throws \Exception
     */
    public function retrieveFeeds()
    {
        $url = $this->feedHelper->getConfigFeedUrl();
        try {
            if ($url != '') {
                list($status) = get_headers($url);
                if (strpos($status, '200') == true) {
                    $feeds = $this->feedReader->import($url);
                    $dataSet = [];
                    if ($feeds) {
                        $i = 1;
                        foreach ($feeds as $feed) {
                            $image = null;
                            if ($feed->getDomDocument()->getElementsByTagName('image')) {
                                $image = $feed->getDomDocument()->getElementsByTagName('image')->item($i - 1);
                            }

                            $dataSet[] = [
                                            'blogLink' => $feed->getLink(),
                                            'blogTitle' => $feed->getTitle(),
                                            'blogImage' => $image->nodeValue,
                                           ];

                            ++$i;
                        }
                    }

                    return serialize($dataSet);
                }
            }
        } catch (\Exception $e) {
            /* @noinspection PhpUndefinedClassInspection */
            throw new \Exception(__($e->getMessage()));
        }
    }
}
