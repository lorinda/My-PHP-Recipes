<?php
include 'inc/connection.php';
include 'inc/functions.php';
$recipe_id = '';

//function to get highest id in recipe table
$id = getLastID();
//convert highest id to integer
$recipe_id =intval($id['id']);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['formIngredient'])){
        if($_POST['formIngredient'] == 'addFormIngredient'){
            $ingredient = trim(filter_input(INPUT_POST,'ingredient',FILTER_SANITIZE_STRING));
            $amount = trim(filter_input(INPUT_POST,'amount',FILTER_SANITIZE_STRING));
            $measurement = trim(filter_input(INPUT_POST,'measurement',FILTER_SANITIZE_STRING));
                        
            //Check that Ingredient and Amount were filled in
            if(!empty($ingredient) && !empty($amount)){
                $ingredient = ucwords($ingredient);
                //Add info to table
                if(addIngredient($recipe_id, $ingredient, $amount, $measurement)){
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
}
include 'inc/header.php';
?>

<div class="jumbotron well">
    <h1>Add Ingredient</h1>
    <form action="" method="post">
        <label for="amount">Amount (Required)</label>
        <input type="text" name="amount" id="amount" value='<?php if(isset($amount)){ echo $amount;}?>' size="10"/>
        <br>
        <label for="measurement">Measurement</label>
        <input type="text" name="measurement" id="measurement" value="<?php if(isset($measurement)){ echo $measurement;}?>" size="10"/>
        <span id="helpMeasurement" class="help-block">Examples: cup, oz, doz, etc.</span>
        <br>
        <label for="ingredient">Ingredient (Required)</label>
        <input type="text" name="ingredient" id="ingredient" value='<?php if(isset($ingredient)){ echo $ingredient;}?>'size="40"/>
        <input type="hidden" name="formIngredient" value="addFormIngredient" />
        <br>
        <input type="submit" value="Add Ingredient" />
    </form>
    
    <form action="recipe.php" method="post">
        <label>No more ingredients to add?</label>
        <input type="submit" value="Recipe Finished" />
    </form>
</div>

<?php
include 'inc/footer.php';    
?>