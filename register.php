<!DOCTYPE html> 
<html lang="en">
    <head>
        <title>Register</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./styles/register.css" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </head>
    <body class="text-align">
        <main class="form-register w-100 m-auto">
            <form class="register-form" id="register" method="get" action="">
                <h1 class="h3 mb-3 fw-normal">Register an account</h1>
                <div class="form-floating">
                  <input type="text" name="first_name" class="form-control" id="first_name" placeholder="first name"/>
                  <label for="first_name">First Name</label>
                </div>
                <div class="form-floating">
                  <input type="text" name="last_name" class="form-control" id="last_name" placeholder="last name"/>
                  <label for="last_name">Last Name</label>
                </div>
                <div class="form-floating">
                  <input type="text" name="create_user" class="form-control" id="create_user" placeholder="username"/>
                  <label for="create_user">Username</label>
                </div>
                <div class="form-floating">
                  <input type="password" name="create_pass" class="form-control" id="create_pass" placeholder="password"/>
                  <label for="create_pass">Password</label>
                </div>
                <div class="form-floating">
                  <input type="email" name="create_email" class="form-control" id="create-email" placeholder="email"/>
                  <label for="create_email">Email</label>

                  <!-- <input type="email" name="create_email" class="form-control" id="create_email" placeholder="email"/> -->
                  <!-- <label for="create_email">Email</label> -->
                </div>
                &nbsp;
                <button name="register" value="register" class="w-100 btn btn-lg btn-primary" id="submit" type="submit">Register</button>
                <p style="text-align: center;">Already registered? <a href="#" onclick="window.open('login.php', '_self');">Sign In</a></p>
            </form>
        </main>
    </body>
    <?php
    session_start();
    require_once("settings.php");
    $conn = mysqli_connect(settings::$servername, settings::$username, settings::$password, settings::$database);
    $msg = '';

    if(!$conn){
      $msg = "Connection Failed: ";
      die($msg . mysqli_connect_error());
    } else {
      $msg = '<p style="text-align:center">Connection Successful</p>';
      #echo $msg;
    }

    if(isset($_GET['register'])){
      # New User Variables
      $newfirst = ''; $newfirst = $_GET["first_name"];
      $newlast = ''; $newlast = $_GET["last_name"];
      $newuser = ''; $newuser = $_GET["create_user"];
      $newpass = ''; $newpass = $_GET["create_pass"];
      $newemail = ''; $newemail = $_GET["create_email"];
      $sql = "";


      if(strlen($newuser) > 0 && strlen($newpass) > 0 && strlen($newfirst) > 0 && strlen($newpass) > 0){
        $sql = "INSERT INTO users (user_id, first_name, last_name, username, password, email, date_created) VALUES ('', '$newfirst', '$newlast', '$newuser', '$newpass', '$newemail', '')";

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