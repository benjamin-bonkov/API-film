<?php

class FilmsController extends Controller{

	public function actionFindOne(){
		Api::response(200, $this->db->exec('SELECT * FROM `film` WHERE `idFilm`="'.F3::get('PARAMS.id').'"'));
	}
	
	public function actionFindAll(){
		Api::response(200, $this->db->exec('SELECT * FROM `film`'));
	}

	public function actionSearch(){
		$req = '';
		$join = '`film`';
		foreach(F3::get('GET') as $key => $value){
			if($req != ''){
				$req .= ' && ';
			}
			$req .= '`'.$key.'`="'.urldecode($value).'"';
		}
		if(isset(F3::get('GET')['genre'])){
			$join = "`film` as f
		 	LEFT JOIN `film_genre` as fg 
		 	ON f.`idFilm` = fg.`idFilm`
		 	LEFT JOIN `genre` as g 
		 	ON fg.`idGenre`=g.`idGenre`";
		}
		Api::response(200, $this->db->exec('SELECT * FROM '.$join.' WHERE '.$req.';'));
	}
//TODO ajout genres
	public function actionCreate(){
		if(isset(F3::get('POST')['nomFilm'])){
			$values = '';
			$req = '';
			foreach(F3::get('POST') as $key => $value){
				if($values != ''){
					$values .= ' , ';
					$req .= ' , ';
				}
				$req .= '`'.$key.'`';
				$values .= '"'.$value.'"';
			}
			$data = array('création de '.$_POST["nomFilm"].'');
			$this->db->exec('INSERT INTO `film` ('.$req.') VALUES('.$values.');');
			Api::response(200, $data);
		}
		else{
			Api::response(400, array('error'=>'Name is missing'));
		}
	}


	public function actionUpdate(){
		$put = Put::get();
		$req = '';
		foreach($put as $key => $value){
			if($req != ''){
				$req .= ' , ';
			}
			$req .= '`'.$key.'`="'.$value.'"';
		}
		$data = array('Update film with id : ' . F3::get('PARAMS.id'));
		$this->db->exec('UPDATE  `film` SET  '.$req.' WHERE  `film`.`idFilm` ='.F3::get('PARAMS.id').';');
		Api::response(200, $data);
	}

	public function actionDelete(){
		$data = array('Delete film with id : ' . F3::get('PARAMS.id'));
		$this->db->exec('DELETE FROM `film` WHERE `film`.`idFilm` ='.F3::get('PARAMS.id').';');
		Api::response(200, $data);
	}
}
