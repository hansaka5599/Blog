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

use Magento\Framework\ObjectManagerInterface;

class BlogMediaFactory
{
    /**
     * ObjectManager
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * BlogMediaFactory constructor.
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Get class instance.
     *
     * @param string $blogMediaClass
     * @param array  $arguments
     *
     * @throws \InvalidArgumentException
     *
     * @return \CameraHouse\Blog\Model\BlogMediaInterface
     */
    public function create($blogMediaClass, $arguments = [])
    {
        $handler = $this->objectManager->create($blogMediaClass, $arguments);
        if (!$handler instanceof BlogMediaInterface) {
            throw new \InvalidArgumentException(
                $blogMediaClass.' doesn\'t implement \CameraHouse\Blog\Model\BlogMediaInterface'
            );
        }

        return $handler;
    }
}
