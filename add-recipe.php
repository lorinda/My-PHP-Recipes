<?php
include 'inc/connection.php';
include 'inc/functions.php';
include 'inc/header.php';


?>
<div class="jumbotron well">
    <h1>Add a Recipe</h1>
    <form action="add-ingredient.php" method="post">
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
        <p><i>Optional: Add image to /image folder</i></p>
        <label for="img_src">Image Name (include extension .jpg, etc)</label>
        <input type="text" name="img_src" id="img_src" size="20" />
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