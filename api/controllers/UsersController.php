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
		var_dump(F3::get('GET'));
		// die();
		if(isset(F3::get('GET')['pseudoUser'])){
			$values = '';
			$req = '';
			foreach(F3::get('GET') as $key => $value){
				if($values != ''){
					$values .= ' , ';
					$req .= ' , ';
				}
				if($key=="mdpUser"){
					$values .= '"'.md5($values).'"';
				}
				$req .= '`'.$key.'`';
				$values .= '"'.$value.'"';
			}
			$req .= ' , `token`';
			//TODO generatetoken
			$values .= ' , "'.md5(F3::get('GET')['pseudoUser']).'"';
			$data = array('creation de '.F3::get('GET')["pseudoUser"].'');
			$this->db->exec('INSERT INTO `utilisateur` ('.$req.') VALUES('.$values.');');
			Api::response(200, $data);
		}
		else{
			Api::response(400, array('error'=>'Name is missing'));
		}
	}

	public function actionUpdate(){
		$put = Put::get();$req = '';
		foreach($put as $key => $value){
			if($req != ''){
				$req .= ' , ';
			}
			$req .= '`'.$key.'`="'.$value.'"';
		}
		$data = array('Update user with id : ' . F3::get('PARAMS.id'));
		$this->db->exec('UPDATE  `utilisateur` SET  '.$req.' WHERE  `utilisateur`.`idUser`="'.F3::get('PARAMS.id').'";');
		Api::response(200, $data);
	}

	public function actionDelete(){
		$data = array('Delete user with id: ' . F3::get('PARAMS.id'));
		$this->db->exec('DELETE FROM `utilisateur` WHERE `utilisateur`.`idUser` ='.F3::get('PARAMS.id').';');
		Api::response(200, $data);
	}
}