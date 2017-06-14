<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 09.03.2017
 * Time: 1:50
 */

class Dashboard_Model extends Model {
    function __construct() {
        parent::__construct();
    }

    function xhrInsert() {
        $text = $_POST['text'];
        $sth = $this->database->prepare('INSERT INTO data(text) VALUES(:text)');
        $sth->execute(array(':text' => $text));
        $data = array('text' => $text, 'id' => $this->db->lastInsertId());
        echo json_encode($data);
    }

    public function xhrGetListings() {
        $sth = $this->database->prepare("SELECT * FROM data");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $data = $sth->fetchAll();
        echo json_encode($data);
    }

    public function xhrDeleteListing() {
        $id = $_POST['id'];
        $sth = $this->database->prepare('DELETE FROM data WHERE id = "'.$id.'"');
        $sth->execute();
    }
}