<?php

class UsersController{
	public $db;

	public function __construct(){
		$this->db=new DB\SQL(
		    'mysql:host=localhost;port=3306;dbname=API-film',
		    'root',
		    ''
		);
	}

	public function actionAuth(){
		$user = new \DB\SQL\Mapper($this->db, 'utilisateur');
		$auth = new \Auth($user, array('id'=>'idUser', 'pw'=>'mdpUser'));
		$auth->basic(); // a network login prompt will display to authenticate the user
	}

	public function actionFindOne(){
		Api::response(200, $this->db->exec('SELECT * FROM `utilisateur` WHERE `idUser`="'.F3::get('PARAMS.id').'"'));
	}
	
	public function actionFindAll(){
		Api::response(200, $this->db->exec('SELECT * FROM `utilisateur`'));
	}

	public function actionSearch(){
		$req = '';
		foreach(F3::get('GET') as $key => $value){
			if($req != ''){
				$req .= ' && ';
			}
			$req .= '`'.$key.'`="'.urldecode($value).'"';
		}
		Api::response(200, $this->db->exec('SELECT * FROM `utilisateur` WHERE '.$req.';'));
	}

	public function actionCreate(){
		if(isset(F3::get('POST')['pseudoUser'])){
			$values = '';
			$req = '';
			foreach(F3::get('POST') as $key => $value){
				if($values != ''){
					$values .= ' , ';
					$req .= ' , ';
				}
				if($key=="mdpUser"){
					$values = md5($values);
				}
				$req .= '`'.$key.'`';
				$values .= '"'.$value.'"';
			}
			$req .= '`token`';
			//TODO generatetoken
			$values .= md5(F3::get('POST')['pseudoUser']);
			die('INSERT INTO `film` ('.$req.') VALUES('.$values.');');
			$data = array('création de '.$_POST["pseudoUser"].'');
			$this->db->exec('INSERT INTO `utilisateur` ('.$req.') VALUES('.$values.');');
			Api::response(200, $data);
		}
		else{
			Api::response(400, array('error'=>'Name is missing'));
		}
	}

	public function actionUpdate(){
		$data = array('Update dog with name: ' . F3::get('PARAMS.id'));
		Api::response(200, $data);
	}

	public function actionDelete(){
		$data = array('Delete dog with name: ' . F3::get('PARAMS.id'));
		Api::response(200, $data);
	}
}