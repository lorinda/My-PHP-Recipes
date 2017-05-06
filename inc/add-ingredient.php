<!-- Display Add Ingredient Form -->
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
    <?php 
        //function to get highest id in recipe table    
        $id = get_last_id($db);
        //convert highest id to integer
        $recipe_id =intval($id['id']);
    ?>
    <form action="recipe.php?id=<?php echo $recipe_id; ?>" method="post">
        <label>No more ingredients to add?</label><br>
        <input type="submit" class="btn btn-warning" value="Recipe Finished" />
    </form>
</div>

<?php
require 'inc/footer.php';    
?>