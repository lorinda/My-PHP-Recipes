<?php
$add_recipe = 'selected';
require 'inc/connection.php';
require 'inc/functions.php';
require 'inc/header.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //If the main recipe form has been submitted...
    if(isset($_POST['recipe'])){
        //Save form fields after sanitizing
        $title = trim(filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING));
        $subtitle = trim(filter_input(INPUT_POST,'subtitle',FILTER_SANITIZE_STRING));
        $cooked_on = trim(filter_input(INPUT_POST,'cooked_on',FILTER_SANITIZE_STRING));
        $img_src = trim(filter_input(INPUT_POST,'img_src',FILTER_SANITIZE_STRING));
        $url = trim(filter_input(INPUT_POST,'url',FILTER_SANITIZE_STRING));

        //Add images folder to filename submitted for image
        //Empty fields become "NULL"
        if($img_src != ""){
            $img_src = '/images/'.$img_src;
        }else{
            $img_src = "NULL";
        }

         //Check that Title and Subtitle were filled in
        if(!empty($title) && !empty($subtitle)){
            $title=ucwords($title);
            $subtitle = ucwords($subtitle);
            //Add Recipe to the database
            if(add_recipe($db, $title, $subtitle, $cooked_on, $img_src, $url)){
            }
        }else{
            //Display error_message after form submit for empty fields
            $error_message = 'Could Not Add Recipe. Fill Required Fields. ';
            echo '<div class="status"><h2>';
            echo $error_message;
            echo '</h2></div>'; 
            
        }
    }//END if(isset($_POST['recipe']))
    
    //If an ingredient has been added...
    if(isset($_POST['formIngredient'])){
        $recipe_id = '';

        //function to get highest id in recipe table    
        $id = get_last_id($db);
        //convert highest id to integer
        $recipe_id =intval($id['id']);
        
        //If an ingredient was submitted...
        if($_POST['formIngredient'] == 'addFormIngredient'){
            //Save form fields after sanitizing
            $ingredient = trim(filter_input(INPUT_POST,'ingredient',FILTER_SANITIZE_STRING));
            $amount = trim(filter_input(INPUT_POST,'amount',FILTER_SANITIZE_STRING));
            $measurement = trim(filter_input(INPUT_POST,'measurement',FILTER_SANITIZE_STRING));
                        
            //Check that Ingredient and Amount were filled in
            if(!empty($ingredient) && !empty($amount)){
                $ingredient = ucwords($ingredient);
                //Add info to table
                if(add_ingredient($db, $recipe_id, $ingredient, $amount, $measurement)){
                    $status = 'Ingredient '.$ingredient.' added.';
                    //Reset variables for new form 
                    $ingredient = $amount = $measurement = '';
                }else{
                    $status = 'Could Not Add Ingredient: '.$ingredient;
                }
            }else{
                $status = "Fill in Amount and Ingredient";
            }
            //Display status message after form submit
            echo '<h2><div class="status">';
            echo $status;
            echo '</h2></div>';
        }
    }

}//END if($_SERVER["REQUEST_METHOD"] == "POST")

//If either Recipe title or subtitle is left blank, load main recipe form
if ((empty($title) || empty($subtitle)) && !isset($_POST['ingredient'])){
    include 'inc/add-recipe.php';
}else{
    //Load Ingredient form until all ingredients added
    include 'inc/add-ingredient.php';
}
?>

