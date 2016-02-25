<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Core\Loader\TemplateLoader as Loader;
class MigrationCommand extends Command
{	
	//Command Name and Description
	protected $commandName = 'db:migration';
    protected $commandDescription = "Create an Migration File";

    //Command Argument
    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "Name of the Migration File";

    //Options for create Template
    
    //Config
    protected function configure()
    {
    	  $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addArgument(
                $this->commandArgumentName,
                InputArgument::OPTIONAL,
                $this->commandArgumentDescription
            );
    }
    //Run Command
    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$migration_name = $input->getArgument($this->commandArgumentName);
    	$fullpath = ROOT . 'database/migrations/' .time().'_'. $migration_name . '.php';
        if ( ! is_dir(dirname($fullpath)) )
        {
            mkdir(dirname($fullpath), 0777, true) or die("Unable to create a directory!");
        }

        $data = array('migration_name' => $migration_name);

        $template = (new Loader())
                                ->load('migration_create',
                                        $data);

        $file = fopen($fullpath, "w") or die("Unable to create a file!");

        fwrite($file, html_entity_decode($template));

        echo $migration_name . ' created.';
    }
}