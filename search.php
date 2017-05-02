<?php
//To mark navigation option 'active'
$search_page = 'selected';

require 'inc/header.php';
require 'inc/connection.php';
require 'inc/functions.php';

//If search form submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $search = trim(filter_input(INPUT_POST,'search',FILTER_SANITIZE_STRING));
    //Add like wildcard for SQL
    $search_term = '%'.$search.'%';
}
?>
<!--Add another search form-->
<div class="jumbotron well">
    <form method="post" action="">
        <input type="text" name="search" id="search" />
        <input type="submit" class="btn" value="Search">
    </form>
</div>

<?php
//If search form submitted, display this:
if ($_SERVER["REQUEST_METHOD"]  == "POST"){
?>    
<div class="jumbotron well">
    <h1>Search Results</h1>
    <h3>
         <?php if($search == ''){
                echo "All Recipes:";
            }
            else{
                echo 'For "'.$search.'"';
            }?>
    </h3>
    
    <!-- Search the database for the term, display results-->
    <?php $searchRecipes = search_recipe($db,$search_term); ?>
        <?php
            $i=1;
            foreach($searchRecipes as $item){
                echo $i.") <a href='http://my-php-recipes/recipe.php?id=".$item['recipe_id']."'>".$item['title']."</a>";
                echo "<br>";
                $i++;
            }
        ?>
</div>
<div class = "container">
    <h2>All Ingredient List</h2>
    <?php $ingredient_list = get_all_distinct_ingredients($db); 
        $i=1;
        echo "<div class = 'col-md-4'>";
        foreach($ingredient_list as $item){
        
        echo "<form action='search.php' method='post'><input type='submit' value='".$item['ingredient']."' name='search' /></form><br>";
        
            //if 10 items have been listed, move to new div
            if ( is_int($i/10)){
                echo "<br><br></div><div class = 'col-md-4'>";
            }
        $i++;
        }    
        echo "</div>";
    ?>
                                           
</div>
<?php } ?>

<?php require 'inc/footer.php'; ?>
