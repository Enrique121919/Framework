<?php

/**
 *
 */
class Categorias {
  private static $nombre = "categorias";

  public static function obtenerTodos(){
    $categoria = Database::ObtenerInstancia();

    $sql = "SELECT id, nombre FROM ".self::$nombre;

    $resultado = $categoria->query($sql);

 foreach (range(0, $resultado->columnCount()-1) as $column_index) {
      $meta[] = $resultado->getColumnMeta($column_index);

    }

    $resultados = $resultado->fetchAll();

    for ($i=0; $i < count($resultados); $i++) {
      $j=0;
      foreach($meta as $value) {
        $rows[$i][$value["table"]][$value["name"]] = $resultados[$i][$j];
        $j++;
      }
    }
    return $rows;

  }

    public static function guardar($datos=array()){
    $categoria = Database::obtenerInstancia();
    
    if (isset($datos["id"])) {
      //si el id existe quiere decir que estamos actualizando
      $consulta = $categoria->prepare("UPDATE ".self::$nombre." SET nombre=:nombre WHERE id=:id");
      $consulta->bindParam(":id", $datos["id"]);
      $consulta->bindParam(":nombre", $datos["nombre"]);
      if ($consulta->execute()) {
         return true;
      }else{
        return false;
      }

    } else {
      //en caso de no pasar id se hace un registro nuevo
      $consulta = $categoria->prepare("INSERT INTO ".self::$nombre.
        " (nombre)
          VALUES (:nombre)");
      $consulta->bindParam(":nombre", $datos["nombre"]);
      if ($consulta->execute()) {
        return true;
      } else {
        return false;
      }
      

    }
  }

  public static function eliminarPorId($id)
  {
    $categoria = Database::obtenerInstancia();
    $consulta = $categoria->prepare("DELETE FROM ".self::$nombre." WHERE id=:id");
    $consulta->bindParam(":id", $id);  
     if ($consulta->execute()) {
         return true;
      }else{
        return false;
      }
  }

  public static function buscarPorId($id){
    $categoria = Database::obtenerInstancia();
    $consulta = $categoria->prepare("SELECT * FROM ".self::$nombre." WHERE id=:id");
    $consulta->bindParam(":id", $id);
    $consulta->execute();
    $registro = $consulta->fetch();
    if ($registro) {
      return $registro;
    } else {
      return false;

    }
  }

}

 ?>
