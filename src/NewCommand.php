<?php

namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp\ClientInterface;
use ZipArchive;

class NewCommand extends Command {
  private $client;
  public function __construct(ClientInterface $client)
  {
   $this->client = $client;
   parent::__construct();
  }
  //* Before referencing this class make sure it can be autoloaded in our .json file ("autoload":) and run: composer dump-autoload from the command line.
  public function configure()
  {
    //* setters and arguments will be set here.
    $this->setName('new')
          ->setDescription('Create a new Laravel application.')
          ->addArgument('name', InputArgument::REQUIRED);
  }
  public function execute(InputInterface $input, OutputInterface $output)
  {
    //* Assert thet the new folder being created doesn't already exist.
    $directory = getcwd() . '/' . $input->getArgument('name');
    $output->writeln('<info>Writing files by hand</info>');
    $this->assertApplicationDoesNotExist($directory, $output);
    //* Download nightly version of Laravel, treat it like a fluent API.
    $this->download($zipFile = $this->makeFileName())
         ->extract($zipFile, $directory)
         ->cleanUp($zipFile);
    //* Extract zip file.
    //* Alert the user.
    $output->writeln('<comment>Application ready to go!!</comment>');
  }
  private function assertApplicationDoesNotExist($directory, OutputInterface $output)
  {
    if (is_dir($directory))
    {
      $output->writeln('<error>Application already exists!</error>');
      exit(1); //* 1 is just a general error status.
    }
  }
  private function makeFileName()
  {
    return getcwd() . '/laravel_' . md5(time().uniqid()) . '.zip';
  }
  private function download($zipFile)
  {
    //* There is a cron job that runs everyday:
    //* http://cabinet.laravel.com/latest.zip
    //* use composer require guzzlehttp/guzzle
    $response = $this->client->get('http://cabinet.laravel.com/latest.zip')->getBody();
    file_put_contents($zipFile, $response);
    return $this; //* Because we want to keep our fluent style interface.
  }
  private function extract($zipFile, $directory)
  {
    $archive = new ZipArchive;
    $archive->open($zipFile);
    $archive->extractTo($directory);
    $archive->close();
    return $this;
  }
  //* Delete zip file after it is downloaded.
  private function cleanUp($zipFile)
  {
    @chmod($zipFile, 0777);
    @unlink($zipFile);
    return $this;
  }
}

?>
