<?php
$search_page = 'selected';
include 'inc/header.php';
include 'inc/connection.php';
include 'inc/functions.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $search_term = trim(filter_input(INPUT_POST,'search',FILTER_SANITIZE_STRING));
    $search_term = '%'.$search_term.'%';
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
    <?php $searchRecipes = search_recipe($db,$search_term); ?>
        <?php
            foreach($searchRecipes as $item){
                echo $item['title'];
                echo "<br>";
            }
        ?>
    <div class="description">
        
    </div>
</div>    
<?php } ?>

<?php include 'inc/footer.php'; ?>
