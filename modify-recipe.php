<?php
//To mark navigation option 'active'
$modify_recipe = 'selected';

require 'inc/functions.php';
require 'inc/connection.php';
require 'inc/header.php';
$addIngredient = '';
$status = '';

//If id in url is in database
if(isset($_GET['id']) && is_id_valid($db, $_GET['id'])){
    //Get id from url
    $id = $_GET['id'];
        if(get_title($db, $id)){
            //Store recipe title from database
            $recipeTitle = get_title($db, $id);
            //Store recipe subtitle from database
            $subTitle = get_subtitle($db, $id); 
        }else{
            $id='';
        }
}else{
    //No valid recipe id
    $id = '';
    //display 'inc/select_recipe_to_modify.php' for invalid ID
}

//If Rename submission clicked for Title      
if(isset($_POST['title'])){
    $title = trim(filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING));
    $title = ucwords($title);
    //Write new Title to database
    if(set_title($db, $title, $id)){
        $recipeTitle = get_title($db, $id);
        $status = 'Title Updated';
    }else{
        $status = 'Could not update Title';
    }    
}

//If Rename submission clicked for SubTitle     
if(isset($_POST['subtitle'])){
    $sub = trim(filter_input(INPUT_POST,'subtitle',FILTER_SANITIZE_STRING));
    $sub = ucwords($sub);
    //Write subtitle to database
    if(set_subtitle($db, $sub, $id)){
        $subTitle = get_subtitle($db, $id);
        $status = 'Subtitle Updated';
    }else{
        $status = 'Could not update SubTitle';
    }    
}

//If Choose New Image clicked
if(isset($_POST['image'])){
    $img = trim(filter_input(INPUT_POST,'image',FILTER_SANITIZE_STRING));
    //Write image filename to database
    if(set_image($db, $img, $id)){
        $status = 'Image Updated';
    }else{
        $status = 'Could not update Image';
    }
}
//If Add Ingredient clicked
if(isset($_POST['addIngredient'])){
    $addIngredient = trim(filter_input(INPUT_POST,'addIngredient',FILTER_SANITIZE_STRING));
    $amount = trim(filter_input(INPUT_POST,'amount',FILTER_SANITIZE_STRING));
    $measurement = trim(filter_input(INPUT_POST,'measurement',FILTER_SANITIZE_STRING));
    $addIngredient = ucwords($addIngredient);
    //Write ingredient to database
    if(add_ingredient($db, $id, $addIngredient, $amount, $measurement)){
        $status = $addIngredient.' Added';
    }else{
        $status = 'Could not add Ingredient';
    }
} 
//If Delete Ingredient clicked
if(isset($_POST['deleteIngredient'])){
    $ingredient = $_POST['deleteIngredient'];
    //Delete ingredient from database
    if(delete_ingredient($db, $id,$ingredient)){
        $status = $ingredient.' Deleted';
    }else{
        $status = 'Could not Delete Ingredient';
    }
}

//If Delete Recipe 
if(isset($_POST['DELETE'])){
    //Delete recipe from database
    if(delete_recipe($db, $id)){
        $status = 'Recipe Deleted';
    }else{
        $status = "Recipe NOT Deleted";
    }
    
}

//If Rename Website Link
if(isset($_POST['website'])){
    $url = trim(filter_input(INPUT_POST,'website',FILTER_SANITIZE_STRING));
    //Write website link to database
    if(change_website($db, $id, $url)){
        $status = "Website changed";
    }else{
        $status = "Website could not be changed";
    }
}

//Display status message for any changes
echo "<div class='status'><h2>".$status."</h2></div>";


///MAIN DISPLAY


if(isset($_GET['id']) && is_id_valid($db, $_GET['id'])){
////If Recipe chosen and valid ID, display this page////
    require 'inc/modify_chosen_recipe.php';
    }else{
    ////If No Recipe Chosen, display this page////
    require 'inc/select_recipe_to_modify.php';
    } 
?>
<?php require 'inc/footer.php'; ?>