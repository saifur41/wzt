<?php
/*
$link = @mysql_connect('localhost', 'mhl397', 'Developer2!');//lonestaar

*/
class Database{
  
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "lonestaar";
    private $username = "mhl397";
    private $password = "Developer2!";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>