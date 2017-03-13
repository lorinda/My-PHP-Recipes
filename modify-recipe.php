<?php
include 'inc/functions.php';
include 'inc/connection.php';
include 'inc/header.php';
$addIngredient = '';
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


var_dump($_POST);
//If Rename submission clicked for Title      
if(isset($_POST['title'])){
    $title = trim(filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING));
    $title = ucwords($title);
    if(setTitle($title, $id)){
        $recipeTitle = getTitle($id);
    }else{
        echo "<h2><div class='status'>Could not update Title</div></h2>";
    }    
}
//If Rename submission clicked for SubTitle     
if(isset($_POST['subtitle'])){
    $sub = trim(filter_input(INPUT_POST,'subtitle',FILTER_SANITIZE_STRING));
    $sub = ucwords($sub);
    if(setSubTitle($sub, $id)){
        $subTitle = getSubTitle($id);
    }else{
        echo "<h2><div class='status'>Could not update SubTitle</div></h2>";
    }    
}
//If Choose New Image clicked
if(isset($_POST['image'])){
    $img = trim(filter_input(INPUT_POST,'image',FILTER_SANITIZE_STRING));
    if(setImage($img, $id)){
    }else{
        echo "<h2><div class='status'>Could not update Image</div></h2>";
    }
}
//If Add Ingredient clicked
if(isset($_POST['addIngredient'])){
    $addIngredient = trim(filter_input(INPUT_POST,'addIngredient',FILTER_SANITIZE_STRING));
    $amount = trim(filter_input(INPUT_POST,'amount',FILTER_SANITIZE_STRING));
    $measurement = trim(filter_input(INPUT_POST,'measurement',FILTER_SANITIZE_STRING));
    if(addIngredient($id, $addIngredient, $amount, $measurement)){
    }else{
        echo "<h2><div class='status'>Could not add Ingredient</div></h2>";
    }
}  


if(isset($_GET['id']) && isIDValid($_GET['id'])){
?>
<!---If Recipe chosen and valid display this page--->
<div class="jumbotron well">
    <div class ="instructions">
        <b>Modify this Recipe.</b> Fill in the associated textbox and click the link to rename Titles and Add Ingredients.  Click the link on the right of Ingredients to delete them from the recipe.
    </div>
    <h3><?php 
        echo "<form method='post' action='' 
                 onsubmit=\"return confirm('Are you sure you want to rename this recipe?');\">\n";
        echo "<input type='text' value='" . $recipeTitle . "' name='title' size='40' />\n";
        echo "<input type='hidden' value='". $id ."' name='id' />";
        echo "<input type='submit' class='button--delete' value='[Rename Recipe Title]' />\n";
        echo "</form>";
        ?>
    </h3>
    <h4><?php
        echo "<form method='post' action='' 
                 onsubmit=\"return confirm('Rename recipe subtitle?');\">\n";
        echo "<input type='text' value='" . $subTitle . "' name='subtitle' size='40' />\n";
        echo "<input type='hidden' value='". $id ."' name='id' />";
        echo "<input type='submit' class='button--delete' value='[Rename Recipe SubTitle]' />\n";
        echo "</form>";
        ?>
    </h4>
    <img src='<?php $image = getImage($id);
              foreach($image as $item){ 
                if($item != 'NULL'){
                    echo $item;
                }else{
                    echo "/images/No_Image_Taken.jpg";
                }
              }
              ?>' height="150" width="180">
    <?php
    if($image['img_src'] == "NULL"){
        $image['img_src'] = "/images/No_Image_Taken.jpg";
    }
        echo "<form method='post' action='' 
                 onsubmit=\"return confirm('Update the image?');\">\n";
        echo "<input type='text' value='" . $image['img_src'] . "' name='image' size='40' />\n";
        echo "<input type='hidden' value='". $id ."' name='id' />";
        echo "<input type='submit' class='button--delete' value='[Choose New Image]' />\n";
        echo "</form>";
    ?>
    <table>
        <tr>
        <th>Ingredients</th>
        </tr>
        <tr>
           <td><?php
            echo "<div class='col-md-2'><form method='post' action=''>";
            echo "<input type='text' name='amount' value='1' name='amount' size='3' aria-describedby='helpAmount'/>";
            echo "<span id='helpAmount' class='help-block'>Number</span></div>";

            echo "<div class='col-md-2'><input type='text' value='cup' name='measurement' size='5' aria-describedby='helpMeasurement'/>";
            echo "<span id='helpMeasurement' class='help-block'>Measure</span></div>";

            echo "<div class='col-md-4'><input type='text' value='Ingredient' name='addIngredient' name='addIngredient' size='20' aria-describedby='helpIngredient'/>\n";
            echo "<span id='helpIngredient' class='help-block'>Ingredient</span></div>";

            echo "<div class='col-md-4'><input type='submit' class='button--delete' value='[Add this Ingredient]' />\n";
            echo "</form></div>";
            ?></td>
        </tr>
    </table>
    <table>    
        <?php 
        $ingredients = getIngredients($id);
        foreach ($ingredients as $item){
            echo "<tr><td>";
            echo "<form method='post' action='#' 
                 onsubmit=\"return confirm('Are you sure you want to delete this ingredient?');\">\n";
            echo $item['amount']." ".$item['measurement']." ".$item['ingredient'];
            echo "<input type='hidden' value='" . $item['ingredient'] . "' name='delete' />\n";
            echo "<input type='submit' class='button--delete' value='[Delete This Ingredient]' />\n";
            echo "</form>";
            echo "</td></tr>";
        }
        ?>
    </table>
    <br>
</div>
<?php }else{?>
<!--If No Recipe Chosen, display this page-->
<div class="jumbotron well">
    <div class="container">
        <h1><?php echo "Update or Delete Recipe"; ?>
        </h1>
        <div class="row">
            <div class="col-md-4">
                <?php $allRecipes = getAllRecipeTitles(); ?>
                <form name="form" class="">
                    <label for="selectRecipe">Choose a Recipe:</label>
                    <select name="selectRecipe" id="selectRecipe" onChange="go()">
                         <option selected disabled>Choose here</option>
                        <?php asort($allRecipes);
                        foreach($allRecipes as $item){
                            echo "<option value='modify-recipe.php?id=";
                            echo $item['recipe_id'];
                            echo "'>";
                            echo $item['title'];
                            echo "</option>";
                        }
                        ?>
                    </select>
                    <script type="text/javascript">
                        function go(){
                        location= document.form.selectRecipe.
                        options[document.form.selectRecipe.selectedIndex].value
                        }
                    </script>
                    <input type="submit" name="findRecipe" value="Load" onclick="go()" />
                </form>
            </div> <!--End "col-md-4" -->
        </div><!--End "row" -->
    </div><!-- End "container" -->
</div><!--End "jumbotron" -->
<?php } //End else?>
<?php include 'inc/footer.php'; ?>