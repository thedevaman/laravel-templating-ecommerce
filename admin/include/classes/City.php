<?php

/**
 * 
 */
class City
{
	
	function AddCity()
	{
		




if(isset($_POST["add_city"])){
        include('config/dbconnection.php');
 
    $statename = trim($_POST['statename']);
        $cityname = trim($_POST['cityname']);
        try {

            $sql = "INSERT INTO city(State_Id, City_Name) VALUES (:a,:b)";
            $r = $db->prepare($sql);

            $insertservice = $r->execute(array(':a'=>$statename,':b'=>$cityname));
          if ($insertservice) {
            echo"<div class='alert alert-icon-left alert-success alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Well done!</strong> City Add Successfully
    </div>";}
          else{
            echo "<div class='alert alert-icon-left alert-danger alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Oh no!</strong> Something went wrong!
    </div>";

          }
          $db = null;
          // header('Location:vendor_city.php');
    }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
      

  
}
}

  function UpdateCity()
{

   if(isset($_POST["UpdateCity"])){
   
     include('config/dbconnection.php');
         
  
      $city_id = $_POST['city_id'];
        $statename = trim($_POST['statename']);
        $cityname = trim($_POST['cityname']);

         try{
                   
                    $sql = "UPDATE city SET State_Id = :a, City_Name = :b WHERE id = '$city_id'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$statename,':b'=>$cityname));
                    if ($insertservice) {
                      echo"<div class='alert alert-icon-left alert-success alert-dismissible mb-2' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Well done!</strong>Update Successfully
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
           
             
     

} }








function ViewCity()
{
    include('config/dbconnection.php');
     

                 
                $result = $db->prepare("SELECT * FROM city ORDER BY City_Name ASC ");
                $result->execute();
               for($i=0; $row = $result->fetch(); $i++){
                $stateid = $row['State_Id'];

                $resultstate = $db->prepare("SELECT * FROM state WHERE id = '$stateid'");
                $resultstate->execute();
               for($i=0; $rowstate = $resultstate->fetch(); $i++){
               

                
                ?>
            
               <tr>
                 <td class="hidden"></td>
                  <td class="hidden"></td>
                   <td class="hidden"></td>
                   <td class="hidden"></td>
                   <td class="hidden"></td>
  <td><?php echo $rowstate['State_Name']; ?></td>
  <td><?php echo $row['City_Name']; ?></td>
 
 
  

                
  <td class="text-center">
                    <div class="btn-group btn-group-xs" role="group">

                      <button type="button" title="Edit" class="btn btn-link btn-icon bigger-130 text-success" data-toggle="modal" data-target="#CityEdit-<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></button>

                      
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
                                        <input type="hidden" name="cityid" value="<?php echo $row['id']; ?>">
                                        <div class="modal-body">
                                            <button type="submit" class="btn btn-danger" name = "DeleteCity" >Delete</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="CityEdit-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="xsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xs" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white shadow-none">
              <h6 class="modal-title" id="xsModalLabel">UPDATE CITY</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
             <section id="section1">
              
                
                <input type="hidden" value="<?php echo $row['id']; ?>" name="city_id">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="list-with-gap">
                      <label>State Name</label>
                      <select class="form-control" name="statename">
                         <option value=" ">Select State</option>
                         <?php 
                         $DropdownObj = new Dropdown;
                         $DropdownObj->StateDropdownSelected($stateid); ?>
                        
                        
                      </select>
                      <label>City</label>
                      <input type="text" name="cityname" value="<?php echo $row['City_Name']; ?>" class="form-control" placeholder="City Name">

                      
                       
                    </div>
                  </div>

                  
                </div>
               
              </section>
            </div>
            <div class="modal-footer">
              <button type="submit" name="UpdateCity" class="btn btn-success">Update</button>
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














function DeleteCity()
{
       if(isset($_POST["DeleteCity"])){
        include('config/dbconnection.php');
            $cityid = $_POST['cityid'];
            try {
             


        $dbmember = "DELETE FROM city WHERE id = ?";
        $q = $db->prepare($dbmember);
        $response = $q->execute(array($cityid));
        
        if ($response) {
           header('Location:vendor_city.php');
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