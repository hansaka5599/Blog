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

interface BlogMediaInterface
{
    /**
     * @return mixed
     */
    public function getFeeds();

    /**
     * @param array $data
     */
    public function setData($data);
}
