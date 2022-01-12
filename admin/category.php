<?php include('header.php'); 
$CatObj = new Category;
?>

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
         <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Category</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a>
                  </li>
                  
                  <li class="breadcrumb-item active">Category
                  </li>
                </ol>
              </div>
            </div>
          </div>
          <button type="button" title="Edit" class="btn btn-outline-success btn-min-width mr-1 mb-1" data-toggle="modal" data-target="#CatAdd"><i class="fa fa-plus"></i> New Category</button>
       
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
    <?php $CatObj->AddCategory();
    $CatObj->DeleteCategory();
    $CatObj->UpdateCategory(); ?>
    
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
                                    <th class="hidden">Role</th>
                                    <th class="hidden">Status</th>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th class="hidden"></th>
                                    <th class="hidden"></th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                               
                               <?php $CatObj->ViewCategory(); ?>
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
     <div class="modal fade" id="CatAdd" tabindex="-1" role="dialog" aria-labelledby="mdModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white shadow-none">
              <h6 class="modal-title" id="mdModalLabel">ADD CATEGORY</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
             <section id="section1">
              
                
                
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="list-with-gap">
                      <label>Category Name</label>
                      <input type="text" name="catname" class="form-control" placeholder="Product Name">
                      <label>Description</label>
                      <input type="text" name="description" class="form-control" placeholder="Description">

                      
                      
                      
                      

                       
                    </div>
                  </div>

                 
                  
                </div>
               
              </section>
            </div>
            <div class="modal-footer">
              <button type="submit" name="add_cat" class="btn btn-success">Update</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              
            </div>
             </form>

          </div>
        </div>
      </div>
</div>


<?php include('footer.php'); ?>