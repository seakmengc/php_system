<script src = "js/message.js"></script>
<?php
    session_start();
    include "php/function/message.php";
    include "php/function/head_location.php";
    include "php/function/get_value.php";

    if(isset($_SESSION['profile'])) {
        session_destroy();
    } 
    else {
        if(isset($_POST["username"]) && isset($_POST["password"])){
            // session_start();
            include "php/function/run_query.php";
            
            $username = get_value("username" , "POST");
            $password = get_value("password" , "POST");

            if(preg_match('/[^a-z0-9]/',$username)){
                $_POST["username"] = "";
                echo "<script>output('PLEASE INPUT VALID USERNAME')</script>";
            }
            else{
                $sql = "SELECT * FROM user WHERE username = '$username' && password = '$password' ";

                $data = get_assoc($sql);

                if(count($data) == 1){
                    if($data[0]["role"] == "staff"){
                        $staffid = $data[0]["id"];
                        $sql = "SELECT * FROM staff WHERE staffid = '$staffid'";
                        $staffdata = get_assoc($sql);
                        $data[0]["position"] = $staffdata[0]["position"];
                    }
                    $con = open_db();
                    $data[0]["password"] = mysqli_real_escape_string($con , $data[0]["password"]);
                    $con->close();
                    $_SESSION["profile"] = $data[0];
                    head_location("Profile/PHP/profile.php");
                }
                else{
                    echo "<script>output('WRONG USERNAME OR PASSWORD')</script>";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container">
        <fieldset class="box">
            <legend>
                <h1>S I G N I N</h1>
            </legend>

            <form action="login.php" method="POST">
                <div class="logo-container">
                    <img src="images/userlogo.svg" alt="" class="logo">
                </div>

                <div class="input-container">
                    <label>
                        <img src="images/user.svg" align="top" alt="" class="icon">
                        <input type="text" class="input" id="inputtext" placeholder="username" name="username" value = '<?php $username = (isset($_POST["username"]) ? get_value("username","POST") : ""); echo $username;?>' >
                    </label>
                </div>

                <div class="input-container">
                    <label>
                        <img src="images/lock.svg" align="top" alt="" class="icon">
                        <input type="password" class="input" id="inputpassword" placeholder="password" name="password">
                    </label>
                </div>

                <div class="signup-container">
                    <p class="signup-p"><a href="Register/PHP/sign_up.php" class="signup-a">Sign Up</a></p>
                </div>

                <div class="button-container">
                    <button class="button" type="submit">Sign In</button>
                </div>
            </form>
        </fieldset>
    </div>
</body>

</html>