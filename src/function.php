<?php

function redirect(string $path)
{
	header('Location: ' . $path);
	exit;
}

function render_view(string $document, array $data = [])
{
	$path = VIEWS_DIR . "/{$document}.php";
	extract($data, EXTR_PREFIX_SAME, '__var_');
	require($path);
}

function session_get_flash($key, $default = null)
{
	$message = $default;
	if (isset($_SESSION[$key])) {
		$message = $_SESSION[$key];
		unset($_SESSION[$key]);
	}
	return $message;
}

function PDO(): \PDO
{
	global $PDO;
	return $PDO;
}
