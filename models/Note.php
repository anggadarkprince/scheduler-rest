<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 1/20/15
 * Time: 9:49 PM
 */

namespace models;


use lib\Database\DB;
use lib\MVC\Model\BaseModel;

class Note extends BaseModel
{

    private $note;
    private $db;

    public function __construct()
    {
        $this->note = new entities\Note();
        $this->db = new DB();
    }

    public function getTotalNote($user)
    {
        # get count note total
        $this->db->bind("user_id", $user);
        $result = $this->db->row("
            SELECT COUNT(*) AS TOTAL
            FROM notes
            WHERE user_id = :user_id
        ");
        return $result["TOTAL"];
    }

    public function getNote($user)
    {
        $this->db->bind("user_id", $user);
        $result = $this->db->query("SELECT * FROM notes WHERE user_id = :user_id");
        return $result;
    }

    public function getOneNote($id)
    {
        $this->note->id = $id;
        $this->note->find();
        return $this->note->variables;
    }

    public function insertNote($note)
    {
        $this->note->title = $note['title'];
        $this->note->label = $note['label'];
        $this->note->note = $note['note'];
        $this->note->user_id = $note['user_id'];
        return $this->note->create();
    }

    public function updateNote($note)
    {
        $this->note->id = $note['id'];
        $this->note->title = $note['title'];
        $this->note->label = $note['label'];
        $this->note->note = $note['note'];
        return $this->note->save();
    }

    public function deleteNote($id)
    {
        $this->note->id = $id;
        return $this->note->delete();
    }

} 