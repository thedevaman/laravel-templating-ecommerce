<?php

/**
 * 
 */
class Category
{
	
	function AddCategory()
	{
		




if(isset($_POST["add_cat"])){
        include('config/dbconnection.php');
 
//         if (!empty($_FILES['upload_image']['name'])) {
         
//         function resizeImage($resourceType,$image_width,$image_height) {
//     $resizeHeight = 215;
//     $resizeWidth = 263;
    
//     $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
//     imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
//     return $imageLayer;
// } 
    
//         $fileName = $_FILES['upload_image']['tmp_name']; 
        
//         $sourceProperties = getimagesize($fileName);
//         $resizeFileName = time();
//         $uploadPath = "upload/category/";
//         $fileExt = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
//         $valid_extensions = array('jpeg', 'jpg', 'png');
//         $uploadImageType = $sourceProperties[2];
//         $sourceImageWidth = $sourceProperties[0];
//         $sourceImageHeight = $sourceProperties[1];
//         if(in_array($fileExt, $valid_extensions)){  
//         switch ($uploadImageType) {
//             case IMAGETYPE_JPEG:
//                 $resourceType = imagecreatefromjpeg($fileName); 
//                 $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
//                 imagejpeg($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
//                 break;
 
//             case IMAGETYPE_GIF:
//                 $resourceType = imagecreatefromgif($fileName); 
//                 $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
//                 imagegif($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
//                 break;
 
//             case IMAGETYPE_PNG:
//                 $resourceType = imagecreatefrompng($fileName); 
//                 $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
//                 imagepng($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
//                 break;
 
//             default:
               
//                 break;
//         }
//         $file=0;
//         move_uploaded_file($file, $uploadPath.$resizeFileName. ".". $fileExt);
       
    $catname = trim($_POST['catname']);
        $description = trim($_POST['description']);
    		try {

	    			$sql = "INSERT INTO category(categoryName, categoryDescription) VALUES (:a,:b)";
	    			$r = $db->prepare($sql);

	    			$insertservice = $r->execute(array(':a'=>$catname,':b'=>$description));
					if ($insertservice) {
						echo"<div class='flash-data' data-flashdata='1'></div>

<script type='text/javascript'>
	const flashdata = $('.flash-data').data('flashdata')
         if(flashdata){

         Swal.fire({
  position: 'top-center',
  icon: 'success',
  title: 'Category Add Successfully!',
  showConfirmButton: false,
  timer: 3000
})

     }
</script>";
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

  function UpdateCategory()
{

   if(isset($_POST["UpdateCategory"])){
   
     include('config/dbconnection.php');
         
//   $imgFile = trim($_FILES['upload_image']['name']);
//   if (!empty($imgFile)) {
//   $cat_id = $_POST['cat_id'];

// function resizeImage($resourceType,$image_width,$image_height) {
//     $resizeHeight = 450;
//     $resizeWidth = 575;
    
//     $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
//     imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
//     return $imageLayer;
// }
 
// $fileName = $_FILES['upload_image']['tmp_name']; 
        
//         $sourceProperties = getimagesize($fileName);
//         $resizeFileName = time();
//         $uploadPath = "upload/category/";
//         $fileExt = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
//         $valid_extensions = array('jpeg', 'jpg', 'png');
//         $uploadImageType = $sourceProperties[2];
//         $sourceImageWidth = $sourceProperties[0];
//         $sourceImageHeight = $sourceProperties[1];
//         if(in_array($fileExt, $valid_extensions)){  

//           $select_stmt=$db->prepare("SELECT * FROM category WHERE id='$cat_id'");
//               $select_stmt->execute();
//               $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
//               if (!empty($row['photo'])) {
              
//               unlink("upload/category/".$row['photo']);
//             } else{
//               echo "";
//             }

//         switch ($uploadImageType) {
//             case IMAGETYPE_JPEG:
//                 $resourceType = imagecreatefromjpeg($fileName); 
//                 $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
//                 imagejpeg($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
//                 break;
 
//             case IMAGETYPE_GIF:
//                 $resourceType = imagecreatefromgif($fileName); 
//                 $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
//                 imagegif($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
//                 break;
 
//             case IMAGETYPE_PNG:
//                 $resourceType = imagecreatefrompng($fileName); 
//                 $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
//                 imagepng($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
//                 break;
 
//             default:
               
//                 break;
//         }
//         $file=0;
//         move_uploaded_file($file, $uploadPath.$resizeFileName. ".". $fileExt);
        $cat_id = $_POST['cat_id'];
       $catname = trim($_POST['catname']);
        $description = trim($_POST['description']);

         try{
                   
                    $sql = "UPDATE category SET categoryName = :a, categoryDescription = :b WHERE id = '$cat_id'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$catname,':b'=>$description));
                    if ($insertservice) {
                     echo"<div class='flash-data' data-flashdata='1'></div>

<script type='text/javascript'>
	const flashdata = $('.flash-data').data('flashdata')
         if(flashdata){

         Swal.fire({
  position: 'top-center',
  icon: 'success',
  title: 'Category Update Successfully!',
  showConfirmButton: false,
  timer: 3000
})

     }
</script>";
                       
                    }
                    else{
                       echo "
<div class='flash-data' data-flashdata='1'></div>
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








function ViewCategory()
{
    include('config/dbconnection.php');
     $user_id = $_SESSION['userid'];

                 
                $result = $db->prepare("SELECT * FROM category ORDER BY categoryName ASC ");
                $result->execute();
               for($i=0; $row = $result->fetch(); $i++){
                $image=$row['photo'];
                $mainslider=$row['main_slider'];

                
                ?>
            
               <tr>
                 <td class="hidden"></td>
                  <td class="hidden"></td>
                   <td class="hidden"></td>
  <td><?php echo $row['categoryName']; ?></td>
  <td><?php echo $row['categoryDescription']; ?></td>
 <td class="hidden"></td>
<td class="hidden"></td>
 
  

                
  <td class="text-center">
                    <div class="btn-group btn-group-xs" role="group">

                      <button type="button" title="Edit" class="btn btn-link btn-icon bigger-130 text-success" data-toggle="modal" data-target="#CatEdit-<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></button>

                      
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
                                        <input type="hidden" name="categoryid" value="<?php echo $row['id']; ?>">
                                        <div class="modal-body">
                                            <button type="submit" class="btn btn-danger" name = "DeleteCategory" >Delete</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="CatEdit-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="mdModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white shadow-none">
              <h6 class="modal-title" id="mdModalLabel">UPDATE CATEGORY</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
             <section id="section1">
              
                
                <input type="hidden" value="<?php echo $row['id']; ?>" name="cat_id">
                <div class="row">
                  <div class="col-lg-12 md-12 col-xs-12 col-sm-12">
                    <div class="list-with-gap">
                      <label>Category Name</label>
                      <input type="text" name="catname" value="<?php echo $row['categoryName']; ?>" class="form-control" placeholder="Category Name">
                      <label>Description</label>
                      <input type="text" name="description" value="<?php echo $row['categoryDescription']; ?>" class="form-control" placeholder="Description">

                      
                       
                    </div>
                  </div>

                  
                  
                </div>
               
              </section>
            </div>
            <div class="modal-footer">
              <button type="submit" name="UpdateCategory" class="btn btn-success">Update</button>
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














function DeleteCategory()
{
       if(isset($_POST["DeleteCategory"])){
        include('config/dbconnection.php');
            $categoryid = $_POST['categoryid'];
            try {
              $select_stmt=$db->prepare("SELECT * FROM category WHERE id='$categoryid'");
              $select_stmt->execute();
              $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
              if (!empty($row['photo'])) {
               
              unlink("upload/category/".$row['photo']);
            } else{
              echo "";
            }



        $dbmember = "DELETE FROM category WHERE id = ?";
        $q = $db->prepare($dbmember);
        $response = $q->execute(array($categoryid));
        
        if ($response) {
           header('Location:category.php');
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