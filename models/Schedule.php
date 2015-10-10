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

class Schedule extends BaseModel
{

    private $schedule;
    private $db;

    public function __construct()
    {
        $this->schedule = new entities\Schedule();
        $this->db = new DB();
    }

    public function getTotalSchedule($user)
    {
        # get count schedule total
        $this->db->bind("user_id", $user);
        $result = $this->db->row("
            SELECT COUNT(*) AS TOTAL
            FROM schedules
            WHERE user_id = :user_id
        ");
        return $result["TOTAL"];
    }

    public function getTotalIncoming($user)
    {
        # get count schedule total
        $this->db->bind("user_id", $user);
        $result = $this->db->row("
            SELECT COUNT(*) AS TOTAL
            FROM schedules
            WHERE user_id = :user_id
            AND date >= CURRENT_DATE
        ");
        return $result["TOTAL"];
    }

    public function getIncomingSchedule($user)
    {
        $this->db->bind("user_id", $user);
        $result = $this->db->query("
            SELECT *
            FROM schedules
            WHERE user_id = :user_id
            AND date >= CURRENT_DATE
            ORDER BY date, time DESC
        ");
        return $result;    }

    public function getTodaySchedule($user)
    {
        $this->db->bind("user_id", $user);
        $result = $this->db->query("
            SELECT *
            FROM schedules
            WHERE user_id = :user_id
            AND date = CURRENT_DATE
            ORDER BY date, time DESC
        ");
        return $result;
    }

    public function getTomorrowSchedule($user)
    {
        $this->db->bind("user_id", $user);
        $result = $this->db->query("
            SELECT *
            FROM schedules
            WHERE user_id = :user_id
            AND date = CURRENT_DATE + 1
            ORDER BY date, time DESC
        ");
        return $result;
    }

    public function getSchedule($user)
    {
        $this->db->bind("user_id", $user);
        $result = $this->db->query("
          SELECT *
          FROM schedules
          WHERE user_id = :user_id
          ORDER BY date, time DESC
        ");
        return $result;
    }

    public function getOneSchedule($id)
    {
        $this->schedule->id = $id;
        $this->schedule->find();
        return $this->schedule->variables;
    }

    public function insertSchedule($schedule)
    {
        $this->schedule->event = $schedule['event'];
        $this->schedule->date = $schedule['date'];
        $this->schedule->time = $schedule['time'];
        $this->schedule->location = $schedule['location'];
        $this->schedule->description = $schedule['description'];
        $this->schedule->user_id = $schedule['user_id'];
        return $this->schedule->create();
    }

    public function updateSchedule($schedule)
    {
        $this->schedule->id = $schedule['id'];
        $this->schedule->event = $schedule['event'];
        $this->schedule->date = $schedule['date'];
        $this->schedule->time = $schedule['time'];
        $this->schedule->location = $schedule['location'];
        $this->schedule->description = $schedule['description'];
        return $this->schedule->save();
    }

    public function deleteSchedule($id)
    {
        $this->schedule->id = $id;
        return $this->schedule->delete();
    }

} 