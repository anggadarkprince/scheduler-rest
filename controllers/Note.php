<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 1/20/15
 * Time: 10:07 PM
 */

namespace controllers;


use lib\MVC\Controller\BaseController;
use models\User;
use models\Utils;

class Note extends BaseController
{

    private $note;

    public function index()
    {
        # check token to make sure request from User that exist in database record
        if (true || User::isValidToken($_POST['token'])) {
            # create new object from note model
            $this->note = new \models\Note();

            # retrieve note data from database and send the result
            $user_id = $_POST['user_id'];
            $result = array('status' => 'success', 'notes' => $this->note->getNote($user_id));
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        } else {
            # status will be restrict when token does not exist ini database record
            $result = array('status' => 'restrict');
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        }
    }

    public function edit()
    {
        # check token to make sure request from User that exist in database record
        if (true || User::isValidToken($_POST['token'])) {
            # create new object from note model
            $this->note = new \models\Note();

            # retrieve single row note data by id
            $id = $_POST['id'];
            $result = array('status' => 'success', 'note' => $this->note->getOneNote($id));
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        } else {
            # status will be restrict when token does not exist ini database record
            $result = array('status' => 'restrict');
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        }
    }

    public function insert()
    {
        # check token to make sure request from User that exist in database record
        if (true || User::isValidToken($_POST['token'])) {
            # create new object from note model
            $this->note = new \models\Note();

            # collect data from post request
            $note = [
                'user_id' => $_POST['user_id'],
                'title' => $_POST['title'],
                'label' => $_POST['label'],
                'note' => $_POST['note'],
            ];

            # insert new record
            $result = $this->note->insertNote($note);

            # if new record has been added
            if ($result) {
                # query success
                $result = array('status' => 'success');
                Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
            } else {
                # query is getting wrong
                $result = array('status' => 'failed');
                Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
            }
        } else {
            # status will be restrict when token does not exist ini database record
            $result = array('status' => 'restrict');
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        }
    }

    public function update()
    {
        # check token to make sure request from User that exist in database record
        if (true || User::isValidToken($_POST['token'])) {
            # create new object from note model
            $this->note = new \models\Note();

            # collect note data from post request
            $note = [
                'id' => $_POST['id'],
                'title' => $_POST['title'],
                'label' => $_POST['label'],
                'note' => $_POST['note'],
            ];

            # send User data to model
            if ($this->note->updateNote($note)) {
                # note data has updated then success
                $result = array('status' => 'success');
                Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
            } else {
                # note data has not updated then failed
                $result = array('status' => 'failed');
                Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
            }
        } else {
            # status will be restrict when token does not exist ini database record
            $result = array('status' => 'restrict');
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        }
    }

    public function delete()
    {
        # check token to make sure request from User that exist in database record
        if (true || User::isValidToken($_POST['token'])) {
            # create new object from note model
            $this->note = new \models\Note();

            # delete note by id
            $id = $_POST['id'];
            if ($this->note->deleteNote($id)) {
                # note data has deleted then success
                $result = array('status' => 'success');
                Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
            } else {
                $result = array('status' => 'failed');
                # note data has not deleted then failed
                Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
            }
        } else {
            # status will be restrict when token does not exist in database record
            $result = array('status' => 'restrict');
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        }
    }
} 