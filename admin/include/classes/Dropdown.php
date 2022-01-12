<?php

        
        
         class Dropdown { 
     
  

   



      function CategoryDropdown()
    {
        include('config/dbconnection.php');
        $result = $db->prepare("SELECT * FROM category ORDER BY categoryName ASC");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){ ?>
            <option value="<?php echo trim($row['id']);?>"><?php echo trim($row['categoryName']);?>   
            </option>
            

            <?php
        }
    }

    function CategoryDropdownSelected($categoryid) 
    {
       include('config/dbconnection.php');
        $result = $db->prepare("SELECT * FROM category ORDER BY categoryName ASC");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){ ?>
            <option value="<?php echo trim($row['id']);?>" <?php if ($row['id'] == $categoryid) { echo 'selected="selected"';}?>><?php echo trim($row['categoryName']);?></option>'
            <?php
        }
    }


      function SubcategoryDropdown()
    {
        include('config/dbconnection.php');
        $result = $db->prepare("SELECT * FROM subcategory ORDER BY subcategory ASC");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){ ?>
            <option value="<?php echo trim($row['id']);?>"><?php echo trim($row['subcategory']);?>   
            </option>
            

            <?php
        }
    }


     function SubCategorySelected($subcategoryid) 
    {
       include('config/dbconnection.php');
        $result = $db->prepare("SELECT * FROM subcategory ORDER BY subcategory ASC");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){ ?>
            <option value="<?php echo trim($row['id']);?>" <?php if ($row['id'] == $subcategoryid) { echo 'selected="selected"';}?>><?php echo trim($row['subcategory']);?></option>'
            <?php
        }
    }


      function LabelCatDropdown()
    {
        include('config/dbconnection.php');
        $result = $db->prepare("SELECT * FROM lblcategory ORDER BY Lbl_Cat_Name ASC");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){ ?>
            <option value="<?php echo trim($row['id']);?>"><?php echo trim($row['Lbl_Cat_Name']);?>   
            </option>
            

            <?php
        }
    }

    function LblCatDropdownSelected($lblcatid) 
    {
       include('config/dbconnection.php');
        $result = $db->prepare("SELECT * FROM lblcategory ORDER BY Lbl_Cat_Name ASC");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){ ?>
            <option value="<?php echo trim($row['id']);?>" <?php if ($row['id'] == $lblcatid) { echo 'selected="selected"';}?>><?php echo trim($row['Lbl_Cat_Name']);?></option>'
            <?php
        }
    }


      function CityDropdown()
    {
        include('config/dbconnection.php');
        $result = $db->prepare("SELECT * FROM city ORDER BY City_Name ASC");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){ ?>
            <option value="<?php echo trim($row['id']);?>"><?php echo trim($row['City_Name']);?>   
            </option>
            

            <?php
        }
    }


       function CityDropdownSelected($cityid) 
    {
       include('config/dbconnection.php');
        $result = $db->prepare("SELECT * FROM city ORDER BY City_Name ASC");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){ ?>
            <option value="<?php echo trim($row['id']);?>" <?php if ($row['id'] == $cityid) { echo 'selected="selected"';}?>><?php echo trim($row['City_Name']);?></option>'
            <?php
        }
    }


          function StateDropdown()
    {
        include('config/dbconnection.php');
        $result = $db->prepare("SELECT * FROM state ORDER BY State_Name ASC");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){ ?>
            <option value="<?php echo trim($row['id']);?>"><?php echo trim($row['State_Name']);?>   
            </option>
            

            <?php
        }
    }


    function StateDropdownSelected($stateid) 
    {
       include('config/dbconnection.php');
        $result = $db->prepare("SELECT * FROM state ORDER BY State_Name ASC");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){ ?>
            <option value="<?php echo trim($row['id']);?>" <?php if ($row['id'] == $stateid) { echo 'selected="selected"';}?>><?php echo trim($row['State_Name']);?></option>'
            <?php
        }
    }

     
    

    
    
}