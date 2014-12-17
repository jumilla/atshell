<?php

function array_has($array, $key)
{
	return isset($array[$key]);
}

function array_get($array, $key, $default = null)
{
	return isset($array[$key]) ? $array[$key] : $default;
}

function os_is_windows()
{
	return PHP_OS === 'WIN';
}

function os_is_mac()
{
	return PHP_OS === 'DARWIN';
}

function os_is_linux()
{
	return PHP_OS === 'LINUX';
}

function path_expand($path)
{
	return preg_replace('/^(~)/', getenv('HOME'), $path);
}

function project_config()
{
	return json_decode(file_get_contents(atshell_path('.projects.json')), true);
}
