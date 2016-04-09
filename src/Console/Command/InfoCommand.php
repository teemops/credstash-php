<?php

namespace CredStash\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Info Command.
 *
 * Note: In python this is "list", but that is already taken by Symfony here.
 *
 * @author Carson Full <carsonfull@gmail.com>
 */
class InfoCommand extends BaseCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('info')
            ->setDescription('List credentials and their versions')
            ->addArgument('pattern', null, 'Filter credentials to those matching this pattern', '*')
            ->addOption('int', 'i', null, 'Cast versions to integers instead of leaving them padded with 0\'s')
        ;
        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pattern = $input->getArgument('pattern');
        $cast = !$input->getOption('int');

        $credentials = $this->getCredStash()->listCredentials($pattern, $cast);

        foreach ($credentials as $name => $version) {
            $output->writeln("<info>$name</info> -- version <comment>$version</comment>");
        }
    }
}
