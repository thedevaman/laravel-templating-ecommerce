
<?php

/**
 * 
 */
class Users 
{


	

function ViewUsers(){
include('config/dbconnection.php');
                      $stmt = $db->prepare("SELECT * FROM users WHERE type!='1' ORDER BY firstname ASC");
                      $stmt->execute();
                      foreach($stmt as $row){
                        $role=$row['type'];
                        ?>
                          <tr>
                            <td class="hidden"></td>
                            <td><?php echo $row['firstname'].$row['lastname'];?></td>
                            <td><?php echo $row['contact_info'];?></td>
                            <td><?php echo $row['address'].", ".$row['City'].", ".$row['State'];?></td>
                            
                            <td><?php echo date('d-m-Y', strtotime($row['created_on']));?></td>
                            <td><?php if ($role == 2) {
                              echo "Vendor";
                            }else
                            if ($role == 3) {
                              echo "Customer";
                             }?></td>
                             <td><?php if ($row['Active'] == 1) { ?>
                              <span class="badge badge-success">Active</span>
                            <?php }else
                            if ($row['Active'] == 2) { ?>
                              <span class="badge badge-danger">Deactive</span>
                            <?php }?></td>
                            
                            
                            <td>
                            
                           
                            <!-- <a class="btn btn-link btn-icon bigger-130 text-info" href="receipt.php?salesid=<?php echo $row['id']; ?>"><i class="fa fa-print"></i></a>  -->
                            <button class="btn btn-link btn-icon bigger-130 text-danger" data-toggle="modal" title="Delete" data-target="#DeleteModal-<?php echo $row['id']; ?>"><i class="fa fa-trash"></i></button>
                            </td>
                          
                     
              </tr>
                        <div class="col-lg-12 col-xs-12">
                            <div class="modal fade" id="DeleteModal-<?php echo $row['id']; ?>" tabindex="<?php echo $row['id']; ?>"  role="dialog" aria-labelledby="myModalLabel-<?php echo $row['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="H2">Are you sure want to delete this record? </h4>
                                        </div>
                                        <form role="form" method="post" class="form-horizontal" id="popup-validation">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <div class="modal-body">
                                                <button type="submit" class="btn btn-danger" name = "DeleteAccount" >Delete</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>







                            <div class="modal fade" id="AccountEdit-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="smModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white shadow-none">
              <h6 class="modal-title" id="smModalLabel">PROCESS</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST">
            <div class="modal-body">
             <section id="section1">
                
                
                <input type="hidden" value="<?php echo $row['id']; ?>" name="account_id">
                
                <div class="row">
                  <div class="form-group col-lg-12 col-xs-12"> 
                  <label>Status</label>
                  <div>
                                <select class="form-control" name="status" id="cancelid" required>
                                  <option>Select Option</option>
                                  <option value="1">Approved</option>
                                  <option value="2">Cancel</option>
                                  
                                </select>
                  </div>
                  </div>

                  <div id="cancel" class="col-lg-12 col-xs-12">
                      <div class="form-group">
                          <label>Reason</label>
                           <div>
                        <input type="text" name="reason" class="form-control"  placeholder="Reason for Cancel Order"  />
                               </div> 
                              
                      </div>
                   </div>

                   <div id="approved" class="col-lg-12 col-xs-12">
                      <div class="form-group ">
                          <label for="edit_name" class=" control-label">Delivery Date</label>
                           <div>
                        <input type="text" name="deliverydate" class="form-control"  placeholder="Delivery Date"  />
                               </div> 
                              
                      </div>
                   </div>
                </div>


               
              </section>
            </div>
            <div class="modal-footer">
              <button type="submit" name="update_account" class="btn btn-success">Submit</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              
            </div>
            
             </form>
          </div>
        </div>
      </div>
                        </div>
              
            <?php
                
            
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
;
</script>