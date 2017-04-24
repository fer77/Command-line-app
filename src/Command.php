<?php 

namespace Acme;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Helper\Table;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends SymfonyCommand {
		/**
		* @var DatabaseAdapter
		*/
	protected $database;
		public function __construct(databaseAdapter $database) {
			$this->database = $database;
			parent::__construct();
		}
		protected function showTasks(OutputInterface $output) {
		//* Fetch all tasks.
				if (! $tasks = $this->database->fetchAll('tasks'))
				{
					return $output->writeln('<info>No More Tasks!</info>');
				}
		//* Build our table.
				$table = new Table($output);
				$table->setHeaders(['Id', 'Description'])
					  ->setRows($tasks)
					  ->render();
			}
}