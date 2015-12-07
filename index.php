<?php
include 'Helpers/secure_session.php';
session_secure_start();

if(isset($_GET['auth']) && !isset($_SESSION['id'])){
    if($_SESSION['token'] != $_POST['token']){
      print $_SESSION['token']."<br>";
      print $_POST['token'];
    die("Error with token!");
  }

  if($_GET['auth'] == 'alunno' && isset($_POST['username']) && !empty($_POST['username'])){
         if(isset($_POST['password']) && !empty($_POST['password'])){
                include 'Model/auth_alunno.php';
            }else{
              header("Location: index.php?error=password");
            }
        }


if($_GET['auth'] == 'amministratore' && isset($_POST['username']) && !empty($_POST['username'])){
    if(isset($_POST['password']) && !empty($_POST['password'])){
                  include 'Model/auth_amministratore.php';
              }else{
                header("Location: index.php?error=password");
              }
          }

}

  if(isset($_SESSION['id'])){
    if($_SESSION['type'] == 'Alunno') header("Location: AreaAlunni/");
    else if($_SESSION['type'] == 'Amministratore') header("Location: AreaAmministrazione/");
    else header("Location: AreaRelatore/");

  }
  if(!isset($_SESSION['id']) && !isset($_GET['auth'])){
    $token = hash("sha512", uniqid('auth', true));
      $_SESSION['token'] = $token;
      include 'View/index.html.php';
  }

?>
