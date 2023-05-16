<?php
include '../dbconfig.php';
 class User {
    protected $email;
    protected $password;
    protected $username;
    protected  $isAuthenticated = false;
  
    public function __construct($email, $password,$username=null) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
      //try {
        $connexion=$GLOBALS['connexion'];
        $stmt = $connexion->prepare('SELECT * FROM users WHERE email = ? ');
        $stmt->execute([$this->email]);
        $row = $stmt->fetch();
        if ($row && password_verify($this->password, $row['password'])) {
          $this->isAuthenticated = true;
          $this->username = $row['username'];
       // }
      //} catch (PDOException $e) {
        //echo "Connection failed: " . $e->getMessage();
      }
    }

    
    // Getter for email
    public function getemail() {
      return $this->email;
    }

    // Getter for password
    public function getPassword() {
      return $this->password;
    }
    //isAuthenticated
    public function isAuthenticated() {
      return $this->isAuthenticated;
    }
    // Getter for username
    public function getusername() {
      return $this->username;
    }

    public function register()
    {
          //try {
            $connexion=$GLOBALS['connexion'];
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
            $stmt = $connexion->prepare('INSERT INTO users (username,email, password) VALUES (?, ?,?)');
            $stmt->execute([$this->username,$this->email, $this->password]);
            return true;
          //} catch (PDOException $e) {
            //echo "Connection failed: " . $e->getMessage();
            //return false;
          //}
    }
}





?>