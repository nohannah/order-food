
<?php include('../config/constants.php') ?>
<html>
    <header>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/login.css">
    </header>
    <body class="body">
        <div class="login text-center1">
            <h1 class="text-center1">Login</h1>
            <br><br>
            <?php
                if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];//Displaying Session Message

                        
                        unset ($_SESSION['login']);//Removing Session Message
                    }
                if(isset($_SESSION['no-login-message']))
                    {
                        echo $_SESSION['no-login-message'];//Displaying Session Message
                        unset ($_SESSION['no-login-message']);//Removing Session Message
                    }
                if(isset($_SESSION['user']))
                    {
                        echo $_SESSION['user'];//Displaying Session Message
                        unset ($_SESSION['user']);//Removing Session Message
                    }
            ?>
            <br>
            <!-- Login Form Starts Here -->

            <form action="" method="POST" class="text-center1">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>

                Password:<br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <!-- Login Form End Here -->
            <p class="text-center1">Create By - <a href="#">IT TEAM</a></p>
        </div>
    </body>
</html>
<?php 
    //Check whether the submit button clicked or not
    if(isset($_POST['submit']))
    {
        //Process the login
        //1. Get the Data from login form
         $username = $_POST['username'];
         $password = md5($_POST['password']);

        //2. SQL to check whether the user with username and password exists or not
        $sql ="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the Query
        $res= mysqli_query($conn,$sql);

        //Count the rows to check whether the user axists or not
        $count=mysqli_num_rows($res);
        if($count==1)
        {
            //User Available and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successfully.</div>";
            $_SESSION['user']  = $username; //To check whether the user is logged in or not and will logout unset it

            //Redirect to Home Page.Dashboard
            header('location:'.SITEURL.'admin/');
        }else
        {
            //User Not Available and ligin Failed
            $_SESSION['login'] = "<div class='error text-center'>Username or password did not match.</div>";
            //Redirect to Login Page Again
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>