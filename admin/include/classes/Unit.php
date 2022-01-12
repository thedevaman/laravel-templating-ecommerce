<?php

/**
 * 
 */
class Unit
{
	
	function AddUnit()
	{
		if(isset($_POST["add_unit"])){
    		include('config/dbconnection.php');
            
            $unitname = trim($_POST['unitname']);
            $description = trim($_POST['description']);
            $user_id = trim($_POST['user_id']);
            
            
    		try {

	    			$sql = "INSERT INTO unit(Unit_Name, Description, User_Id) VALUES (:a,:b,:c)";
	    			$r = $db->prepare($sql);

	    			$insertservice = $r->execute(array(':a'=>$unitname,':b'=>$description,':c'=>$user_id));
					if ($insertservice) {
						$_SESSION['success']='Unit Add Successfully!';
					}
					else{
						$_SESSION['success']='Something Wrong!';

					}
          $db = null;
    }
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
    	}
	}

  function UpdateUnit()
{

   if(isset($_POST["update_unit"])){
   
     include('config/dbconnection.php');
              $unitid=$_POST['unitid'];
             $unitname = trim($_POST['unitname']);
            $description = trim($_POST['description']);

        
                try {
                   
                    $sql = "UPDATE unit SET Unit_Name = :a, Description = :b WHERE id = '$unitid'";
                    $z = $db->prepare($sql);
                   $insertservice = $z->execute(array(':a'=>$unitname,':b'=>$description));
                    if ($insertservice) {
                      $_SESSION['success']='Update Successfully.';
                       
                    }
                    else{
                        $_SESSION['error']='Something Wrong!';
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








function ViewUnit()
{
    include('config/dbconnection.php');
     $user_id = $_SESSION['userid'];

                 
                $result = $db->prepare("SELECT * FROM unit WHERE User_Id='$user_id' ORDER BY Unit_Name ASC ");
                $result->execute();
               for($i=0; $row = $result->fetch(); $i++){
               ?>
            
               <tr>
                
  <td><?php echo $row['Unit_Name']; ?></td>

  <td><?php echo $row['Description']; ?></td>
  

                
  <td class="text-center">
                    <div class="btn-group btn-group-xs" role="group">

                      <button type="button" title="Edit" class="btn btn-link btn-icon bigger-130 text-success" data-toggle="modal" data-target="#ProductEdit-<?php echo $row['id']; ?>"><i data-feather="edit"></i></button>

                      
                      <button class="btn btn-link btn-icon bigger-130 text-danger" data-toggle="modal" title="Delete" data-target="#DeleteModal-<?php echo $row['id']; ?>"><i data-feather="trash"></i></button>

                      
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
                                        <input type="hidden" name="unitid" value="<?php echo $row['id']; ?>">
                                        <div class="modal-body">
                                            <button type="submit" class="btn btn-danger" name = "DeleteUnit" >Delete</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="ProductEdit-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="smModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white shadow-none">
              <h6 class="modal-title" id="smModalLabel">UPDATE UNIT</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form method="POST">
            <div class="modal-body">
             <section id="section1">
              
                
                <input type="hidden" value="<?php echo $row['id']; ?>" name="unitid">
               
                    <div class="list-with-gap">
                      <label>Unit Name</label>
                      <input type="text" name="unitname" value="<?php echo $row['Unit_Name']; ?>" class="form-control" placeholder="Unit_Name" required>
                      <label>Description</label>
                      <input type="text" name="description" value="<?php echo $row['Description']; ?>" class="form-control" placeholder="Description">

                       
                    </div>
                 
               
              </section>
            </div>
            <div class="modal-footer">
              <button type="submit" name="update_unit" class="btn btn-success">Update</button>
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





function DeleteUnit()
{
       if(isset($_POST["DeleteUnit"])){
        include('config/dbconnection.php');
            $unitid = $_POST['unitid'];
            try {

        $dbmember = "DELETE FROM unit WHERE id = ?";
        $q = $db->prepare($dbmember);
        $response = $q->execute(array($unitid)); 
        if ($response) {
           header('Location:unit.php');
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