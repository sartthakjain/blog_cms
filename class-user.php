<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User {

    private $username;
    private $password;
    private $email_id;
    public $connection;
    private $user_id;

    function __construct($db_handler) {
        $this->connection = $db_handler->connection;
    }

    function create_user($username, $password, $email_id) {
        $this->username = $username;
        $this->password = $password;
        $this->email_id = $email_id;
    }

    public function add_user_to_db() {

        $isconnected = $this->connection;


        if (!$isconnected)
            echo 'error in db connection';
        else {
            if ($this->is_user_exsist()) {
                echo "user already exsist";
            } else {


                $sql = "insert into user (username,password,email)"
                        . " values('"
                        . $this->username
                        . "','"
                        . $this->password
                        . "','"
                        . $this->email_id
                        . " ')";

                if (mysqli_query($isconnected, $sql)) {
                    print_r("inserted successfully");
                    //$this->user_id = $this->get_user_id($this->username);
                }
            }
        }
    }

    public function get_user_details($uid) {

        $isconnected = $this->connection;


        if (!$isconnected)
            echo 'error in db connection';
        else {
            if (isset($uid) && $uid != '') {
                $sql = "select * from user where  uid = $uid";
                $results = mysqli_query($isconnected, $sql);
                if (mysqli_num_rows($results) > 0) {
                    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
                    return $row;
                }
            }
        }
    }

    public function set_user_details_to_object($uid) {
        $row = $this->get_user_details($uid);
        $this->username = $row['username'];
        $this->email_id = $row['email'];
        $this->user_id = $uid;
    }

    public function get_user_id($username) {
        $isconnected = $this->connection;


        if (!$isconnected)
            echo 'error in db connection';
        else {
            if (isset($username) && $username != '') {
                $sql = "select uid from user where  username = '$username'";
                $results = mysqli_query($isconnected, $sql);
                if (mysqli_num_rows($results) == 1) {
                    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
                    return $row['uid'];
                }
            }
        }
    }

    public function is_user_exsist() {

        $sql = "select * from user where username ='$this->username'";

        $results = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($results) > 0) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function check_user_password($username, $password) {
        $sql = "select * from user where username ='$username'";

        $results = mysqli_query($this->connection, $sql);


        if (mysqli_num_rows($results) == 1) {
            $row = mysqli_fetch_array($results);
            if ($row['password'] == $password) {
                print_r("authenticated");
                $this->username = $username;
                $this->password = $password;
                return true;
            } else {
                print_r("incorrect password");
                return false;
            }
        } else {
            print_r("username does not exsist");
            return false;
        }
    }

    public function check_loggedIn() {
        if (!isset($_SESSION['loggedIn']))
            header("location: login.php");
    }

    public function reset_user_object() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    public function get_all_post($uid) {
        $isconnected = $this->connection;


        if (!$isconnected)
            echo 'error in db connection';
        else {
            if (isset($uid) && $uid != '') {
                $sql = "select * from post where  uid = $uid";
                $results = mysqli_query($isconnected, $sql);
                if (mysqli_num_rows($results) > 0) {
                    $row = mysqli_fetch_all($results, MYSQLI_ASSOC);
                    return $row;
                }
            }
        }
    }

    public function chop_user_post($str, $len) {
        if (strlen($str) < $len)
            return $str;
        else {
            $str = substr($str, 0, $len);
            return $str . "....Read More";
        }
    }

}
