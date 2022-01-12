<?php include('header.php'); 
$SalesObj = new Sales;
?>
<script type="text/javascript">
           



      function getcity() 
        {
          var subject = $('#state').val();
          var top = subject;
          //alert(join);
          //alert(sub);
          ajaxRequest = new XMLHttpRequest();
          ajaxRequest.onreadystatechange = function()
          {
              if(ajaxRequest.readyState == 4)
              {
                  var ajaxDisplay = document.getElementById('city');
                  ajaxDisplay.innerHTML = ajaxRequest.responseText;    
              }
          }
        ajaxRequest.open("GET", "ajax.php?State_Id=" +top, true);
          ajaxRequest.send(); 
      }  




 function getvendor() 
        {
          var subject = $('#city').val();
          var top = subject;
          //alert(join);
          //alert(sub);
          ajaxRequest = new XMLHttpRequest();
          ajaxRequest.onreadystatechange = function()
          {
              if(ajaxRequest.readyState == 4)
              {
                  var ajaxDisplay = document.getElementById('vendor');
                  ajaxDisplay.innerHTML = ajaxRequest.responseText;    
              }
          }
        ajaxRequest.open("GET", "ajax.php?City_Id=" +top, true);
          ajaxRequest.send(); 
      }  


        </script>
<?php
$SalesObj->AssignVendor();
$SalesObj->OrderProcess();

 ?>

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
         <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Sales</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a>
                  </li>
                  
                  <li class="breadcrumb-item active">Sales
                  </li>
                </ol>
              </div>
            </div>
          </div>
        
       
        </div>
        <center><h5 style="color: green;">
       <?php
       if (isset($_SESSION['success'])) {
         echo $_SESSION['success'];
       }
       ?>
       </h5></center>
        <div class="content-body"><!-- users list start -->
<section class="users-list-wrapper">
  
      
    <div class="users-list-table">
        <div class="card">
            <div class="card-content"> 
                <div class="card-body">
                    <!-- datatable start -->
                    <div class="table-responsive">
                        <table id="users-list-datatable" class="table">
                            <thead>
                                <tr>
                                  <th class="hidden"></th>
                                  
                                    <th>Date</th>
                                    <th>Buyer Name</th>
                                    <th>Delivery Status</th>
                                    <th>Vendor</th>
                                    <th>Amount</th>
                                    <th>Order</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php 


                               $userid=$_SESSION['userid'];
include('config/dbconnection.php');
                      $stmt = $db->prepare("SELECT * FROM sales ORDER BY sales_date DESC");
                      $stmt->execute();
                      foreach($stmt as $row){
                        $user_id = $row['user_id'];
                        $order_id = $row['Order_Id'];
                        $invoice_no = $row['Invoice_No'];
                        $statusid = $row['Status'];
                        $shippingcharge = $row['Shipping_Charge'];
                        $total = $row['Total_Payable_Amount']+$shippingcharge;
                        $vendorid = $row['Vendor_Id'];

                        $stmtuser = $db->prepare("SELECT * FROM users WHERE id = '$user_id'");
                      $stmtuser->execute();
                      foreach($stmtuser as $rowuser){

                        $stmtorder = $db->prepare("SELECT * FROM order_list WHERE order_id=:id");
                        $stmtorder->execute(['id'=>$order_id]);
                        
                        foreach($stmtorder as $details){
                          $subtotal = $details['price']*$details['qty'];
                          
                        } ?>
                          <tr>
                            <td class="hidden"></td>
                           
                            <td><?php echo date('M d, Y', strtotime($row['sales_date']));?></td>
                            <td><?php echo $rowuser['firstname'].$rowuser['lastname'];?></td>
                            <td><?php if ($statusid == 0) {
                              echo "Pending ..";
                            }else
                            if ($statusid == 1) {
                              echo "Order Delivery Date - ".$row['Delivery_Date'];
                             } else
                             if ($statusid == 2) {
                                echo "Order Cancel Reason: ".$row['Cancel_Reason'];
                              } else
                             if ($statusid == 3) {
                                echo "Order Returned Reason: ".$row['Return_Reason'];
                              } 

                              else
                             if ($statusid == 4) {
                                echo "Order Delivered";
                              } 



                              ?></td>

                               <td><?php if ($vendorid==0) {
                                 echo "BPL";
                               } else{

                                $resultvendor = $db->prepare("SELECT * FROM vendor WHERE id=:id");
                        $resultvendor->execute(['id'=>$vendorid]);
                        for ($i=0; $rowvendor=$resultvendor->fetch(); $i++) { 
                          echo $rowvendor['Firm_Name']." (".$rowvendor['Vendor_Name'].")";
                        } }

                                ?></td>
                            <td><i class="fa fa-inr"></i> <?php echo number_format($total, 2); ?></td>
                            <td><button type='button' class='btn btn-link btn-icon bigger-130 text-primary' data-id='<?php echo $row['id']; ?>'><i class='fa fa-eye'></i></button> 
                            </td>
                            <td>
                            <button type='button' class='btn btn-success btn-sm btn-flat process' data-target="#OrderProcess-<?php echo $row['id']; ?>" data-toggle="modal"><i class='fa fa-arrow-right'></i>Order Process</button>

                            <button type='button' class='btn btn-success btn-sm btn-flat process' data-target="#VendorAssign-<?php echo $row['id']; ?>" data-toggle="modal"><i class='fa fa-arrow-right'></i>Assign Vendor</button>
                            <?php if ($statusid ==1 || $statusid ==4) { ?>
                            <a class="btn btn-link btn-icon bigger-130 text-info" href="receipt.php?orderid=<?php echo $row['Order_Id']; ?>"><i class="fa fa-print"></i></a> <?php } else {echo "";} ?>
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







                            <div class="modal fade" id="OrderProcess-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="smModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white shadow-none">
              <h6 class="modal-title" id="smModalLabel">ORDER PROCESS</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST">
            <div class="modal-body">
             <section id="section1">
                
                
                <input type="hidden" value="<?php echo $row['id']; ?>" name="salesid">
                
                <div class="row">
                  <div class="form-group col-lg-12 col-xs-12"> 
                  <label>Status</label>
                  <div>
                                <select class="form-control" name="status" id="status" required>
                                  <option>Select Option</option>
                                  <option value="1">Approved</option>
                                  <option value="2">Cancel</option>
                                  <option value="3">Return</option>
                                  <option value="4">Delivered</option>
                                </select>
                  </div>
                  </div>

                  <div id="cancel" class="col-lg-12 col-xs-12" style="display: none;">
                      <div class="form-group">
                          <label>Cancel Reason</label>
                           <div>
                        <input type="text" name="cancelreason" class="form-control"  placeholder="Reason for Cancel Order"  />
                               </div> 
                              
                      </div>
                   </div>


                    <div id="return" class="col-lg-12 col-xs-12" style="display: none;">
                      <div class="form-group">
                          <label>Return Reason</label>
                           <div>
                        <input type="text" name="returnreason" class="form-control"  placeholder="Reason for Return Order"  />
                               </div> 
                              
                      </div>
                   </div>

                   <div id="approved" class="col-lg-12 col-xs-12" style="display: none;">
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
              <button type="submit" name="order_process" class="btn btn-success">Submit</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              
            </div>
            
             </form>
          </div>
        </div>
      </div>
                   




                    <div class="modal fade" id="VendorAssign-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="smModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white shadow-none">
              <h6 class="modal-title" id="smModalLabel">ASSIGN VENDOR</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST">
            <div class="modal-body">
             <section id="section1">
                
                
                <input type="hidden" value="<?php echo $row['id']; ?>" name="salesid">
                
                <div class="row">
                  <div class="form-group col-lg-12 col-xs-12"> 
                 <label>State</label>
                  <div>
                                <select class="form-control" name="status" id="state" onchange = "getcity();">
                                  <option>Select State</option>
                                  <?php 
                                  $dropdownObj = new Dropdown;
                                  $dropdownObj->StateDropdown();
                                  ?>
                                  
                                </select>
                  </div>
                  </div>

                  <div class="col-lg-12 col-xs-12">
                      <div class="form-group">
                          <label>City</label>
                           <div>
                      <select class="form-control" name="status" id="city" onchange = "getvendor();">
                                  <option>Select City</option>
                                  
                                  
                                </select>
                               </div> 
                              
                      </div>
                   </div>

                   <div class="col-lg-12 col-xs-12">
                      <div class="form-group ">
                          <label for="edit_name" class=" control-label">Vendor Name</label>
                           <div>
                       <select class="form-control" name="vendor" id="vendor" required>
                                  <option>Select Vendor</option>
                                  <option value="0">BPL</option>
                                  
                                  
                                </select>
                               </div> 
                              
                      </div>
                   </div>
                </div>


               
              </section>
            </div>
            <div class="modal-footer">
              <button type="submit" name="assign_vendor" class="btn btn-success">Submit</button>
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

 ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- datatable ends -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- users list ends -->
        </div>
      </div>
    </div>
    <!-- END: Content-->


<?php include('footer.php'); ?>

<script type="text/javascript">
   $('#status').on('change',function(){
            if( $(this).val()==="1"){
              $("#approved").show()
              }
              else{
              $("#approved").hide()
            }

           
        });

    $('#status').on('change',function(){
            if( $(this).val()==="2"){
              $("#cancel").show()
              }
              else{
              $("#cancel").hide()
            }

           
        });


    $('#status').on('change',function(){
            if( $(this).val()==="3"){
              $("#return").show()
              }
              else{
              $("#return").hide()
            }

           
        });


   
</script>