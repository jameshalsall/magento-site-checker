<?php

namespace JamesHalsall\MagentoSiteChecker\Command;

use JamesHalsall\MagentoSiteChecker\Converter\YamlToSitesConfigConverter;
use JamesHalsall\MagentoSiteChecker\SiteChecker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Site Checker console command.
 *
 * Wraps the site checker in a command line interface.
 *
 * @package JamesHalsall\MagentoSiteChecker\Command
 * @author  James Halsall <james.t.halsall@googlemail.com>
 */
class SiteCheckerCommand extends Command
{
    /**
     * True if the command is running in failure only mode.
     *
     * This means that success messages will be silenced and only failure
     * messages will be displayed.
     *
     * @var boolean
     */
    private $failuresOnly = false;

    /**
     * Configures the command
     */
    protected function configure()
    {
        $this
            ->setName('run')
            ->setDescription('Runs the site checker and gives feedback based on various options')
            ->addArgument('sites-config', InputArgument::REQUIRED, 'The path to the YAML file containing the sites that need checking')
            ->addOption('email', 'e', InputOption::VALUE_OPTIONAL, 'An email address where output will be sent')
            ->addOption('failures-only', 'f', InputOption::VALUE_NONE, 'If failures-only is specified then only failure messages will be displayed')
        ;
    }

    /**
     * Executes the command
     *
     * @param InputInterface $input   An input stream
     * @param OutputInterface $output An output stream
     *
     * @return integer
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->failuresOnly = $input->getOption('failures-only');
        $emailAddress = $input->getOption('email');
        $sitesConfigPath = $input->getArgument('sites-config');


        if (!is_readable($sitesConfigPath)) {
            throw new \RuntimeException(
                sprintf('The sites config path provided (%s) does not exist or can not be read', $sitesConfigPath)
            );
        }

        $sites = YamlToSitesConfigConverter::convert(file_get_contents(realpath($sitesConfigPath)));
        $checker = new SiteChecker($sites);

        $checker->check();

        foreach ($sites as $site) {
            $this->writeOutput(
                sprintf('<info>Site %s is patched up-to-date</info>', $site->getDomain()),
                $output
            );
        }

        foreach ($checker->getFailures() as $failure) {
            $this->writeOutput(
                sprintf(
                    '<error>Site %s failed security check with message: %s</error>',
                    $failure->getSite()->getDomain(),
                    $failure->getMessage()
                ),
                $output,
                true
            );
        }

        return $checker->isSuccessful() ? 0 : 1;
    }

    /**
     * Writes a message to the output stream
     *
     * @param string          $outputString The string to output
     * @param OutputInterface $outputStream An output stream to write to
     * @param boolean         $isError      True if the output string is an error message, defaults to false
     */
    private function writeOutput($outputString, OutputInterface $outputStream, $isError = false)
    {
        if (true === $this->failuresOnly && false === $isError) {
            return;
        }

        $outputStream->writeln($outputString);
    }
}
