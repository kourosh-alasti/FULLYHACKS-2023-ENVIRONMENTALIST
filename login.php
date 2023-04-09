<!DOCTYPE html> 
<html lang="en">
    <head> 
        <title>Login</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./styles/login.css" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </head>
    <body> 
        <div class="login-container"> 
            <form class="login-form" id="login" method="get" action="">
                <div class="form-floating">
                    <label for="user">Username</label>
                    <input type="text" name="user" id="user floatingInput" class="form-control" placeholder="username"/>
                </div>
                <div>
                    <label for="pass">Password</label>
                    <input type="text" name="pass" id="pass floatingInput" class="placeholder="password"/>
                </div>
                &nbsp;
                <button name="login" value="login" class="w-100 btn btn-primary" id="submit" type="submit">login</button>
                <!-- <input type="submit" name="login" value="login" id="submit" placeholder="login"/>  -->
                <p class="message">No account? <a href="#" onclick="window.open('register.php', '_self');"> Create an account</a></a></p>
            </form>
        </div>
    </body>

    <?php 
        session_start(); 
        require_once("settings.php");
        $conn = mysqli_connect(settings::$servername, settings::$username, settings::$password, settings::$database);
        $msg = ''; 

        if(!$conn) {
            $msg = "Connection Failed: "; 
            die($msg . mysqli_connect_error());
        } else {
            $msg = '<p style="text-align:center">Connection Successful</p>';
        }

        if(isset($_GET['login'])) {
            $loginuser = ""; $loginuser = mysqli_real_escape_string($conn, $_GET['user']);
            $loginpass = ""; $loginpass = mysqli_real_escape_string($conn, $_GET['pass']);

            if($loginuser != "" && $loginpass != "") {
                $sql = "SELECT count(*) as userCount FROM users WHERE username='".$loginuser."' AND password='".$loginpass."'"; 
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result); 

                $accountCounter = $row['userCount']; 

                if($accountCounter > 0) {
                    $sql = "SELECT user_id FROM users WHERE username='".$loginuser."' AND password='".$loginpass."'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    if(!$row){ 
                        die($sql);
                    } else {
                        $_SESSION['user_acc'] = $row['user_id'];
                        header('Location: profile.php');
                    }
                } else {
                    echo '<p style="text-align: center"> Invalid Username or Password</p>';

                }
            }
        }
        mysqli_close($conn);
    ?>
</html>