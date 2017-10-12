<?php
  session_start();
  if($_GET['submit'] != null)
  {
      if ($_GET['submit'] == "OK")
      {
        $_SESSION['login'] = $_GET['login'];
        $_SESSION['passwd'] = $_GET['passwd'];
      }
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <style>
      form  { border: 3px solid #f1f1f1;}
      input[type=text] {
          width: 100%;
          padding: 12px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          box-sizing: border-box;
      }
      input[type=submit]{
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        width: 100%;
      }
      input[type=submit]:hover { opacity: 0.8;}
      #debug {
          background-color: black;
          color: white;
          width: 100%;
          height: 100px;
          font-size: 12px;
          padding: 8px 0 0 0;
          margin: 15px  0 0 0;
          border: 1px solid grey;
      }
    </style>
  </head>
  <body>
    <div id="main">
      <h1>edit profil</h1>
      <div id="login">
        <form class="" action="index.php" method="GET">
          <label>login: </label>
          <input type="text" name="login" value="<?php if ($_SESSION['login'] != null) {echo $_SESSION['login'];}?>"/></br>
          <label>password: </label>
          <input type="text" name="passwd" value="<?php if ($_SESSION['passwd'] != null) {echo $_SESSION['passwd'];}?>"/></br>
          <input type="submit" name="submit" value="OK"/>
        </form>
      </div>
  </div>
    <div id="debug">
      <?php
        print_r($_GET);
        echo "</br>";
        print_r($_SESSION);
       ?>
    </div>
  </body>
</html>
