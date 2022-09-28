<?php include ('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php
            if(isset($_GET['id']))
            {
            $id = $_GET['id'];
             }
        ?>
        <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Current Password:</td>
                        <td>
                            <input type="password" name="current_password" placeholder="Current Password">
                        </td>
                    </tr>

                    <tr>
                        <td>New Password:</td>
                        <td>
                            <input type="password" name="new_password" placeholder="New Password">
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm Password:</td>
                        <td>
                            <input type="password" name="confirm_password" placeholder="Confirm Password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                        </td>
                    </tr>
                </table>
        </form>
    </div>
</div>

<?php 
    //Check whether the submit button click or not
    if(isset($_POST['submit']))
    {
        //Echo "Button click!";
        //Get the Data from form
        $id                 =   $_POST['id'];
        $current_password   =   md5($_POST['current_password']);
        $new_password       =   md5($_POST['new_password']);
        $confirm_assword    =   md5($_POST['confirm_password']);

       //Check whether user current ID and current password exists or not
       $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
       //Execute the Query
       $res = mysqli_query($conn,$sql);
       //Check whether the query have user or not
       if($res==true)
       {
            //Query Executed
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                //Check whether the new password and confirm password match or not
                if($new_password==$confirm_assword)
                {
                    //Create SQL Query to update admin
                        $sql2="UPDATE tbl_admin SET 
                        password = '$new_password'
                        WHERE id='$id'
                    ";
                    //Execute the Query
                    $res2 = mysqli_query($conn,$sql2);
                    //Check whether the query successfully or not
                    if($res==true)
                    {
                        //Query Executed and admin updated
                        $_SESSION['change-pws'] = "<div class='success'>Password Changed Succesfully.</div>";
                        //Redirect Page To Manage Admin
                        header("location:".SITEURL.'admin/admin.php');
                    }else
                    {
                        //Failed to update admin
                        $_SESSION['change-pws'] = "<div class='error'>Failed to Change Password.</div>";
                        //Redirect Page To Manage Admin
                        header("location:".SITEURL.'admin/admin.php');
                    }
                }else
                {
                    //User does not exists set message and redirect
                    $_SESSION['pws-not-match'] = "<div class='error'>Password did not match.</div>";
                    //Redirect Page To Manage Admin
                    header("location:".SITEURL.'admin/admin.php'); 
                }
            }else
            {
            //User does not exists set message and redirect
            $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
            //Redirect Page To Manage Admin
            header("location:".SITEURL.'admin/admin.php'); 
            }
        
       }else
       {
        //User does not exists set message and redirect
        $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
        //Redirect Page To Manage Admin
        header("location:".SITEURL.'admin/admin.php');
       }

    }
?>
<?php include ('partials/footer.php');?>