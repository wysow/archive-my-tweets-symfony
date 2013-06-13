<?php

namespace Wysow\ArchiveMyTweetsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ArchiveCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('wysow:twitter:archive')
            ->setDescription('This task archive your last tweets')
            ->addOption('with-favorites', null, InputOption::VALUE_NONE, 'if defined, favorited tweets will be archived too')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        
    }
}