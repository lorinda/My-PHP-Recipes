<div class="jumbotron well">
    <div class="container">
        <h1><?php echo "Update or Delete Recipe"; ?>
        </h1>
        <div class="row">
            <div class="col-md-4">
                <?php $allRecipes = get_all_recipe_titles($db); ?>
                <form name="form" class="">
                    <label for="selectRecipe">Choose a Recipe:</label>
                    <select name="selectRecipe" id="selectRecipe" class="form-control" onChange="go()">
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
                    <input type="submit" name="findRecipe" value="Load" class="btn" onclick="go()" />
                </form>
            </div> <!--End "col-md-4" -->
        </div><!--End "row" -->
    </div><!-- End "container" -->
</div><!--End "jumbotron" -->