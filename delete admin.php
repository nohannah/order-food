<?php 
    //Include Constants.php file here
    include('../config/constants.php');
    //1. get the ID of Admin to be delete
     $id=$_GET['id'];

    //2. Create SQL Query to delete Admin
    $slq = "DELETE FROM tbl_admin WHERE id='10'";

    //Execute the Query 
    $res = mysqli_query($conn,$slq);
    //Check whether the query execute seccessfully or not 
    if($res==true)
    {
        //Query Executed successfully
        //echo "Admin delete successfully";
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        //Redirect to Manage Admin
        header('location:'.SITEURL.'admin.php');
    }else
    {
        //echo "Fialed delete Admin".$id;
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='error'>Failed to Deleted Admin. Try Again Later.</div>";
        //Redirect to Manage Admin
        header('location:'.SITEURL.'admin.php');
    }

    //3. Redirect to Manage Admin page with message (Suucess/error)
?>