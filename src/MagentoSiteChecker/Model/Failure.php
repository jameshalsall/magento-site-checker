<?php

namespace JamesHalsall\MagentoSiteChecker\Model;

/**
 * Failure.
 *
 * Represents a site that has failed valid security checking because
 * it is either insecure or there was insufficient information available
 * to determine either way.
 *
 * @package JamesHalsall\MagentoSiteChecker\Model
 * @author  James Halsall <james.t.halsall@googlemail.com>
 */
class Failure
{
    /**
     * The site that failed the security check
     *
     * @var Site
     */
    private $site;

    /**
     * The message describing the failure
     *
     * @var string
     */
    private $message;

    /**
     * Constructor.
     *
     * @param Site   $site    The site that failed the security check
     * @param string $message The message describing the failure
     */
    public function __construct($site, $message)
    {
        $this->site = $site;
        $this->message = $message;
    }

    /**
     * Gets the failing site
     *
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Gets the failure message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
