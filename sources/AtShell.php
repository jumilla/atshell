<?php namespace Jumilla\Atshell;

class AtShell {

	const VERSION = '0.0.2';

	public static function run()
	{
		$app = new Jumilla\Atshell\AtShell;

		$app->run();
	}

	public function application()
	{
		$app = new \Symfony\Component\Console\Application('Atshell', static::VERSION);

		$app->add(new InitCommand);
		$app->add(new ConfigCommand);
		$app->add(new EditCommand);
		$app->add(new ProjectsCommand);
		$app->add(new UpCommand);

		// project specified commands
		$project = $this->findProject(getcwd());

		if ($project) {

		}
	}

	private function findProject($path)
	{
	}

}
