<?php

/**
 * 
 */
class Invoice  
{
	

function ViewBosInvoice($companyid){
include('config/dbconnection.php'); 
                
             $sessionid = $_SESSION['sessionid'];
             
                 $resultd = $db->prepare("SELECT * FROM sale WHERE Company_Id = '$companyid' AND Session_Id = '$sessionid' AND Bill_Type='1'");
                $resultd->execute();
               for($i=0; $row = $resultd->fetch(); $i++){
                $brokerid = $row['Broker'];
                $datee = $row['Rec_Time_Stamp'];
                $invdate = date("d-m-Y", strtotime($datee));
               $orderid = $row['Order_Id'];
                $invno = $row['Invoice_No'];
               
                $saveclient = $row['Save_Client'];


                $resultb = $db->prepare("SELECT Person_Name FROM account WHERE id = '$brokerid' AND Ac_Group=1 ");
                $resultb->execute();
               $rowbro = $resultb->fetch();
               
                ?>
            
               <tr>
  <td><?php echo $row['Invoice_No']; ?></td>
  <td><?php echo date('d-m-Y', strtotime($row['Invoice_Date'])) ; ?></td>

    <td>
     <?php 
     $resultk = $db->prepare("SELECT * FROM account WHERE id = '$saveclient' AND Ac_Group=2");
                $resultk->execute();
               for($i=0; $rowf = $resultk->fetch(); $i++)
               {
                echo $rowf['Person_Name'];
               } 
                 ?>  </td>

                  <td><?php echo $row['Vehicle']; ?></td>
                  <td><?php echo $rowbro['Person_Name']; ?></td>
                  <td><?php 

               $resultpro = $db->prepare("SELECT * FROM salesorder WHERE Order_Id = '$orderid' ");
                $resultpro->execute();
               for($i=0; $rowpro = $resultpro->fetch(); $i++){
                $productid = $rowpro['Product_Id'];

                $resultproname = $db->prepare("SELECT * FROM product WHERE Product_Id = '$productid' ");
                $resultproname->execute();
               for($i=0; $rowproname = $resultproname->fetch(); $i++){

                 

                echo $rowproname['Product_Name'].",<br>";
                   

                  } } ?></td>
                  

                  <td><?php 

                  $resultsub = $db->prepare("SELECT sum(Subtotal_Cost) as subtotal FROM salesorder WHERE Order_Id = '$orderid' ");
                $resultsub->execute();
               for($i=0; $rowsub = $resultsub->fetch(); $i++){
                $subtotalcost = $rowsub['subtotal'];

                  echo number_format($subtotalcost); }?> </td>



                        <td>
                           <!-- <div class="btn-group btn-group-xs" role="group"> -->
                           

                           <a href="receipt.php?orderid=<?php echo $row['Order_Id']; ?>" title="Print" class="btn btn-link btn-icon bigger-130 text-info">
                                <i data-feather="printer"></i>
                            </a>

                            
                                  

                          <button class="btn btn-link btn-icon bigger-130 text-danger" data-toggle="modal" title="Delete" data-target="#DeleteModal-<?php echo $row['Order_Id']; ?>"><i data-feather="trash"></i></button>

                            <?php 
                                if($row['Active'] =='1')
                                { 
                            ?>

                            <button class="btn btn-link btn-icon bigger-130 text-danger" data-placement="top" title="Deactivate" data-toggle="modal"  data-target="#DeactiveModal-<?php echo $row['Order_Id']; ?>"><i data-feather="x-circle"></i>  </button>    
                            <a href="update_bos.php?orderid=<?php echo $row['Order_Id']; ?>" title="Edit" class="btn btn-link btn-icon bigger-130 text-success">
                                <i data-feather="edit"></i>
                            </a>
                            
                             <a href="bilty.php?orderid=<?php echo $row['Order_Id']; ?>" title="Bilty" class="btn btn-success btn-sm">
                                Bilty
                            </a>

                            <a href="customer_payment.php?orderid=<?php echo $row['Order_Id']; ?>" title="Payment" class="btn btn-link btn-icon bigger-130 text-primary">
                                <i data-feather="credit-card"></i>
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
                                        <input type="hidden" name="invoiceid" value="<?php echo $row['Order_Id']; ?>">
                                        <div class="modal-body">
                                            <button type="submit" class="btn btn-danger" name = "DeleteBosInvoice" >Delete</button>
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
                                            <input type="hidden" name="invoiceid" value="<?php echo $row['Order_Id']; ?>">
                                            <div class="modal-body">
                                                <button type="submit" class="btn btn-danger" name = "DeactivateBosInvoice" >Deactivate</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>    
                                        <?php 
                                            }
                                                else
                                            {
                                        ?>
                                        <form role="form" method="post" class="form-horizontal" id="popup-validation">
                                            <input type="hidden" name="invoiceid" value="<?php echo $row['Order_Id']; ?>">
                                            <div class="modal-body">
                                                <button type="submit" class="btn btn-danger" name = "ActivateBosInvoice" >Activate</button>
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
                
            }   


     }//close of function view doctor	




function ViewInvoice($companyid){
include('config/dbconnection.php'); 
                
             $sessionid = $_SESSION['sessionid'];
             
                 $resultd = $db->prepare("SELECT * FROM sale WHERE Company_Id = '$companyid' AND Session_Id = '$sessionid' AND Bill_Type='2'");
                $resultd->execute();
               for($i=0; $row = $resultd->fetch(); $i++){
                $brokerid = $row['Broker'];
                $datee = $row['Rec_Time_Stamp'];
                $invdate = date("d-m-Y", strtotime($datee));
               $orderid = $row['Order_Id'];
                $invno = $row['Invoice_No'];
               
                $saveclient = $row['Save_Client'];


                $resultb = $db->prepare("SELECT Person_Name FROM account WHERE id = '$brokerid' AND Ac_Group=1 ");
                $resultb->execute();
               $rowbro = $resultb->fetch();
               
                ?>
            
               <tr>
  <td><?php echo $row['Invoice_No']; ?></td>
  <td><?php echo date('d-m-Y', strtotime($row['Invoice_Date'])) ; ?></td>

    <td>
     <?php 
     $resultk = $db->prepare("SELECT * FROM account WHERE id = '$saveclient' AND Ac_Group=2");
                $resultk->execute();
               for($i=0; $rowf = $resultk->fetch(); $i++)
               {
                echo $rowf['Person_Name'];
               } 
                 ?>  </td>

                  <td><?php echo $row['Vehicle']; ?></td>
                  <td><?php echo $rowbro['Person_Name']; ?></td>
                  <td><?php 

               $resultpro = $db->prepare("SELECT * FROM salesorder WHERE Order_Id = '$orderid' ");
                $resultpro->execute();
               for($i=0; $rowpro = $resultpro->fetch(); $i++){
                $productid = $rowpro['Product_Id'];

                $resultproname = $db->prepare("SELECT * FROM product WHERE Product_Id = '$productid' ");
                $resultproname->execute();
               for($i=0; $rowproname = $resultproname->fetch(); $i++){

                 

                echo $rowproname['Product_Name'].",<br>";
                   

                  } } ?></td>
                  

                  <td><?php 

                  $resultsub = $db->prepare("SELECT sum(Subtotal_Cost) as subtotal FROM salesorder WHERE Order_Id = '$orderid' ");
                $resultsub->execute();
               for($i=0; $rowsub = $resultsub->fetch(); $i++){
                $subtotalcost = $rowsub['subtotal'];

                  echo number_format($subtotalcost); }?> </td>



                        <td>
                           <!-- <div class="btn-group btn-group-xs" role="group"> -->
                           

                           <a href="receipt.php?orderid=<?php echo $row['Order_Id']; ?>" title="Print" class="btn btn-link btn-icon bigger-130 text-info">
                                <i data-feather="printer"></i>
                            </a>

                            
                                  

                          <button class="btn btn-link btn-icon bigger-130 text-danger" data-toggle="modal" title="Delete" data-target="#DeleteModal-<?php echo $row['Order_Id']; ?>"><i data-feather="trash"></i></button>

                            <?php 
                                if($row['Active'] =='1')
                                { 
                            ?>

                            <button class="btn btn-link btn-icon bigger-130 text-danger" data-placement="top" title="Deactivate" data-toggle="modal"  data-target="#DeactiveModal-<?php echo $row['Order_Id']; ?>"><i data-feather="x-circle"></i>  </button>    
                            <a href="update_invoice.php?orderid=<?php echo $row['Order_Id']; ?>" title="Edit" class="btn btn-link btn-icon bigger-130 text-success">
                                <i data-feather="edit"></i>
                            </a>
                            
                             <a href="bilty.php?orderid=<?php echo $row['Order_Id']; ?>" title="Bilty" class="btn btn-success btn-sm">
                                Bilty
                            </a>

                            <a href="customer_payment.php?orderid=<?php echo $row['Order_Id']; ?>" title="Payment" class="btn btn-link btn-icon bigger-130 text-primary">
                                <i data-feather="credit-card"></i>
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
                                        <input type="hidden" name="invoiceid" value="<?php echo $row['Order_Id']; ?>">
                                        <div class="modal-body">
                                            <button type="submit" class="btn btn-danger" name = "DeleteBosInvoice" >Delete</button>
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
                                            <input type="hidden" name="invoiceid" value="<?php echo $row['Order_Id']; ?>">
                                            <div class="modal-body">
                                                <button type="submit" class="btn btn-danger" name = "DeactivateBosInvoice" >Deactivate</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>    
                                        <?php 
                                            }
                                                else
                                            {
                                        ?>
                                        <form role="form" method="post" class="form-horizontal" id="popup-validation">
                                            <input type="hidden" name="invoiceid" value="<?php echo $row['Order_Id']; ?>">
                                            <div class="modal-body">
                                                <button type="submit" class="btn btn-danger" name = "ActivateBosInvoice" >Activate</button>
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
                
            }   


     }
   



function DeleteBosInvoice()
{
       if(isset($_POST["DeleteBosInvoice"])){
        include('config/dbconnection.php');
            $invoiceid = $_POST['invoiceid'];
            try {

        $dbmember = "DELETE FROM sale WHERE Order_Id = ?";
        $q = $db->prepare($dbmember);
        $response = $q->execute(array($invoiceid));  

        $dbmember2 = "DELETE FROM salesorder WHERE Order_Id = ?";
        $qp = $db->prepare($dbmember2);
        $response = $qp->execute(array($invoiceid));  

       

          }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
        }

}

function DeactivateBosInvoice()
    {
        if(isset($_POST["DeactivateBosInvoice"])){
            include('config/dbconnection.php');
            $invoiceid = $_POST['invoiceid'];
            
            
            try {
                $sql = "UPDATE sale SET Active = :a WHERE Order_Id = '$invoiceid'";
                $q = $db->prepare($sql);
                $insertservice = $q->execute(array(':a'=>0,));
                if ($insertservice) {
                  $_SESSION['success']='Bill Cancel Successfully!';
                  
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


      function ActivateBosInvoice()
    {
        if(isset($_POST["ActivateBosInvoice"])){
            include('config/dbconnection.php');
            $invoiceid = $_POST['invoiceid'];
            
            
            try {
                $sql = "UPDATE sale SET Active = :a WHERE Order_Id = '$invoiceid'";
                $q = $db->prepare($sql);
                $insertservice = $q->execute(array(':a'=>1,));
                if ($insertservice) {
                   $_SESSION['success']='Bill Active Successfully!';
                  
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