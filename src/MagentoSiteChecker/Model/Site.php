<?php

namespace JamesHalsall\MagentoSiteChecker\Model;

/**
 * Site model.
 *
 * @package JamesHalsall\MagentoSiteChecker\Model
 * @author  James Halsall <james.t.halsall@googlemail.com>
 */
class Site
{
    /**
     * The site domain
     *
     * @var string
     */
    private $domain;

    /**
     * Path to the magento admin
     *
     * @var string
     */
    private $adminPath;

    /**
     * Whether to force HTTPS
     *
     * @var boolean
     */
    private $useHttps;

    /**
     * Constructor.
     *
     * @param string  $domain    The site domain
     * @param string  $adminPath The path to the Magento admin
     * @param boolean $useHttps  Whether to force HTTPS when connecting
     */
    public function __construct($domain, $adminPath, $useHttps)
    {
        $this->domain = $domain;
        $this->adminPath = $adminPath;
        $this->useHttps = $useHttps;
    }

    /**
     * Gets the site domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Gets the path to the Magento admin
     *
     * @return string
     */
    public function getAdminPath()
    {
        return $this->adminPath;
    }

    /**
     * Returns true if the site uses HTTPS
     *
     * @return boolean
     */
    public function usesHttps()
    {
        return $this->useHttps;
    }
}
