<?php namespace Jumilla\Atshell;

use Symfony\Component\Process\Process;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpCommand extends Command {

	/**
	 * Configure the command options.
	 *
	 * @return void
	 */
	protected function configure()
	{
		$this->setName('up')
			->setDescription('Start the porject')
			->addArgument('name', InputArgument::REQUIRED, 'Project name.')
		;
	}

	/**
	 * Execute the command.
	 *
	 * @param  \Symfony\Component\Console\Input\InputInterface  $input
	 * @param  \Symfony\Component\Console\Output\OutputInterface  $output
	 * @return void
	 */
	public function execute(InputInterface $input, OutputInterface $output)
	{
		$projects = project_config();
		$projectName = $input->getArgument('name');

		$config = $projects[$projectName];

		$projectPath = path_expand($config['path']);
		if ($projectPath === false) {
			$output->writeln('<error>Config Error</error>');
			var_dump($config);
			return;
		}

		// Step1. add environment variable
		putenv('PATH=.:'.getenv('PATH'));
//		putenv('@PROJECT='.$projectPath);

		// Step2. move directory
		chdir($projectPath);

		// Step3. launch new shell with set user/group
		$user = array_get($config, 'user', null);
		if ($user !== null) {
			$command = 'sudo runuser --login ' . $user;
		}
		else {
			$command = '/usr/bin/env bash --login';
		}
		passthru($command);
	}

}
