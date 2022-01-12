<?php class Famsmaster   {
    

function UpdateDP()
{

if(isset($_POST["dp_btn"])){
        include('config/dbconnection.php');
            $user_id = trim($_POST['user_id']);



function resizeImage($resourceType,$image_width,$image_height) {
    $resizeHeight = 60;
    $resizeWidth = 60;
    
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}
 
$fileName = $_FILES['dp']['tmp_name']; 
        
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = rand();
        $uploadPath = "../english/upload/DP/";
        $fileExt = pathinfo($_FILES['dp']['name'], PATHINFO_EXTENSION);
        $valid_extensions = array('jpeg', 'jpg');
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        if(in_array($fileExt, $valid_extensions)){  

          // For Delete photo from folder coding start
                $selectSql = $db->prepare("SELECT * FROM user WHERE User_Id='$user_id'");
                $selectSql->execute();
                $getRow = $selectSql->fetch();
                $getIamgeName = $getRow['DP'];
                if (!empty($getIamgeName)) {
                  $createDeletePath = "../english/upload/DP/".$getIamgeName;
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
                    
                    $sql = "UPDATE user SET DP = :a WHERE User_Id='$user_id'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$resizeFileName.".".$fileExt));
                   
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
             
      }
}

        function UpdateProfile()
    {
        include('config/dbconnection.php');
        
        if(isset($_POST["update_profile"])){
            $userid = trim($_POST['userid']);
            $firstname = trim($_POST['firstname']);
            $contact = trim($_POST['usercontact']);
            $emailid = trim($_POST['useremail']);
            $address = trim($_POST['address']);
            $state = trim($_POST['state']);
            
            try {

                    $sql = "UPDATE user SET First_Name = :a, User_Contact = :c, User_Email = :d, Address = :e, State = :f WHERE User_Id= $userid ";
                    $q = $db->prepare($sql);
                    $insertservice = $q->execute(array(':a'=>$firstname,':c'=>$contact,':d'=>$emailid,':e'=>$address,':f'=>$state));
                    if ($insertservice) {
                        $_SESSION['success']='Update Successfully!';
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


            function ChangePassword()
    {
        include('config/dbconnection.php');
          
  
        if(isset($_POST["update_password"])){
            $userid=trim($_POST['userid']);
            $old_password = Md5(trim($_POST['OldPassword']));
            $new_password = Md5(trim($_POST['NewPassword'])); 
            
            $result = $db->prepare("SELECT * FROM user WHERE User_Id='$userid'");
        $result->execute();
        for ($i=0; $row=$result->fetch(); $i++) { 
            $Password = $row['User_Password'];
        }
    
    if ($_POST["NewPassword"]===$_POST["ConfirmPassword"]){

        if ($old_password == $Password) {
            
                $sql = "UPDATE user SET User_Password = :a WHERE User_Id='$userid' ";
                    $q = $db->prepare($sql);
                    $insertpassword = $q->execute(array(':a'=>$new_password));
                    if ($insertpassword) {
                        $_SESSION['success']='Password Updated Successfully!';
                        
                    }
                    else{
                        $_SESSION['error']='Password Not Successfully Updated!';
                    }
                    
                }

                else{

                    $_SESSION['error']='Old Password Does Not Match!';
                }
            }
            else{
                $_SESSION['error']='New Password & Confirm Password Does Not Match!';
            }
           
        }
    }
    



    function UpdateSetting()
{

   if(isset($_POST["update_set"])){
     include('config/dbconnection.php');
        $profileid=trim($_POST['profileid']);
        $btc1 = trim($_POST['btc1']);
        $btc2 = trim($_POST['btc2']);
        $btc3 = trim($_POST['btc3']);
        $template = trim($_POST['template']);
        $sign = trim($_POST['sign']);
       
        $imgFile = $_FILES['signphoto']['name'];

             if (!empty($imgFile)) {
   
function resizeImage($resourceType,$image_width,$image_height) {
    $resizeHeight = 75;
    $resizeWidth = 120;
    
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}
 
$fileName = $_FILES['signphoto']['tmp_name']; 
        
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = rand();
        $uploadPath = "upload/Sign/";
        $fileExt = pathinfo($_FILES['signphoto']['name'], PATHINFO_EXTENSION);
        $valid_extensions = array('jpeg', 'jpg');
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        if(in_array($fileExt, $valid_extensions)){  

          // For Delete photo from folder coding start
                $selectSql = $db->prepare("SELECT * FROM company_profile WHERE Profile_Id='$profileid'");
                $selectSql->execute();
                $getRow = $selectSql->fetch();
                $getIamgeName = $getRow['Bill_Sign'];
                if (!empty($getIamgeName)) {
                  $createDeletePath = "upload/Sign/".$getIamgeName;
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
                   
                    $sql = "UPDATE company_profile SET Bill_TC_1 = :a, Bill_TC_2 = :b,Bill_TC_3 = :c, Invoice_Type = :d, Sign_Confirmation = :e, Bill_Sign = :f WHERE Profile_Id = '$profileid'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$btc1,':b'=>$btc2,':c'=>$btc3,':d'=>$template,':e'=>$sign,':f'=>$resizeFileName.".".$fileExt));
                    if ($insertservice) {
                      $_SESSION['success']='Update Successfully!';
                        
                    }
                    else{
                       $_SESSION['error']='Something Wrong!';
                    }
                    $db = null;
                     
                header('Refresh:0');
                }
                
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }


                } else{
                  $_SESSION['error'] = 'Sorry, only JPG & JPEG files are allowed.';
                } }
            else{
               try {
                   
                     $sql = "UPDATE company_profile SET Bill_TC_1 = :a, Bill_TC_2 = :b,Bill_TC_3 = :c, Invoice_Type = :d, Sign_Confirmation = :e WHERE Profile_Id = '$profileid'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$btc1,':b'=>$btc2,':c'=>$btc3,':d'=>$template,':e'=>$sign));
                    if ($insertservice) {
                      $_SESSION['success']='Update Successfully!';
                        
                    }
                    else{
                       $_SESSION['error']='Something Wrong!';
                    }
                    $db = null;
                     header('Refresh:0');
                
                }
                
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
                }
            }

           
                 

   
    
}


function NewProfile()
{
     if(isset($_POST["signupbtn"])){
            include('config/dbconnection.php');
            $firstname = trim($_POST['firstname']);
           
            $mob = trim($_POST['mob']);
            $e_mail = trim($_POST['e_mail']);
            $softwaretype = trim($_POST['softwaretype']);
            $password = Md5 (trim($_POST['password']));
            $confirmpassword = Md5(trim($_POST['confirmpassword']));
            
            $startdate = date('Y-m-d');
            $enddate = date('Y-m-d', strtotime($startdate. ' + 15 days'));

            if ($softwaretype==1) {
                $softwarename="TRNSPT";
            } if ($softwaretype==2) {
                $softwarename="MRCHNT";
            }
            $customerid=rand();
            $stmt = $db->prepare("SELECT count(*) as numrows FROM user WHERE User_Email=:email");
            $stmt->execute(['email'=>$e_mail]);
            $row = $stmt->fetch();
            if($row['numrows'] > 0){
                
                $_SESSION['error'] = 'Email already taken';
                
            } else{

            try {
                    if ($password==$confirmpassword) {
                    $sql = "INSERT INTO user (First_Name,User_Contact,User_Email,Software_Type, User_Password, Start_Date,End_Date,Software_Name,Customer_Id) VALUES (:a,:c,:d,:e,:f,:g,:h,:i,:j)";
                    $r = $db->prepare($sql);

                    $insertservice = $r->execute(array(':a'=>$firstname,':c'=>$mob,':d'=>$e_mail,':e'=>$softwaretype,':f'=>$password,':g'=>$startdate,':h'=>$enddate,':i'=>$softwarename,':j'=>$customerid));
                    if ($insertservice) {
                        $_SESSION['success']='Registration Successfull Please Wait!';
                        
                        
                    }
                    else{
                        $_SESSION['error']='Something wrong';
                        
                    }
                    $db = null;

                } else{
                    $_SESSION['error']='Password & Confirm Password are not matched';
                    
                   
                }
                // header('location: signup.php');


                $field = array(
    "sender_id" => "IMPSMS",
    "language" => "english",
    "route" => "qt",
    "numbers" => $mob,
    "message" => "30585",
    "variables" => "{#DD#}",
    "variables_values" => $firstname
);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($field),
  CURLOPT_HTTPHEADER => array(
    "authorization: WfrHm2NSDzEyALPM3RacKQb8kXGxwtJTjgnIis0YpZhevBloFCIG2qZKXRLkCifUMAtOazg9lmxwnQJB",
    "cache-control: no-cache",
    "accept: */*",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);



$field = array(
    "sender_id" => "IMPSMS",
    "language" => "english",
    "route" => "qt",
    "numbers" => "9919646671",
    "message" => "30586",
    "variables" => "{#DD#}|{#BB#}|{#CC#}",
    "variables_values" => $firstname."|".$softwarename."|".$mob
);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($field),
  CURLOPT_HTTPHEADER => array(
    "authorization: WfrHm2NSDzEyALPM3RacKQb8kXGxwtJTjgnIis0YpZhevBloFCIG2qZKXRLkCifUMAtOazg9lmxwnQJB",
    "cache-control: no-cache",
    "accept: */*",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);





                
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
        }
}


function SendOTP()
{
    if(isset($_POST["btn"])){
            include('config/dbconnection.php');
            $mob = trim($_POST['mob']);

            $result = $db->prepare("SELECT *, count(*) as mobile FROM user WHERE User_Contact=:a");
            $result->execute(['a'=>$mob]);
            $row = $result->fetch();
            
            if($row['mobile']>0){
                $userid=$row['User_Id'];
            $fourdigitrandom = rand(1000,9999); 
            
              $sql = "INSERT INTO otp (User_Id,OTP) VALUES (:a,:b)";
                    $r = $db->prepare($sql);

                    $insertservice = $r->execute(array(':a'=>$userid,':b'=>$fourdigitrandom));

                    $field = array(
    "sender_id" => "IMPSMS",
    "language" => "english",
    "route" => "qt",
    "numbers" => $mob,
    "message" => "30595",
    "variables" => "{#BB#}",
    "variables_values" => $fourdigitrandom
);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($field),
  CURLOPT_HTTPHEADER => array(
    "authorization: WfrHm2NSDzEyALPM3RacKQb8kXGxwtJTjgnIis0YpZhevBloFCIG2qZKXRLkCifUMAtOazg9lmxwnQJB",
    "cache-control: no-cache",
    "accept: */*",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

                    if ($insertservice) {
                        $_SESSION['success']='Otp Sent Successfull!';
                        header("Refresh: 0; URL=verify_otp.php?userid=$userid");
                    }
                    else{
                        $_SESSION['error']='Something wrong';
                        header('Refresh 0:forgot_userid.php');
                        
              }
            }
             else{
                        $_SESSION['error']='Mobile number are not registered';
                        header('Refresh 0:forgot_userid.php');
                        
              }

           
        }
}




function SendPasswordOTP()
{
    if(isset($_POST["btn"])){
            include('config/dbconnection.php');
            $userid = trim($_POST['userid']);

            $result = $db->prepare("SELECT *, count(*) as useremail FROM user WHERE User_Email=:a");
            $result->execute(['a'=>$userid]);
            $row = $result->fetch();
            
            if($row['useremail']>0){
                $userid=$row['User_Id'];
                $mob = $row['User_Contact'];
            $fourdigitrandom = rand(1000,9999); 
            
              $sql = "INSERT INTO otp (User_Id,OTP) VALUES (:a,:b)";
                    $r = $db->prepare($sql);

                    $insertservice = $r->execute(array(':a'=>$userid,':b'=>$fourdigitrandom));

                    $field = array(
    "sender_id" => "IMPSMS",
    "language" => "english",
    "route" => "qt",
    "numbers" => $mob,
    "message" => "30595",
    "variables" => "{#BB#}",
    "variables_values" => $fourdigitrandom
);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($field),
  CURLOPT_HTTPHEADER => array(
    "authorization: WfrHm2NSDzEyALPM3RacKQb8kXGxwtJTjgnIis0YpZhevBloFCIG2qZKXRLkCifUMAtOazg9lmxwnQJB",
    "cache-control: no-cache",
    "accept: */*",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

                    if ($insertservice) {
                        $_SESSION['success']='Otp Sent Successfull!';
                        header("Refresh: 0; URL=verify_password_otp.php?userid=$userid");
                    }
                    else{
                        $_SESSION['error']='Something wrong';
                        header('Refresh 0:forgot_password.php');
                        
              }
            }
             else{
                        $_SESSION['error']='User Id are not correct';
                        header('Refresh 0:forgot_password.php');
                        
              }

           
        }
}



function VerifyOTP()
{
    if(isset($_POST["btn"])){
            include('config/dbconnection.php');
            $userid = trim($_POST['userid']);
            $otp = trim($_POST['otp']);

            $result = $db->prepare("SELECT * FROM otp WHERE User_Id=:a ORDER BY id DESC");
            $result->execute(['a'=>$userid]);
            $row = $result->fetch();
            
            if($row['OTP']==$otp){

                $resultuser = $db->prepare("SELECT * FROM user WHERE User_Id=:a");
            $resultuser->execute(['a'=>$userid]);
            $rowuser = $resultuser->fetch();
                $useremail=$rowuser['User_Email'];
            
                        $_SESSION['otp']=$useremail;
                 
            }
             else{
                        $_SESSION['error']='Invalid OTP';
                       
               }

           
        }
}



function VerifyPasswordOTP()
{
    if(isset($_POST["btn"])){
            include('config/dbconnection.php');
            $userid = trim($_POST['userid']);
            $otp = trim($_POST['otp']);

            $result = $db->prepare("SELECT * FROM otp WHERE User_Id=:a ORDER BY id DESC");
            $result->execute(['a'=>$userid]);
            $row = $result->fetch();
            
            if($row['OTP']==$otp){

               
                       header("Refresh: 0; URL=reset_password.php?userid=$userid");
                 
            }
             else{
                        $_SESSION['error']='Invalid OTP';
                       
               }

           
        }
}




function ResetPassword()
    {
        include('config/dbconnection.php');
          
  
        if(isset($_POST["btn"])){
            $userid=trim($_POST['userid']);
            $password = Md5(trim($_POST['password']));
            $confirm_password = Md5(trim($_POST['confirmpassword'])); 
            

        if ($password == $confirm_password) {
            
                $sql = "UPDATE user SET User_Password = :a WHERE User_Id='$userid' ";
                    $q = $db->prepare($sql);
                    $insertpassword = $q->execute(array(':a'=>$password));
                    if ($insertpassword) {
                        $_SESSION['success']='Password Updated Successfully!';
                        
                    }
                    else{
                        $_SESSION['error']='Password Not Successfully Updated!';
                    }
                    
                }

                else{

                    $_SESSION['error']='New Password & Confirm Password Does Not Match!';
                }
            }
           
           
        }
    


function UpdateBiltySetting()
{

   if(isset($_POST["update_bilty_set"])){
     include('config/dbconnection.php');
        $transportid=trim($_POST['transportid']);
        $btc1 = trim($_POST['btc1']);
        $btc2 = trim($_POST['btc2']);
        $template = trim($_POST['template']);
        $sign = trim($_POST['sign']);
       
        $imgFile = $_FILES['signphoto']['name'];

             if (!empty($imgFile)) {
   
function resizeImage($resourceType,$image_width,$image_height) {
    $resizeHeight = 75;
    $resizeWidth = 120;
    
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}
 
$fileName = $_FILES['signphoto']['tmp_name']; 
        
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = rand();
        $uploadPath = "upload/Bilty/";
        $fileExt = pathinfo($_FILES['signphoto']['name'], PATHINFO_EXTENSION);
        $valid_extensions = array('jpeg', 'jpg');
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        if(in_array($fileExt, $valid_extensions)){  

          // For Delete photo from folder coding start
                $selectSql = $db->prepare("SELECT * FROM add_transporter WHERE id='$transportid'");
                $selectSql->execute();
                $getRow = $selectSql->fetch();
                $getIamgeName = $getRow['Bilty_Sign'];
                if (!empty($getIamgeName)) {
                  $createDeletePath = "upload/Bilty/".$getIamgeName;
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
                   
                    $sql = "UPDATE add_transporter SET BTC_1 = :a, BTC_2 = :b,Template = :c, Sign_Confirmation = :d, Bilty_Sign = :e WHERE id = '$transportid'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$btc1,':b'=>$btc2,':c'=>$template,':d'=>$sign,':e'=>$resizeFileName.".".$fileExt));
                    if ($insertservice) {
                      $_SESSION['success']='Update Successfully!';
                        
                    }
                    else{
                       $_SESSION['error']='Something Wrong!';
                    }
                    $db = null;
                     
                header('Refresh:0');
                }

                
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }


                } else{
                  $_SESSION['error'] = 'Sorry, only JPG & JPEG files are allowed.';
                } }
            else{
               try {
                   
                    $sql = "UPDATE add_transporter SET BTC_1 = :a, BTC_2 = :b,Template = :c, Sign_Confirmation = :d WHERE id = '$transportid'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$btc1,':b'=>$btc2,':c'=>$template,':d'=>$sign));
                    if ($insertservice) {
                      $_SESSION['success']='Update Successfully!';
                        
                    }
                    else{
                       $_SESSION['error']='Something Wrong!';
                    }
                    $db = null;
                     
                header('Refresh:0');
                }
                
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
                }
            }

           
                 

   
    
}









}