<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 1/20/15
 * Time: 1:18 AM
 */

namespace models;

use lib\Database\DB;
use lib\MVC\Model\BaseModel;

class User extends BaseModel
{

    private $user;
    private $db;

    public function __construct()
    {
        $this->user = new entities\User();
        $this->db = new DB();
    }

    public static function isValidToken($token)
    {
        $db = new DB();

        $db->bind("token", $token);
        $result = $db->row("
            SELECT *
            FROM users
            WHERE token = :token
        ");

        if ($result != null) {
            return true;
        }
        return false;
    }

    public function login($username, $password, $oncheck = false)
    {
        $this->db->bind("username", $username);
        $this->db->bind("password", md5($password));

        $user = $this->db->row("
            SELECT *
            FROM users
            WHERE username = :username
                AND password = :password
        ");

        if ($oncheck) {
            return $user;
        }

        session_start();

        $_SESSION['sch_id'] = $user['id'];
        $_SESSION['sch_token'] = $user['token'];
        $_SESSION['sch_username'] = $user['username'];
        $_SESSION['sch_name'] = $user['name'];

        return $user;
    }

    public function logout()
    {
        unset($_SESSION['sch_id']);
        unset($_SESSION['sch_token']);
        unset($_SESSION['sch_username']);
        unset($_SESSION['sch_name']);
    }

    public function getUser()
    {
        $result = $this->user->all();
        return $result;
    }

    public function checkAvailability($email)
    {
        $this->db->bind("username", $email);
        $result = $this->db->row("
            SELECT *
            FROM users
            WHERE username = :username
        ");

        if ($result != null) {
            return false;
        }
        return true;
    }

    public function registerUser($data)
    {
        $token = md5(uniqid() . $data['username']);

        $this->user->token = $token;
        $this->user->name = $data['name'];
        $this->user->username = $data['username'];
        $this->user->password = md5($data['password']);
        return $this->user->create();

        return false;
    }

    public function getOneUserById($id)
    {
        $this->user->id = $id;
        $this->user->find();
        return $this->user->variables;
    }

    public function getOneUserByUsername($username)
    {
        $this->user->id = $username;
        $this->user->find();
        return $this->user->variables;
    }

    public function updateUser($user)
    {
        $this->user->id = $user['id'];
        $this->user->name = $user['name'];
        $this->user->work = $user['work'];
        $this->user->about = $user['about'];
        $this->user->reminder = $user['reminder'];

        if (isset($user['password'])) {
            $this->user->password = md5($user['password']);
        }

        return $this->user->save();
    }

    public function deleteUser($id)
    {
        $this->user->id = $id;
        return $this->user->delete();
    }

} 