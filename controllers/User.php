<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 1/19/15
 * Time: 11:02 PM
 */

namespace controllers;

use lib\MVC\Controller\BaseController;
use models\Utils;

/**
 * Class User
 * @package controllers
 */
class User extends BaseController
{

    /**
     * @var
     */
    private $user;

    /**
     * this function will accessed by administrator only
     * get all User data in details
     * as usually we always check token key make sure administrator has validated in database record
     */
    public function index()
    {
        # check token to make sure request from User that exist in database record
        if (true || \models\User::isValidToken($_POST['token'])) {
            # create new object from User model
            $this->user = new \models\User();

            # retrieve User data from database and send the result
            $result = array('status' => 'success', 'users' => $this->user->getUser());
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        } else {
            # status will be restrict when token does not exist ini database record
            $result = array('status' => 'restrict');
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        }
    }

    /**
     * User start using app and check the database that User granted to access feature
     * if User does not register, then offer them to register
     * if email or password mismatch the sign them too
     */
    public function login()
    {
        # send email and password combination to model
        $this->user = new \models\User();
        $result = $this->user->login($_POST["username"], $_POST["password"]);

        # check User state and make sure result contains User data
        if ($result != NULL) {
            # password and email match, then access granted
            $result['status'] = 'granted';
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        } else {
            # password and email mismatch, then access denied
            $result['status'] = 'denied';
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        }
    }

    /**
     * User escape from the system and we clear session data
     * while she/he has logged in from long time in their mobile device
     * the this proceeds is not actually needed because system will destroy session life within 72 hour
     */
    public function logout()
    {
        # check token to make sure request from User that exist in database record
        if (true || \models\User::isValidToken($_POST['token'])) {
            # create new object from User model
            $this->user = new \models\User();

            # call logout function to destroy User session if exist, or it will destroy anyway
            $this->user->logout();

            $result = array('status' => 'success');
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        } else {
            # status will be restrict when token does not exist ini database record
            $result = array('status' => 'restrict');
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        }
    }

    /**
     * User need account from our feature
     * then he/she sent basic data like name, email and password
     * first, check maybe User has registered or User maybe has suspend state
     * tell User if yes or confirm new registration data as new record then send them
     * confirmation email to activate User state
     */
    public function register()
    {
        # create new object first because we will call function to check email availability
        $this->user = new \models\User();

        # check username availability, if does not exist, proceeds as new record
        if ($this->user->checkAvailability($_POST["username"])) {

            # collect registration data in an array
            $data = array(
                "usr_name" => $_POST["name"],
                "usr_email" => $_POST["username"],
                "usr_password" => $_POST["password"]
            );

            # send registration data to model, insert as new record and send confirmation email
            $result = $this->user->registerUser($data);

            # if new record has been added and email has been sent, then give a sign to User
            if ($result) {
                # email or query success
                $result = array('status' => 'success');
                Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
            } else {
                # email or query is getting wrong
                $result = array('status' => 'failed');
                Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
            }
        } else {
            # username has been registered, maybe User did not confirm or forget, then ask she/he to login or open their email client
            $result = array('status' => 'exist');
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        }
    }

    /**
     * request User profile by id
     * return an assoc array
     */
    public function edit()
    {
        # check token to make sure request from User that exist in database record
        if (true || \models\User::isValidToken($_POST['token'])) {
            # create new object from User model
            $this->user = new \models\User();

            # retrieve single row User data by id
            $result = array('status' => 'success', 'user' => $this->user->getOneUserById($_POST['id']));
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        } else {
            # status will be restrict when token does not exist ini database record
            $result = array('status' => 'restrict');
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        }
    }

    /**
     * update User profile data like name or job
     * check token from post request then we have 3 condition
     * 1. success when update complete
     * 2. failed when update fail
     * 3. restrict when sender does not send the token
     */
    public function update()
    {
        # check token to make sure request from User that exist in database record
        if (true || \models\User::isValidToken($_POST['token'])) {
            # create new object from User model
            $this->user = new \models\User();

            # collect User data from post request
            $user = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'work' => $_POST['work'],
                'about' => $_POST['about']
            ];

            $checkPassword = $this->user->login($_POST["username"], $_POST["password"]);

            # check User state and make sure result contains User data
            if ($checkPassword != NULL) {
                if (!empty($_POST['password_new'])) {
                    $user['password'] = $_POST['password_new'];
                    # send User data to model
                    $update = $this->user->updateUser($user);
                } else {
                    # send User data to model
                    $update = $this->user->updateUser($user);
                }

                if ($update) {
                    # User data has updated then success
                    $result = array('status' => 'success');
                    Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
                } else {
                    # User data has not updated then failed
                    $result = array('status' => 'failed');
                    Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
                }
            } else {
                # User data has not updated then failed
                $result = array('status' => 'mismatch');
                Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
            }
        } else {
            # status will be restrict when token does not exist ini database record
            $result = array('status' => 'restrict');
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        }
    }

    /**
     * delete User by id
     * check token from post request then we have 3 condition
     * 1. success when delete complete
     * 2. failed when delete fail
     * 3. restrict when sender does not send the token
     */
    public function delete()
    {
        # check token to make sure request from User that exist in database record
        if (true || \models\User::isValidToken($_POST['token'])) {
            # create new object from User model
            $this->user = new \models\User();

            # delete User by id
            if ($this->user->deleteUser(2)) {
                # User data has deleted then success
                $result = array('status' => 'success');
                Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
            } else {
                $result = array('status' => 'failed');
                # User data has not deleted then failed
                Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
            }
        } else {
            # status will be restrict when token does not exist ini database record
            $result = array('status' => 'restrict');
            Utils::prettyPrint(json_encode($result, JSON_PRETTY_PRINT));
        }
    }
}
