<?php

/**
 * 
 */
class Purchase  
{
  

function ViewPurchase($companyid){
include('config/dbconnection.php'); 
                
             $sessionid = $_SESSION['sessionid'];
             
                 $resultd = $db->prepare("SELECT * FROM purchase WHERE Company_Id = '$companyid' AND Session_Id = '$sessionid'");
                $resultd->execute();
               for($i=0; $row = $resultd->fetch(); $i++){
                $datee = $row['Rec_Time_Stamp'];
                $invdate = date("d-m-Y", strtotime($datee));
               $orderid = $row['Order_Id'];
                $invno = $row['Invoice_No'];
               
                $supplierid = $row['Supplier'];


                $resulsup = $db->prepare("SELECT * FROM account WHERE id = '$supplierid' AND Ac_Group=3 ");
                $resulsup->execute();
                for($i=0; $rowsup = $resulsup->fetch(); $i++)
               {

                $resulsum = $db->prepare("SELECT sum(Amount) as deduction FROM deduction_supplier WHERE Order_Id = '$orderid'");
                $resulsum->execute();
               for($i=0; $rowsum = $resulsum->fetch(); $i++){
               
                ?>
            
               <tr>
  <td><?php echo $row['Invoice_No']; ?></td>
  <td><?php echo date('d-m-Y', strtotime($row['Invoice_Date'])) ; ?></td>

    <td> <?php echo $rowsup['Person_Name']; ?> </td>

                  <td><?php echo $rowsup['City']; ?></td>
                  
                  <td><?php 

               $resultpro = $db->prepare("SELECT * FROM purchaseorder WHERE Order_Id = '$orderid' ");
                $resultpro->execute();
               for($i=0; $rowpro = $resultpro->fetch(); $i++){
                $productid = $rowpro['Product_Id'];

                $resultproname = $db->prepare("SELECT * FROM product WHERE Product_Id = '$productid' ");
                $resultproname->execute();
               for($i=0; $rowproname = $resultproname->fetch(); $i++){

                 $unit=$rowpro['Unit'];
                 if ($rowpro['Unit']==1) {
                   $unit="Que";
                 } if ($rowpro['Unit']==2) {
                   $unit="kg";
                 }

                echo $rowproname['Product_Name']." @".$rowpro['Price']." Rs * ".$rowpro['Quantity']." ".$unit."<br>";
                   

                  } } ?></td>
                  
                  <td><?php echo number_format($rowsum['deduction']); ?></td>
                  <?php 

                  $resultsub = $db->prepare("SELECT sum(Subtotal_Cost) as subtotal FROM purchaseorder WHERE Order_Id = '$orderid' ");
                $resultsub->execute();
               for($i=0; $rowsub = $resultsub->fetch(); $i++){
                $subtotalcost = $rowsub['subtotal']; ?>


                <td> <?php echo number_format($subtotalcost); ?></td>
                 <td> <?php echo number_format($subtotalcost-$rowsum['deduction']); ?></td>

                 <?php } ?> 



                        <td>
                           <!-- <div class="btn-group btn-group-xs" role="group"> -->
                           

                           <a href="purchaseOrderDetails.php?orderid=<?php echo $row['Order_Id']; ?>" title="View" class="btn btn-link btn-icon bigger-130 text-info">
                                <i data-feather="eye"></i>
                            </a>

                            
                                  

                          <button class="btn btn-link btn-icon bigger-130 text-danger" data-toggle="modal" title="Delete" data-target="#DeleteModal-<?php echo $row['Order_Id']; ?>"><i data-feather="trash"></i></button>

                            <?php 
                                if($row['Active'] =='1')
                                { 
                            ?>

                            <button class="btn btn-link btn-icon bigger-130 text-danger" data-placement="top" title="Deactivate" data-toggle="modal"  data-target="#DeactiveModal-<?php echo $row['Order_Id']; ?>"><i data-feather="x-circle"></i>  </button>    
                            <a href="update_purchase.php?orderid=<?php echo $row['Order_Id']; ?>" title="Edit" class="btn btn-link btn-icon bigger-130 text-success">
                                <i data-feather="edit"></i>
                            </a>
                            

                            
                            <?php
                                }
                                else
                                {
                            ?>
                            <button class="btn btn-link btn-icon bigger-130 text-success" data-placement="top" title="Activate" data-toggle="modal"  data-target="#DeactiveModal-<?php echo $row['Order_Id']; ?>"><i data-feather="check-circle" aria-hidden="true"></i>  </button>
                              <?php
                                } 
                            ?>
                            <!--Make Payment Link-->
                           
                            
                  
                        </td>
                    </tr>
             <div class="col-lg-12">
                        <div class="modal fade" id="DeleteModal-<?php echo $row['Order_Id']; ?>" tabindex="<?php echo $row['Order_Id']; ?>"  role="dialog" aria-labelledby="myModalLabel-<?php echo $row['Order_Id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="H2">Are you sure want to delete this record? </h4>
                                    </div>
                                    <form role="form" method="post" class="form-horizontal" id="popup-validation">
                                        <input type="hidden" name="purchaseid" value="<?php echo $row['Order_Id']; ?>">
                                        <div class="modal-body">
                                            <button type="submit" class="btn btn-danger" name = "DeletePurchase" >Delete</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="DeactiveModal-<?php echo $row['Order_Id']; ?>" tabindex="<?php echo $row['Order_Id']; ?>" role="dialog" aria-labelledby="myModalLabel-<?php echo $row['Order_Id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <?php 
                                            if($row['Active'] == '1')
                                            { 
                                        ?>
                                        <h4 class="modal-title" id="H2">Are you sure want to deactivate this Bill? </h4>    
                                        <?php 
                                            }
                                                else
                                            {
                                        ?>
                                        <h4 class="modal-title" id="H2">Are you sure want to Activate this Bill? </h4> 
                                        <?php   
                                            }
                                        ?>
                                    </div>
                                    <?php 
                                        if($row['Active'] == '1')
                                            { 
                                        ?>
                                        <form role="form" method="post" class="form-horizontal" id="popup-validation">
                                            <input type="hidden" name="purchaseid" value="<?php echo $row['Order_Id']; ?>">
                                            <div class="modal-body">
                                                <button type="submit" class="btn btn-danger" name = "DeactivatePurchase" >Deactivate</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>    
                                        <?php 
                                            }
                                                else
                                            {
                                        ?>
                                        <form role="form" method="post" class="form-horizontal" id="popup-validation">
                                            <input type="hidden" name="purchaseid" value="<?php echo $row['Order_Id']; ?>">
                                            <div class="modal-body">
                                                <button type="submit" class="btn btn-danger" name = "ActivatePurchase" >Activate</button>
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
                
            }   } }


     }//close of function view doctor 





   



function DeletePurchase()
{
       if(isset($_POST["DeletePurchase"])){
        include('config/dbconnection.php');
            $purchaseid = $_POST['purchaseid'];
            try {

        $dbmember = "DELETE FROM purchase WHERE Order_Id = ?";
        $q = $db->prepare($dbmember);
        $response = $q->execute(array($purchaseid));  

        $dbmember2 = "DELETE FROM purchaseorder WHERE Order_Id = ?";
        $qp = $db->prepare($dbmember2);
        $response = $qp->execute(array($purchaseid));  

        

          }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
        }

}

function DeactivatePurchase()
    {
        if(isset($_POST["DeactivatePurchase"])){
            include('config/dbconnection.php');
            $purchaseid = $_POST['purchaseid'];
            
            
            try {
                $sql = "UPDATE purchase SET Active = :a WHERE Order_Id = '$purchaseid'";
                $q = $db->prepare($sql);
                $insertservice = $q->execute(array(':a'=>0,));
                if ($insertservice) {
                  $_SESSION['success']='Cancel Successfully!';
                  
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


      function ActivatePurchase()
    {
        if(isset($_POST["ActivatePurchase"])){
            include('config/dbconnection.php');
            $purchaseid = $_POST['purchaseid'];
            
            
            try {
                $sql = "UPDATE purchase SET Active = :a WHERE Order_Id = '$purchaseid'";
                $q = $db->prepare($sql);
                $insertservice = $q->execute(array(':a'=>1,));
                if ($insertservice) {
                   $_SESSION['success']='Activate Successfully!';
                  
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







    


    










 } // close of cladss doctor 


?>