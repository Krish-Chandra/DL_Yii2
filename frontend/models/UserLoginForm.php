<?php
namespace app\models;
class UserLoginForm extends LoginForm
{
    public function getUser()
    {
        if ($this->_user === false) {
            // $this->_user = User::findByUsername($this->username);
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

}