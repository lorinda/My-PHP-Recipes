<?php
include 'inc/functions.php';
$addIngredient = '';
if(isset($_GET['id']) && isIDValid($_GET['id'])){
    $id = $_GET['id'];
        if(getRecipeTitle($id)){
            $recipeTitle = getRecipeTitle($id);
            $subTitle = getRecipeSubTitle($id);    
        }else{
            $id='';
        }
        
            
}else{
    $id = '';
    //display update page
}
include 'inc/connection.php';

if(isset($_POST['delete']) || isset($_POST['update'])){
    
}
   
if(isset($_POST['updateTitle'])){
    var_dump($_POST);
    if(setRecipeTitle($_POST['updateTitle'],$_POST['id'])){
        $recipeTitle = getRecipeTitle($id);
    }else{
        echo "<div class='status'>Could not update Title</div>";
    }
}
   
include 'inc/header.php';

//<!---If id in $_GET for URL display this page--->
if(isset($_GET['id']) && isIDValid($_GET['id'])){
?>
<div class="jumbotron well">
    <div class ="instructions">
        <b>Modify this Recipe.</b> Fill in the associated textbox and click the link to rename Titles and Add Ingredients.  Click the link on the right of Ingredients to delete them from the recipe.
    </div>
    <h3><?php 
        echo "<form method='post' action='' 
                 onsubmit=\"return confirm('Are you sure you want to rename this recipe?');\">\n";
        echo "<input type='text' value='" . $recipeTitle . "' name='updateTitle' size='40' />\n";
        echo "<input type='hidden' value='". $id ."' name='id' />";
        echo "<input type='submit' class='button--delete' value='[Rename Recipe Title]' />\n";
        echo "</form>";
        ?>
    </h3>
    <h4><?php
        echo "<form method='post' action='#' 
                 onsubmit=\"return confirm('Rename recipe subtitle?');\">\n";
        echo "<input type='text' value='" . $subTitle . "' name='update' size='40' />\n";
        echo "<input type='submit' class='button--delete' value='[Rename Recipe SubTitle]' />\n";
        echo "</form>";
        ?>
    </h4>
    <img src='<?php
              $image = getImage($id);
              foreach($image as $item){
                  echo $item;
              }
              ?>' height="150" width="180">
    <table>
        <tr>
        <th>Ingredients</th>
        </tr>
        <tr>
            <td>
               <?php
                echo "<tr><td><form method='post' action='#'>";
                echo "<input type='text' value='" . $addIngredient . "' name='update' size='50' />\n";
                echo "<input type='submit' class='button--delete' value='[Add this Ingredient]' />\n";
                echo "</form>";
                ?>
            </td>
        </tr>
    </table>
    <table>    
        <?php 
        $ingredients = getIngredients($id);
        foreach ($ingredients as $item){
            echo "<tr><td>";
            echo "<form method='post' action='#' 
                 onsubmit=\"return confirm('Are you sure you want to delete this ingredient?');\">\n";
            echo $item['ingredient'];
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