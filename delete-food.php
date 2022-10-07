<?php 
    //Include Constants.php file here
    include('../config/constants.php');
    //1. get the ID of Admin to be delete
    echo $id=$_GET['id'];
     //1. Get the ID and image_name  since it's link from food.php that we select  link 80
     $id=$_GET['id']; 
     $image_name=$_GET['image_name'];
  
     //2. Create SQL Query to get the detail 
     // block code
     /*$sql2="SELECT id,image_name FROM tbl_food WHERE 1"; */

     //Execute the Query from file which save image 
     $res2=mysqli_query($conn,$sql2); 

     //if id and image_name different from empty code executed remove from file that save in image
     if($id!=""&& $image_name!="") 
     { 
        $remove_path = "../images/Food/".$image_name; 
        $remove = unlink($remove_path);
        //if remove is fale code excecute which fail
        if($remove=false)
        {
            $_SESSION['remover_image'] = "<div class='success'>Fail remove image</div>";
       
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/food.php'); 
            die() ;
        }
        /* //Check whether the data available or not 
         $count2=mysqli_num_rows($res2); 
         //Check whether we have data admin ot not 
         if($count2==1) 
         { 
             //Get the detail 
             //echo "Admin available"; 
             $row=mysqli_fetch_assoc($res2); 
             $image_name=$row['image_name']; 
              

         } 
         */
     }
     else 
     { 
         //Redirect to Manage Admin Page 
         header('lacation:'.SITEURL.'admin/food.php'); 
     } 


    //2. Create SQL Query to delete Category
    $slq = "DELETE FROM tbl_food WHERE id=$id "; // delete from table id and image name

    //Execute the Query 
    $res = mysqli_query($conn,$slq);
    //Check whether the query execute seccessfully or not 
    if($res==true)
    {
        //Query Executed successfully
        //echo "Admin delete successfully";
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
       
        //Redirect to Manage Category
        header('location:'.SITEURL.'admin/food.php');
    }else
    {
        //echo "Fialed delete Category";
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='error'>Failed to Deleted Food. Try Again Later.</div>";
        //Redirect to Manage Category
        header('location:'.SITEURL.'admin/food.php');
    }

    //3. Redirect to Manage Admin page with message (Suucess/error)
?>
