<?php
session_start();
require_once('include/function/autoload.php');
        include('config/dbconnection.php');
  if (!isset($_SESSION['userid'])) {
    header('location:login.php'); 
  }
  

    
        
  $orderid=$_GET['orderid'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>BPL E-Commerce Invoice Slip</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
 
  <script src="../assets/js/bootstrap.min.js"></script>
   <!-- <script>
      function myFunction() {
          window.print();
      }
    </script>  -->

  <style>
      body {
        font-family: arial;
        font-size: 12px;
        
      }
      
      .clearfix {
        clear: both;
      }
      table.gridtable th {
        padding: 5px;
      }
      table.gridtable td {
        padding: 5px;
      }
    </style>
    <script language="javascript">
      function Clickheretoprint()
      { 
        var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
          disp_setting+="scrollbars=yes,width=1000, height=500, left=100, top=25"; 
        var content_vlue = document.getElementById("content").innerHTML; 
        
        var docprint=window.open("","",disp_setting); 
         docprint.document.open(); 
         docprint.document.write('</head><body onLoad="self.print()" style="width: 1000px; font-size:11px; font-family:arial; font-weight:normal;">');          
         docprint.document.write(content_vlue); 
         docprint.document.close(); 
         docprint.focus(); 
      }
    </script>

<!-- <script type="text/javascript">
  window.print();
</script> -->


</head>
<!-- <body onLoad="self.print()"> -->

<!-- <a id="addd" href="javascript:Clickheretoprint()">Print</a> | <a id="addd" href="Invoice.php">Back</a>
   -->  
<style type="text/css">
  @media print{
  .bgset{
    height: 50px;
     background-color: orange !important;
     padding: 0px; 
     margin: 0px;
     -webkit-print-color-adjust: exact;
  }

}
h1{
        float: right;
            margin-top: 0px;
    font-size: 60px;
    color: #555555 !important;
  }
  .signset{
    float: right;
    margin-top: -15px;
    background: #fff !important;
    font-size: 17px;
    width: 156px;
    text-align: center;
    margin-right: 38px;
    border-top: 5px solid #555555;
    line-height: 2.2;
    font-weight: bold;
  }
  /*.h4set{
    color: #FF7700 !important;
  }
*/
</style>








    <div class="row">
      

                       


                
                 
                    
<div class="wrapper">
  <!-- Main content -->
  <section class="" style="width:95%; padding: 20px; margin-left:2.5%; ">

<div class="row" style="border-bottom: 1px solid;">
  <div class="col-xs-3">
    <img src="images/logo.png" height="40" width="150">
  </div>
  <div class="col-xs-9">
    <p>Contact us: 8858-1338-91 || info@bpl.com  &nbsp; &nbsp;&nbsp; &nbsp; <b><!-- GSTIN : 10AKWPC8820A1ZL --></b><br> <b>BPL E-Commerce for Daily needs</b> &nbsp; Bhojubeer, Varanasi, U.P.</p>
  </div>
</div>

<?php


           
            $result = $db->prepare("SELECT * FROM sales WHERE Order_Id= :a ");
          $result->bindParam(':a', $orderid);
          $result->execute();
          for($i=0; $rows = $result->fetch(); $i++){
            $userid = $rows['user_id'];
          
          
            


          $results = $db->prepare("SELECT * FROM users WHERE id ='$userid'");
       
          $results->execute();
          for($i=0; $row = $results->fetch(); $i++){
            ?>



<div class="row" style="border-bottom: 1px solid;">
  <div class="col-xs-6">
    
    <h6><b>Order ID : &nbsp;&nbsp;&nbsp; </b> <?php echo $orderid; ?></h6>
    <h6><b>Order Date : &nbsp;&nbsp;&nbsp; </b> <?php echo date("d-M-Y", strtotime($rows['sales_date'])); ?></h6>
  </div>
  <div class="col-xs-6">
    
    <h6><b>Invoice No : &nbsp;&nbsp;&nbsp;</b> <?php echo $rows['Invoice_No']; ?></h6>
    <h6><b>Order Date : &nbsp;&nbsp;&nbsp;</b> <?php echo date("d-M-Y", strtotime($rows['sales_date'])); ?></h6>
  </div>
</div>

<div class="row" style="border-bottom: 1px solid;">
  <div class="col-xs-6" style="padding: 10px;">
    <h5><b>Billing Address</b></h5>
    <h6 style="line-height: 1.3;"><?php echo $row['firstname']." ".$row['lastname']; ?> <br>
      <?php echo $row['address'].", ".$row['City'].", (".$row['State'].") - ".$row['Pin_Code']; ?> <br>
      <b>Contact : </b> <?php echo $row['contact_info']; ?> <br>
      <b>Email : </b> <?php echo $row['email']; ?>
    </h6>
  </div>
  <div class="col-xs-6" style="padding: 10px;">
    <h5><b>Shipping Address</b></h5>
    <h6 style="line-height: 1.3;"><?php echo $row['firstname']." ".$row['lastname']; ?> <br>
      <?php echo $row['address'].", ".$row['City'].", (".$row['State'].") - ".$row['Pin_Code']; ?> <br>
      <b>Contact : </b> <?php echo $row['contact_info']; ?> <br>
      <b>Email : </b> <?php echo $row['email']; ?>
    </h6>
  </div>
</div>


<div class="row" style="font-size:12px;" >
       <table class="" style="width:100%;">
           <thead>


               
         
           <tr height="25" style="border-bottom: 1px solid;">
               <th > &nbsp; Sl</th>
               <th style="width: 350px;" >Product Name</th>
               <th align="center">Company Name</th>
               <th align="center">Price</th>
               <th align="center">Qty</th>
               <!-- <th align="center">GST (Rs)</th> -->
               
               
               
               <th  align="right" class="text-right">Net Amount</th>
           </tr>
             </thead>
             <tbody>


              <?php
          $result = $db->prepare("SELECT * FROM order_list WHERE order_id= :a");
          $result->bindParam(':a', $orderid);
          $result->execute();
          foreach($result as $row){

             $productid = $row['product_id'];
             $productname = $row['product_name'];
             
             $resultgst = $db->prepare("SELECT * FROM products WHERE id= :a");
          $resultgst->bindParam(':a', $productid);
          $resultgst->execute();
          foreach($resultgst as $rowgst){
             $gst = $rowgst['GST'];
             
             $discountvalue = $row['prize']*$row['Discount_Percentage']/100;
             $price = $row['prize']-$discountvalue;
             $amount = $price*$row['qty']; 
             $gstvalue = $amount*$gst/100;
           
          

           ?>
             
                  
              <tr  height="22" style="border-bottom: 1px solid;">
               <!--    <td><?php echo $x++;?></td> -->

                  <td> &nbsp; <?php echo $x;?></td>
                  <td style="width: 350px;" ><?php echo $productname; ?></td>
                  <td align="center"><?php echo $rowgst['productCompany']; ?></td>
                  <td align="center"><?php echo number_format($price); ?></td>
                  <td align="center"><?php echo number_format($row['qty']); ?></td>
                  <!-- <td align="center"><?php echo number_format($gstvalue,2); ?></td> -->
                  
                  
                  <td align="right"><?php echo number_format($amount); ?> &nbsp;</td>



                  
              </tr>
             



              <?php } } ?>

              <?php
              $totalamount=0;
              $totalgstvalue =0;

              $result = $db->prepare("SELECT *, sum(qty) as qty FROM order_list WHERE order_id= :a");
          $result->bindParam(':a', $orderid);
          $result->execute();
          foreach($result as $row){ 
            $productid = $row['product_id'];
            $resultgst = $db->prepare("SELECT * FROM products WHERE id= :a");
          $resultgst->bindParam(':a', $productid);
          $resultgst->execute();
          foreach($resultgst as $rowgst){
             $gst = $rowgst['GST'];
             
             $discountvalue = $row['prize']*$row['Discount_Percentage']/100;
             $price = $row['prize']-$discountvalue;
             $amount = $price*$row['qty']; 
             $gstvalue = $amount*$gst/100;
             $totalamount += $amount;
             $totalgstvalue += $gstvalue;
             ?>

   
 <tr height="22" style="border-bottom: 1px solid;">
          <td align="center"></td>
          <td style="width: 350px;" align="right">Shipping Charge :</td>
          <td></td>
          <td align="center"><?php echo number_format($rows['Shipping_Charge']); ?></td>
          <td></td>
          
          <td align="right"><?php echo number_format($rows['Shipping_Charge']); ?> &nbsp;</td>
        </tr>


        <!-- <tr height="29" style="border-bottom: 1px solid;">
          <td align="center"></td>
          <td style="width: 350px;" align="right"><b>Total :</b></td>
          <td align="center"></td>
          <td align="center"><b></b></td>
          <td align="center"><b><?php echo $row['qty']; ?></b></td>
          <td align="center"><b><?php echo $totalgstvalue; ?></b></td>
          <td align="right"><b><?php echo number_format($totalamount+$rows['Shipping_Charge'],2); ?></b></td>
        </tr> -->

              
<?php } } ?>
              

             
          
                </tbody>
              
           
       </table>
   </div>

   <div class="row">
     <div class="col-xs-8"></div>
     <div class="col-xs-4" style="border-bottom: 1px solid;">
       <h4 class="text-right"><b>Grand Total &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <?php echo number_format($rows['Total_Payable_Amount']+$rows['Shipping_Charge'],2); ?></b></h4>
     </div>
   </div>


















      
<div class="row" style=" border-top: 1px solid #ddd; border-bottom: 2px solid #FF7700;  font-size:16px; height: 100px;" >
         
            
          <div class="col-xs-8">
           <br>
           <h5><b> Congrats !</b></h5>
           <h5><b>You have saved <?php echo number_format($rows['Total_Amount_BeforeDiscount'],2); ?> Rupees from the HGG Store.</b> </h5>
          
         
      
          </div>

          <div class="col-xs-4">
            <!-- <center><img src="Img/sighn.jpg"></center> -->
          </div>

          
          
       
  </div>
<?php } } ?>
  <div class="row">
    <div class="col-xs-8">
      
      <h6> <i class="fa fa-home" style="font-size: 21px;"></i> &nbsp; <b>Registered Address :</b> Lippan Tiraha, Station Road, Bhadohi, (U.P.), website - www.hggstore.com </h6>

    </div>
    <div class="col-xs-4">
            <h5 class="signset" style="float: right;">Authorised Sign</h5>
          </div>
  </div>






    <br>
    <div class="row" style="border-top: 1px solid #ddd;">
      <center><h5><i class="fa fa-heart"></i> &nbsp; Thank you for your business</h5></center>
    </div>
         




</div>
     






   
 

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->






        


        <!-- PAGE CONTENT ENDS -->
  
    
</div>





