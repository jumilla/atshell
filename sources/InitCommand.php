<?php namespace Jumilla\Atshell;

use Symfony\Component\Process\Process;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitCommand extends Command {

	/**
	 * Configure the command options.
	 *
	 * @return void
	 */
	protected function configure()
	{
		$this->setName('init')
			->setDescription('Initialize @shell')
			->addOption('force', 'f', InputOption::VALUE_NONE, 'Force initialize.')
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
		$output->writeln(sprintf('<info>@shell resource directory: %s</info>', atshell_path()));
		$output->writeln('');

		if (is_dir(atshell_path())) {
			if ($input->getOption('force') === false) {
				$output->writeln('<error>Error: already initialized.</error>');
				return;
			}

			unlink(atshell_path('.projects.json'));
			rmdir(atshell_path());
		}

		mkdir(atshell_path());

		copy(base_path('stubs/.projects.json'), atshell_path('.projects.json'));

		$output->writeln('<info>Initialized</info>');
	}

}
