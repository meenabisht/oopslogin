
<?php
  require 'config.php';
 
  class db_class{
    public $host = 'localhost';
    public $user = 'root';
    public $pass = 'root';
    public $dbname = 'logindb';
    public $conn;
    public $error;
 
    public function __construct(){
      $this->connect();
    }
 
    private function connect(){
      $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
      if(!$this->conn){
        $this->error = "Fatal Error: Can't connect to database".$this->conn->connect_error;
        return false;
      }
    }
 
    public function save($username, $password, $firstname, $lastname){
      $stmt = $this->conn->prepare("INSERT INTO `user` (username, emailid, password) VALUES(?, ?, ?)") or die($this->conn->error);
      $stmt->bind_param("ssss", $username, $emailid, $password);
      if($stmt->execute()){
        $stmt->close();
        $this->conn->close();
        return true;
      }
    }
  }
?>