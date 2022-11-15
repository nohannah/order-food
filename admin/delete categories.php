<?php 
    //Include Constants.php file here
    include('../config/constants.php');
    //1. get the ID of Admin to be delete
    echo $id=$_GET['id'];
     //1. Get the ID of Select Food 
     $id=$_GET['id']; 
  
     //2. Create SQL Query to get the detail 
     $sql2="SELECT * FROM tbl_category WHERE id=$id"; 

     //Execute the Query 
     $res2=mysqli_query($conn,$sql2); 

     //Check whether the Query Execute ot not 
     if(isset($_GET['id'])) 
     { 
         //Check whether the data available or not 
         $count2=mysqli_num_rows($res2); 
         //Check whether we have data admin ot not 
         if($count2==1) 
         { 
             //Get the detail 
             //echo "Admin available"; 
             $row=mysqli_fetch_assoc($res2); 
             $image_name=$row['image_name']; 
              

         } 
     }else 
     { 
         //Redirect to Manage Admin Page 
         header('lacation:'.SITEURL.'admin/manage-categories.php'); 
     } 


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
        $remove_path = "../images/category/".$image_name; 
        $remove = unlink($remove_path); 
        //Redirect to Manage Category
        header('location:'.SITEURL.'admin/manage-categories.php');
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
