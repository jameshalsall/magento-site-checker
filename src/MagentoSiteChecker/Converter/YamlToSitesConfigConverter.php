<?php

namespace JamesHalsall\MagentoSiteChecker\Converter;

use JamesHalsall\MagentoSiteChecker\Model\Site;
use Symfony\Component\Yaml\Yaml;

/**
 * Converst YAML file contents to an array of site objects.
 *
 * @package JamesHalsall\MagentoSiteChecker\Converter
 * @author  James Halsall <james@rippleffect.com>
 */
class YamlToSitesConfigConverter
{
    /**
     * Converts YAML file contents to an array of Site models
     *
     * @param string $yamlContents The YAML file content to convert
     *
     * @return Site[]
     */
    public static function convert($yamlContents)
    {
        $convertedSites = [];
        $rawData = Yaml::parse($yamlContents);

        foreach ($rawData as $siteName => $siteData) {
            static::normalizeDataValues($siteData);

            $convertedSites[$siteName] = new Site(
                $siteData['domain'],
                $siteData['admin_path'],
                (boolean) $siteData['https']
            );
        }

        return $convertedSites;
    }

    /**
     * Normalizes site data, adding any missing values with defaults.
     *
     * @param array $siteData The unnormalized site data
     */
    private static function normalizeDataValues(array &$siteData)
    {
        if (!isset($siteData['admin_path'])) {
            $siteData['admin_path'] = 'admin';
        }

        if (!isset($siteData['https'])) {
            $siteData['https'] = false;
        }
    }
}
