<?php

class ErrorController
{
	function pageNotFound()
	{
		http_response_code(404);
		echo '<h2>Page Not Found</h2>';
	}
}

$router->set404('ErrorController@pageNotFound');