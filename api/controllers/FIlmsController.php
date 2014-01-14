<?php

class FilmsController{
	public $db;
	public function __construct(){
		$this->db=new DB\SQL(
		    'mysql:host=localhost;port=3306;dbname=API-film',
		    'root',
		    ''
		);
	}

	public function actionFindAll(){
		Api::response(200, $this->db->exec('SELECT * FROM `film`'));
	}

	public function actionFind(){
		Api::response(200, $this->db->exec('SELECT * FROM `film` WHERE `idFilm`="'.F3::get('PARAMS.id').'"'));
	}

	public function actionSearch(){
		$req = '';
		$join = '`film`';
		foreach(F3::get('GET') as $key => $value){
			if($req != ''){
				$req .= ' && ';
			}
			$req .= '`'.$key.'`="'.$value.'"';
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

	public function actionFindByGenre(){
		Api::response(200, $this->db->exec(
			'SELECT * FROM `film` as f
		 	LEFT JOIN `film_genre` as fg 
		 	ON f.`idFilm` = fg.`idFilm`
		 	LEFT JOIN `genre` as g 
		 	ON fg.`idGenre`=g.`idGenre`
		 	WHERE `genre`="'.F3::get('PARAMS.genre').'"'
		));
	}

	public function actionCreate(){
		if(isset($_POST['nomFilm'])){
			$data = array('création de '.$_POST["nomFilm"].')');
			$this->db->exec('INSERT INTO `film` (nomFilm) VALUES("'.$_POST["nomFilm"].'")');
			Api::response(200, $data);
		}
		else{
			Api::response(400, array('error'=>'Name is missing'));
		}
	}


	public function actionUpdate(){
		$data = array('Update film with id : ' . F3::get('PARAMS.id').' set name ='.F3::get('GET.nomFilm'));
		$this->db->exec('UPDATE  `film` SET  `nomFilm` =  "'.F3::get('GET.nomFilm').'" WHERE  `film`.`idFilm` ='.F3::get('PARAMS.id').';');
		Api::response(200, $data);
	}

	public function actionDelete(){
		$data = array('Delete film with name: ' . F3::get('PARAMS.id'));
		Api::response(200, $data);
	}
}