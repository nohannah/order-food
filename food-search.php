<?php include('partials-frontend/header.php')?>
<?php include('config/constants.php')?> 
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php  
            //Get the search keyboard
            $search=$_POST['search'];  
            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            $_SESSION

            //SQL query to get foods based on search keyboard
            $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%'OR description LIKE '%$search%'";

            //Excute the query
            $res=mysqli_query($conn,$sql);

            //count Rows
            $count=mysqli_num_rows($res);

            //check wether foos available or not
            if($count>0)
            {
                //food available 
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the details
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $description=$row['description'];
                    $image_name=$row['image_name'];
                    ?>

                                <div class="food-menu-box">
                                    <div class="food-menu-img">
                                    <?php 
                                        //Check whether image available or not
                                        if($image_name=="")
                                        {
                                            //image not available
                                            echo "<div class='error'>Image not available.</div>";
                                        }else
                                        {
                                            
                                            //Image available
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/Food/<?php echo $image_name; ?>" alt="Chicke Hawain Momo" class="img-responsive img-curve">
                                            <?php
                                                                               
                                        }
                                    ?>
                                       
                                    </div>

                                    <div class="food-menu-desc">
                                            <h3><?php echo $title ?></h3>
                                            <input type="hidden" name="food" value="<?php echo $title;?>">

                                            <p class="food-price">$<?php echo $price ?></p>
                                            <input type="hidden" name="price" value="<?php echo $price;?>">
                                            <p class="food-detail">
                                            <?php echo $description ?>
                                                </p>
                                            <div class="order-label">Quantity :</div>
                                            <input type="number" name="qty" class="input-responsive" value="1" required>
                                            <br>
                                    </div>
                                        <br>

                                        <a href="<?php echo SITEURL; ?>order1.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                    </div>
                                </div>

                    <?php
                }
            }
            else
            {
                echo "<div class ='error'> Food not found.</div>";
            }
                     ?>
                     
    </section>
    <!-- fOOD Menu Section Ends Here -->

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
    
    <!-- footer Section Ends Here -->
    <?php include('partials-frontend/footer.php')?>   