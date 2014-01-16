<?php

$f3=require('framework/base.php');

$f3->set('DEBUG',1);
if ((float)PCRE_VERSION<7.9)
	trigger_error('PCRE version is out of date');

$f3->config('api/configs/config.ini');
$f3->config('api/configs/routes.ini');

if(isset(F3::get('GET')['token']) && Api::verifToken(F3::get('GET')['token'])){
	unset($_GET['token']);
}else{
	Api::response(400, array('error'=>'incorrect token'));
	return;
}

$f3->route('GET /',
	function($f3) {
		Api::response(404, 0);
	}
);

$f3->run();
