<div class="jumbotron well">
    <div class="container">
        <h1><?php 
            echo "View Recipes"; 
            ?>
        </h1>
        <div class="row">
            <div class="col-md-4">
                <?php $allRecipes = get_all_recipe_titles($db);
                    asort($allRecipes); //Sort by title alphabetically
                    $topRecipeInForm = array_values($allRecipes);//Choose top recipe for form redirection on pressing 'Load' button. All other recipes load when chosen.
                ?>
                <form name="form" method="post" action='<?php echo "recipe.php?id=".$topRecipeInForm[0]['recipe_id']; ?>'>
                    <label for="selectRecipe">Choose a Recipe:</label>
                    <select name="selectRecipe" id="selectRecipe" class="form-control" onChange="go()">
                        <?php
                        foreach($allRecipes as $item){
                            echo "<option value='recipe.php?id=";
                            echo $item['recipe_id'];
                            echo "'>";
                            echo $item['title'];
                            echo "</option>";
                        }
                        ?>
                    </select>
                    <script type="text/javascript">
                        //Function to redirect to <option> value page when recipe chosen
                        function go(){
                        location= document.form.selectRecipe.
                        options[document.form.selectRecipe.selectedIndex].value
                        }
                    </script>
                    <input type="submit" name="findRecipe" class="btn" value="Load" />
                </form>
            </div> <!--End "col-md-4" -->
        </div><!--End "row" -->
        <h3>Or Choose a Random Recipe</h3>
        <div class="row">
             <ul>
                <?php
                $random = random_recipe($db);
                foreach ($random as $item) {
                    echo "<div class='col-md-4'>";
                    echo "<a href='recipe.php?id=".$item['recipe_id']."'>";
                    echo "<img src='".$item['img_src']."' title='".$item['title']."' alt='Image of Random Recipe' class='img-responsive'>";
                    echo "</a><br></div>";
                }
                ?>							
            </ul>
        </div><!--End "row" -->
    </div><!-- End "container" -->
</div><!-- End "jumbotron well" -->
