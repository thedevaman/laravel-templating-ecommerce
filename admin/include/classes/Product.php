<?php

/**
 * 
 */
class Product
{
  
  function AddProduct()
  {
  
if(isset($_POST["add_product"])){
        include('config/dbconnection.php');
 
       
    $catname = trim($_POST['catname']);
    // $lblcatname = trim($_POST['lblcatname']);
    $subcatname = trim($_POST['subcatname']);
        $gst = trim($_POST['gst']);
             $productname = trim($_POST['productname']);
             $companyname = trim($_POST['companyname']);
             $oldprice = trim($_POST['oldprice']);
             $newprice = trim($_POST['newprice']);
             $description = trim($_POST['description']);

             $imgFile = trim($_FILES['upload_image']['name']);
  if (!empty($imgFile)) {

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
        $uploadPath = "upload/product/";
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



        try {

            $sql = "INSERT INTO products(category, subCategory, GST, productName, productCompany, productPrice, New_Price, productDescription,Image) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i)";
            $r = $db->prepare($sql);

            $insertservice = $r->execute(array(':a'=>$catname,':b'=>$subcatname,':c'=>$gst,':d'=>$productname,':e'=>$companyname,':f'=>$oldprice,':g'=>$newprice,':h'=>$description,':i'=>$resizeFileName.".".$fileExt));
          if ($insertservice) {
            echo"<div class='alert alert-icon-left alert-success alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Well done!</strong> Product Add Successfully
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
    }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
    } else {
            echo "<div class='alert alert-icon-left alert-danger alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Oh no!</strong> Sorry Only Jpg, Jpeg & Png Supportrd!
    </div>";
            

          }
    } else {
      try {

            $sql = "INSERT INTO products(category, subCategory, GST, productName, productCompany, productPrice, New_Price, productDescription) VALUES (:a,:b,:c,:d,:e,:f,:g,:h)";
            $r = $db->prepare($sql);

            $insertservice = $r->execute(array(':a'=>$catname,':b'=>$subcatname,':c'=>$gst,':d'=>$productname,':e'=>$companyname,':f'=>$oldprice,':g'=>$newprice,':h'=>$description));
          if ($insertservice) {
            echo"<div class='alert alert-icon-left alert-success alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Well done!</strong> Product Add Successfully
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
    }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
    }
}
}




function AddPic()
  {
    




if(isset($_POST["AddPic"])){
        include('config/dbconnection.php');
 
        $productid = trim($_POST['productid']);

        $resultcount=$db->prepare("SELECT count(*) as countimg FROM product_img WHERE Product_Id='$productid'");
        $resultcount->execute();
        $rowcount=$resultcount->fetch();
        $countimg = $rowcount['countimg'];

        if ($countimg==3) {
           echo "<div class='alert alert-icon-left alert-danger alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Oh no!</strong> Allready 3 image Inserted!
    </div>";
        } else{



         
        function resizeImage($resourceType,$image_width,$image_height) {
    $resizeHeight = 215;
    $resizeWidth = 263;
    
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
} 
    
        $fileName = $_FILES['upload_image']['tmp_name']; 
        
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "upload/product/";
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
       
    
    
        try {

            $sql = "INSERT INTO product_img(Product_Id, photo) VALUES (:a,:b)";
            $r = $db->prepare($sql);

            $insertservice = $r->execute(array(':a'=>$productid,':b'=>$resizeFileName.".".$fileExt));
          if ($insertservice) {
            echo"<div class='alert alert-icon-left alert-success alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Well done!</strong> Pic Add Successfully
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
}

 
 function UpdateProduct()
{

   if(isset($_POST["UpdateProduct"])){
   
     include('config/dbconnection.php');
         
  $imgFile = trim($_FILES['upload_image']['name']);
  if (!empty($imgFile)) {
   $product_id = $_POST['product_id'];

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

          $select_stmt=$db->prepare("SELECT * FROM products WHERE id='$product_id'");
              $select_stmt->execute();
              $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
              if (!empty($row['image'])) {
               
              unlink("upload/product/".$row['image']);
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
    $resizeHeight = 450;
    $resizeWidth = 575;
    
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








function ViewProduct()
{
    include('config/dbconnection.php');

                $result = $db->prepare("SELECT * FROM products ORDER BY productName ASC ");
                $result->execute();
               for($i=0; $row = $result->fetch(); $i++){
               
                $subcatid=$row['subCategory'];
                $productid=$row['id'];

                $resultsubcat = $db->prepare("SELECT * FROM subcategory WHERE id='$subcatid'");
                $resultsubcat->execute();
               for($i=0; $rowsubcat = $resultsubcat->fetch(); $i++){
                $categoryid=$rowsubcat['categoryid'];
                

                $resultcat = $db->prepare("SELECT * FROM category WHERE id='$categoryid'");
                $resultcat->execute();
               for($i=0; $rowcat = $resultcat->fetch(); $i++){
                

                
                ?>
            
               <tr>
                 
                  
                   
  <td><?php echo $rowcat['categoryName']."->(".$rowsubcat['subcategory'].")"; ?></td>
  <td><?php echo $row['productName']." (".$row['productCompany'].")"; ?></td>
  <td><?php echo $row['New_Price']." (<del>".$row['productPrice']."</del>)"; ?></td>
  
  <td>
<?php 
if (!empty($row['Image'])) { ?>
    <img height="50" src="upload/product/<?php echo $row['Image']; ?>">
<?php } else { ?>
  <img height="50" src="images/no_images.jpg">
<?php } ?>
  </td>
                             <td><?php echo $row['GST']; ?> %</td>
                             <td><?php echo $row['productDescription']; ?></td>
  
                    <td></td>                          

 
 
  

                
  <td class="text-center">
                    <div class="btn-group btn-group-xs" role="group">

                      <button type="button" title="Add Photo" class="btn btn-link btn-icon bigger-130 text-info" data-toggle="modal" data-target="#AddPhoto-<?php echo $row['id']; ?>"><i class="fa fa-photo"></i></button>

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
                     <input type="file" name="upload_image" class="form-control"> 
                      
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
              <h6 class="modal-title" id="lgModalLabel">UPDATE PRODUCT</h6>
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
                      <label>Category Name</label>
                     <select class="form-control" name="catname">
                        <option value=" ">Select Category</option>
                        <?php
                        $DropdownObj = new Dropdown;
                        $DropdownObj->CategoryDropdownSelected($categoryid); ?>
                      </select>

                       <label>Sub Category Name</label>

                        <select class="form-control" name="subcatname">
                        <option value=" ">Select Category</option>
                        <?php
                      
                        $DropdownObj->SubCategorySelected($subcatid); ?>
                      </select>
                      
                    
                    <!--   <label>Deal of the month</label>
                      <select class="form-control" name="dom">
                         <option value="2" <?php if (2 == $dom) { echo 'selected="selected"';}?>>No</option>
                         <option value="1" <?php if (1 == $dom) { echo 'selected="selected"';}?>>Yes</option>
                        
                      </select> -->
                      <input type="hidden" name="dom" value="2">

                        

                      <label>Product Name</label>
                      
                      <input type="text" name="productname" class="form-control" placeholder="Product Name">

                      <label>Company Name</label>
                      
                      <input type="text" name="companyname" class="form-control" placeholder="Company Name" value="<?php echo $row['productCompany']; ?>">

                      <label>GST %</label>
                      
                      <input type="text" name="gst" class="form-control" placeholder="GST %">
                       

                    <!--   <label>Slider</label>
                       -->
                      
                      
                     <!--  <select class="form-control" name="slider">
                         <option value="1" <?php if (1 == $mainslider) { echo 'selected="selected"';}?>>Active</option>
                         <option value="2" <?php if (2 == $mainslider) { echo 'selected="selected"';}?>>Deactive</option>
                        
                      </select> -->
                      <input type="hidden" name="slider" value="1">
                       
                    </div>
                  </div>

                  <div class="col-lg-6 md-6 col-xs-12 col-sm-12">
                    <div class="list-with-gap">
                       <!-- <label>Company Name</label>
                      
                      <input type="text" name="companyname" class="form-control" placeholder="Company Name"> -->

                      <label>Old Price</label>
                      
                      <input type="text" name="oldprice" class="form-control" placeholder="Old Price">

                      <label>New Price</label>
                      
                      <input type="text" name="newprice" class="form-control" placeholder="New Price">
                      
                     
                     <label>Product Photo</label>
                     <input type="file" name="upload_image" class="form-control"> 
                      
                   <br>
                     <?php if (empty($row['Image'])) { ?>
                                <img src="images/no_images.jpg" height='60px' width='100px'>
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
              <button type="submit" name="UpdateProduct" class="btn btn-success">Update</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              
            </div>
             </form>

          </div>
        </div>
      </div>

                        

              </div>
              
            <?php
                 }  } }
            
}








function DeleteProduct()
{
       if(isset($_POST["DeleteProduct"])){
        include('config/dbconnection.php');
            $produtid = $_POST['produtid'];
            try {
              $select_stmt=$db->prepare("SELECT * FROM products WHERE id='$produtid'");
              $select_stmt->execute();
              $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
              if (!empty($row['Image'])) {
              
              unlink("upload/product/".$row['Image']);
            } else{
              echo "";
            }



        $dbmember = "DELETE FROM products WHERE id = ?";
        $q = $db->prepare($dbmember);
        $response = $q->execute(array($produtid));
        
        if ($response) {
           header('Location:products.php');
         } 
          }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
        }


}


function DeletePic()
{
       if(isset($_POST["DeletePic"])){
        include('config/dbconnection.php');
            $picid = $_POST['picid'];
            try {
              $select_stmt=$db->prepare("SELECT * FROM product_img WHERE id='$picid'");
              $select_stmt->execute();
              $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
              if (!empty($row['photo'])) {
              
              unlink("upload/product/".$row['photo']);
            } else{
              echo "";
            }



        $dbmember = "DELETE FROM product_img WHERE id = ?";
        $q = $db->prepare($dbmember);
        $response = $q->execute(array($picid));
        
        if ($response) {
           header('Location:products.php');
         } 
          }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
        }


}





 









}

