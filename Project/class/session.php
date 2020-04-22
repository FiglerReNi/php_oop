<?php

class Session
{
    private $signedIn = false;
    public $userId;
    private $message;
    public $count;

    function __construct()
    {
        session_start();
        $this->visitorCount();
        $this->checkTheLogin();
        $this->checkMessage();
    }

    public function isSignedIn()
    {
        return $this->signedIn;
    }

    public function login($user)
    {
        if ($user) {
            $_SESSION['user_id'] = $user->id;
            $this->userId = $_SESSION['user_id'];
            $this->signedIn = true;
        }
    }

    public function logOut()
    {
        unset($_SESSION['user_id']);
        unset($this->userId);
        $this->signedIn = false;
    }

    private function checkTheLogin()
    {
        if (isset($_SESSION['user_id'])) {
            $this->userId = $_SESSION['user_id'];
            $this->signedIn = true;
        } else {
            unset($this->userId);
            $this->signedIn = false;
        }
    }

    public function message($msg = "")
    {
        if (!empty($msg)) {
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }

    private function checkMessage()
    {
        if (isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }

    public function visitorCount(){
        if(isset($_SESSION['count'])){
            return $this->count = $_SESSION['count']++;
        }else{
            return $_SESSION['count'] = 1;
        }
    }
}
