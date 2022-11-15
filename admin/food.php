<?php include ('partials/menu.php')?>

<div class="main-centent">
    <div class="wrapper">
        <h1>manage food</h1>
        <?php 
            if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];//Displaying Session Message
                    unset ($_SESSION['add']);//Removing Session Message 
                }
            if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];//Displaying Session Message
                    unset ($_SESSION['delete']);//Removing Session Message
                }
            if(isset($_SESSION['unauthorize']))
                {
                    echo $_SESSION['unauthorize'];//Displaying Session Message
                    unset ($_SESSION['unauthorize']);//Removing Session Message unauthorize
                }
        ?>
        <br/><br/>
         <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br/><br/>
        <!-- button to add food-->
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>image</th>
                <th>description</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
                $sql = "SELECT * FROM tbl_food";
                $res = mysqli_query($conn,$sql);
                $sn=1;
                $count = mysqli_num_rows($res);
                
                if ($count >0){
                     while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $description = $row['description'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>
                            <tr>
                                <td><?php echo $sn++;?></td>
                                <td><?php echo $title;?></td>
                                <td><?php echo $price;?></td>

                                <td>
                                <?php 
                                //Check whether the image is available or not
                                if($image_name!="")
                                {
                                //Display the Image
                                //echo $image_name;
                                ?>
                                <img src="<?php echo SITEURL; ?>images/Food/<?php echo $image_name; ?>" width="150px">
                                <?php 
                                }
                                else
                                {
                                    echo "no image";
                                }
                                ?>
                                </td>
                                <td><?php echo $description; ?></td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"  class="btn-danger">Delete</a>
                                </td>
                            </tr>
                           
                        <?php
                     }       
                }
                else
                {
                    ?>
                        <tr>
                            <td colspend="7"><div class="error">No Food add .</div></td>
                        </tr>
                         <?php

                }
            ?>
  
        </table>
    </div>
</div>
<?php include ('partials/footer.php'); ?>