<?php

/**
 * 
 */
class LabelCategory
{
	
	function AddLblCategory()
	{
		




if(isset($_POST["add_lblcat"])){
        include('config/dbconnection.php');
 
    $catname = trim($_POST['catname']);
    $lblcatname = trim($_POST['lblcatname']);
        $description = trim($_POST['description']);
             $Rec_Time_Stamp = date('Y-m-d');
    		try {

	    			$sql = "INSERT INTO lblcategory(Cat_Id, Lbl_Cat_Name, Description, Rec_Time_Stamp) VALUES (:a,:b,:c,:d)";
	    			$r = $db->prepare($sql);

	    			$insertservice = $r->execute(array(':a'=>$catname,':b'=>$lblcatname,':c'=>$description,':d'=>$Rec_Time_Stamp));
					if ($insertservice) {
						echo"<div class='flash-data' data-flashdata='1'></div>

<script type='text/javascript'>
	const flashdata = $('.flash-data').data('flashdata')
         if(flashdata){

         Swal.fire({
  position: 'top-center',
  icon: 'success',
  title: 'Lbl Category Add Successfully!',
  showConfirmButton: false,
  timer: 3000
})

     }
</script>
";
					}
					else{
            echo "<div class='flash-data' data-flashdata='1'></div>
	<script type='text/javascript'>
		const flashdata = $('.flash-data').data('flashdata')
         if(flashdata){

        Swal.fire({
	icon: 'error',
  title: 'Oops...',
  text: 'Something went wrong!',
  showConfirmButton: false,
  timer: 2500
})

     }
	</script>";
						

					}
          $db = null;
    }
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
    	
}
}

  function UpdateLblCategory()
{

   if(isset($_POST["UpdateLblCategory"])){
   
     include('config/dbconnection.php');
  
   $lbl_cat_id = $_POST['lbl_cat_id'];

        
       $catname = trim($_POST['catname']);
       $lblcatname = trim($_POST['lblcatname']);
        $description = trim($_POST['description']);
             

         try{
                   
                    $sql = "UPDATE lblcategory SET Cat_Id = :a, Lbl_Cat_Name = :b, Description = :c WHERE id = '$lbl_cat_id'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$catname,':b'=>$lblcatname,':c'=>$description));
                    if ($insertservice) {
                     echo"<div class='flash-data' data-flashdata='1'></div>

<script type='text/javascript'>
	const flashdata = $('.flash-data').data('flashdata')
         if(flashdata){

         Swal.fire({
  position: 'top-center',
  icon: 'success',
  title: 'Update Successfully!',
  showConfirmButton: false,
  timer: 3000
})

     }
</script>
";
                       
                    }
                    else{
                       echo "<div class='flash-data' data-flashdata='1'></div>
	<script type='text/javascript'>
		const flashdata = $('.flash-data').data('flashdata')
         if(flashdata){

        Swal.fire({
	icon: 'error',
  title: 'Oops...',
  text: 'Something went wrong!',
  showConfirmButton: false,
  timer: 2500
})

     }
	</script>";
                    }
                    $db = null;
                     // header('location:ViewProduct.php');
                
                }
                
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
           
             
   
}
} 








function ViewLblCategory()
{
    include('config/dbconnection.php');

                 
                $result = $db->prepare("SELECT * FROM lblcategory ORDER BY Lbl_Cat_Name ASC ");
                $result->execute();
               for($i=0; $row = $result->fetch(); $i++){

                $category_id = $row['Cat_Id'];

                 $resultcat = $db->prepare("SELECT * FROM category WHERE id='$category_id'");
                $resultcat->execute();
               for($i=0; $rowcat = $resultcat->fetch(); $i++){

               

                
                ?>
            
               <tr>
                 <td class="hidden"></td>
                  <td class="hidden"></td>
                  <td class="hidden"></td>
                  <td class="hidden"></td>
                  <td><?php echo $row['Lbl_Cat_Name']; ?></td>
  <td><?php echo $rowcat['categoryName']; ?></td>
  <td><?php echo $row['Description']; ?></td>
 
 
  

                
  <td class="text-center">
                    <div class="btn-group btn-group-xs" role="group">

                      <button type="button" title="Edit" class="btn btn-link btn-icon bigger-130 text-success" data-toggle="modal" data-target="#LblCatEdit-<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></button>

                      
                      <button class="btn btn-link btn-icon bigger-130 text-danger" data-toggle="modal" title="Delete" data-target="#DeleteModal-<?php echo $row['id']; ?>"><i class="fa fa-trash"></i></button>

                      
                    </div>
                  
                         </td>

                    </tr>
                    
             <div class="col-lg-12">
                        <div class="modal fade" id="DeleteModal-<?php echo $row['id']; ?>" tabindex="<?php echo $row['id']; ?>"  role="dialog" aria-labelledby="myModalLabel-<?php echo $row['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="H2">Are you sure want to delete this record? </h4>
                                    </div>
                                    <form role="form" method="post" class="form-horizontal" id="popup-validation">
                                        <input type="hidden" name="lblcategoryid" value="<?php echo $row['id']; ?>">
                                        <div class="modal-body">
                                            <button type="submit" class="btn btn-danger" name = "DeleteLblCategory" >Delete</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="LblCatEdit-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="mdModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white shadow-none">
              <h6 class="modal-title" id="mdModalLabel">UPDATE LABEL CATEGORY</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
             <section id="section1">
              
                
                <input type="hidden" value="<?php echo $row['id']; ?>" name="lbl_cat_id">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="list-with-gap">
                      <label>Category Name</label>
                      <select class="form-control" name="catname">
                        <option value=" ">Slect Category</option>
                        <?php $DropdownObj = new Dropdown;
                        $DropdownObj->CategoryDropdownSelected($category_id); ?>
                      </select>

                       <label>Label Category</label>
                      <input type="text" name="lblcatname" value="<?php echo $row['Lbl_Cat_Name']; ?>" class="form-control" placeholder="Lable Category Name">
                      
                      <label>Description</label>
                      <input type="text" name="description" value="<?php echo $row['Description']; ?>" class="form-control" placeholder="Description">

                     
                       
                    </div>
                  </div>

                  
                  
                </div>
               
              </section>
            </div>
            <div class="modal-footer">
              <button type="submit" name="UpdateLblCategory" class="btn btn-success">Update</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              
            </div>
             </form>

          </div>
        </div>
      </div>

                        

              </div>
              
            <?php
                 }  }
            
}














function DeleteLblCategory()
{
       if(isset($_POST["DeleteLblCategory"])){
        include('config/dbconnection.php');
            $lblcategoryid = $_POST['lblcategoryid'];
           


            try {
            
        $dbmember = "DELETE FROM lblcategory WHERE id = ?";
        $q = $db->prepare($dbmember);
        $response = $q->execute(array($lblcategoryid));
        
        if ($response) {
           header('Location:lbl_category.php');
         } 
          }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
        }


}





 









}

?>