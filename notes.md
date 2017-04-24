## 1
##Using symfony's console component.

Steps:

1. create a composer.json file add symfony to it and `composer install`.

2. create the file that will be executed i.e. laravel or homestead...

`permission denied: ./laracasts` This error means two things:

1. Make sure this file is executable: `chmod +x ./laracasts`

2. start up the application: `app->run();`

## 2
## Class for console commands.

Steps:

1. create a "sayHelloTo" command.

2. set the description and

3. add an argument.

**InputInterface** Fetch argument values and any options.

**OutputInterface** If we want to output anything to the console.

## 6
1. Create entry point.

2. Make file executable `chmod +x ./tasks`

**Note**
If you use a constructor as a command make sure you call the parent class constructor (parent::__construct())