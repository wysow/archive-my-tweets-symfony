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
            ->addOption('with-followers', null, InputOption::VALUE_NONE, 'if defined, data on followers will be archived too')
            ->addOption('only-followers', null, InputOption::VALUE_NONE, 'if defined, ONLY data on followers will be archived')
            ->addOption('from-import', null, InputOption::VALUE_NONE, 'if defined, an import of archive js files will be done instead of using twitter api.
                Must be an absolute link to a directory')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $archiver = $this->getContainer()->get('wysow_archive_my_tweets.twitter.archiver');

        if($input->getOption('from-import') && !$input->getOption('only-followers')) {
            if(is_dir($input->getOption('from-import'))) {
                $output->writeln('<info>Importing from Twitter Archive files</info>');
                $importResult = $archiver->importJSON($input->getOption('from-import'));
                $output->writeln('<info>'.$importResult.'</info>');
            } else {
                $output->writeln('<error>The "from-import" option must be a directory!');
            }
            return;
        }

        if (!$input->getOption('only-followers')) {
            // getting all tweets already archived
             $this->getContainer()->get('doctrine.orm.entity_manager')->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findAll();

            $message = $input->getOption('with-favorites') ? '<info>Starting to archive tweets WITH favorites</info>' : '<info>Starting to archive tweets WITHOUT favorites</info>';
            $output->writeln($message);

            $archiveResult = $archiver->archive();

            $output->writeln('<info>'.$archiveResult.'</info>');
        }

        if($input->getOption('with-favorites') && !$input->getOption('only-followers')) {
            $archiveFavoritesResult = $archiver->archiveFavorites();

            $output->writeln('<info>'.$archiveFavoritesResult.'</info>');
        }

        if(
            $input->getOption('with-followers') ||
            $input->getOption('only-followers')
        ) {
            $output->writeln('<info>Starting to archive followers</info>');

            // getting all followers already archived
            $this->getContainer()->get('doctrine.orm.entity_manager')->getRepository('WysowArchiveMyTweetsBundle:Follower')->findAll();

            $followersResult = $archiver->archiveFollowers();

            $output->writeln('<info>'.$followersResult.'</info>');
        }
    }
}