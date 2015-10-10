<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 1/20/15
 * Time: 10:07 PM
 */

namespace controllers;


use lib\MVC\Controller\BaseController;
use models\Note;
use models\User;
use models\Utils;

class Schedule extends BaseController
{

    private $schedule;

    public function index()
    {
        # check token to make sure request from User that exist in database record
        if (true || User::isValidToken($_POST['token'])) {
            # create new object from schedule model
            $this->schedule = new \models\Schedule();

            # retrieve note data from database and send the result
            $user_id = $_POST['user_id'];
            $result = array('status' => 'success', 'schedules' => $this->schedule->getSchedule($user_id));
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        } else {
            # status will be restrict when token does not exist in database record
            $result = array('status' => 'restrict');
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        }
    }

    public function summary()
    {
        # check token to make sure request from User that exist in database record
        if (true || User::isValidToken($_POST['token'])) {
            # create new object from schedule model
            $this->schedule = new \models\Schedule();

            $note = new Note();

            # retrieve note data from database and send the result
            $user_id = $_POST['user_id'];
            $result = array(
                'status' => 'success',
                'total_schedule' => $this->schedule->getTotalSchedule($user_id),
                'total_incoming' => $this->schedule->getTotalIncoming($user_id),
                'total_note' => $note->getTotalNote($user_id),
                'incoming' => $this->schedule->getIncomingSchedule($user_id),
                'today' => $this->schedule->getTodaySchedule($user_id),
                'tomorrow' => $this->schedule->getTomorrowSchedule($user_id)
            );
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
            # create new object from schedule model
            $this->schedule = new \models\Schedule();

            # retrieve single row schedule data by id
            $id = $_POST['id'];
            $result = array('status' => 'success', 'schedule' => $this->schedule->getOneSchedule($id));
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
            $this->schedule = new \models\Schedule();

            # collect data from post request
            $schedule = [
                'user_id' => $_POST['user_id'],
                'event' => $_POST['event'],
                'date' => $_POST['date'],
                'time' => $_POST['time'],
                'location' => $_POST['location'],
                'description' => $_POST['description'],
            ];

            # insert new record
            $result = $this->schedule->insertSchedule($schedule);

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
            $this->schedule = new \models\Schedule();

            # collect note data from post request
            $schedule = [
                'id' => $_POST['id'],
                'event' => $_POST['event'],
                'date' => $_POST['date'],
                'time' => $_POST['time'],
                'location' => $_POST['location'],
                'description' => $_POST['description'],
            ];

            # send User data to model
            if ($this->schedule->updateSchedule($schedule)) {
                # note data has updated then success
                $result = array('status' => 'success');
                Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
            } else {
                # note data has not updated then failed
                $result = array('status' => 'failed');
                Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
            }
        } else {
            # status will be restrict when token does not exist in database record
            $result = array('status' => 'restrict');
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        }
    }

    public function delete()
    {
        # check token to make sure request from User that exist in database record
        if (true || User::isValidToken($_POST['token'])) {
            # create new object from note model
            $this->schedule = new \models\Schedule();

            # delete note by id
            $id = $_POST['id'];
            if ($this->schedule->deleteSchedule($id)) {
                # note data has deleted then success
                $result = array('status' => 'success');
                Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
            } else {
                $result = array('status' => 'failed');
                # note data has not deleted then failed
                Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
            }
        } else {
            # status will be restrict when token does not exist ini database record
            $result = array('status' => 'restrict');
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        }
    }
}
