<?php
/**
 * Netstarter Pty Ltd.
 *
 * @category    CameraHouse
 *
 * @author      Netstarter Team <contact@netstarter.com>
 * @copyright   Copyright (c) 2016 Netstarter Pty Ltd. (http://www.netstarter.com.au)
 */

namespace CameraHouse\Blog\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    /**
     * Blog feed configuration path.
     *
     * @var string
     */
    const XML_FEED_PATH = 'camerahouse_blog/settings/config_feed_url';

    /**
     * Blog configuration path.
     *
     * @var string
     */
    const XML_BLOG_PATH = 'camerahouse_blog/settings/config_blog_url';

    /**
     * Scope Config.
     *
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Get Configuration Settings.
     *
     * @param string $scope
     *
     * @return string|int|bool|null
     */
    public function getConfigFeedUrl($scope = ScopeInterface::SCOPE_STORE)
    {
        return $this->scopeConfig->getValue(self::XML_FEED_PATH, $scope);
    }

    /**
     * Get Configuration Settings.
     *
     * @param string $scope
     *
     * @return string|int|bool|null
     */
    public function getConfigBlogUrl($scope = ScopeInterface::SCOPE_STORE)
    {
        return $this->scopeConfig->getValue(self::XML_BLOG_PATH, $scope);
    }
}
