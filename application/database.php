<?php

/**
 *
 */
class Database
{

  private $controlador;
  private $host;
  private $base;
  private $usuario;
  private $clave;
  private $puerto;
  private static $instancia = null;

  private function __construct(
     $controlador = "mysql",
     $host        = "localhost",
     $base        = "test",
     $usuario     = "root",
     $clave       = "",
     $puerto      = "3306"
  ){
     $this->controlador = $controlador;
     $this->host        = $host;
     $this->base        = $base;
     $this->usuario     = $usuario;
     $this->clave       = $clave;
     $this->puerto      = $puerto;
     try {
       self::$instancia = new PDO(
         $this->controlador.':host='.
         $this->host.';port='.$this->puerto.';dbname='.
         $this->base,
         $this->usuario,
         $this->clave
       );

     } catch (PDOException $e) {
       print "¡Erro!: ".$e->getMessage();
       die();
     }


  }

  public static function obtenerInstancia(){
    if (!self::$instancia) {
      new self();
    }
    return self::$instancia;

  }
  public static function cerraInstancia(){
    self::$instancia =null;
  }
}


 ?>
