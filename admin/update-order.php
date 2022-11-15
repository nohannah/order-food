<?php include('partials/menu.php');?>
<center> 
<?php 
            //1. Get the ID of Select Food
            $id=$_GET['id'];

            //2. Create SQL Query to get the detail
            $sql="SELECT * FROM tbl_order WHERE id=$id";

            //Execute the Query
            $res2=mysqli_query($conn,$sql);

            //Check whether the Query Execute ot not
            if(isset($_GET['id']))
            {
                //Check whether the data available or not
                $count2=mysqli_num_rows($res2);
                //Check whether we have data admin ot not
                if($count2==1)
                {
                    //Get the detail from the form
                    //echo "Admin available";
                    $row=mysqli_fetch_assoc($res2);
                    $id = $row['id'];
                    $title = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status= $row['status'];
                    $customer_name= $row['customer_name'];
                    $customer_contact= $row['customer_contact'];
                    $customer_email= $row['customer_email'];
                    $customer_address= $row['customer_address'];
                }
            
            else
                {
                //Redirect to Manage Admin Page
                header('lacation:'.SITEURL.'order.php');
                }
            }                
    ?>  
     <section class="food-search">  
        <div class="container">
        <div class="main-content">
       
                <form action="#" method="POST" class="order">
                    
                            <!--  <div class="food-menu-img">
                                        
                                        <?php 
                                        /*
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
                                            
                                            
                                            }*/
                                        ?>
                                    </div>-->
                                    <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Food Name:</td>
                        <td><b><?php echo $title; ?></b></td>
                    </tr>

                    <tr>
                        <td>Price</td>
                        <td><b><?php echo $price; ?></b></td>
                    </tr>

                    <tr>
                        <td>Qty</td>
                        <td>
                            <input type="number" name="qty" value ="<?php echo $qty; ?>"> 
                        </td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td>
                            <select name="status">
                                <option <?php if($status=="Ordered"){echo"selected";} ?> value="Ordered"> Ordered</option>
                                <option <?php if($status=="On Delivery"){echo"selected";} ?>value="On Delivery"> On delivery</option>
                                <option <?php if($status=="Deliverd"){echo"selected";} ?>value="Deliverd"> Deliverd</option>
                                <option <?php if($status=="Cancelled"){echo"selected";} ?>value="Cancelled"> Cancelled</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Name:</td>
                        <td>
                        <input type="text" name="customer_name" value ="<?php echo $customer_name; ?>"> 
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Contact:</td>
                        <td>
                        <input type="text" name="customer_contact" value ="<?php echo $customer_contact; ?>"> 
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Email:</td>
                        <td>
                        <input type="text" name="customer_email" value ="<?php echo $customer_email; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Address: </td>
                        <td> 
                            <textarea name="customer_address" cols="30" row="5"><?php echo $customer_address; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                            <input type="submit" name="submit" value="Update" class="btn-secondary">
                        </td>
                    </tr>

                </table>
        </form>


                </form>
        </div>                                     
        </div>
        <?php
        if (isset($_POST['submit']))
        {
                $title=$title;
                $price=$_POST['price'];
                $qty=$_POST['qty'];
                $total=$price*$qty; //total = price x qty
                $order_date =date('d-m-y h:i:s');  //order date
                $status=$_POST['status'] ; //ordered , on delivery , delivered , cancelled
                $customer_name=$_POST['customer_name'];
                $customer_contact=$_POST['customer_contact'];
                $customer_email=$_POST['customer_email'];
                $customer_address=$_POST['customer_address'];

                $sql = "UPDATE tbl_order SET
                /* insert variable put into database*/
                        food='$title',
                        price=$price,
                        qty=$qty,
                        total=$total,
                        order_date='$order_date',
                        status='$status',
                        customer_name= '$customer_name',
                        customer_contact='$customer_contact',
                        customer_email='$customer_email',
                        customer_address='$customer_address'  
                        WHERE id = '$id'
                        ";
                    
                      
                    
                $res = mysqli_query($conn, $sql);
                if ($res == true)
                {
                    $_SESSION['update'] = "<div class = 'success'> admin updated successfully.</div>";
                    header("location: ".SITEURL. 'admin/order.php');
                }else
                {
                echo "Not submit;";
                }
               
        }
        
    
?>
</section>
    </center>
<?php include('partials/footer.php');?>