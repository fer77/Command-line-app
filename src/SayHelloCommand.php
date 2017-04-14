<?php

namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SayHelloCommand extends Command {
  //* Before referencing this class make sure it can be autoloaded in our .json file ("autoload":) and run: composer dump-autoload from the command line.
  public function configure()
  {
    //* setters and arguments will be set here.
    $this->setName('sayHelloTo')
          ->setDescription('Greets the given person.')
          ->addArgument('name', InputArgument::REQUIRED, 'Your name.')
          ->addOption('greeting', null, InputOption::VALUE_OPTIONAL, 'Overrides the default greeting', 'Hello!');
  }
  public function execute(InputInterface $input, OutputInterface $output)
  {
    $message = 'Hello, ' . $input->getArgument('name');
    $message = sprintf('%s, %s', $input->getOption('greeting'), $input->getArgument('name'));

    $output->writeln("<info>{$message}</info>"); //* Can be wrapped in HTML like tags <comment> and <info>...to add styles.
  }
}

?>
