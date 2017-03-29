<?php
//To mark navigation option 'active'
$view_recipe = 'selected';
require 'inc/functions.php';
require 'inc/connection.php';

//If id in url is in database
if(isset($_GET['id']) && is_id_valid($db, $_GET['id'])){
    $id = $_GET['id'];
        //Get recipe title and subtitle from database
        if(get_title($db, $id)){
            $recipeTitle = get_title($db, $id);
            $subTitle = get_subtitle($db, $id);    
        }else{
            $id='';
        }            
}else{
    $id = '';
}

require 'inc/header.php';

?>
<?php
if(isset($_GET['id']) && is_id_valid($db, $id)){
//display recipe for id
    require 'inc/view_chosen_recipe.php';
}
else{  
//display selector page for recipes
    require 'inc/select_recipe_to_view.php';
} 
?>

<?php require 'inc/footer.php'; ?>