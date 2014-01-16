<?php

class UsersController extends Controller{

	// public function actionAuth(){
	// 	$user = new \DB\SQL\Mapper($this->db, 'utilisateur');
	// 	$auth = new \Auth($user, array('id'=>'pseudoUser', 'pw'=>'mdpUser'));
	// 	$auth->basic(); // a network login prompt will display to authenticate the user
	// 	if ($auth) {
	// 		echo 'error';
	// 	} else {
	// 		echo 'gud';
	// 	}
	// }

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
		if(isset(F3::get('GET')['pseudoUser'])){
			if(count($this->db->exec('SELECT * FROM `utilisateur` WHERE `pseudoUser`="'.F3::get('GET')['pseudoUser'].'"'))>0){
				Api::response(400, array('error'=>'Name is already taken'));
				return;
			}
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
			$values .= ' , "'.uniqid(rand(), true).'"';
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

	public function actionLike(){
		$data = array('User : ' . F3::get('GET')['idUser'].' liked '. F3::get('GET')['idFilm']);
		$this->db->exec('INSERT INTO `like` (`idUser`, `idFilm`) VALUES ("'. F3::get('GET')['idUser'] .'", "'. F3::get('GET')['idFilm'] .'");');
		Api::response(200, $data);
	}

	public function actionUnlike(){
		$data = array('User : ' . F3::get('GET')['idUser'].' unliked '. F3::get('GET')['idFilm']);

		$this->db->exec('DELETE FROM `like` WHERE `idUser` ="'. F3::get('GET')['idUser'] .'"&& `idFilm` ="'.F3::get('GET')['idFilm'] .'";');
		Api::response(200, $data);
	}

	public function actionLiked(){
		Api::response(200, $this->db->exec('SELECT * FROM `film` as f
		 	LEFT JOIN `like` as l 
		 	ON f.`idFilm` = l.`idFilm`
		 	LEFT JOIN `utilisateur` as u 
		 	ON l.`idUser`=u.`idUser`
		 	WHERE u.`idUser`='.F3::get('PARAMS.id').';'));
	}
}