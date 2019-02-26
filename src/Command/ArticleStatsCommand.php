<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ArticleStatsCommand extends Command
{
    protected static $defaultName = 'article:stats';

    protected function configure()
    {
        $this
            ->setDescription('Passes content to Articles')
            ->addArgument('slug', InputArgument::REQUIRED, 'The article content')
            ->addOption('format', null, InputOption::VALUE_REQUIRED, 'The text format output', 'text');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io   = new SymfonyStyle($input, $output);
        $slug = $input->getArgument('slug');

        $data = array(
            'slug'   => $slug,
            'hearts' => rand(10, 100),
        );

        switch ($input->getOption('format')) {
            case 'text':
                $rows = [];
                foreach ($data as $key => $val) {
                    $rows[] = [$key, $val];
                }
                $io->table(['Key', 'Value'], $rows);
                break;
            case 'json':
                $io->write(json_encode($data));
                break;
            default:
                throw new \Exception('What kind of crazy format is that!?');
                break;
        }

        $io->success('We printed the article correctly!');
    }
}
