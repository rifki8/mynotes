<?php

     class Database{
          private $host  = 'localhost';
          private $user  = 'mrifkimy_rifki';
          private $password   = "rifkinotes86";
          private $database  = "mrifkimy_notes";

          public function koneksi(){
               try {
                    $conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
                    return $conn;
               }
               catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
               }
          }   
     }

?>
