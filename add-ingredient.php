<?php
include 'inc/connection.php';
include 'inc/functions.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST['recipe'] == 'addRecipe'){
        $title = trim(filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING));
        $subtitle = trim(filter_input(INPUT_POST,'subtitle',FILTER_SANITIZE_STRING));
        $cooked_on = trim(filter_input(INPUT_POST,'cooked_on',FILTER_SANITIZE_STRING));
        $img_src = trim(filter_input(INPUT_POST,'img_src',FILTER_SANITIZE_STRING));
        $url = trim(filter_input(INPUT_POST,'url',FILTER_SANITIZE_STRING));
        var_dump($title);
    }
    
    
    
}
include 'inc/header.php';


?>

<div class="jumbotron well">
    <h1>Add Ingredient</h1>
    <form action="#" method="post">
        <label for="ingredient">Ingredient</label>
        <input type="text" name="ingredient" id="ingredient" size="40"/>
        <input type="submit" value="Add Ingredient" />
    </form>
    
    <form action="" method="post">
        <label>No more ingredients to add?</label>
        <input type="submit" value="Recipe Finished" />
    </form>
</div>

<?php
include 'inc/footer.php';    
?>