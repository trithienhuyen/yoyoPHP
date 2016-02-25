<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Core\Loader\TemplateLoader as Loader;
class ControllerCommand extends Command
{	
	//Command Name and Description
	protected $commandName = 'app:controller';
    protected $commandDescription = "Create an Controller";

    //Command Argument
    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "Name of the Controller";

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
    	$controller_name = $input->getArgument($this->commandArgumentName);
    	$fullpath = APP . 'controllers' . '/' . $controller_name . '.php';
        if (file_exists($fullpath))
        {
            echo $controller_name.' is exists!';
        }
        else
            {
                if ( ! is_dir(dirname($fullpath)) )
                {
                    mkdir(dirname($fullpath), 0777, true) or die("Unable to create a directory!");
                }

                $data = array('controller_name' => $controller_name);

                $template = (new Loader())
                                ->load('controller_default',
                                    [
                                       'controller_name'=>$controller_name
                                    ]);

                $file = fopen($fullpath, "w") or die("Unable to create a file!");

                fwrite($file, html_entity_decode($template));

                echo $controller_name . ' created.';
            }
    }
}