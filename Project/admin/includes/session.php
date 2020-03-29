<?php

class Session
{

    private $signedIn = false;
    public $userId;

    function __construct()
    {
        session_start();
        $this->checkTheLigin();
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

    private function checkTheLigin()
    {
        if (isset($_SESSION['user_id'])) {
            $this->userId = $_SESSION['user_id'];
            $this->signedIn = true;
        } else {
            unset($this->userId);
            $this->signedIn = false;
        }
    }
}
