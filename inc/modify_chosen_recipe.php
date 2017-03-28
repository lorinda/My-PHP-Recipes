<div class="jumbotron well">
    <div class="warning">
        <form method='post' action=''>
            <input type='submit' class='btn btn-danger' value='DELETE this Recipe' name='DELETE' />;
        
        </form>
    <br><br>
    </div>
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
    <img src='<?php $image = get_image($db, $id);
              foreach($image as $item){ 
                if($item != 'NULL'){
                    echo $item;
                }else{
                    echo "/images/No_Image_Taken.jpg";
                }
              }
              ?>' alt="Image of <?php echo $recipeTitle.' '.$subTitle; ?>" height="150" width="180">
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
        $ingredients = get_ingredients($db, $id);
        foreach ($ingredients as $item){
            echo "<tr><td>";
            echo "<form method='post' action='' 
                 onsubmit=\"return confirm('Are you sure you want to delete this ingredient?');\">\n";
            echo $item['amount']." ";
            if($item['measurement'] != "NULL"){echo $item['measurement'];}
            echo " ".$item['ingredient'];
            echo "<input type='hidden' value='" . $item['ingredient'] . "' name='deleteIngredient' />\n";
            echo "<input type='submit' class='button--delete' value='[Delete This Ingredient]' />\n";
            echo "</form>";
            echo "</td></tr>";
        }
        ?>
    </table>
    <hr>
    <h4>Change the linked recipe url:</h4>
    <?php 
    $url = get_URL($db, $id);
        echo "<form method='post' action='' 
                 onsubmit=\"return confirm('Are you sure you want to change the linked website?');\">\n";
        echo "<input type='text' value='" . $url . "' name='website' size='60' />\n";
        echo "<input type='hidden' value='". $id ."' name='id' />";
        echo "<input type='submit' class='button--delete' value='[Rename Recipe Website]' />\n";
        echo "</form>";
        ?>
    <br>
</div>