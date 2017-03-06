<?php
$pageTitle = "My Blue Apron Meals";
$recipeTitle = 'Sunchoke & Egg Noodle Casserole';
$subTitle = 'with Kale & Mornay Sauce';
$addIngredient = '';
include 'inc/header.php';
include 'inc/connection.php';

if(isset($_POST['delete']) || isset($_POST['update'])){
    var_dump($_POST);
}
?>
<div class="jumbotron well">
    <div class ="instructions">
        <b>Modify this Recipe.</b> Fill in the associated textbox and click the link to rename Titles and Add Ingredients.  Click the link on the right of Ingredients to delete them from the recipe.
    </div>
    <h3><?php 
        echo "<form method='post' action='recipe.php' 
                 onsubmit=\"return confirm('Are you sure you want to rename this recipe?');\">\n";
        echo "<input type='text' value='" . $recipeTitle . "' name='update' size='40' />\n";
                        
        echo "<input type='submit' class='button--delete' value='[Rename Recipe Title]' />\n";
        echo "</form>";
        ?>
    </h3>
    <h4><?php
        echo "<form method='post' action='recipe.php' 
                 onsubmit=\"return confirm('Rename recipe subtitle?');\">\n";
        echo "<input type='text' value='" . $subTitle . "' name='update' size='40' />\n";
                        
        echo "<input type='submit' class='button--delete' value='[Rename Recipe SubTitle]' />\n";
        echo "</form>";
        ?>
    </h4>
    <img src='<?php
              $results = $db->query('SELECT img_src FROM recipe WHERE recipe_id=2');
              $image = $results->fetch(PDO::FETCH_ASSOC);
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
                echo "<tr><td><form method='post' action='recipe.php'>";
                echo "<input type='text' value='" . $addIngredient . "' name='update' size='50' />\n";
                echo "<input type='submit' class='button--delete' value='[Add this Ingredient]' />\n";
                echo "</form>";
                ?>
            </td>
        </tr>
    </table>
    <table>    
        <?php 
        $results = $db->query('SELECT ingredient FROM recipe_ingredients WHERE recipe_id=2');
        $ingredients = $results->fetchAll(PDO::FETCH_ASSOC);
        foreach ($ingredients as $item){
            echo "<tr><td>";
            echo "<form method='post' action='recipe.php' 
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

<?php include 'inc/footer.php'; ?>