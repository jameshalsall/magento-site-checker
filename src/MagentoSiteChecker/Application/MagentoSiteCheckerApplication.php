<?php

namespace JamesHalsall\MagentoSiteChecker\Application;

use JamesHalsall\MagentoSiteChecker\Command\SiteCheckerCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Magento site checker console application.
 *
 * @package JamesHalsall\MagentoSiteChecker\Application
 * @author  James Halsall <james.t.halsall@googlemail.com>
 */
class MagentoSiteCheckerApplication extends Application
{
    /**
     * {@inheritDoc}
     */
    protected function getCommandName(InputInterface $input)
    {
        return 'run';
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultCommands()
    {
        $commands = parent::getDefaultCommands();

        $commands[] = new SiteCheckerCommand();

        return $commands;
    }

    /**
     * {@inheritDoc}
     */
    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        $inputDefinition->setArguments();

        return $inputDefinition;
    }
}
