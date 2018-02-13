<?php

  session_start();

  if (isset($_SESSION['logueado'])) {
    header('Location: /admin');
  } 


  if (isset($_POST['usuario']) && isset($_POST['password'])) {

    if ($_POST['usuario'] == 'admin' && $_POST['password'] == 'admin') {
      
      $_SESSION['logueado'] = $_POST['usuario'];
      header('Location: /admin');
    } else {

      $incorrecto = 'Pass incorrecto!';
    }
    
  } 

?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title> Login Admin </title>
      <link rel="stylesheet" href="css/style.css">  
</head>
<body>

  <div class="login-page" style=" float: left; margin: 5px">
    <img style="-webkit-box-shadow: 2px 4px 17px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 2px 4px 17px 0px rgba(0,0,0,0.75);
box-shadow: 2px 4px 17px 0px rgba(0,0,0,0.75);filter:brightness(0.6);" src="sitema.png" height="500" width="900">
  </div>

  <div class="login-page" style="  float: right; margin: 70px">
    <div class="form" >
      <button><strong>Ingresar al sistema</strong></button>
      <br>
      <br>
      <br>


      <form class="login-form" action="index.php" method="POST">
        <input type="text" name="usuario" placeholder="usuario"/>
        <input type="password" name="password" placeholder="password"/>
        <button>login</button>
        <p class="message" onclick="alert('Contacta al número 0992 310 230');"> Olvidaste tu pass ? </p>

        <?php if (isset($incorrecto)) { ?>
            <a href=""> <?= $incorrecto ?> </a>
        <?php } ?>
      </form>
    </div>
  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script  src="js/index.js"></script>
</body>
</html>







