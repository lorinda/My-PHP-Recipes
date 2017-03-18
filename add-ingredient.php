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
    <form class="form-horizontal" action="" method="post">
        <div class="form-group">
            <label class="control-label col-sm-2" for="amount">Amount (Required)</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" name="amount" id="amount" value='<?php if(isset($amount)){ echo $amount;}?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="measurement">Measurement</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="measurement" id="measurement" value="<?php if(isset($measurement)){ echo $measurement;}?>" />
                <span id="helpMeasurement" class="help-block">Examples: cup, oz, doz, etc.</span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2"  for="ingredient">Ingredient (Required)</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="ingredient" id="ingredient" value='<?php if(isset($ingredient)){ echo $ingredient;}?>'/>
            </div>
        </div>
        <input type="hidden" name="formIngredient" value="addFormIngredient" />
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-success" value="Add Ingredient" />
            </div>
        </div>
    </form>
    <br>
    <form action="recipe.php" method="post">
        <label>No more ingredients to add?</label><br>
        <input type="submit" class="btn btn-warning" value="Recipe Finished" />
    </form>
</div>

<?php
include 'inc/footer.php';    
?>