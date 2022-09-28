<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1> Add Admin</h1>
        <br><br>
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

         //SQL Queury to save the data into database
         $slq = "INSERT INTO tbl_admin SET 
                full_name = '$full_name',
                username  = '$username',
                password  = '$password'
         ";
        //3. Executing Query and Saving Data into Database
         $res = mysqli_query($conn,$slq) or die(mysqli_error());
         //4. Check whether the (Query is Executed) data is inserted or not and display appropriate massege
         if($res==TRUE)
         {
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            //Redirect Page To Manage Admin
            header("location:".SITEURL.'admin/admin1.php');
         }else{
            //Failed to Insert Data
            //echo "Faile to Inserte Data";
                //Create a Session Variable to display message
                $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
                //Redirect Page To Add Admin
                header("location:".SITEURL.'admin/add-admin1.php');
         }
    }
?>