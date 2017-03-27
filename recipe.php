<?php
$view_recipe = 'selected';
include 'inc/functions.php';

if(isset($_GET['id']) && isIDValid($_GET['id'])){
    $id = $_GET['id'];
        if(getTitle($id)){
            $recipeTitle = getTitle($id);
            $subTitle = getSubTitle($id);    
        }else{
            $id='';
        }
        
            
}else{
    $id = '';
    //display main recipe page
}
include 'inc/header.php';

?>
<?php
if(isset($_GET['id']) && isIDValid($id)){
//display recipe for id
?>
<div class="jumbotron well">
    <div class="container">
        <h1><?php echo $recipeTitle; ?></h1>
        <h2><?php echo $subTitle; ?> </h2>
        <div class="container">
            <div class="col-md-4" style="padding-left: 0px;  padding-right: 0px;">
                <img src='<?php
                    $image = getImage($id);
                    foreach($image as $item){
                        if($item != 'NULL' && $item !=""){
                              echo $item;
                        }else{
                            echo "/images/No_Image_Taken.jpg";
                        }
                    }
                ?>' class="img-responsive">
            </div> <!--End col-md-4 div-->
            <div class="col-md-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Ingredients</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $ingredients = getIngredients($id);
                        foreach ($ingredients as $item){
                            echo "<tr><td>";
                            echo $item['amount']." ";
                            if ($item['measurement'] != "NULL"){
                              echo $item['measurement']." ";  
                            }
                            echo $item['ingredient'];
                            echo "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div> <!--End col-md-4 div-->
            <div class="col-md-4">
                <br><b>Cooked on:</b>
                <?php 
                $dateURL = getDateUrl($id);
                foreach ($dateURL as $item){
                    echo $item['cooked_on'];
                    echo "<br>";
                    echo "<a href='".$item['url']."' target='_blank'>"."<h4>Link to Full Recipe on Blue Apron.com.</h4>"."</a>";
                }
                ?>
                <br><br>
                Update This Page Listing
            </div> <!-- End col-md-4 div-->
        </div> <!-- End container div -->
        <br>
    </div><!-- End Recipe div -->
</div><!-- End Jumbotron Well div -->
<?php
}//Close if(isset)
//-----------else No ID set----------------//
else{  
?>
<div class="jumbotron well">
    <div class="container">
        <h1><?php 
            echo "View Recipes"; 
            ?>
        </h1>
        <div class="row">
            <div class="col-md-4">
                <?php $allRecipes = getAllRecipeTitles();
                    asort($allRecipes); //Sort by title alphabetically
                    $topRecipeInForm = array_values($allRecipes);//Choose top recipe for form redirection on pressing 'Load' button. All other recipes load when chosen.
                ?>
                <form name="form" method="post" action='<?php echo "recipe.php?id=".$topRecipeInForm[0]['recipe_id']; ?>'>
                    <label for="selectRecipe">Choose a Recipe:</label>
                    <select name="selectRecipe" id="selectRecipe" onChange="go()">
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
                    <input type="submit" name="findRecipe" value="Load" />
                </form>
            </div> <!--End "col-md-4" -->
        </div><!--End "row" -->
        <h3>Or Choose a Random Recipe</h3>
        <div class="row">
             <ul>
                <?php
                $random = random_recipe();
                foreach ($random as $item) {
                    echo "<div class='col-md-4'>";
                    echo "<a href='recipe.php?id=".$item['recipe_id']."'>";
                    echo "<img src='".$item['img_src']."' class='img-responsive'>";
                    echo "</a></div>";
                }
                ?>							
            </ul>
        </div><!--End "row" -->
    </div><!-- End "container" -->
</div><!-- End "jumbotron well" -->

<?php } //Close else ?>

<?php include 'inc/footer.php'; ?>