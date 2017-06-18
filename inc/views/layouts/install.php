<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>LightCloud | Installation</title>
    <meta name="description" content="An another opensource cloud system.">
    <meta name="author" content="Roch Blondiaux">

    <!-- Bootstrap -->
    <link href="<?=APP_URL?>/inc/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=APP_URL?>/inc/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

</head>

<body class="container" id="home">

<div class="panel panel-primary">
    <style media="screen">
      #home {
          margin-top: 5%;
      }
    </style>


    <div class="panel-heading"><i class="fa fa-gears"></i> Installation wizzard</div>

    <div class="panel-body">
      <?=$this->section('content')?>
    </div>

</div>

<!-- Bootstrap -->
<script src="<?=APP_URL?>/inc/assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>
