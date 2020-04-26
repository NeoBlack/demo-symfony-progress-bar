<?php

/*
 * This file is part of the package neoblack/demo-symfony-progress-bar.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace App\Command;

use App\Entity\ProgressDemo;
use App\Repository\ProgressDemoRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DemoResetDatabaseCommand extends Command
{
    protected static $defaultName = 'demo:reset-database';

    /**
     * @var ProgressDemoRepository
     */
    private $progressDemoRepository;

    public function __construct(ProgressDemoRepository $progressDemoRepository)
    {
        parent::__construct(null);
        $this->progressDemoRepository = $progressDemoRepository;
    }

    protected function configure()
    {
        $this
            ->setDescription('Reset the demo database')
            ->addOption('records', 'r', InputOption::VALUE_OPTIONAL, 'Amount of records to create', 1000)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->note('Start cleanup database');

        $io->note('Remove old records, cleanup table');
        foreach ($this->progressDemoRepository->findAll() as $entity) {
            $this->progressDemoRepository->remove($entity);
        }

        $io->note('Create new demo records');
        for ($i=0; $i<$input->getOptions()['records']; $i++) {
            $demo = (new ProgressDemo())
                ->setTitle('Demo: ' . $i)
                ->setUpdated(0);
            $this->progressDemoRepository->persist($demo);
        }

        $io->success('Database resetted');

        return 0;
    }
}
