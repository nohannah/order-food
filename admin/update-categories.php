<?php include('partials/menu.php') ?>

<?php 
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

                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];

                }
            }
            else
            {
                //Redirect to Manage Admin Page
                header('lacation:'.SITEURL.'admin/categories.php');
            }
    ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

    <form action="" method="POST" enctype="multipart/form-data">
        <table class = "tbl-full">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image:</td>
                <td>
                <?php 
                            if($image_name=="")
                            {
                                //Image not available
                                echo "<div class'error'>Image not Available.</div>";
                            }
                            else
                            {
                                //Image available
                                ?>
                                <img src="<?php SITEURL;?>images/category<?php echo $image_name?>" alt="<?php echo $title ?>" width="150px" height="50px">
                                <?php
                            }
                            ?>
                </td>
            </tr>

            <tr>
                <td>New Image:</td>
                <td>
                    <input type="file" name="image">
                  
                </td>
            </tr>

            <tr>
                        <td>Featured:</td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "Checked";} ?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if($featured=="No"){echo "Checked";} ?> type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "Checked";} ?> type="radio" name="active" value="Yes"> Yes
                            <input <?php if($featured=="No"){echo "Checked";} ?> type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <Input type="hidden" name="id" value="<?php echo $id ?>">
                            <Input type="hidden" name="current_image" value="<?php echo $image_name ?>">
                            <input type="submit" name="submit" value="Update" class="btn-secondary">
                        </td>
                        
                    </tr>
        </table>

        </form>
        <?php 
            if(isset($_POST['submit']))
            {
                //1. Get the data from form
                $title = $_POST['title'];
                $current_image =$_POST['current_image'];
                $featured = $_POST['featured'];
                $active   = $_POST['active'];

                //1. For radio input, we check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    //Get the value from form
                    $featured = $_POST['featured'];
                }else
                {
                    //Set the Default value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    //Get the value from form
                    $active   = $_POST['active'];
                }else
                {
                    //Set the Default value
                    $active   = "No";
                }
                $choose_image = $_FILES['image']['name'];

                if($choose_image!="")
                    {
                        //Upload the image
                        $image_name = $_FILES['image']['name'];
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
                            if($upload==false)
                            {
                                //Set message
                                $_SESSION['upload'] ="<div class='error'>Fialed to upload Image.</div>";
                                header('lacation:'.SITEURL.'admin/manage-categories.php');
                                //Stop the proccess
                                die();
                            }
                             //Remove current image if available
                             if($current_image!="")
                             {
                                 //Cureent image is available
                                 //Remove the image
                                 $remove_path = "../images/category/".$current_image;
                                 $remove = unlink($remove_path);
                                 //Check whether the image removed or not
                                 if($remove==false)
                                 {
                                     //Failed to remove current image
                                     $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image.</div>";
                                     //Redirect to manage-food
                                     header('location:'.SITEURL.'admin/manage-categories.php');
                                     die();
                                 }
                             }

                    }else
                    {
                        $image_name = $current_image;
                    }
                //Insert into database
                    $sql3 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name  = '$image_name',
                    featured = '$featured',
                    active   = '$active'
                    WHERE id=$id
                    ";
                //3. Execute Query
                $res3 = mysqli_query($conn,$sql3);

                if($res3==true)
                {
                    //4. Check whether the query executed or not data add or not
                    $_SESSION['update-category'] = "<div class='success'>Category Update Successfully.</div?";
                    //Redirect to Manage Category Page
                    header("location:".SITEURL.'admin/manage-categories.php');
                }
                else
                {
                    //Failed to add category
                    $_SESSION['update-category'] = "<div class='error'>Failed to Update Category.</div?";
                    //Redirect to Manage Category Page
                    header("location:".SITEURL.'admin/manage-categories.php');
                }
                
    
                             /*

                            //Check whether the image is select or not and upload image only if select
                        if($image_name!="")
                            {
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
                            if($upload==false)

                            {
                                //Set message
                                $_SESSION['upload'] ="<div class='error'>Fialed to upload Image.</div>";
                                header('lacation:'.SITEURL.'admin/categories.php');
                                //Stop the proccess
                                die();
                            }
                               else
                                {
                                    $image_name = $current_image;
                                 }  
                            //Remove current image if available
                            if($current_image!="")
                            {
                                //Cureent image is available
                                //Remove the image
                                $remove_path = "../images/category/".$current_image;
                                $remove = unlink($remove_path);
                                //Check whether the image removed or not
                                
                                if($remove==false)
                                {
                                    //Failed to remove current image
                                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image.</div>";
                                    //Redirect to manage-food
                                    header('location:'.SITEURL.'admin/categories.php');
                                    die();
                                }
                                 
                                
                            }
                        }
                        }
                        
                        //Insert into database
                        $sql3 = "UPDATE tbl_category SET
                        title = '$title',
                        image_name  = '$image_name',
                        featured = '$featured',
                        active   = '$active'
                        WHERE id=$id
                        ";
                    //3. Execute Query
                    $res3 = mysqli_query($conn,$sql3);

                    if($res3==true)
                    {
                        //4. Check whether the query executed or not data add or not
                        $_SESSION['update-category'] = "<div class='success'>Category Update Successfully.</div?";
                        //Redirect to Manage Category Page
                        header("location:".SITEURL.'admin/categories.php');
                    }
                    else
                    {
                        //Failed to add category
                        $_SESSION['update-category'] = "<div class='error'>Failed to Update Category.</div?";
                        //Redirect to Manage Category Page
                        header("location:".SITEURL.'admin/categories.php');
                    }*/
                    
            }else
            {
                echo "Not submit";
            }
        
        ?>
    </div>
</div>

<?php include('partials/footer.php') ?>