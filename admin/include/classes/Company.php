<?php

/**
 * 
 */
class Company  
{
	
	function AddCompany()
	{
		


    	if(isset($_POST["add_company"])){
    		include('config/dbconnection.php');
            $user_id = trim($_POST['user_id']);
    		    $company_name = trim($_POST['company_name']);
            $address = trim($_POST['address']);
            $city = trim($_POST['city']);
            $state = trim($_POST['state']);
            $state_code = trim($_POST['state_code']);
            $pin_code = trim($_POST['pin_code']);
            
            $mob1 = trim($_POST['mob1']);
            $mob2 = trim($_POST['mob2']);
            $e_mail = trim($_POST['e_mail']);
            $gst = trim($_POST['gst']);
            $pan = trim($_POST['pan']);
            $acnumber = trim($_POST['acnumber']);
            $ifsc = trim($_POST['ifsc']);
            $bankname = trim($_POST['bankname']);
            $branchname = trim($_POST['branchname']);
            $RecTimeStamp = date('Y-m-d h:m:s');
           
            $imgFile = $_FILES['logo']['name'];
            $manditax=$_POST['manditax']; 



function resizeImage($resourceType,$image_width,$image_height) { 
    $resizeHeight = 120;
    $resizeWidth = 120;
    
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}
if (!empty($imgFile)) {
 
      
    $fileName = $_FILES['logo']['tmp_name']; 
        
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = rand();
        $uploadPath = "upload/Logo/";
        $fileExt = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $valid_extensions = array('jpeg', 'jpg');
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        if(in_array($fileExt, $valid_extensions)){  
        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagegif($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                break;
 
            default:
               
                break;
        }
        $file=0;
        move_uploaded_file($file, $uploadPath.$resizeFileName. ".". $fileExt);
       



        try {

                


	    			$sql = "INSERT INTO company_profile (User_Id, Company_Name, Address, City, State, State_Code, Pin_Code, Mob, Mob2, E_mail, Gst_No, Pan_No, Ac_No, IFSC, Bank_Name, Branch, Rec_Time_Stamp, Logo,Mandi_Tax) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:n,:o,:p,:q,:r,:s,:t)";
	    			$r = $db->prepare($sql);

	    			$insertservice = $r->execute(array(':a'=>$user_id,':b'=>$company_name,':c'=>$address, ':d'=>$city,':e'=>$state,':f'=>$state_code,':g'=>$pin_code,':h'=>$mob1,':i'=>$mob2,':j'=>$e_mail,':k'=>$gst,':l'=>$pan,':n'=>$acnumber,':o'=>$ifsc,':p'=>$bankname,':q'=>$branchname,':r'=>$RecTimeStamp,':s'=>$resizeFileName.".".$fileExt,':t'=>$manditax));
					if ($insertservice) {
            $_SESSION['success']='Registration Successfully!';
					}
					else{
						$_SESSION['error']='Something Wrong!';
					}
          $db = null;
                }

                catch(PDOException $e)
      {
        echo $e->getMessage();
      }
                    
              
       }
       else{
                $_SESSION['error'] = 'Sorry, only JPG & JPEG files are allowed.';  
               }
             } else {
              try {

                


            $sql = "INSERT INTO company_profile (User_Id, Company_Name, Address, City, State, State_Code, Pin_Code, Mob, Mob2, E_mail, Gst_No, Pan_No, Ac_No, IFSC, Bank_Name, Branch, Rec_Time_Stamp,Mandi_Tax) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:n,:o,:p,:q,:r,:s)";
            $r = $db->prepare($sql);

            $insertservice = $r->execute(array(':a'=>$user_id,':b'=>$company_name,':c'=>$address, ':d'=>$city,':e'=>$state,':f'=>$state_code,':g'=>$pin_code,':h'=>$mob1,':i'=>$mob2,':j'=>$e_mail,':k'=>$gst,':l'=>$pan,':n'=>$acnumber,':o'=>$ifsc,':p'=>$bankname,':q'=>$branchname,':r'=>$RecTimeStamp,':s'=>$manditax));
          if ($insertservice) {
           $_SESSION['success']='Registration Successfully!';
          }
          else{
            $_SESSION['error']='Something Wrong!';
          }
          $db = null;
                }

                catch(PDOException $e)
      {
        echo $e->getMessage();
      }
             }
    	}
    }
    


 
function UpdateCompany()
{

   if(isset($_POST["update_company"])){
     include('config/dbconnection.php');
            $profileid = $_POST['profileid'];
            $company_name = trim($_POST['company_name']);
            $address = trim($_POST['address']);
            $city = trim($_POST['city']);
            $state = trim($_POST['state']);
             $state_code = trim($_POST['state_code']);
            $pin_code = trim($_POST['pin_code']);
           
            $mob1 = trim($_POST['mob1']);
            $mob2 = trim($_POST['mob2']);
            $e_mail = trim($_POST['e_mail']);
            $pan = trim($_POST['pan']);
            $gst = trim($_POST['gst']);
            $acnumber = trim($_POST['acnumber']);
            $ifsc = trim($_POST['ifsc']);
            $bankname = trim($_POST['bankname']);
            $branchname = trim($_POST['branchname']);
            $imgFile = $_FILES['logo']['name'];
            $manditax=$_POST['manditax'];

             if (!empty($imgFile)) {
   
function resizeImage($resourceType,$image_width,$image_height) {
    $resizeHeight = 120;
    $resizeWidth = 120;
    
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}
 
$fileName = $_FILES['logo']['tmp_name']; 
        
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = rand();
        $uploadPath = "upload/Logo/";
        $fileExt = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $valid_extensions = array('jpeg', 'jpg');
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        if(in_array($fileExt, $valid_extensions)){  

          // For Delete photo from folder coding start
                $selectSql = $db->prepare("SELECT * FROM company_profile WHERE Profile_Id='$profileid'");
                $selectSql->execute();
                $getRow = $selectSql->fetch();
                $getIamgeName = $getRow['Logo'];
                if (!empty($getIamgeName)) {
                  $createDeletePath = "upload/Logo/".$getIamgeName;
                unlink($createDeletePath);
                }
                
    // For Delete photo from folder coding end

        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagegif($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                break;
 
            default:
               
                break;
        }
        $file=0;
        move_uploaded_file($file, $uploadPath.$resizeFileName. ".". $fileExt);

            try {
                   
                    $sql = "UPDATE company_profile SET Company_Name = :a, Address = :b, City = :c, State = :d, State_Code = :e, Pin_Code = :f,  Mob = :g, Mob2 = :h, E_mail = :i, Pan_No = :j, Gst_No = :k, Ac_No = :m, IFSC = :n, Bank_Name = :o, Branch = :p, Logo =:q, Mandi_Tax=:r WHERE Profile_Id = '$profileid'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$company_name,':b'=>$address,':c'=>$city,':d'=>$state,':e'=>$state_code,':f'=>$pin_code,':g'=>$mob1,':h'=>$mob2,':i'=>$e_mail,':j'=>$pan,':k'=>$gst,':m'=>$acnumber,':n'=>$ifsc,':o'=>$bankname,':p'=>$branchname,':q'=>$resizeFileName.".".$fileExt,':r'=>$manditax,));
                    if ($insertservice) {
                        $_SESSION['success']='Update Successfully!';
                        header('location:company_profile.php');
                    }
                    else{
                        $_SESSION['error']='Something Wrong!';
                        header('location:company_profile.php');
                    }
                    $db = null;
                     
                
                }
                
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }


                } else {
                  $_SESSION['error'] = 'Sorry, only JPG & JPEG files are allowed.';
                }
              }
            else{
                try {
                   
                     $sql = "UPDATE company_profile SET Company_Name = :a, Address = :b, City = :c, State = :d, State_Code = :e, Pin_Code = :f,  Mob = :g, Mob2 = :h, E_mail = :i, Pan_No = :j, Gst_No = :k, Ac_No = :m, IFSC = :n, Bank_Name = :o, Branch = :p, Mandi_Tax=:q WHERE Profile_Id = '$profileid'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$company_name,':b'=>$address,':c'=>$city,':d'=>$state,':e'=>$state_code,':f'=>$pin_code,':g'=>$mob1,':h'=>$mob2,':i'=>$e_mail,':j'=>$pan,':k'=>$gst,':m'=>$acnumber,':n'=>$ifsc,':o'=>$bankname,':p'=>$branchname,':q'=>$manditax));
                    if ($insertservice) {
                        $_SESSION['success']='Update Successfully!';
                        header('location:company_profile.php');
                    }
                    else{
                        $_SESSION['error']='Something Wrong!';
                        header('location:company_profile.php');
                    }
                    $db = null;
                
                
                }
                
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
                }
            }

           
                 

   
    
}//close of function update doctor
       


function ViewCompany(){
include('config/dbconnection.php');
                $user_id = $_SESSION['userid'];
     
                $result = $db->prepare("SELECT * FROM company_profile WHERE User_Id='$user_id' ORDER BY Company_Name ASC");
                $result->execute();
               for($i=0; $row = $result->fetch(); $i++){
                $stateid = $row['State'];

                $resultstate = $db->prepare("SELECT * FROM state_code WHERE id='$stateid'");
                $resultstate->execute();
               for($i=0; $rowstate = $resultstate->fetch(); $i++){

                
                ?>
            
                <tr>
                        <td><?php echo $row['Company_Name']; ?></td>
                        <td><?php echo $row['City'].", ".$rowstate['State_Name']; ?></td>
                        <td><?php echo $row['Address']; ?></td>
                        <td><?php echo $row['Mob'].", ".$row['Mob2']; ?></td>
                        <td><?php echo $row['E_mail']; ?></td>
                         <td><?php echo $row['Pan_No']; ?></td>
                         <td><?php echo $row['Gst_No']; ?></td>
        <td>
          <?php
          if (empty($row['Logo'])) { ?>
           <img style="height: 50px; width: 90px;" src="dist/img/noimage.png">
          <?php } else { ?>
           <img style="height: 50px; width: 90px;" src="upload/Logo/<?php echo $row['Logo']; ?>"><?php } ?></td>
                         
                       

                        <td>
                          <a href="company_edit.php?id=<?php echo $row['Profile_Id']; ?>" class="btn btn-link btn-icon bigger-130 text-info" data-placement="top" title="Edit"><i data-feather="edit"></i></a>
                            <?php 
                                if($row['Active'] =='1')
                                { 
                            ?>
                            <button class="btn btn-link btn-icon bigger-130 text-danger" data-placement="top" title="Deactivate" data-toggle="modal"  data-target="#DeactiveModal-<?php echo $row['Profile_Id']; ?>"><i data-feather="x-circle"></i>  </button>    
                            <?php
                                }
                                else
                                {
                            ?>
                            <button class="btn btn-link btn-icon bigger-130 text-success" data-placement="top" title="Activate" data-toggle="modal"  data-target="#DeactiveModal-<?php echo $row['Profile_Id']; ?>"><i data-feather="check-circle" aria-hidden="true"></i>  </button>
                              <?php
                                } 
                            ?>
                            <button class="btn btn-link btn-icon bigger-130 text-danger" data-toggle="modal" title="Delete" data-target="#DeleteModal-<?php echo $row['Profile_Id']; ?>"><i data-feather="trash"></i></button>

                           <a href="setting.php?id=<?php echo $row['Profile_Id']; ?>" class="btn btn-link btn-icon bigger-130 text-primary" data-placement="top" title="Setting"><i data-feather="settings"></i></a>
                             
                    
                        </td>
                    </tr>
             <div class="col-lg-12">
                       <div class="modal fade" id="DeleteModal-<?php echo $row['Profile_Id']; ?>" tabindex="<?php echo $row['Profile_Id']; ?>"  role="dialog" aria-labelledby="myModalLabel-<?php echo $row['Profile_Id']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="H2">Are you sure want to delete this record? </h4>
                                        </div>
                                        <form role="form" method="post" class="form-horizontal" id="popup-validation">
                                            <input type="hidden" name="id" value="<?php echo $row['Profile_Id']; ?>">
                                            <div class="modal-body">
                                                <button type="submit" class="btn btn-danger" name = "DeleteCompany" >Delete</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        <div class="modal fade" id="DeactiveModal-<?php echo $row['Profile_Id']; ?>" tabindex="<?php echo $row['Profile_Id']; ?>" role="dialog" aria-labelledby="myModalLabel-<?php echo $row['Profile_Id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <?php 
                                            if($row['Active'] == '1')
                                            { 
                                        ?>
                                        <h4 class="modal-title" id="H2">Are you sure want to deactivate ? </h4>    
                                        <?php 
                                            }
                                                else
                                            {
                                        ?>
                                        <h4 class="modal-title" id="H2">Are you sure want to Activate ? </h4> 
                                        <?php   
                                            }
                                        ?>
                                    </div>
                                    <?php 
                                        if($row['Active'] == '1')
                                            { 
                                        ?>
                                        <form role="form" method="post" class="form-horizontal" id="popup-validation">
                                            <input type="hidden" name="companyid" value="<?php echo $row['Profile_Id']; ?>">
                                            <div class="modal-body">
                                                <button type="submit" class="btn btn-danger" name = "DeactivateCompany" >Deactivate</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>    
                                        <?php 
                                            }
                                                else
                                            {
                                        ?>
                                        <form role="form" method="post" class="form-horizontal" id="popup-validation">
                                            <input type="hidden" name="companyid" value="<?php echo $row['Profile_Id']; ?>">
                                            <div class="modal-body">
                                                <button type="submit" class="btn btn-danger" name = "ActivateCompany" >Activate</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </form> 
                                        <?php   
                                            }
                                        ?>
                                    
                                </div>
                            </div>
                        </div>


                       </div>
              
            <?php
                } }
            


     }  






function DeactivateCompany()
    {
        if(isset($_POST["DeactivateCompany"])){
            include('config/dbconnection.php');
            $companyid = $_POST['companyid'];
            
            
            try {
                $sql = "UPDATE company_profile SET Active = :a WHERE Profile_Id = '$companyid'";
                $q = $db->prepare($sql);
                $insertservice = $q->execute(array(':a'=>0,));
                if ($insertservice) {
                    $_SESSION['success']='Company Deactivate Successfully';
                   
                }
                else{
                    $_SESSION['error']='Something Wrong';
                }
                $db = null;
                
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
    }


      function ActivateCompany()
    {
        if(isset($_POST["ActivateCompany"])){
            include('config/dbconnection.php');
            $companyid = $_POST['companyid'];
            
            
            try {
                $sql = "UPDATE company_profile SET Active = :a WHERE Profile_Id = '$companyid'";
                $q = $db->prepare($sql);
                $insertservice = $q->execute(array(':a'=>1,));
                if ($insertservice) {
                   $_SESSION['success']='Company Activate Successfully';
                   
                }
                else{
                    $_SESSION['error']='Something Wrong';
                }
                $db = null;
                
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
    }




function DeleteCompany()
{
      
 include('config/dbconnection.php');

if(isset($_POST['DeleteCompany']))
  {
    $id=$_POST['id'];
    $selectSql=$db->prepare("SELECT * FROM company_profile WHERE Profile_Id='$id'");
    $selectSql->execute();
    $getRow=$selectSql->fetch();
    $getIamgeName = $getRow['Logo'];
    if (empty($getIamgeName)) {
      $dbmember = "DELETE FROM company_profile WHERE Profile_Id = ?";
        $q = $db->prepare($dbmember);
        $response = $q->execute(array($id));  
      
      if($response)
      {
        header('location:company_profile.php');
        exit();
      }
    } else {
    $createDeletePath = "upload/Logo/".$getIamgeName;
    
    if(unlink($createDeletePath))
    {

      $dbmember = "DELETE FROM company_profile WHERE Profile_Id = ?";
        $q = $db->prepare($dbmember);
        $response = $q->execute(array($id));  
      
      if($response)
      {
        header('location:company_profile.php');
        exit();
      }
    }
    else
    {
      $errorMsg = "Unable to delete Image";
    }
  
  }
}

}













 } // close of cladss doctor 


?>