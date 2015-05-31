<?php

namespace JamesHalsall\MagentoSiteChecker;

use JamesHalsall\MagentoSiteChecker\Model\Site;

/**
 * Site Checker.
 *
 * Initialises the site checking process.
 *
 * @package JamesHalsall\MagentoSiteChecker
 * @author  James Halsall <james.t.halsall@googlemail.com>
 */
class SiteChecker
{
    const VERSION = '0.1-dev';

    /**
     * The sites to check
     *
     * @var Site[]
     */
    private $sites = [];

    /**
     * Constructor.
     *
     * @param Site[] $sites The sites to check
     */
    public function __construct(array $sites)
    {
        $this->sites = $sites;
    }

    /**
     * Runs the site checker
     */
    public function check()
    {
        // todo
    }
}
