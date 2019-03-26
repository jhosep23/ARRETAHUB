<?php 
class conectionDB {

function conexion(){ 

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'pruebarest';
      try{

        $mbd = new PDO("mysql:host=".$host.";dbname=".$db, $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
        
      } catch (PDOException $e) {
          print "¡Error!: " . $e->getMessage() . "<br/>";
          die();
      }
      return $mbd;
    }


}
 ?>
