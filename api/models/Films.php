<?php
class Films {

    public function __construct() {
    }
 
    public function findAll($db) {
        return $db->exec('SELECT * FROM `film`');
    }
 
    public function search($db) {
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
        return $db->exec('SELECT * FROM '.$join.' WHERE '.$req.';');
    }
}