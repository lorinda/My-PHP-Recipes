<?php
$search_page = 'selected';
include 'inc/header.php';
include 'inc/connection.php';
include 'inc/functions.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $search = trim(filter_input(INPUT_POST,'search',FILTER_SANITIZE_STRING));
    $search_term = '%'.$search.'%';
}
?>
<div class="jumbotron well">
    <form method="post" action="">
        <input type="text" name="search" id="search" />
        <input type="submit" value="Search">
    </form>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"]  == "POST"){
?>    
<div class="jumbotron well">
    <h1>Search Results</h1>
    <h3>For "<?php echo $search; ?>"</h3></3>
    <?php $searchRecipes = search_recipe($db,$search_term); ?>
        <?php
            $i=1;
            foreach($searchRecipes as $item){
                echo $i.") <a href='http://my-php-recipes/recipe.php?id=".$item['recipe_id']."'>".$item['title']."</a>";
                echo "<br>";
                $i++;
            }
        ?>
    <div class="description">
        
    </div>
</div>    
<?php } ?>

<?php include 'inc/footer.php'; ?>
