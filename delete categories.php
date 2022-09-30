<?php 
    //Include Constants.php file here
    include('../config/constants.php');
    //1. get the ID of Admin to be delete
    echo $id=$_GET['id'];

    //2. Create SQL Query to delete Category
    $slq = "DELETE FROM tbl_category WHERE id=$id"; // delete from table id 

    //Execute the Query 
    $res = mysqli_query($conn,$slq);
    //Check whether the query execute seccessfully or not 
    if($res==true)
    {
        //Query Executed successfully
        //echo "Admin delete successfully";
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
        //Redirect to Manage Category
        header('location:'.SITEURL.'admin/categories.php');
    }else
    {
        //echo "Fialed delete Category";
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='error'>Failed to Deleted Category. Try Again Later.</div>";
        //Redirect to Manage Category
        header('location:'.SITEURL.'admin/categories.php');
    }

    //3. Redirect to Manage Admin page with message (Suucess/error)
?>