<?php
/**
 * Netstarter Pty Ltd.
 *
 * @category    CameraHouse
 *
 * @author      Netstarter Team <contact@netstarter.com>
 * @copyright   Copyright (c) 2016 Netstarter Pty Ltd. (http://www.netstarter.com.au)
 */

namespace CameraHouse\Blog\Model;

use CameraHouse\Blog\Model\Blog\BlogFactory;
use CameraHouse\ContentGeneration\Helper\Data;
use CameraHouse\ContentGeneration\Model\AbstractContentProcessor;
use CameraHouse\ContentGeneration\Model\ContentFactory;

class BlogContentProcessor extends AbstractContentProcessor
{
    /**
     * BlogContentProcessor -> identifier.
     *
     * @var string
     */
    protected $identifier = 'blog';

    /**
     * Blog API.
     *
     * @var BlogFactory
     */
    protected $blogFactory;

    /**
     * BlogContentProcessor constructor.
     *
     * @param BlogFactory    $blogFactory
     * @param ContentFactory $contentFactor
     * @param Data           $helperData
     */
    public function __construct(
        BlogFactory $blogFactory,
        ContentFactory $contentFactor,
        Data $helperData
    ) {
        parent::__construct($contentFactor, $helperData);
        $this->blogFactory = $blogFactory;
    }

    /**
     * Function generate.
     *
     * @return string[]
     */
    public function generate()
    {
        $data = $this->blogFactory->create()->getFeeds(true);

        return [$this->identifier => serialize($data)];
    }

    /**
     * Function extract.
     *
     * @return string
     */
    public function extract()
    {
        if ($contents = parent::extract()) {
            return unserialize($contents);
        }

        return null;
    }
}
