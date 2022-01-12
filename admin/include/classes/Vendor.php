<?php

/**
 * 
 */
class Vendor
{
	
	function AddVendor()
	{
		




if(isset($_POST["add_cat"])){
        include('config/dbconnection.php');
 
        
    $vendorname = trim($_POST['vendorname']);
        $firmname = trim($_POST['firmname']);
             $contact = trim($_POST['contact']);
             $product = trim($_POST['product']); 
             $statename = trim($_POST['statename']);
        $cityname = trim($_POST['cityname']);
             $address = trim($_POST['address']);
           $Rec_Time_Stamp = date('Y-m-d');
           $type="2";
           $password = md5("bpl");

        try {

            $result = $db->prepare("SELECT count(*) as countuser FROM users WHERE contact_info = '$contact'");
            $result->execute();
            $row = $result->fetch();
            $countuser = $row['countuser'];
            if ($countuser > 0) {
              echo "<div class='alert alert-icon-left alert-danger alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Oh no!</strong> Contact No Allready Registered!
    </div>";
            } else{

            $sqluser = "INSERT INTO users(firstname, contact_info, type, password) VALUES (:a,:b,:c,:d)";
            $ruser = $db->prepare($sqluser);

          $insertuser = $ruser->execute(array(':a'=>$vendorname,':b'=>$contact,':c'=>$type,':d'=>$password));



            $sql = "INSERT INTO vendor(Vendor_Name, Firm_Name, Contact_No, Product, State_Id, City_Id, Address, RecTimeStamp) VALUES (:a,:b,:c,:d,:e,:f,:g,:h)";
            $r = $db->prepare($sql);

            $insertservice = $r->execute(array(':a'=>$vendorname,':b'=>$firmname,':c'=>$contact,':d'=>$product,':e'=>$statename,':f'=>$cityname,':g'=>$address,':h'=>$Rec_Time_Stamp));
          if ($insertservice) {
            echo"<div class='alert alert-icon-left alert-success alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Well done!</strong> Vendor Add Successfully
    </div>";}
          else{
            echo "<div class='alert alert-icon-left alert-danger alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Oh no!</strong> Something went wrong!
    </div>";

          }
        }
          $db = null;
          // header('Location:category.php');
    }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
      

  
}
}

  function UpdateVendor()
{

   if(isset($_POST["UpdateVendor"])){
   
     include('config/dbconnection.php');
   
      $vendorid = $_POST['vendorid'];
       $vendorname = trim($_POST['vendorname']);
        $firmname = trim($_POST['firmname']);
             $contact = trim($_POST['contact']);
             $product = trim($_POST['product']); 
             $statename = trim($_POST['statename']);
        $cityname = trim($_POST['cityname']);
             $address = trim($_POST['address']);

         try{
                   
                    $sql = "UPDATE vendor SET Vendor_Name = :a, Firm_Name = :b, Contact_No = :c, Product = :d, State_Id = :e, City_Id = :f, Address = :g WHERE id = '$vendorid'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$vendorname,':b'=>$firmname,':c'=>$contact, ':d'=>$product,':e'=>$statename,':f'=>$cityname, ':g'=>$address));
                    if ($insertservice) {
                      echo"<div class='alert alert-icon-left alert-success alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Well done!</strong> Vendor Update Successfully
    </div>";
                       
                    }
                    else{
                        echo "<div class='alert alert-icon-left alert-danger alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Oh no!</strong> Something went wrong!
    </div>";
                    }
                    $db = null;
                     // header('location:ViewProduct.php');
                
                }
                
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
           
             
     

} }








function ViewVendor()
{
    include('config/dbconnection.php');
     $user_id = $_SESSION['userid'];

                 
                $result = $db->prepare("SELECT * FROM vendor ORDER BY Vendor_Name ASC ");
                $result->execute();
               for($i=0; $row = $result->fetch(); $i++){
                $cityid=$row['City_Id'];

                $resultcity = $db->prepare("SELECT * FROM city WHERE id = '$cityid'");
                $resultcity->execute();
               for($i=0; $rowcity = $resultcity->fetch(); $i++){

                 $stateid=$rowcity['State_Id'];

                $resultstate = $db->prepare("SELECT * FROM state WHERE id = '$stateid'");
                $resultstate->execute();
               for($i=0; $rowstate = $resultstate->fetch(); $i++){

               
               

                
                ?>
            
               <tr>
                 <td><?php echo $row['Vendor_Name']; ?></td>
  <td><?php echo $row['Firm_Name']; ?></td>
  <td><?php echo $row['Contact_No']; ?></td>
  <td><?php echo $rowstate['State_Name']; ?></td>
  <td><?php echo $rowcity['City_Name']; ?></td>
  <td><?php echo $row['Address']; ?></td>
  <td><?php echo $row['Product']; ?></td>
 
 
  

                
  <td class="text-center">
                    <div class="btn-group btn-group-xs" role="group">

                      <button type="button" title="Edit" class="btn btn-link btn-icon bigger-130 text-success" data-toggle="modal" data-target="#CatEdit-<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></button>

                      
                      <button class="btn btn-link btn-icon bigger-130 text-danger" data-toggle="modal" title="Delete" data-target="#DeleteModal-<?php echo $row['id']; ?>"><i class="fa fa-trash"></i></button>

                      
                    </div>
                  
                         </td>

                    </tr>
                    
             <div class="col-lg-12">
                        <div class="modal fade" id="DeleteModal-<?php echo $row['id']; ?>" tabindex="<?php echo $row['id']; ?>"  role="dialog" aria-labelledby="myModalLabel-<?php echo $row['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="H2">Are you sure want to delete this record? </h4>
                                    </div>
                                    <form role="form" method="post" class="form-horizontal" id="popup-validation">
                                        <input type="hidden" name="vendorid" value="<?php echo $row['id']; ?>">
                                        <div class="modal-body">
                                            <button type="submit" class="btn btn-danger" name = "DeleteVendor" >Delete</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="CatEdit-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="lgModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white shadow-none">
              <h6 class="modal-title" id="lgModalLabel">UPDATE VENDOR</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
             <section id="section1">
              
                
                <input type="hidden" value="<?php echo $row['id']; ?>" name="vendorid">
                <div class="row">
                  <div class="col-lg-6 md-6 col-xs-12 col-sm-12">
                    <div class="list-with-gap">
                      <label>Vendor Name</label>
                      <input type="text" name="vendorname" value="<?php echo $row['Vendor_Name']; ?>" class="form-control" placeholder="Vendor Name">
                      <label>Firm Name</label>
                      <input type="text" name="firmname" value="<?php echo $row['Firm_Name']; ?>" class="form-control" placeholder="Firm Name">

                      <label>Contact No</label>
                      <input type="text" name="contact"value="<?php echo $row['Contact_No']; ?>" class="form-control" placeholder="Contact No">
                      
                      <label>Product Supplier</label>
                      <input type="text" name="product" value="<?php echo $row['Product']; ?>" class="form-control" placeholder="Which Product Supplier">
                      
                      

                       
                    </div>
                  </div>

                  <div class="col-lg-6 md-6 col-xs-12 col-sm-12">
                    <div class="list-with-gap">
                        <label>State Name</label>
                      <select class="form-control" id="statename" name="statename" onchange = "getprice();">
                         <option value=" ">Select State</option>
                         <?php
                          $DropdownObj = new Dropdown;
                          $DropdownObj->StateDropdownSelected($stateid); ?>
                        
                        
                      </select>

                       <div id="city">
                               
                    <label>City Name</label>
                      <select class="form-control" id="city" name="cityname">
                         <option value=" ">Select City</option>
                         <?php $DropdownObj->CityDropdownSelected($cityid); ?>
                        
                        
                      </select>
                              </div>

                              <label>Location</label>
                      <input type="text" name="address" value="<?php echo $row['Address']; ?>" class="form-control" placeholder="Location">
                     
                    
                    </div>
                  </div>
                  
                </div>
               
              </section>
            </div>
            <div class="modal-footer">
              <button type="submit" name="UpdateVendor" class="btn btn-success">Update</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              
            </div>
             </form>

          </div>
        </div>
      </div>

                        

              </div>
              
            <?php
                 }   }}
            
}














function DeleteVendor()
{
       if(isset($_POST["DeleteVendor"])){
        include('config/dbconnection.php');
            $vendorid = $_POST['vendorid'];
            try {
            
        $dbmember = "DELETE FROM vendor WHERE id = ?";
        $q = $db->prepare($dbmember);
        $response = $q->execute(array($vendorid));
        
        if ($response) {
           header('Location:vendor.php');
         } 
          }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
        }


}





 









}

?>