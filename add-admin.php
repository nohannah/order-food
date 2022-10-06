<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1> Add Admin</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['Exist']))
                {
                    echo $_SESSION['Exist'];//Displaying Session Message
                    unset ($_SESSION['Exist']);//Removing Session Message 
                }
            
        ?>
        <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" placeholder="Input Your Name"></td>
            </tr>

            <tr>
                <td>User Name:</td>
                <td><input type="text" name="user_name" placeholder="Your User Name"></td>
            </tr>

            <tr>
                <td>Password:</td>
                <td>
                    <input type="password" name="password" placeholder="Your Password">
                </td>
            </tr>
            <tr>
                <td>Status:</td>
                <td>
                    <input type="radio" name="active" value="yes">Active
                    <input type="radio" name="inactive" value="no">Inactive
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>

           
        </table>
        </form>
        
    </div>
</div>

<?php include('partials/footer.php')?>
<?php 
    //Process the Value from form and Save it in Databse

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        //Button Clicked
        //echo "Button Clicked!";

        //1. Get the Data from form
         $full_name = $_POST['full_name'];
         $username  = $_POST['user_name'];
         $password  = md5($_POST['password']); //Password Encription with MD5


        if(isset($_POST['active']))
        {
            $status=1;
        }
        else{
            $status=0;
        }
        //Select usename colum which show exist
         $select =mysqli_query($conn,"SELECT*FROM tbl_admin WHERE username='$username'");
         $count=mysqli_num_rows($select);
         if($count==1)
          {

            $_SESSION['Exist'] = "<div class='success'>User name already Exist.</div>";
            //Redirect Page To Manage Admin
            header("location:".SITEURL.'admin/add-admin.php');
            die();
         }
         
        
         //SQL Queury to save the data into database
         $slq = "INSERT INTO tbl_admin SET 
                full_name = '$full_name',
                username  = '$username',
                password  = '$password',
                status=$status

         ";
         //3. Executing Query and Saving Data into Database
         $res = mysqli_query($conn,$slq) or die(mysqli_error());
         
         if($res==TRUE)
         {
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            //Redirect Page To Manage Admin
            header("location:".SITEURL.'admin/admin.php');
         }else{
            //Failed to Insert Data
            //echo "Faile to Inserte Data";
                //Create a Session Variable to display message
                $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
                //Redirect Page To Add Admin
                header("location:".SITEURL.'admin/add-admin.php');
         }
         
        /*    $select =mysqli_query($conn,"SELECT*FROM tbl_admin WHERE username='".$_POST['username']."'");
            if(mysqli_num_rows($select))
             {
                exit('This username already exists');
            }
         /*
        //3. Executing Query and Saving Data into Database
         $res = mysqli_query($conn,$slq) or die(mysqli_error());
         
         if($res==TRUE)
         {
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            //Redirect Page To Manage Admin
            header("location:".SITEURL.'admin/admin.php');
         }else{
            //Failed to Insert Data
            //echo "Faile to Inserte Data";
                //Create a Session Variable to display message
                $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
                //Redirect Page To Add Admin
                header("location:".SITEURL.'admin/add-admin.php');
         }
         */
    }
?>
