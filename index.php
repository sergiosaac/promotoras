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
  <div class="login-page">
  <div class="form">
    
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
