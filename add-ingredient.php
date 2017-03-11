<?php
include 'inc/connection.php';
include 'inc/functions.php';
$title = $subtitle = $recipe_id = '';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['recipe'])){
        if($_POST['recipe'] == 'addRecipe'){
            $title = trim(filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING));
            $subtitle = trim(filter_input(INPUT_POST,'subtitle',FILTER_SANITIZE_STRING));
            $cooked_on = trim(filter_input(INPUT_POST,'cooked_on',FILTER_SANITIZE_STRING));
            $img_src = trim(filter_input(INPUT_POST,'img_src',FILTER_SANITIZE_STRING));
            $url = trim(filter_input(INPUT_POST,'url',FILTER_SANITIZE_STRING));

            $img_src = '/images/'.$img_src;
                if(addRecipe($title, $subtitle, $cooked_on, $img_src, $url)){
                    $status = 'Recipe '.$title.' added.';
                }else{
                    $status = 'Could Not Add Recipe '.$title;
                }
            echo '<div class="status">';
            echo $status;
            echo '</div>';
        }
    }
    if(isset($_POST['formIngredient'])){
        if($_POST['formIngredient'] == 'addFormIngredient'){
            $title = trim(filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING));
            $subtitle = trim(filter_input(INPUT_POST,'subtitle',FILTER_SANITIZE_STRING));
            $ingredient = trim(filter_input(INPUT_POST,'ingredient',FILTER_SANITIZE_STRING));
            $amount = trim(filter_input(INPUT_POST,'amount',FILTER_SANITIZE_STRING));
            $measurement = trim(filter_input(INPUT_POST,'measurement',FILTER_SANITIZE_STRING));
            
            //function to get highest id in recipe table
            $id = getLastID();
            $recipe_id =intval($id['id']);
                    
            if(addIngredient($recipe_id, $ingredient, $amount, $measurement)){
                 $status = 'Ingredient '.$ingredient.' added.';
                }else{
                    $status = 'Could Not Add Ingredient: '.$ingredient;
                }
            echo '<div class="status">';
            echo $status;
            echo '</div>';
        }
    }
}
include 'inc/header.php';
?>

<div class="jumbotron well">
    <h1>Add Ingredient</h1>
    <form action="#" method="post">
        <label for="amount">Amount</label>
        <input type="text" name="amount" id="amount" value="1, 2, etc." size="10"/>
        <br>
        <label for="measurement">Measurement</label>
        <input type="text" name="measurement" id="measurement" value="cups, tbsp, etc." size="10"/>
        <br>
        <label for="ingredient">Ingredient</label>
        <input type="text" name="ingredient" id="ingredient" size="40"/>
        <input type="hidden" name="title" id="title" value='<?php echo $title; ?>' />
        <input type="hidden" name="subtitle" id="subtitle" value='<?php echo $subtitle; ?>' />
        <input type="hidden" name="formIngredient" value="addFormIngredient" />
        <br>
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