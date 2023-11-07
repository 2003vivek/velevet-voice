<?php
class UserDetail{

    private $username;
    private $password;
    private $email;
    private $country;
    private $city;
    
    
    function setusername($name){
        $this->username=$name;
    }
    function getusername(){
        return $this->username;
    }

    function setpassword($password){
            $this->password=$password;
    }
    function getpassword(){
        return $this->password;
    }

    function setemail($email){
            $this->email=$email;
    }
    function getemail(){
        return $this->email;
    }

    function setcountry($country){
         $this->country=$country;
    }
    
    function getcountry(){
        return $this->country;
    }

    function setcity($city){
         $this->city=$city;
    }

    function getcity(){
        return $this->city;
    }


}
?>