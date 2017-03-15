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
        <table>
            <tr>
                <td>
                    <label for="title">Recipe Title (required)</label>
                </td>
                <td>
                    <input type="text" name="title" id="title" size="40" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="subtitle">Recipe Subtitle (required)</label>
                </td>
                <td>
                    <input type="text" name="subtitle" id="subtitle" size="40" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="cooked_on">Date Cooked (MM/DD/YYYY)</label>
                </td>
                <td>
                    <input type="text" name="cooked_on" id="cooked_on" size="10" />
                </td>
            </tr>
        </table>
        <br>
        <label for="img_src">Image Name (include extension .jpg, etc)</label>
        <input type="text" name="img_src" id="img_src" size="20" aria-describedby="helpImage" />
        <span id="helpImage" class="help-block">Add image to /image folder.</span>
        <br>
        <label for="url">Blue Apron Website Link</label>
        <input type="text" name="url" id="url" size="40" value="https://www.blueapron.com/recipes/"/>
        <br>
        <input type="hidden" name="recipe" value="addRecipe"/>
        <input type="submit" value="Continue" />
    </form>
</div>
<?php
include 'inc/footer.php';    
?>