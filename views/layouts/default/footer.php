<script>
  $("#eliminar").click(function() {
    if (confirm("Seguro de eliminar?")) {
      $("#eliminar").attr("href", "http://localhost/it101/practica4/tareas/index");
    }else {
      return false;
    }
  });
</script>