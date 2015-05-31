<?php

namespace JamesHalsall\MagentoSiteChecker\Command;

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
     * Configures the command
     */
    protected function configure()
    {
        $this
            ->setName('run')
            ->setDescription('Runs the site checker and gives feedback based on various options')
            ->addArgument('config-file', InputArgument::REQUIRED, 'The path to ')
            ->addOption('email', 'e', InputOption::VALUE_OPTIONAL, 'An email address where output will be sent')
            ->addOption('quiet', 'q', InputOption::VALUE_NONE, 'If quiet is specified then only failure messages will be displayed')
        ;
    }

    /**
     * Executes the command
     *
     * @param InputInterface $input   An input stream
     * @param OutputInterface $output An output stream
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $checker = new SiteChecker();

        $emailAddress = $input->getArgument('email');

    }
}
