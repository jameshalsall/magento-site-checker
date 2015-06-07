<?php

namespace JamesHalsall\MagentoSiteChecker;

use GuzzleHttp\Client;
use JamesHalsall\MagentoSiteChecker\Model\Failure;
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
    const API_ENDPOINT = 'https://magento.com/security-patch-check';

    /**
     * The sites to check
     *
     * @var Site[]
     */
    private $sites = [];

    /**
     * Failed site checks
     *
     * @var array
     */
    private $failures = [];

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
        $client = new Client();

        foreach ($this->sites as $site) {
            $response = $client->get($this->buildCheckUriForSite($site));

            if ($response->getStatusCode() !== 200) {
                $this->failures[] = new Failure($site, 'The security checker API endpoint was not reachable');
            } else {
                $responseObject = json_decode($response->getBody()->getContents());

                if ($responseObject->status === 'error') {
                    $this->failures[] = new Failure($site, $responseObject->message);
                }
            }
        }
    }

    /**
     * Gets any failed site checks
     *
     * @return Failure[]
     */
    public function getFailures()
    {
        return $this->failures;
    }

    /**
     * Returns true if the site checks were all successful
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return empty($this->failures);
    }

    /**
     * Builds a URI to check a Magento site's security
     *
     * @param Site $site The site to build the URI for
     *
     * @return string
     */
    private function buildCheckUriForSite(Site $site)
    {
        $base = sprintf('%s/%s/%s', static::API_ENDPOINT, $site->getDomain(), $site->getAdminPath());

        if ($site->usesHttps()) {
            $base .= '/https';
        }

        return $base;
    }
}
