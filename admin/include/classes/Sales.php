




<?php

/**
 * 
 */
class Sales 
{



function AssignVendor()
{
   
if (isset($_POST['assign_vendor'])) {
    include('config/dbconnection.php');
    $salesid = $_POST['salesid'];
    $vendor = $_POST['vendor'];
    
   try{

  

               $sql = "UPDATE sales SET Vendor_Id = :a WHERE id = '$salesid'";
            $z = $db->prepare($sql);
           $insertservice = $z->execute(array(':a'=>$vendor));
            if ($insertservice) {
                $_SESSION['success']='Vendor Assign Successfully!';
                }
            else{
                $_SESSION['error']='Something Wrong!';
            }
            $db = null;
   
 }

   catch(PDOException $e){
    echo $e->getMessage();
   }
   
}





}


  






function OrderProcess()
{
   
if (isset($_POST['order_process'])) {
    include('config/dbconnection.php');
    $salesid = $_POST['salesid'];
    $status = $_POST['status'];
    $cancelreason = $_POST['cancelreason'];
    $returnreason = $_POST['returnreason'];
    $deliverydate = $_POST['deliverydate'];
    
   try{

  

               $sql = "UPDATE sales SET Status = :a, Cancel_Reason = :b, Return_Reason = :c, Delivery_Date = :d WHERE id = '$salesid'";
            $z = $db->prepare($sql);
           $insertservice = $z->execute(array(':a'=>$status, ':b'=>$cancelreason, ':c'=>$returnreason, ':d'=>$deliverydate));
            if ($insertservice) {
                $_SESSION['success']='Update Successfully!';
                }
            else{
                $_SESSION['error']='Something Wrong!';
            }
            $db = null;
   
 }

   catch(PDOException $e){
    echo $e->getMessage();
   }
   
}





}


      


function AddAccount()
{
   
if (isset($_POST['add_account'])) {
    include('config/dbconnection.php');
    $user_id = $_POST['user_id'];
    $person_name = $_POST['person_name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
   $state = $_POST['state'];
   $opening_balance = $_POST['opening_balance'];
    $cr_dr = $_POST['cr_dr'];
    $gst = $_POST['gst'];
   $group = $_POST['group'];
   $mob = $_POST['mob'];
    $email_id = $_POST['email_id'];
    $account_no = $_POST['account_no'];
   $ifsc = $_POST['ifsc'];
   $branch = $_POST['branch'];
   $holder_name = $_POST['holder_name'];
    $description = $_POST['description'];
    
   $RecTimeStamp = Date("Y-m-d H:m:s");

   

   try{

  

    $sql = "INSERT INTO account (User_Id, Person_Name, Address, City, State, Opening_Balance, Cr_Dr, GST_No, Ac_Group, Mob, Email, Ac_No, IFSC, Branch, Holder_Name, Description, Rec_Time_Stamp) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m,:n,:o,:p,:q)";
    $r = $db->prepare($sql);
    $result =$r->execute(array(':a'=>$user_id, ':b'=>$person_name, ':c'=>$address, ':d'=>$city, ':e'=>$state, ':f'=>$opening_balance, ':g'=>$cr_dr, ':h'=>$gst, ':i'=>$group, ':j'=>$mob, ':k'=>$email_id, ':l'=>$account_no, ':m'=>$ifsc, ':n'=>$branch, ':o'=>$holder_name, ':p'=>$description, ':q'=>$RecTimeStamp));
    if ($result) {
        $_SESSION['success']='Account Create Successfully!';
    }
    else{
        $_SESSION['error']='Something Wrong!';
    }
    $db = null;
   
   
 }

   catch(PDOException $e){
    echo $e->getMessage();
   }
   
}





}




function UpdateAccount()
{

   if(isset($_POST["update_account"])){
     include('config/dbconnection.php');
       
    $account_id = $_POST['account_id'];
    $person_name = $_POST['person_name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
   $state = $_POST['state'];
   $opening_balance = $_POST['opening_balance'];
    $cr_dr = $_POST['cr_dr'];
    $gst = $_POST['gst'];
   $group = $_POST['group'];
   $mob = $_POST['mob'];
    $email_id = $_POST['email_id'];
    $account_no = $_POST['account_no'];
   $ifsc = $_POST['ifsc'];
   $branch = $_POST['branch'];
   $holder_name = $_POST['holder_name'];
    $description = $_POST['description'];
    
        
                try {
                   
                    $sql = "UPDATE account SET Person_Name = :a, Address = :b, City = :c, State = :d, Opening_Balance = :e, Cr_Dr = :f, GST_No = :g, Ac_Group = :h, Mob = :i, Email = :j, Ac_No = :k, IFSC = :l, Branch = :m, Holder_Name = :n, Description = :o WHERE id = '$account_id'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$person_name,':b'=>$address,':c'=>$city,':d'=>$state, ':e'=>$opening_balance,':f'=>$cr_dr,':g'=>$gst,':h'=>$group,':i'=>$mob, ':j'=>$email_id,':k'=>$account_no,':l'=>$ifsc,':m'=>$branch,':n'=>$holder_name, ':o'=>$description));
                    if ($insertservice) {
                        $_SESSION['success']='Account Update Successfully!';
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
             
     
	
}//close of function update client
       
//delete client
function DeleteAccount()
{
       if(isset($_POST["DeleteAccount"])){
        include('config/dbconnection.php');
            $id = $_POST['id'];
            try {

        $dbmember = "DELETE FROM account WHERE id = ?";
        $q = $db->prepare($dbmember);
        $response = $q->execute(array($id)); 
        if ($response) {
           header('Location:account.php');
         } 
          }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
        }

}






 } // close of cladss doctor 


?>
          <script type="text/javascript">
   $('#cancelid').on('change',function(){
            if( $(this).val()==="1"){
              $("#approved").show()
              }
              else{
                 $("#approved").hide() 
            }

             if( $(this).val()==="2"){
              $("#cancel").show()
              }
              else{
                 $("#cancel").hide() 
            }
  
            });
</script>