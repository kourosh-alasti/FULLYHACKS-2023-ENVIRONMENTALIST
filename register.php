<!DOCTYPE html> 
<html lang="en">
    <head>
        <title>Register</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./styles/register.css" type="text/css">
    </head>
    <body>
        <div class="register-container">
            <form class="register-form" id="register" method="get" action="">
                <input type="text" name="first_name" id="first_name" placeholder="first name"/>
                <input type="text" name="last_name" id="last_name" placeholder="last name"/>
                <input type="text" name="create_user" id="create_user" placeholder="username"/>
                <input type="text" name="create_pass" id="create_pass" placeholder="password"/>
                <input type="email" name="create_email" id="create_email" placeholder="email"/>
                <input type="date" name="create_date" id="create_date"/>
                <input type="submit" name="create" id="create" value="register"/>
                <p class="message">Already registered? <a href="#" onclick="window.open('login.php', '_self');">Sign In</a></p>
            </form>
        </div>
    </body>
    <?php
    session_start();
    require_once("settings.php");
    $conn = mysqli_connect(Settings::$servername, Settings::$username, Settings::$password, Settings::$database);
    $msg = '';

    if(!$conn){
      $msg = "Connection Failed: ";
      die($msg . mysqli_connect_error());
    } else {
      $msg = '<p style="text-align:center">Connection Successful</p>';
      #echo $msg;
    }

    if(isset($_GET['create'])){
      # New User Variables
      $newfirst = ''; $newfirst = $_GET["first_name"];
      $newlast = ''; $newlast = $_GET["last_name"];
      $newuser = ''; $newuser = $_GET["create_user"];
      $newpass = ''; $newpass = $_GET["create_pass"];
      $newemail = ''; $newemail = $_GET["create_email"];
      $newdate = ''; $newdate = $_GET["create_date"];
      $sql = "";


      if(strlen($newuser) > 0 && strlen($newpass) > 0 && strlen($newfirst) > 0 && strlen($newpass) > 0){
        $sql = "INSERT INTO users (user_id, first_name, last_name, username, password, email, date_created) VALUES ('', '$newfirst', '$newlast', '$newuser', '$newpass', '$newemail', '$newdate')";

        if(mysqli_query($conn, $sql)){
          echo "<br><br> New record created successfully";
          header('Location: login.php');
        } else {
          echo "<br><br> Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      }
    }

    mysqli_close($conn);
  ?>
</html>