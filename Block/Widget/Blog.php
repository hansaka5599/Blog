<?php
/**
 * Netstarter Pty Ltd.
 *
 * @category    CameraHouse
 *
 * @author      Netstarter Team <contact@netstarter.com>
 * @copyright   Copyright (c) 2016 Netstarter Pty Ltd. (http://www.netstarter.com.au)
 */

namespace CameraHouse\Blog\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;
use CameraHouse\Blog\Model\BlogMediaFactory;
use CameraHouse\Blog\Model\BlogMediaInterface;
use CameraHouse\Blog\Helper\Data;

/**
 * Class Blog.
 */
class Blog extends Template implements BlockInterface
{
    /**
     * BlogMediaFactory
     *
     * @var BlogMediaFactory
     */
    protected $blogMediaFactory;

    /**
     * Feed Data.
     *
     * @var FeedData
     */
    protected $feedHelper;

    /**
     * Blog constructor.
     * @param Context $context
     * @param BlogMediaFactory $blogMediaFactory
     * @param Data $feedHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        BlogMediaFactory $blogMediaFactory,
        Data $feedHelper,
        array $data
    ) {
        $this->blogMediaFactory = $blogMediaFactory;
        parent::__construct($context, $data);
        $this->feedHelper = $feedHelper;
    }

    /**
     * Function getFeeds
     *
     * @return mixed|void
     */
    public function getFeeds()
    {
        /** @var BlogMediaInterface $handler */
        $handler = $this->blogMediaFactory->create($this->getData('media'));
        $handler->setData($this->getData());

        return $handler->getFeeds();
    }

    /**
     * Get block cache life time.
     *
     * @return int
     */
    protected function getCacheLifetime()
    {
        return parent::getCacheLifetime() ?: 3600;
    }

    /**
     * Function getCacheKeyInfo.
     *
     * @return array
     */
    public function getCacheKeyInfo()
    {
        // if the custom cache key is set concat it
        return [
            'BLOG_WIDGET',
            $this->getCustomCacheKey(),
        ];
    }

    /**
     * Function get Blog URL.
     *
     * @return bool|int|null|string
     */
    public function getBlogUrl()
    {
        return $this->feedHelper->getConfigBlogUrl();
    }

    /**
     * Get widget title.
     *
     * @return int
     */
    public function getWidgetTitle()
    {
        return parent::getBlockTitle();
    }

    /**
     * Function getFeed count.
     *
     * @return mixed
     */
    public function getFeedCount()
    {
        return parent::getFeedCount();
    }
}
