<?php

/**
 * 
 */
class SubCategory
{
	
	function AddSubCategory()
	{
		




if(isset($_POST["add_cat"])){
        include('config/dbconnection.php');
 
        if (!empty($_FILES['upload_image']['name'])) {
         
        function resizeImage($resourceType,$image_width,$image_height) {
    $resizeHeight = 600;
    $resizeWidth = 600;
    
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
} 
    
        $fileName = $_FILES['upload_image']['tmp_name']; 
        
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "upload/subcategory/";
        $fileExt = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
        $valid_extensions = array('jpeg', 'jpg', 'png');
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        if(in_array($fileExt, $valid_extensions)){  
        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagegif($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                break;
 
            default:
               
                break;
        }
        $file=0;
        move_uploaded_file($file, $uploadPath.$resizeFileName. ".". $fileExt);
       
    $catname = trim($_POST['catname']);
    $lblcatname = trim($_POST['lblcatname']);
    $subcatname = trim($_POST['subcatname']);
        $dom = trim($_POST['dom']);
             $slider = trim($_POST['slider']);
             $sliderheading = trim($_POST['sliderheading']);
             $sliderdescription = trim($_POST['sliderdescription']);
    		try {

	    			$sql = "INSERT INTO subcategory(categoryid, lblcatid, subcategory,dom, main_slider, photo,Slider_Heading,Slider_Description) VALUES (:a,:b,:c,:d,:e,:f,:g,:h)";
	    			$r = $db->prepare($sql);

	    			$insertservice = $r->execute(array(':a'=>$catname,':b'=>$lblcatname,':c'=>$subcatname,':d'=>$dom,':e'=>$slider,':f'=>$resizeFileName.".".$fileExt,':g'=>$sliderheading,':h'=>$sliderdescription));
					if ($insertservice) {
						echo"<div class='flash-data' data-flashdata='1'></div>

<script type='text/javascript'>
	const flashdata = $('.flash-data').data('flashdata')
         if(flashdata){

         Swal.fire({
  position: 'top-center',
  icon: 'success',
  title: 'Sub Category Add Successfully!',
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
    	} else{

            echo "
            
            <div class='flash-data' data-flashdata='1'></div>
	<script type='text/javascript'>
		const flashdata = $('.flash-data').data('flashdata')
         if(flashdata){

        Swal.fire({
	icon: 'error',
  title: 'Oops...',
  text: 'Sorry only JPG, JPEG & PNG files are allowed!',
  showConfirmButton: false,
  timer: 2500
})

     }
	</script>";
      }
	} else{
    $catname = trim($_POST['catname']);
    $lblcatname = trim($_POST['lblcatname']);
    $subcatname = trim($_POST['subcatname']);
        $dom = trim($_POST['dom']);
             $slider = trim($_POST['slider']);
             $sliderheading = trim($_POST['sliderheading']);
             $sliderdescription = trim($_POST['sliderdescription']);
        try {

            $sql = "INSERT INTO subcategory(categoryid, lblcatid, subcategory,dom, main_slider, Slider_Heading, Slider_Description) VALUES (:a,:b,:c,:d,:e,:f,:g)";
            $r = $db->prepare($sql);

            $insertservice = $r->execute(array(':a'=>$catname,':b'=>$lblcatname,':c'=>$subcatname,':d'=>$dom,':e'=>$slider,':f'=>$sliderheading,':g'=>$sliderdescription));
          if ($insertservice) {
            echo"<div class='flash-data' data-flashdata='1'></div>

<script type='text/javascript'>
	const flashdata = $('.flash-data').data('flashdata')
         if(flashdata){

         Swal.fire({
  position: 'top-center',
  icon: 'success',
  title: 'Sub Category Add Successfully!',
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
}

  function UpdateSubCategory()
{

   if(isset($_POST["UpdateCategory"])){
   
     include('config/dbconnection.php');
         
  $imgFile = trim($_FILES['upload_image']['name']);
  if (!empty($imgFile)) {
   $subcat_id = $_POST['subcat_id'];

function resizeImage($resourceType,$image_width,$image_height) {
    $resizeHeight = 600;
    $resizeWidth = 600;
    
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}
 
$fileName = $_FILES['upload_image']['tmp_name']; 
        
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "upload/subcategory/";
        $fileExt = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
        $valid_extensions = array('jpeg', 'jpg', 'png');
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        if(in_array($fileExt, $valid_extensions)){  

          $select_stmt=$db->prepare("SELECT * FROM subcategory WHERE id='$subcat_id'");
              $select_stmt->execute();
              $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
              if (!empty($row['photo'])) {
               
              unlink("upload/subcategory/".$row['photo']);
            } else{
              echo "";
            }

        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagegif($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                break;
 
            default:
               
                break;
        }
        $file=0;
        move_uploaded_file($file, $uploadPath.$resizeFileName. ".". $fileExt);
        
       $catname = trim($_POST['catname']);
       $lblcatname = trim($_POST['lblcatname']);
    $subcatname = trim($_POST['subcatname']);
        $dom = trim($_POST['dom']);
             $slider = trim($_POST['slider']);

         try{
                   
                    $sql = "UPDATE subcategory SET categoryid = :a, lblcatid=:b, subcategory = :c, dom = :d, main_slider = :e, photo = :f WHERE id = '$subcat_id'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$catname,':b'=>$lblcatname,':c'=>$subcatname,':d'=>$dom,':e'=>$slider,':f'=>$resizeFileName.".".$fileExt));
                    if ($insertservice) {
                     echo"<div class='alert alert-icon-left alert-success alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Well done!</strong> Update Successfully
    </div>";
                       
                    }
                    else{
                       echo "<div class='alert alert-icon-left alert-danger alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Oh no!</strong> Something went wrong!
    </div>";
                    }
                    $db = null;
                     // header('location:ViewProduct.php');
                
                }
                
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
            } else{
            echo "<div class='alert alert-icon-left alert-danger alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Oh no!</strong> Sorry only JPG, JPEG & PNG files are allowed!
    </div>";

            }
             
     
  
} else{
   $subcat_id = $_POST['subcat_id'];
      $catname = trim($_POST['catname']);
      // $lblcatname = trim($_POST['lblcatname']);
    $subcatname = trim($_POST['subcatname']);
        // $dom = trim($_POST['dom']);
             $slider = trim($_POST['slider']);

         try{
                   
                    $sql = "UPDATE subcategory SET categoryid = :a, subcategory = :b, main_slider = :c WHERE id = '$subcat_id'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$catname,':b'=>$subcatname,':c'=>$slider));
                    if ($insertservice) {
                     echo"<div class='alert alert-icon-left alert-success alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Well done!</strong> Update Successfully
    </div>";
                       
                    }
                    else{
                       echo "<div class='alert alert-icon-left alert-danger alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Oh no!</strong> Something went wrong!
    </div>";
                    }
                    $db = null;
                     // header('location:ViewProduct.php');
                
                }
                
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
           
             
     
}
} }







  function UpdateSlider()
{

   if(isset($_POST["UpdateSlider"])){
   
     include('config/dbconnection.php');
         
  $imgFile = trim($_FILES['upload_image']['name']);
   $subcat_id = $_POST['subcat_id'];

function resizeImage($resourceType,$image_width,$image_height) {
    $resizeHeight = 360;
    $resizeWidth = 850;
    
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}
 
$fileName = $_FILES['upload_image']['tmp_name']; 
        
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "upload/slider/";
        $fileExt = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
        $valid_extensions = array('jpeg', 'jpg', 'png');
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        if(in_array($fileExt, $valid_extensions)){  

          $select_stmt=$db->prepare("SELECT * FROM subcategory WHERE id='$subcat_id'");
              $select_stmt->execute();
              $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
              if (!empty($row['slider_photo'])) {
              
              unlink("upload/slider/".$row['slider_photo']);
            } else{
              echo "";
            }

        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagegif($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                break;
 
            default:
               
                break;
        }
        $file=0;
        move_uploaded_file($file, $uploadPath.$resizeFileName. ".". $fileExt);
        
       

         try{
                   
                    $sql = "UPDATE subcategory SET slider_photo = :a WHERE id = '$subcat_id'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$resizeFileName.".".$fileExt));
                    if ($insertservice) {
                     echo"<div class='alert alert-icon-left alert-success alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Well done!</strong> Slider Photo Update Successfully
    </div>";
                       
                    }
                    else{
                       echo "<div class='alert alert-icon-left alert-danger alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Oh no!</strong> Something went wrong!
    </div>";
                    }
                    $db = null;
                     // header('location:ViewProduct.php');
                
                }
                
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
            } else{
            echo "<div class='alert alert-icon-left alert-danger alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Oh no!</strong> Sorry only JPG, JPEG & PNG files are allowed!
    </div>";

            }
             
     
  

           
             
     

} }








function ViewSubCategory()
{
    include('config/dbconnection.php');

                $result = $db->prepare("SELECT * FROM subcategory ORDER BY subcategory ASC ");
                $result->execute();
               for($i=0; $row = $result->fetch(); $i++){
                $categoryid=$row['categoryid'];
                $image=$row['photo'];
                $mainslider=$row['main_slider'];
                $dom=$row['dom'];
                $sliderphoto=$row['slider_photo'];
                // $labelcatid = $row['lblcatid'];

                $resultcat = $db->prepare("SELECT * FROM category WHERE id='$categoryid'");
                $resultcat->execute();
               for($i=0; $rowcat = $resultcat->fetch(); $i++){

               //  $resultlblcat = $db->prepare("SELECT * FROM lblcategory WHERE id='$labelcatid'");
               //  $resultlblcat->execute();
               // for($i=0; $rowlblcat = $resultlblcat->fetch(); $i++){
                

                
                ?>
            
               <tr>
                 
                  
       <td><?php echo $row['subcategory']; ?></td>            
  <td><?php echo $rowcat['categoryName']; ?></td>
 <!--  <td><?php echo $rowlblcat['Lbl_Cat_Name']; ?></td> -->

  
  
  <td>
                              <?php if (empty($image)) { ?>
                                <img src="../images/noimage.png" height='40px' width='40px'>
                              <?php } else { ?>
                              <img src="upload/subcategory/<?php echo $image; ?>" height='40px' width='40px'>
                            <?php } ?>
                             
                            </td>
  <td><?php if ($dom == 1) { ?>
                              <span class="badge badge-success">Yes</span>
                            <?php }
                            if ($dom == 2) { ?>
                              <span class="badge badge-danger">No</span>
                            <?php }?></td>
                            <td>
                               <?php if (empty($sliderphoto)) { ?>
                                <img src="../images/noimage.png" height='40px' width='80px'>
                              <?php } else { ?>
                              <img src="upload/slider/<?php echo $sliderphoto; ?>" height='40px' width='80px'>
                            <?php } ?>
                             <button type="button" title="Edit" class="btn btn-link btn-icon bigger-130 text-info" data-toggle="modal" data-target="#SliderEdit-<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></button>
                            </td>

  <td><?php if ($mainslider == 1) { ?>
                              <span class="badge badge-success">Active</span>
                            <?php }
                            if ($mainslider == 2) { ?>
                              <span class="badge badge-danger">Deactive</span>
                            <?php }?></td>
 
  

                
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
                                        <input type="hidden" name="subcategoryid" value="<?php echo $row['id']; ?>">
                                        <div class="modal-body">
                                            <button type="submit" class="btn btn-danger" name = "DeleteSubCategory" >Delete</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="SliderEdit-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="xsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xs" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white shadow-none">
              <h6 class="modal-title" id="xsModalLabel">UPDATE SLIDER</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
             <section id="section1">
              
                
                <input type="hidden" value="<?php echo $row['id']; ?>" name="subcat_id">
                <div class="row">
                  
                  <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="list-with-gap">
                      
                     
                     <label>Slider Photo</label>
                     <input type="file" name="upload_image" class="form-control" required> 
                      
                   <br>
                     <?php if (empty($sliderphoto)) { ?>
                                <img src="../images/noimage.png" height='60px' width='100px'>
                              <?php } else { ?>
                              <img src="upload/slider/<?php echo $sliderphoto; ?>" height='60px' width='100px'>
                            <?php } ?>
                     
                       
                          
                        
                      

                    </div>
                  </div>
                  
                </div>
               
              </section>
            </div>
            <div class="modal-footer">
              <button type="submit" name="UpdateSlider" class="btn btn-success">Update</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              
            </div>
             </form>

          </div>
        </div>
      </div>




                        <div class="modal fade" id="CatEdit-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="lgModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white shadow-none">
              <h6 class="modal-title" id="lgModalLabel">UPDATE SUBCATEGORY</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
             <section id="section1">
              
                
                <input type="hidden" value="<?php echo $row['id']; ?>" name="subcat_id">
                <div class="row">
                  <div class="col-lg-6 md-6 col-xs-12 col-sm-12">
                    <div class="list-with-gap">
                      <label>Category</label>
                     <select class="form-control" name="catname" required>
                        <option value=" ">Select Category</option>
                        <?php
                        $DropdownObj = new Dropdown;
                        $DropdownObj->CategoryDropdownSelected($categoryid); ?>
                      </select>

                       

                       <label>Sub Category</label>
                      
                      <input type="text" name="subcatname" value="<?php echo $row['subcategory']; ?>" class="form-control" placeholder="Sub Category Name">

                     <!--  <label>Deal of the month</label>
                      <select class="form-control" name="dom">
                         <option value="2" <?php if (2 == $dom) { echo 'selected="selected"';}?>>No</option>
                         <option value="1" <?php if (1 == $dom) { echo 'selected="selected"';}?>>Yes</option>
                        
                      </select>
                        -->

                   
                       
                    </div>
                  </div>

                  <div class="col-lg-6 md-6 col-xs-12 col-sm-12">
                    <div class="list-with-gap">
                      
                        <label>Slider</label>
                      
                      
                      
                      <select class="form-control" name="slider">
                         <option value="1" <?php if (1 == $mainslider) { echo 'selected="selected"';}?>>Active</option>
                         <option value="2" <?php if (2 == $mainslider) { echo 'selected="selected"';}?>>Deactive</option>
                        
                      </select>

                     <label>Slider Photo</label>
                     <input type="file" name="upload_image" class="form-control"> 
                      
                   <br>
                     <?php if (empty($image)) { ?>
                                <img src="../images/noimage.png" height='60px' width='100px'>
                              <?php } else { ?>
                              <img src="upload/subcategory/<?php echo $image; ?>" height='60px' width='100px'>
                            <?php } ?>
                     
                       
                          
                        
                      

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
                  } }
            
}














function DeleteSubCategory()
{
       if(isset($_POST["DeleteSubCategory"])){
        include('config/dbconnection.php');
            $subcategoryid = $_POST['subcategoryid'];
            try {
              $select_stmt=$db->prepare("SELECT * FROM subcategory WHERE id='$subcategoryid'");
              $select_stmt->execute();
              $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
              if (!empty($row['photo'])) {
              
              unlink("upload/subcategory/".$row['photo']);
            } else{
              echo "";
            }



        $dbmember = "DELETE FROM subcategory WHERE id = ?";
        $q = $db->prepare($dbmember);
        $response = $q->execute(array($subcategoryid));
        
        if ($response) {
           header('Location:subcategory.php');
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