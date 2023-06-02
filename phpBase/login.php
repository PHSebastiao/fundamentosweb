<?php

include'connect.php';

// is set 
if(isset($_POST['sub'])){
    $u=$_POST['user'];
    $p=$_POST['pass'];
    
   $s= "select * from reg where username='$u' and password= '$p'";   
   $qu= mysqli_query($con, $s);
   if(mysqli_num_rows($qu)>0){
      $f= mysqli_fetch_assoc($qu);
      $_SESSION['id']=$f['id'];
      header ('location:home.php');
   }
   else{
       echo 'username or password does not exist';
   }
  
}
?>
<html>
      
    <head>
        <meta charset="UTF-8">
        <title>Login Sistema</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body>
        <div class="container col-6">
            <h1> Login </h1>
            <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Usuário</label>
                <input type="text" class="form-control" name="user">
            </div>
            <div class="form-group mb-3">
                <label for="pass">Senha</label>
                <input type="password" class="form-control" name="pass">
            </div>
            <button type="submit" name="sub" class="btn btn-primary">Enviar</button>
            <a href="reg.php" class="btn btn-Secondary">cadastrar</a>
        </div>
    </body>
</html>
