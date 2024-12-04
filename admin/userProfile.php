<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
<?php  
 $userId = Session::get('userId');
 $userRole = Session::get('userRole');
?>
<div class="box round first grid">
<h2>Update  Post</h2>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = mysqli_real_escape_string($db->link, ($_POST['username']));
    $email = mysqli_real_escape_string($db->link, ($_POST['email']));
    $details = mysqli_real_escape_string($db->link, ($_POST['details']));

        $query = "UPDATE tbl_user SET
            username = '$username',
            email = '$email',
          details = '$details'
            WHERE id ='$userId'";

        $updated_user = $db->update($query);
        if ($updated_user) {
        echo "<span class='success'>User Updated Successfully.
        </span>";
        }else {
        echo "<span class='error'>User Not Updated !</span>";
        }
    }   
?>

<div class="block">     
    <?php 
    $query = "SELECT * FROM tbl_user WHERE id='$userId' AND role='$userRole'";
    $getUser = $db->select($query);
    if($getUser){
        while($result = $getUser->fetch_assoc()){
  
  ?>          
    <form action="" method="POST" enctype="multipart/form-data">
    <table class="form">
        
        <tr>
            <td>
                <label>Username</label>
            </td>
            <td>
                <input type="text" name="username" value="<?php echo $result['username']?>"/>
            </td>
        </tr>
        <tr>
            <td>
                <label>Email</label>
            </td>
            <td>
                <input type="text" name="email" value="<?php echo $result['email']?>"/>
            </td>
        </tr>
        
        <tr>
            <td style="vertical-align: top; padding-top: 9px;">
                <label>Details</label>
            </td>
            <td>
                <textarea class="tinymce" name="details">
                <?php echo $result['details']?>
                </textarea>
            </td>
        </tr>
        
      
        <tr>
            <td></td>
            <td>
                <input type="submit" name="submit" Value="Update" />
            </td>
        </tr>
    </table>
    </form>
    <?php } } ?>
</div>
</div>
</div>


<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
    setupTinyMCE();
    setDatePicker('date-picker');
    $('input[type="checkbox"]').fancybutton();
    $('input[type="radio"]').fancybutton();
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
    setupLeftMenu();
    setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
