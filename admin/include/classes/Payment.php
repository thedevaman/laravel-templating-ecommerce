
<?php

/**
 * 
 */
class Payment 
{


    

function ViewPayment($orderid){
include('config/dbconnection.php');
    $result = $db->prepare("SELECT * FROM payment WHERE Order_Id='$orderid'");
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
        $depositid=$row['Payment_Method'];

        $resultpayment = $db->prepare("SELECT * FROM dropdown WHERE Status_Id='$depositid'");
    $resultpayment->execute();
    for($i=0; $rowpayment = $resultpayment->fetch(); $i++){
    


    ?>

    <tr>
    <td><?php echo date('d-m-Y', strtotime($row['Payment_Date'])); ?></td> 
    <td><?php echo number_format($row['Amount']); ?></td> 
    <td><?php echo $rowpayment['Deposit_Method']; ?></td>
    <td><?php echo $row['Description']; ?></td>
     
    <td class="text-center">
      <div class="btn-group btn-group-xs" role="group">

      <button type="button" title="Edit" class="btn btn-link btn-icon bigger-130 text-success" data-toggle="modal" data-target="#PaymentEdit-<?php echo $row['id']; ?>"><i data-feather="edit"></i></button>


    <button class="btn btn-link btn-icon bigger-130 text-danger" data-toggle="modal" title="Delete" data-target="#DeleteModal-<?php echo $row['id']; ?>"><i data-feather="trash"></i></button>
    </div>

      


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
                            <button type="submit" class="btn btn-danger" name = "DeletePayment" >Delete</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="modal fade" id="PaymentEdit-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="smModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white shadow-none">
              <h6 class="modal-title" id="smModalLabel">UPDATE PAYMENT</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST">
            <div class="modal-body">
             <section id="section1">
              
                
                <input type="hidden" value="<?php echo $row['id']; ?>" name="paymentid">
                 <div>
                 
                    <div class="list-with-gap">
                      <label>Amount</label>
                      <input type="text" value="<?php echo $row['Amount']; ?>" name="amount" class="form-control" placeholder="Amount">
                      <label>Date</label>
                       <input type="text" value="<?php echo $row['Payment_Date']; ?>" name="paymentdate" class="form-control datepicker-input" autocomplete="off" placeholder="yyyy-mm-dd" required>

                      
                       <label>Payment Method</label>
                      <select class="form-control" name="paymentmethod" required>
                      <?php
                      $DropdownObj = new Dropdown;
                       $DropdownObj->PaymentMethodSelected($depositid); ?>

                    </select>
                      <label>Description</label>
                      <input type="text" value="<?php echo $row['Description']; ?>" name="description" class="form-control" placeholder="Description">
                    </div>
                  </div>
               
              </section>
            </div>
            <div class="modal-footer">
              <button type="submit" name="update_payment" class="btn btn-success">Submit</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              
            </div>
            
             </form>
          </div>
        </div>
      </div>
                        </div>
              
            <?php
                } }
            


     } 



     function ViewPaymentTotal($orderid){
include('config/dbconnection.php');

    $resultpurchase = $db->prepare("SELECT * FROM purchase WHERE Order_Id='$orderid'");
    $resultpurchase->execute();
    $rowpurchase = $resultpurchase->fetch();
    

    $resultpurchaseorder = $db->prepare("SELECT sum(Subtotal_Cost) as subtotal FROM purchaseorder WHERE Order_Id='$orderid'");
    $resultpurchaseorder->execute();
    $rowpurchaseorder = $resultpurchaseorder->fetch();

    $result = $db->prepare("SELECT sum(Amount) as deduction FROM deduction_supplier WHERE Order_Id='$orderid'");
    $result->execute();
    $row = $result->fetch();
    

        $resultpayment = $db->prepare("SELECT sum(Amount) as payamount FROM payment WHERE Order_Id='$orderid'");
    $resultpayment->execute();
    $rowpayment = $resultpayment->fetch();
    
    $payableamount=$rowpurchaseorder['subtotal']-$row['deduction'];

    ?>

    <tr style="background: bisque;">
    <td><?php echo date('d-m-Y', strtotime($rowpurchase['Invoice_Date'])); ?></td> 
    <td><?php 
    $resultprode = $db->prepare("SELECT * FROM purchaseorder WHERE Order_Id='$orderid'");
    $resultprode->execute();
    for ($i=0; $rowprode=$resultprode->fetch(); $i++) { 
        $productid=$rowprode['Product_Id'];
        $unitid=$rowprode['Unit'];
    if ($unitid==1) {
        $unit="Quental";
    } if ($unitid==2) {
        $unit="Kg";
    }

        $resultproduct = $db->prepare("SELECT * FROM product WHERE Product_Id='$productid'");
    $resultproduct->execute();
    for ($i=0; $rowproduct=$resultproduct->fetch(); $i++) { 

    echo $rowproduct['Product_Name']." @ ".$rowprode['Price']."Rs * ".$rowprode['Quantity']." ".$unit."<br>";

    

    } } ?></td>
    <td><?php echo number_format($rowpurchaseorder['subtotal']); ?></td> 
    <td><?php echo number_format($row['deduction']); ?></td>
    <td><?php echo number_format($payableamount); ?></td>
     <td><?php echo number_format($rowpayment['payamount']); ?></td>
   <td><?php echo number_format($payableamount-$rowpayment['payamount']); ?></td>
              
            <?php
            
            


     } 




      


function AddPayment()
{
   
if (isset($_POST['add_payment'])) {
    include('config/dbconnection.php');
    $orderid = $_POST['orderid'];
    $supplierid = $_POST['supplierid'];
    $amount = $_POST['amount'];
    $paymentdate = $_POST['paymentdate'];
   $paymentmethod = $_POST['paymentmethod'];
   $description = $_POST['description'];
    $RecTimeStamp = Date("Y-m-d H:m:s");
    $acgroup=$_POST['acgroup'];

   

   try{

  

    $sql = "INSERT INTO payment (Order_Id, Supplier_Id, Amount, Payment_Date, Payment_Method, Description, Rec_Time_Stamp,Ac_Group) VALUES (:a,:b,:c,:d,:e,:f,:g,:h)";
    $r = $db->prepare($sql);
    $result =$r->execute(array(':a'=>$orderid, ':b'=>$supplierid, ':c'=>$amount, ':d'=>$paymentdate, ':e'=>$paymentmethod, ':f'=>$description, ':g'=>$RecTimeStamp, ':h'=>$acgroup));
    if ($result) {
        $_SESSION['success']='Payment Add Successfully!';

    }
    else{
        $_SESSION['error']='Something Wrong!';
    }
    $db = null;
header('Refresh:0');
   
 }

   catch(PDOException $e){
    echo $e->getMessage();
   }
   
}





}




function UpdatePayment()
{

   if(isset($_POST["update_payment"])){
     include('config/dbconnection.php');
    $paymentid=$_POST['paymentid'];   
    $amount = $_POST['amount'];
    $paymentdate = $_POST['paymentdate'];
   $paymentmethod = $_POST['paymentmethod'];
   $description = $_POST['description'];
    
                try {
                   
                    $sql = "UPDATE payment SET Amount = :a, Payment_Date = :b, Payment_Method = :c, Description = :d WHERE id = '$paymentid'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$amount,':b'=>$paymentdate,':c'=>$paymentmethod,':d'=>$description));
                    if ($insertservice) {
                        $_SESSION['success']='Payment Update Successfully!';
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
             
     
    
}//close of function update payment
       
//delete payment
function DeletePayment()
{
       if(isset($_POST["DeletePayment"])){
        include('config/dbconnection.php');
            $id = $_POST['id'];
            try {

        $dbmember = "DELETE FROM payment WHERE id = ?";
        $q = $db->prepare($dbmember);
        $response = $q->execute(array($id)); 
         
          }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
        }

}

















function ViewSalePayment($orderid){
include('config/dbconnection.php');
    $result = $db->prepare("SELECT * FROM payment WHERE Order_Id='$orderid'");
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
        $depositid=$row['Payment_Method'];

        $resultpayment = $db->prepare("SELECT * FROM dropdown WHERE Status_Id='$depositid'");
    $resultpayment->execute();
    for($i=0; $rowpayment = $resultpayment->fetch(); $i++){
    


    ?>

    <tr>
  
    <td><?php echo date('d-m-Y', strtotime($row['Payment_Date'])); ?></td> 
    <td><?php echo number_format($row['Amount']); ?></td> 
    <td><?php echo $rowpayment['Deposit_Method']; ?></td>
    <td><?php echo $row['Description']; ?></td>
     
    <td class="text-center">
      <div class="btn-group btn-group-xs" role="group">

      <button type="button" title="Edit" class="btn btn-link btn-icon bigger-130 text-success" data-toggle="modal" data-target="#PaymentEdit-<?php echo $row['id']; ?>"><i data-feather="edit"></i></button>


    <button class="btn btn-link btn-icon bigger-130 text-danger" data-toggle="modal" title="Delete" data-target="#DeleteModal-<?php echo $row['id']; ?>"><i data-feather="trash"></i></button>
    </div>

      


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
                            <button type="submit" class="btn btn-danger" name = "DeletePayment" >Delete</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="modal fade" id="PaymentEdit-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="smModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white shadow-none">
              <h6 class="modal-title" id="smModalLabel">UPDATE PAYMENT</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST">
            <div class="modal-body">
             <section id="section1">
              
                
                <input type="hidden" value="<?php echo $row['id']; ?>" name="paymentid">
                 <div>
                 
                    <div class="list-with-gap">
                      <label>Amount</label>
                      <input type="text" value="<?php echo $row['Amount']; ?>" name="amount" class="form-control" placeholder="Amount">
                      <label>Date</label>
                       <input type="text" value="<?php echo $row['Payment_Date']; ?>" name="paymentdate" class="form-control datepicker-input" autocomplete="off" placeholder="yyyy-mm-dd" required>

                      
                       <label>Payment Method</label>
                      <select class="form-control" name="paymentmethod" required>
                      <?php
                      $DropdownObj = new Dropdown;
                       $DropdownObj->PaymentMethodSelected($depositid); ?>

                    </select>
                      <label>Description</label>
                      <input type="text" value="<?php echo $row['Description']; ?>" name="description" class="form-control" placeholder="Description">
                    </div>
                  </div>
               
              </section>
            </div>
            <div class="modal-footer">
              <button type="submit" name="update_payment" class="btn btn-success">Submit</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              
            </div>
            
             </form>
          </div>
        </div>
      </div>
                        </div>
              
            <?php
                } }
            


     } 



     function ViewSalePaymentTotal($orderid){
include('config/dbconnection.php');

    $resultpurchase = $db->prepare("SELECT * FROM sale WHERE Order_Id='$orderid'");
    $resultpurchase->execute();
    $rowpurchase = $resultpurchase->fetch();
    

    $resultpurchaseorder = $db->prepare("SELECT sum(Subtotal_Cost) as subtotal FROM salesorder WHERE Order_Id='$orderid'");
    $resultpurchaseorder->execute();
    $rowpurchaseorder = $resultpurchaseorder->fetch();

    $result = $db->prepare("SELECT sum(Amount) as deduction FROM deduction_customer WHERE Order_Id='$orderid'");
    $result->execute();
    $row = $result->fetch();
    

        $resultpayment = $db->prepare("SELECT sum(Amount) as payamount FROM payment WHERE Order_Id='$orderid' AND Ac_Group='1'");
    $resultpayment->execute();
    $rowpayment = $resultpayment->fetch();
    
    $payableamount=$rowpurchaseorder['subtotal']-$row['deduction'];

    ?>

    <tr style="background: bisque;">
    <td><?php echo date('d-m-Y', strtotime($rowpurchase['Invoice_Date'])); ?></td> 
    <td><?php 
    $resultprode = $db->prepare("SELECT * FROM salesorder WHERE Order_Id='$orderid'");
    $resultprode->execute();
    for ($i=0; $rowprode=$resultprode->fetch(); $i++) { 
        $productid=$rowprode['Product_Id'];
        $unitid=$rowprode['Unit'];
    if ($unitid==1) {
        $unit="Quental";
    } if ($unitid==2) {
        $unit="Kg";
    }

        $resultproduct = $db->prepare("SELECT * FROM product WHERE Product_Id='$productid'");
    $resultproduct->execute();
    for ($i=0; $rowproduct=$resultproduct->fetch(); $i++) { 

    echo $rowproduct['Product_Name']." @ ".$rowprode['Sale_Price']."Rs * ".$rowprode['Quantity']." ".$unit."<br>";

    

    } } ?></td>
    <td><?php echo number_format($rowpurchaseorder['subtotal']); ?></td> 
    <td><?php echo number_format($row['deduction']); ?></td>
    <td><?php echo number_format($payableamount); ?></td>
     <td><?php echo number_format($rowpayment['payamount']); ?></td>
   <td><?php echo number_format($payableamount-$rowpayment['payamount']); ?></td>
              
            <?php
            
            


     } 




      


function AddSalePayment()
{
   
if (isset($_POST['add_sale_payment'])) {
    include('config/dbconnection.php');

    $orderid = $_POST['orderid'];
    $customerid = $_POST['customerid'];
    $amount = $_POST['amount'];
    $paymentdate = $_POST['paymentdate'];
   $paymentmethod = $_POST['paymentmethod'];
   $description = $_POST['description'];
    $RecTimeStamp = Date("Y-m-d H:m:s");
    $acgroup = $_POST['acgroup'];
   

   try{

  

    $sql = "INSERT INTO payment (Order_Id, Supplier_Id, Amount, Payment_Date, Payment_Method, Description, Rec_Time_Stamp,Ac_Group) VALUES (:a,:b,:c,:d,:e,:f,:g,:h)";
    $r = $db->prepare($sql);
    $result =$r->execute(array(':a'=>$orderid, ':b'=>$customerid, ':c'=>$amount, ':d'=>$paymentdate, ':e'=>$paymentmethod, ':f'=>$description, ':g'=>$RecTimeStamp, ':h'=>$acgroup));
    if ($result) {
        $_SESSION['success']='Payment Add Successfully!';
    }
    else{
        $_SESSION['error']='Something Wrong!';
    }
    $db = null;
   header('Refresh:0');
   
 }

   catch(PDOException $e){
    echo $e->getMessage();
   }
   
}





}




function UpdateSalePayment()
{

   if(isset($_POST["update_payment"])){
     include('config/dbconnection.php');
    $paymentid=$_POST['paymentid'];   
    $amount = $_POST['amount'];
    $paymentdate = $_POST['paymentdate'];
   $paymentmethod = $_POST['paymentmethod'];
   $description = $_POST['description'];
    
                try {
                   
                    $sql = "UPDATE payment SET Amount = :a, Payment_Date = :b, Payment_Method = :c, Description = :d WHERE id = '$paymentid'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$amount,':b'=>$paymentdate,':c'=>$paymentmethod,':d'=>$description));
                    if ($insertservice) {
                        $_SESSION['success']='Payment Update Successfully!';
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
             
     
    
}//close of function update payment
       
//delete payment
function DeleteSalePayment()
{
       if(isset($_POST["DeletePayment"])){
        include('config/dbconnection.php');
            $id = $_POST['id'];
            try {

        $dbmember = "DELETE FROM payment WHERE id = ?";
        $q = $db->prepare($dbmember);
        $response = $q->execute(array($id)); 
         
          }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
        }

}





 } // close of cladss doctor 


?>