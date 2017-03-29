<?php
$view_recipe = 'selected';
include 'inc/functions.php';
include 'inc/connection.php';

if(isset($_GET['id']) && is_id_valid($db, $_GET['id'])){
    $id = $_GET['id'];
        if(get_title($db, $id)){
            $recipeTitle = get_title($db, $id);
            $subTitle = get_subtitle($db, $id);    
        }else{
            $id='';
        }
        
            
}else{
    $id = '';
    //display main recipe page
}
include 'inc/header.php';

?>
<?php
if(isset($_GET['id']) && is_id_valid($db, $id)){
//display recipe for id
    include 'inc/view_chosen_recipe.php';
}
else{  
//display selector page for recipes
    include 'inc/select_recipe_to_view.php';
} 
?>

<?php include 'inc/footer.php'; ?>