<?php include('partials-frontend/header.php')?>
<?php include('config/constants.php')?>

    <!-- Navbar Section Ends Here -->
    <?php
        if($_GET['food_id'])
        {
            $food_id=$_GET['food_id'];

            //Get the detial of select food
            
        }
        else{
            header('location:'.SITEURL);
        }
    ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                      
                    <legend>Selected Food</legend>

                  
                        <?php 
                        //Getting Foods from Database that are active and featured
                        //SQL Query
                        $sql2 ="SELECT * FROM tbl_food WHERE id='$food_id'";
                    

                        //Execute Query 
                        $res2 = mysqli_query($conn, $sql2);
                        //Count Rows
                        $count2 = mysqli_num_rows($res2);
                        //Check whether food available or not
                        if($count2>0)
                        {
                            //Food available
                            $row=mysqli_fetch_assoc($res2);
                            
                                //Get all the value
                            
                                $title=$row['title'];
                                $price = $row['price'];
                                $description=$row['description'];
                                $image_name = $row['image_name'];
                                ?>
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

                                            <div class="order-label">Quantity :</div>
                                            <input type="number" name="qty" class="input-responsive" value="1" required>
                                            <br>
                                        </div>
                                
                                <?php
                        }
                            else
                                {
                                    //Food not available
                                    echo "<div class='error'>Food not available.</div>";
                                }

                                ?>
                 </fieldset>
               <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="customer_name" placeholder="E.g. No Hannah" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="customer_contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="customer_email" placeholder="E.g. hi@johnkim.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="customer_address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php 
            //checking whether submit button is click 
            if(isset($_POST['submit']))
            {
                //get all the datails from the form 
                
                $food=$_POST['food'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];
                $total=$price*$qty; //total = price x qty
                $order_date =date('d-m-y');  //order date
                $status="ordered" ; //ordered , on delivery , delivered , cancelled
                $customer_name=$_POST['customer_name'];
                $customer_contact=$_POST['customer_contact'];
                $customer_email=$_POST['customer_email'];
                $customer_address=$_POST['customer_address'];

                //save the order in database 
                // Insert into database create sql
                $sql3= "INSERT INTO tbl_order SET             
                    id=$food_id,
                    food='$food',
                    price=$price,
                    qty=$qty,
                    total=$total,
                    order_date='$order_date',
                    status='$status',
                    customer_name= '$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                ";
               
                //echo $sql2;die();
                
             
                //execute the qury 
                $res3=mysqli_query ($conn,$sql3);

                //check wether query excuted successfully or not

                if ($res3==true)
                {
                    $_SESSION['submit']="<div class='success'>Food order successfully</div>";
                  header("location:".SITEURL.'index.php');
                }
                else
                {
                    $_SESSION['submit']="<div class='error'>Failed order food </div>";
                    /*header("location:".SITEURL.'admin/index.php');*/
                }
               
              

            }
            
            ?>


        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <!-- footer Section Ends Here -->

    <?php include('partials-frontend/footer.php')?>   