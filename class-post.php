<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Post {

    private $post_id;
    private $title;
    private $content;
    private $user;
    public $connection;

    function __construct($db_handler) {

        $this->connection = $db_handler->connection;
    }

    public function get_post_id() {
        return $this->post_id;
    }

    public function get_post_title() {
        return $this->title;
    }

    public function set_post_title($value) {
      //  $value = htmlspecialchars($value);
        $this->title = $value;
    }

    public function get_post_content() {
        return $this->content;
    }

    public function set_post_content($value) {
        //$value = htmlspecialchars($value);
        $this->content = $value;
    }

    public function get_post_user() {
        return $this->user;
    }

    public function set_post_user($value) {
        $this->user = $value;
    }

    
    public function delete_post($postid){
        $sql = "delete from post where id = ?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $postid);
        mysqli_stmt_execute($stmt);
        print_r("successfully deleted");
    }

    public function upload_post() {

        $sql = "insert into post(uid,title,content,timestamp)"
                . "values(?,?,?,now())";

        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "iss", $this->user, $this->title, $this->content);
        mysqli_stmt_execute($stmt);
        print_r("uploaded successfully");
    }
    
    public function update_post($postid) {

        $sql = "update post "
                . "set title='$this->title',"
                . "content='$this->content'"
                . "where id=$postid";

        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "iss", $this->user, $this->title, $this->content);
        mysqli_stmt_execute($stmt);
        print_r("updated successfully");
    }

    public function get_post_details_by_postid($postid) {
        $isconnected = $this->connection;


        if (!$isconnected)
            echo 'error in db connection';
        else {
            if (isset($postid) && $postid != '') {
                $sql = "select * from post where  id = $postid";
                $results = mysqli_query($isconnected, $sql);
                if (mysqli_num_rows($results) > 0) {
                    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
                    return $row;
                }
            }
        }
    }

}
