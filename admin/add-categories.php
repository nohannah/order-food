<?php 
    include ('partials/menu.php');
?>

       <!-- Menu Content Section Starts -->
    <div class="Main-Content">
        <div class="wrapper">
            <h1>Add Categories</h1>
            <br />
            <br><br><br>
            <?php
            if (isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
           /* if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];//Displaying Session Message
                unset ($_SESSION['upload']);//Removing Session Message
            } 
            */
            ?>
            
            <!---Button Add Admin-->
           
            <br /> <br /> <br />
            <form action="" method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" insert class -->
                <table class="tbl-full">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Category Titile">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Feature:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="Yes">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add category" class="btn-secondary">
                           
                        </td>
                    </tr>
                </table>
                <div class="clearfix"></div>
       
            </form>
           
        <!-- add category from ends-->
    
       <?php
            //chec wether the submit button is click or not
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //1. Get the value from catagory form
               
                $title=$_POST['title'];

                //Fron radio input , wee need to check wether is the selected or not
                if (isset($_POST['featured']))
                    {
                        //get the vaule from from 
                     $featured=$_POST['featured'];
                    }
                 else 
                    {
                            //set the dedult value
                       $featured="No";
                    }
                if (isset($_POST['active']))
                    {
                        $active=$_POST['active'];
                    }
                 else 
                    {
                       $active="No";
                    }
                    $choose_image = $_FILES['image']['name'];
                if($choose_image!="")
                    {
                        //echo $choose_image;
                        //Upload the image
                        $image_name = $_FILES['image']['name'];
                        //Auto Rename image 
                        //Get the extention if our image (jpg,png,gif,etc) e.g "Special.food.jpg"
                        $tmp = explode('.', $image_name);
                        $ext = end($tmp);
                        //Rename the image
                        $image_name = "Food_Category_".rand(000,999).'.'.$ext;//e.g Food_Category_832.jpg
    
                        $source_path= $_FILES['image']['tmp_name'];
                        $destination="../images/category/".$image_name;
    
                        //Finally upload image
                        $upload = move_uploaded_file($source_path,$destination);
                        //Check whether the image upload or not
                        //And if the image is not upload then we will stop the proccess and redirect with the error message
                        if($_FILES==false)
                        {
                            //Set message
                            $_SESSION['upload'] ="<div class='error'>Fialed to upload Image.</div>";
                            header('lacation:'.SITEURL.'admin/add_category.php');
                            //Stop the proccess
                            die();
                        }
                    }
                else
                    {
                        $image_name = "";
                        //echo "not choose!";
                    }

                /*
                if(isset($_FILES['image']['name']))
                        {
                            //Upload the image
                            $choose_image = $_FILES['image']['name'];
                            //Auto Rename image 
                            //Get the extention if our image (jpg,png,gif,etc) e.g "Special.food.jpg"
                            $ext = end(explode('.',$image_name));
                            //Rename the image
                            $image_name = "Food_Category_".rand(000,999).'.'.$ext;//e.g Food_Category_832.jpg

                            $source_path= $_FILES['image']['tmp_name'];
                            $destination="../images/category/".$image_name;

                            //Finally upload image
                            $upload = move_uploaded_file($source_path,$destination);
                            //Check whether the image upload or not
                            //And if the image is not upload then we will stop the proccess and redirect with the error message
                            if($_FILES==false)
                            {
                                //Set message
                                $_SESSION['upload'] ="<div class='error'>Fialed to upload Image.</div>";
                                header('lacation:'.SITEURL.'admin/add-categories.php');
                                //Stop the proccess
                                die();
                            }
                        }else
                        {
                            $image_name = "";
                        }
                        */

                 //2.create sql query to insert category into indatabase
                 $sql="INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active' 

                 "; 
                
                 //3.excute the query and save in database
                 $res=mysqli_query($conn,$sql)  ;
                 
                 //4.Check the wether the quary excuted or not and data addes or not
                 if($res==true)
                 {
                    //query excuted and category addes
                    $_SESSION['add']="<div class='error'> category Added successfully.</div>";

                    //redirect to maange category page
                    header ('location:'.SITEURL.'admin/manage-categories.php');
        
                 }
                 else {
                    //Failed to add category
                    $_SESSION['add'] = "<div class='error'>Failed to add Category.</div?";
                    //Redirect to Manage Category Page
                    header("location:".SITEURL.'admin/add-categories.php');
                 }
              
            }
       ?>
        </div>    
    </div>
 <?php include ('partials/footer.php') ?>