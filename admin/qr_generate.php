<?php 

 

  include('header.php');
  $SalesObj = new Sales; ?>


    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">QR Generation</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a>
                  </li>
                  
                  <li class="breadcrumb-item active">QR Generate
                  </li>
                </ol>
              </div>
            </div>
          </div>
         <!--  <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
              <div class="btn-group" role="group">
                <button class="btn btn-outline-primary dropdown-toggle dropdown-menu-right" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings icon-left"></i> Settings</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"><a class="dropdown-item" href="card-bootstrap.html">Bootstrap Cards</a><a class="dropdown-item" href="component-buttons-extended.html">Buttons Extended</a></div>
              </div><a class="btn btn-outline-primary" href="full-calender-basic.html"><i class="feather icon-mail"></i></a><a class="btn btn-outline-primary" href="timeline-center.html"><i class="feather icon-pie-chart"></i></a>
            </div>
          </div> -->
        </div>
        <div class="content-body"><!-- DOM - jQuery events table -->

<!-- DOM - jQuery events table -->
<!-- Column rendering table -->
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">QR Code Generation <a href="javascript:void(0);" onclick="printDiv('printableArea')" class="btn btn-info btn-sm"> Print</a></h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                          <li><a data-action="collapse"><i class="fa fa-minus"></i></a></li>
                            <li><a data-action="reload"><i class="fa fa-refresh"></i></a></li>
                            <li><a data-action="expand"><i class="fa fa-window-maximize"></i></a></li>
                            <li><a data-action="close"><i class="fa fa-close"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       <div class="row">
                       



                      <?php    
/*
 * PHP QR Code encoder
 *
 * Exemplatory usage
 *
 * PHP QR Code is distributed under LGPL 3
 * Copyright (C) 2010 Dominik Dzienia <deltalab at poczta dot fm>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */
    


 //config form
    echo '<form action="qr_generate.php" method="post">
        Data:&nbsp;<input name="data" value="'.(isset($_REQUEST['data'])?htmlspecialchars($_REQUEST['data']):'PHP QR Code :)').'" /><select class="hidden" name="level">
            
            <option value="H">H - best</option>
        </select><select class="hidden" name="size">';
        
    
        echo '<option value="5">5</option>';

        
        
    echo '</select>&nbsp; Qty
    <input type="text" name="qty" placeholder="qty" required>;

        <input type="submit" value="GENERATE"></form><hr/>';
    
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    

    $matrixPointSize = 4;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);


    if (isset($_REQUEST['data'])) { 
    
        //it's very important!
        if (trim($_REQUEST['data']) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    } else {    
    
        //default data
        echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    }    
        
    //display generated file


   
        
    // benchmark
    // QRtools::timeBenchmark();    

    ?>
    </div>


    <div class="row" id="printableArea">

      <?php
      error_reporting(0);

      for ($i=0; $i < $_POST['qty']; $i++) { 
  
echo '<span class="img_set" style="float:left;line-height: 0;text-align: center;margin-top:16px;"><img src="'.$PNG_WEB_DIR.basename($filename).'" /><br>BPL-ECOMMERCE</span>';  
   } 

      ?>
      
    </div>





                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Column rendering table -->



        </div>
      </div>
    </div>
    <!-- END: Content-->

<?php include('footer.php'); ?>
<!-- <script type="text/javascript">
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
</script> -->


<script>
function printDiv(printableArea) {
     var printContents = document.getElementById(printableArea).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>