<?php

class Api{
	
	public static function response($code, $data, $error = false){

		header('Content-type: application/json; charset=utf-8');
		header('HTTP/1.1 '. self::status($code));
	
		$response = array('meta'=>array('code'=>$code));

		if($error){
			$response['meta']['error'] = $error;
		}
		else{
			if($data){
				$response['data'] = $data;
			}
		}

		print json_encode($response);
	}

	public static function verifToken($token){
		$db=new DB\SQL(
		    'mysql:host=localhost;port=3306;dbname=API-film',
		    'root',
		    ''
		);
		return count($db->exec('SELECT * FROM `utilisateur` WHERE `token`="'.$token.'"')) > 0;
	}

	private static function status($code){
		switch ($code) {
			case 200:
				return $status = $code . 'OK';
				break;

			case 400:
				return $status = $code . 'Bad Request';
				break;

			case 404:
				return $status = $code . 'Not Found';
				break;
			
			default:
				return $status = '400 Bad Request';
				break;
		}
	}
}