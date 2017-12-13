<?php
/**
 *
 */
class tareas{
  private static $nombre = "tareas";

  public static function obtenerTodos(){

    $tarea = Database::obtenerInstancia();

    $sql = "SELECT * FROM ".self::$nombre."
    INNER JOIN categorias
    ON tareas.categoria_id = categorias.id ";

    $resultado = $tarea->query($sql);


    foreach (range(0, $resultado->columnCount()-1) as $column_index) {
      $meta[] = $resultado->getColumnMeta($column_index);

    }

    $resultados = $resultado->fetchAll(PDO::FETCH_NUM);

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
    $tarea = Database::obtenerInstancia();

    if (isset($datos["id"])) {
      //si el id existe quiere decir que estamos actualizando
      $consulta = $tarea->prepare("UPDATE ".self::$nombre." SET categoria_id=:categoria_id, nombre=:nombre ,descripcion=:descripcion ,fecha=:fecha ,prioridad=:prioridad, status=:status WHERE id=:id");
      $consulta->bindParam(":id", $datos["id"]);
      $consulta->bindParam(":nombre", $datos["nombre"]);
      $consulta->bindParam(":descripcion", $datos["descripcion"]);
      $consulta->bindParam(":categoria_id", $datos["categoria_id"]);
      $consulta->bindParam(":fecha", $datos["fecha"]);
      $consulta->bindParam(":prioridad", $datos["prioridad"]);
      $consulta->bindParam(":status", $datos["status"]);
      if ($consulta->execute()) {
         return true;
      }else{
        return false;
      }

    } else {
      //en caso de no pasar id se hace un registro nuevo
      $consulta = $tarea->prepare("INSERT INTO ".self::$nombre.
        " (nombre, descripcion, categoria_id, fecha, prioridad)
          VALUES (:nombre, :descripcion, :categoria_id, :fecha, :prioridad)");
      $consulta->bindParam(":nombre", $datos["nombre"]);
      $consulta->bindParam(":descripcion", $datos["descripcion"]);
      $consulta->bindParam(":categoria_id", $datos["categoria_id"]);
      $consulta->bindParam(":fecha", $datos["fecha"]);
      $consulta->bindParam(":prioridad", $datos["prioridad"]);
      if ($consulta->execute()) {
        return true;
      } else {
        return false;
      }


    }
  }

  public static function eliminarPorId($id)
  {
    $tarea = Database::obtenerInstancia();
    $consulta = $tarea->prepare("DELETE FROM ".self::$nombre." WHERE id=:id");
    $consulta->bindParam(":id", $id);
     if ($consulta->execute()) {
         return true;
      }else{
        return false;
      }
  }

  public static function buscarPorId($id){
    $tarea = Database::obtenerInstancia();
    $consulta = $tarea->prepare("SELECT * FROM ".self::$nombre." WHERE id=:id");
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
