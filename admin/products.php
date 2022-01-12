<?php include('header.php'); 
$ProductObj = new Product;
$DropdownObj = new Dropdown;
?>

<script type="text/javascript">
           



      function getlblcat() 
        {
          var subject = $('#cat').val();
          var top = subject;
          //alert(join);
          //alert(sub);
          ajaxRequest = new XMLHttpRequest();
          ajaxRequest.onreadystatechange = function()
          {
              if(ajaxRequest.readyState == 4)
              {
                  var ajaxDisplay = document.getElementById('lblcat');
                  ajaxDisplay.innerHTML = ajaxRequest.responseText;    
              }
          }
        ajaxRequest.open("GET", "ajax.php?Cat_Id=" +top, true);
          ajaxRequest.send(); 
      }  


 function getsubcat() 
        {
          var subject = $('#cat').val();
          var top = subject;
          //alert(join);
          //alert(sub);
          ajaxRequest = new XMLHttpRequest();
          ajaxRequest.onreadystatechange = function()
          {
              if(ajaxRequest.readyState == 4)
              {
                  var ajaxDisplay = document.getElementById('subcat');
                  ajaxDisplay.innerHTML = ajaxRequest.responseText;    
              }
          }
        ajaxRequest.open("GET", "ajax.php?Cat_Id=" +top, true);
          ajaxRequest.send(); 
      }  

 
        </script>

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
         <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Product</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Products</a>
                  </li>
                  
                  <li class="breadcrumb-item active">Product
                  </li>
                </ol>
              </div>
            </div>
          </div>
          <button type="button" title="Edit" class="btn btn-outline-success btn-min-width mr-1 mb-1" data-toggle="modal" data-target="#ProductAdd"><i class="fa fa-plus"></i> New Product</button>
       
        </div>
       
        <div class="content-body"><!-- users list start -->
<section class="users-list-wrapper">
   <!--  <div class="users-list-filter px-1">
        <form>
            <div class="row border border-light rounded py-2 mb-2">
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-verified">Verified</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="users-list-verified">
                            <option value="">Any</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-role">Role</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="users-list-role">
                            <option value="">Any</option>
                            <option value="User">User</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-status">Status</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="users-list-status">
                            <option value="">Any</option>
                            <option value="Active">Active</option>
                            <option value="Close">Close</option>
                            <option value="Banned">Banned</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                    <button class="btn btn-block btn-primary glow">Show</button>
                </div>
            </div>
        </form>
    </div> -->
    <?php $ProductObj->AddProduct();
    $ProductObj->DeleteProduct();
    $ProductObj->UpdateProduct();
    $ProductObj->AddPic();
    $ProductObj->DeletePic();  ?>
    
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <!-- datatable start -->
                    <div class="table-responsive">
                        <table id="users-list-datatable" class="table">
                            <thead>
                                <tr>
                                    <th>Category -> (SubCategory)</th>
                                    
                                    <th>Product (Company)</th>
                                    <th>New Price (Old)</th>
                                    <th>Photo</th>
                                    <th>GST</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                               
                               <?php $ProductObj->ViewProduct(); ?>
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

<div class="col-lg-12">
     <div class="modal fade" id="ProductAdd" tabindex="-1" role="dialog" aria-labelledby="lgModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white shadow-none">
              <h6 class="modal-title" id="lgModalLabel">ADD PRODUCT</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
             <section id="section1">
              
                
                
                <div class="row">
                  <div class="col-lg-6 md-6 col-xs-12 col-sm-12">
                    <div class="list-with-gap">
                      <label>Category</label>
                      <select class="form-control" name="catname" id="cat" onchange = "getsubcat();" required>
                        <option value=" ">Select Category</option>
                        <?php $DropdownObj->CategoryDropdown(); ?>
                      </select>

                     <!--  <label>Label Category</label>
                      <select class="form-control" name="lblcatname" id="lblcat" onchange = "getsubcat();" required>
                        <option value=" ">Label Category</option>
                       
                      </select>


 -->


                     <input type="hidden" name="lblcatname">
                   
                      <label>Sub Category</label>
                      <select class="form-control" name="subcatname" id="subcat">
                        <option value=" ">Select SubCategory</option>
                     
                      </select>

                      <label>Product Name</label>
                      
                      <input type="text" name="productname" class="form-control" placeholder="Product Name">

                      <label>GST %</label>
                      
                      <input type="text" name="gst" class="form-control" placeholder="GST %">

                     

                      
                      
                     

                       
                    </div>
                  </div>

                  <div class="col-lg-6 md-6 col-xs-12 col-sm-12">
                    <div class="list-with-gap">

    
                      <label>Company Name</label>
                      
                      <input type="text" name="companyname" class="form-control" placeholder="Company Name">

                      <label>Old Price</label>
                      
                      <input type="text" name="oldprice" class="form-control" placeholder="Old Price">

                      <label>New Price</label>
                      
                      <input type="text" name="newprice" class="form-control" placeholder="New Price">
                      

                       <label>Product Photo</label>
                     <input type="file" name="upload_image" class="form-control"> 
                      
                   <br>
                     <?php if (empty($image)) { ?>
                                <img src="../images/icons/no_images.jpg" height='60px' width='100px'>
                              <?php } else { ?>
                              <img src="upload/subcategory/<?php echo $image; ?>" height='60px' width='100px'>
                            <?php } ?>
                     
                       
                    
                      
                   
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="form-group">
    <label for="email">Description</label>
   
   <div class="form-group">
         <textarea id="editor" name="description"></textarea>
      </div>
  </div> 
                  </div>
                  
                </div>
               
              </section>
            </div>
            <div class="modal-footer">
              <button type="submit" name="add_product" class="btn btn-success">Add</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              
            </div>
             </form>

          </div>
        </div>
      </div>
</div>


<?php include('footer.php'); ?>