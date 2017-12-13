<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Framework</title>
    <link rel="stylesheet" href="<?php echo $layoutParams["route_css"];?>/bootstrap.css">
    <script src="<?php echo $layoutParams["route_js"];?>/jquery.js"></script>
  </head>
  <body>
    <?php
    if (isset($flashMessage)) {
      echo $flashMessage;
    }

     ?>
