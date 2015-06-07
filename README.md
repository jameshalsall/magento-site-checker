# Magento Site Checker

The Magento site checker is a tool that can be used manually on a regular basis or scheduled on a cron to test your
Magento stores for security vulnerabilities.

## Why?

I got sick of manually checking sites against the API using curl and wanted something that would run all the time and
let me know whenever one of my Magento stores was not patched up-to-date. In a studio environment where you have many
stores to check it's not something you want to be running manually and it's easy to forget one of your clients' stores.

## How?

The tool simply makes use of the Magento security checker API, and wraps it up with a command line interface and a
site configuration file making it easier to check all of your Magento stores.

## Setup

1. Add the package to your composer dependencies (`"jameshalsall/magento-site-checker": "~1.0"`)
2. Make sure your `composer.json` has `"bin-dir": "bin/"` in the `config` options (see [here](https://getcomposer.org/doc/04-schema.md#config)
for more information on composer config.
3. Create a YAML configuration file for your sites (see `config/sites.yml.dist` for an example, or the Configuration section
of this README for more information)
4. Run the site checker manually first, `bin/magento-site-checker path/to/your/sites.yml`
5. Schedule the site checker to run on a cron job and use the `--failures-only` option so you only get cron output for
failing sites. Using something like `mutt` can facilitate in emailing the output.

## Configuration

The `sites.yml` configuration file represents each of your Magento stores that are to be checked during execution of the
tool. An example of the file can be seen in the `config/sites.yml.dist` file in this repository. The key for each entry
in the file should be the name of the site, and each entry supports the following properties:

1. **domain** - the domain name of the site (without the protocol)
2. **admin_path** - the path to the admin login screen on the site, which will usually be `admin` (optional, defaults to `admin`)
3. **https** - either `true` or `false` to indicate whether the site is available over SSL (optional, defaults to `false`)

## Roadmap

1. Add native email support
2. Investigate methods for detecting which specific patches are missing on the Magento stores
