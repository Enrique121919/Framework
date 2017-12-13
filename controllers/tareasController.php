<?php
include ROOT."models".DS."tareas.php";
include ROOT."models".DS."categorias.php";

class TareasController  extends AppController{
  public function __construct(){
    parent::__construct();

  }
  public function index(){
    $tareas = Tareas::obtenerTodos();

    $this->set("tareas", $tareas);
  }

  public function agregar(){
    if($_POST){
      
      if (Tareas::guardar($_POST)) {
        $this->set("flashMessage", "Tarea guardada correctamente");
        $this->redirect(array(
          "controller"=>"tareas",
          "action"=>"index"
        ));
        
      } else {
        $this->redirect(array(
          "controller"=>"tareas",
          "action"=>"agregar"
        ));
      }
    } else {
      $categorias = Categorias::obtenerTodos();
      
      $this->set("categorias", $categorias);
    }
  }

  public function editar($id){
    if ($_POST) {
      if (Tareas::guardar($_POST)) {
        $this->set("flashMessage", "Tarea actualizada correctamente");
        $this->redirect(array(
          "controller"=>"tareas",
          "action"=>"index"
        ));
        
      } else {
        $this->redirect(array(
          "controller"=>"tareas",
          "action"=>"editar",
          "args"=>$_POST["id"]
        ));
      }
    } else {
      $tarea = Tareas::buscarPorId($id);
      $categorias = Categorias::obtenerTodos();
      $this->set(compact("tarea","categorias"));
    } 
  }

  public function eliminar($id){
   /* if($_GET){
       if (Tareas::eliminar($id)) {
        $this->redirect(array(
          "controller"=>"tareas",
          "action"=>"index"
        ));
        } else {
          $this->set("flashMessage", "No se puede elimnar");
      }
    }else{
      $categorias = Categorias::obtenerTodos();

      $this->set("categorias", $categorias);
    }   */

    if (!isset($id)|| empty($tarea= Tareas::buscarPorId($id))) {
      $this->set("flashMessage","Tarea no econtrada");
      $this->redirect(array(
          "controller"=>"tareas",
          "action"=>"editar"
        ));
    }else{
        if ($tarea =Tareas::eliminarPorId($id)) {
          $this->set("flashMessage","Tarea eliminada correctamente");
        }else{
          $this->set("flashMessage","La tarea no pudo ser eliminada");
        }
        $this->redirect(array(
          "controller"=>"tareas",
          "action"=>"index"
        ));
    }
  }
}


?>