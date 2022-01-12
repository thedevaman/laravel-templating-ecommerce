<?php 
error_reporting(0);
session_start();
ob_start();
$user_id = $_SESSION['userid'];
require_once('include/function/autoload.php');
include('config/dbconnection.php');




//Get State Code Start 

if(isset($_GET['State_Id']))
{
  $State_Id = $_REQUEST['State_Id']; 
}


if(isset($State_Id))
{
  $query = $db->prepare("SELECT * FROM city WHERE State_Id = '$State_Id'");
  $query->execute(); 
  $num = $query->rowCount();
  if($num>0)
  {
    ?>
    <option id = "classvalue" value=''>Select City</option>
    <?php
    for ($i=0; $data=$query->fetch(); $i++) { 
     
        ?>
        <option value = "<?php echo $data['id']; ?>" > <?php echo $data['City_Name']; ?> </option>;
        <?php
      }
    }
    else
    { 
      ?>
      <option value = "" > <?php echo "Sorry No City Found" ?> </option>; 
      <?php
    }
}


//Get State Code Ending




if(isset($_GET['City_Id']))
{
  $City_Id = $_REQUEST['City_Id']; 
}


if(isset($City_Id))
{
  $query = $db->prepare("SELECT * FROM vendor WHERE City_Id = '$City_Id'");
  $query->execute(); 
  $num = $query->rowCount();
  if($num>0)
  {
    ?>
    <option id = "classvalue" value=''>Select Vendor</option>
    <?php
    for ($i=0; $data=$query->fetch(); $i++) { 
     
        ?>
        <option value = "<?php echo $data['id']; ?>" > <?php echo $data['Firm_Name']." (".$data['Vendor_Name'].")"; ?> </option>;
        <?php
      }
    }
    else
    { 
      ?>
      <option value = "" > <?php echo "Sorry No Vendor Found" ?> </option>; 
      <?php
    }
}





if(isset($_GET['Cat_Id']))
{
  $Cat_Id = $_REQUEST['Cat_Id']; 
}


if(isset($Cat_Id))
{
  $query = $db->prepare("SELECT * FROM subcategory WHERE categoryid = '$Cat_Id'");
  $query->execute(); 
  $num = $query->rowCount();
  if($num>0)
  {
    ?>
    <option id = "classvalue" value=''>Select Sub Category</option>
    <?php
    for ($i=0; $data=$query->fetch(); $i++) { 
     
        ?>
        <option value = "<?php echo $data['id']; ?>" > <?php echo $data['subcategory']; ?> </option>;
        <?php
      }
    }
    else
    { 
      ?>
      <option value = "" > <?php echo "Sorry No Sub Category Found" ?> </option>; 
      <?php
    }
}







if(isset($_GET['lblCat_Id']))
{
  $lblCat_Id = $_REQUEST['lblCat_Id']; 
}


if(isset($lblCat_Id))
{
  $query = $db->prepare("SELECT * FROM subcategory WHERE lblcatid = '$lblCat_Id'");
  $query->execute(); 
  $num = $query->rowCount();
  if($num>0)
  {
    ?>
    <option id = "classvalue" value=''>Select Sub Category</option>
    <?php
    for ($i=0; $data=$query->fetch(); $i++) { 
     
        ?>
        <option value = "<?php echo $data['id']; ?>" > <?php echo $data['subcategory']; ?> </option>;
        <?php
      }
    }
    else
    { 
      ?>
      <option value = "" > <?php echo "Sorry No Sub Category Found" ?> </option>; 
      <?php
    }
}



//Get Deduction Price Start 

if(isset($_GET['statename']))
{
  $statename = $_REQUEST['statename'];
}
if(isset($statename)){
$rtd = $db->prepare("SELECT * FROM city WHERE State_Id = '$statename'");
$rtd->execute();
$num=$rtd->rowCount();
if($num>0) {
$data = $rtd->fetch(); ?>
<select class="form-control" id="city" name="cityname">
<option value="<?php echo $row['id']; ?>"> <?php echo $data['City_Name']; ?> </option>
   </select>          
                           


<?php } else { ?>
   <select class="form-control" id="city" name="cityname">                   

<option value=""> Sorry</option>
</select>
<?php } }

//Get Deduction Price Ending





?>

