<?php
include ROOT."models".DS."tareas.php";
include ROOT."models".DS."categorias.php";

class CategoriasController  extends AppController{
  public function __construct(){
    parent::__construct();

  }
  public function index(){
    $categorias = Categorias::obtenerTodos();

    $this->set("categorias", $categorias);
  }

  public function agregar(){
    if($_POST){
      
      if (Categorias::guardar($_POST)) {
        $this->set("flashMessage", "Categoria guardada correctamente");
        $this->redirect(array(
          "controller"=>"categorias",
          "action"=>"index"
        ));
        
      } else {
        $this->redirect(array(
          "controller"=>"categorias",
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
      if (Categorias::guardar($_POST)) {
        $this->set("flashMessage", "Categoria actualizada correctamente");
        $this->redirect(array(
          "controller"=>"categorias",
          "action"=>"index"
        ));
        
      } else {
        $this->redirect(array(
          "controller"=>"categorias",
          "action"=>"editar",
          "args"=>$_POST["id"]
        ));
      }
    } else {
      $categoria = Categorias::buscarPorId($id);
      $this->set(compact("categoria"));
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

    if (!isset($id)|| empty($categoria= Categorias::buscarPorId($id))) {
      $this->set("flashMessage","Categoria no econtrada");
      $this->redirect(array(
          "controller"=>"categorias",
          "action"=>"editar"
        ));
    }else{
        if ($categoria =Categorias::eliminarPorId($id)) {
          $this->set("flashMessage","Categoria eliminada correctamente");
        }else{
          $this->set("flashMessage","La categoria no pudo ser eliminada");
        }
        $this->redirect(array(
          "controller"=>"categorias",
          "action"=>"index"
        ));
    }
  }
}


?>