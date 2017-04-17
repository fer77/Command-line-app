<?php 
namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RenderCommand extends Command
{
	
	public function configure()
	{
		$this->setName('render')
			 ->setDescription('Render some tabular data.');
	}
	public function execute(InputInterface $input, OutputInterface $output)
	{
		$table = new Table($output); //* 1. Instantiate table class and feed it your $output.
		$table->setHeaders(['Name', 'Age']) //* 2. Specify header.
		//* 3. Give it an array of arrays that will represent each row in a table.
			 ->setRows([
			 	['Bob Belcher', 30],
			 	['Linda Belcher', 30]
			 	])
			 ->render(); //* 4. Render it to the console.
	}
}
 ?>