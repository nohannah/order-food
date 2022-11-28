<?php include('partials-frontend/header.php')?>
<?php include('config/constants.php')?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
            //Create quary to get date from database 

            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 6";
            //Execute query
            $res = mysqli_query($conn,$sql);
            //Count the rows
            $count = mysqli_num_rows($res);
            if($count>0)
            {
              
            //Category is available
             while($row=mysqli_fetch_assoc($res))
                    {
                    //Get the values like ID,title,image_name
                       $title = $row['title'];
                       $image_name=$row['image_name'];
                        ?>
                    <a href="admin/manage-categories.php">
                    <div class="box-3 float-container">
                    <?php
                    if($image_name=="")
                    {
                      //Display the message
                      echo "<div class='error'>Categoried not Available.</div>";  
                    }else
                    {
                      //Image Available
                      ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                    <?php  
                    }
                    ?>

                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                    </a>
                        <?php
                    }
            }else
            {
                //Categories not available
                echo "<div class='error'>Categoried not Added.</div>";
            }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <?php include('partials-frontend/footer.php')?>   