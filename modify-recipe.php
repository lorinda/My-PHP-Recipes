<?php
$modify_recipe = 'selected';
include 'inc/functions.php';
include 'inc/connection.php';
include 'inc/header.php';
$addIngredient = '';
$status = '';
//If id in url is in database
if(isset($_GET['id']) && isIDValid($_GET['id'])){
    //Get id from url
    $id = $_GET['id'];
        if(getTitle($id)){
            //Store recipe title from database
            $recipeTitle = getTitle($id);
            //Store recipe subtitle from database
            $subTitle = getSubTitle($id); 
        }else{
            $id='';
        }
}else{
    //No valid recipe id
    $id = '';
    //display update page
}

//If Rename submission clicked for Title      
if(isset($_POST['title'])){
    $title = trim(filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING));
    $title = ucwords($title);
    if(setTitle($db, $title, $id)){
        $recipeTitle = getTitle($id);
        $status = 'Title Updated';
    }else{
        $status = 'Could not update Title';
    }    
}
//If Rename submission clicked for SubTitle     
if(isset($_POST['subtitle'])){
    $sub = trim(filter_input(INPUT_POST,'subtitle',FILTER_SANITIZE_STRING));
    $sub = ucwords($sub);
    if(setSubTitle($sub, $id)){
        $subTitle = getSubTitle($id);
        $status = 'Subtitle Updated';
    }else{
        $status = 'Could not update SubTitle';
    }    
}
//If Choose New Image clicked
if(isset($_POST['image'])){
    $img = trim(filter_input(INPUT_POST,'image',FILTER_SANITIZE_STRING));
    if(setImage($img, $id)){
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
    if(addIngredient($id, $addIngredient, $amount, $measurement)){
        $status = $addIngredient.' Added';
    }else{
        $status = 'Could not add Ingredient';
    }
} 
//If Delete Ingredient clicked
if(isset($_POST['deleteIngredient'])){
    $ingredient = $_POST['deleteIngredient'];
    if(deleteIngredient($id,$ingredient)){
        $status = $ingredient.' Deleted';
    }else{
        $status = 'Could not Delete Ingredient';
    }
}

//If Delete Recipe 
if(isset($_POST['DELETE'])){
    if(deleteRecipe($id)){
        $status = 'Recipe Deleted';
    }else{
        $status = "Recipe NOT Deleted";
    }
    
}
//Display status message
echo "<div class='status'><h2>".$status."</h2></div>";

if(isset($_GET['id']) && isIDValid($_GET['id'])){
////If Recipe chosen and valid display this page////
    include 'inc/modify_chosen_recipe.php';
    }else{
    ////If No Recipe Chosen, display this page////
    include 'inc/select_recipe_to_modify.php';
    } //End else
?>
<?php include 'inc/footer.php'; ?>