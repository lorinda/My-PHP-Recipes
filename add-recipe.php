<?php
$add_recipe = 'selected';
include 'inc/connection.php';
include 'inc/functions.php';
include 'inc/header.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['recipe'])){
        if($_POST['recipe'] == 'addRecipe'){
            $title = trim(filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING));
            $subtitle = trim(filter_input(INPUT_POST,'subtitle',FILTER_SANITIZE_STRING));
            $cooked_on = trim(filter_input(INPUT_POST,'cooked_on',FILTER_SANITIZE_STRING));
            $img_src = trim(filter_input(INPUT_POST,'img_src',FILTER_SANITIZE_STRING));
            $url = trim(filter_input(INPUT_POST,'url',FILTER_SANITIZE_STRING));

            $img_src = '/images/'.$img_src;
             //Check that Title and Subtitle were filled in
            if(!empty($title) & !empty($subtitle)){
                $title=ucwords($title);
                $subtitle = ucwords($subtitle);
                //Add Recipe to the database and re-direct
                if(addRecipe($title, $subtitle, $cooked_on, $img_src, $url)){
                    header('Location: add-ingredient.php');
                }
            }else{
                //Display error_message after form submit
                $error_message = 'Could Not Add Recipe. Fill Required Fields. ';
                echo '<div class="status"><h2>';
                echo $error_message;
                echo '</h2></div>';
            }
        }//End if($_POST['recipe'] == 'addRecipe')
    }//END if(isset($_POST['recipe']))
}//END if($_SERVER["REQUEST_METHOD"] == "POST")
?>
<div class="jumbotron well">
    <h1>Add a Recipe</h1>
    <form action="add-recipe.php" method="post" class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-sm-2" for="title">Recipe Title (required)</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="title" id="title" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="subtitle">Recipe Subtitle (required)</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="subtitle" id="subtitle"  />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="cooked_on">Date Cooked (MM/DD/YYYY)</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="cooked_on" id="cooked_on" />
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="control-label col-sm-2" for="img_src">Image Name <br>(include extension .jpg, etc)</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="img_src" id="img_src" aria-describedby="helpImage" />
                <span id="helpImage" class="help-block">Add image to /image folder.</span>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="control-label col-sm-2" for="url">Blue Apron Website Link</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="url" id="url" value="https://www.blueapron.com/recipes/"/>
            </div>
        </div>
        <br>
        <input type="hidden" name="recipe" value="addRecipe"/>
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-success" value="Continue" />
            </div>
        </div>
    </form>
</div>
<?php
include 'inc/footer.php';    
?>