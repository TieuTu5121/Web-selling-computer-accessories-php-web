<?php
define('BASEURL', 'http://localhost:8080/');
define('ROOT_DIR', dirname(dirname(__FILE__)));
define('VIEWS_DIR', ROOT_DIR . '/src/views');


session_start();

require_once ROOT_DIR . '/vendor/autoload.php';
require_once ROOT_DIR . '/src/functions.php';


try {
	$PDO = (new App\PDOFactory())->create([
		'dbhost' => 'localhost',
		'dbname' => 'ntshop_db',
		'dbuser' => 'root',
		'dbpass' => ''
	]);
} catch (Exception $ex) {
	echo 'Không thể kết nối đến MySQL,
		kiểm tra lại username/password đến MySQL.<br>';
	echo '<pre>';
	var_dump($ex);
	exit();
}

use Bramus\Router\Router as Router;

$router = new Router();

require(ROOT_DIR . '/routes/web.php');
require(ROOT_DIR . '/routes/errors.php');

$router->run();
