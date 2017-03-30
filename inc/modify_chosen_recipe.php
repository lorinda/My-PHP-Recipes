<div class="jumbotron well">
    <div class="warning">
        <form method='post' action=''>
            <input type='submit' class='btn btn-danger' value='DELETE this Recipe' name='DELETE' />;
        
        </form>
    <br><br>
    </div>
    <div class="row">
        <div class ="instructions col-md-6">
            <b>Modify this Recipe.</b> Fill in the associated textbox and click the button to rename Titles, Add Ingredients, or Delete Ingredients from the recipe.
        </div>
    </div>
    
        
    <h3> 
        <div class= 'row'>
            <form method='post' action='' onsubmit="return confirm('Are you sure you want to rename this recipe?');">
                <div class= 'form-group'>
                    <div class="row">
                        <div class="col-md-4">
                            <label for = 'title'>Rename Title</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?php
                            echo "<input type='text' value='" . $recipeTitle . "' name='title' id='title' class='form-control input-lg' />\n";
                            echo "<input type='hidden' value='". $id ."' name='id' />";
                            ?>
                        </div>
                    </div>
                </div>
                <div class= 'form-group'>
                <input type='submit' class='btn btn-warning' value='Rename Recipe Title' />
                </div>
            </form>
        </div>
    </h3>

    <h4>
        <div class= 'row'>
            <form method='post' action='' onsubmit="return confirm('Are you sure you want to rename this subtitle?');">
                <div class= 'form-group'>
                    <div class="row">
                        <div class="col-md-4">
                            <label for = 'subtitle'>Rename Subtitle</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?php
                            echo "<input type='text' value='" . $subTitle . "' name='subtitle' class='form-control input-md' />\n";
                            echo "<input type='hidden' value='". $id ."' name='id' />";
                            ?>
                        </div>
                    </div>
                </div>
                <div class= 'form-group'>
                <input type='submit' class='btn btn-warning' value='Rename Subtitle' />
                </div>
            </form>
        </div>
    </h4>
    <h4>
        <div class= 'row'>
            <div class="col-md-4">
                <label for = 'image'>New Image File</label>

                <img src='<?php $image = get_image($db, $id);
                  foreach($image as $item){ 
                    if($item != 'NULL'){
                        echo $item;
                    }else{
                        echo "/images/No_Image_Taken.jpg";
                    }
                  }
                  ?>' alt="Image of <?php echo $recipeTitle.' '.$subTitle; ?>" class="img-responsive">
            </div>
        </div>
    </h4>
    <div class= 'row'>
        <div class="col-md-4">
            <?php
            if($image['img_src'] == "NULL"){
                $image['img_src'] = "/images/No_Image_Taken.jpg";
            }
            echo "<form method='post' action='' onsubmit='return confirm(\'Update the image?\');>";
            echo "<div class='form-group'>";
            echo "<input type='text' value='" . $image['img_src'] . "' name='image' id='image' class=' form-control input-md'>";
            echo "</div>";
            ?>
            <input type='hidden' value='". $id ."' name='id' />
            
            <div class= 'form-group'>
                <input type='submit' class='btn btn-warning' value='Choose New Image' />
            </div>
            <?php echo "</form>"; ?>
        </div>
    </div>
    <h4>    
        <form method='post' action=''>

            <div class='row'>
                <label for = 'addIngredient'>Add New Ingredient</label>   

            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <input type='text' name='amount' value='1' name='amount' class='form-control' aria-describedby='helpAmount'/>
                    <span id='helpAmount' class='help-block'>Number</span>
                </div>

                <div class='col-md-2'>
                    <input type='text' value='cup' name='measurement' class='form-control' aria-describedby='helpMeasurement'/>
                    <span id='helpMeasurement' class='help-block'>Measure</span>
                </div>

                <div class='col-md-4'>
                    <input type='text' value='Ingredient' name='addIngredient' id='addIngredient' class='form-control' aria-describedby='helpIngredient'/>
                    <span id='helpIngredient' class='help-block'>Ingredient</span>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-4'>
                    <input type='submit' class='btn btn-warning' value='Add this Ingredient' />

                </div>
            </div>
        </form>
    </h4>
    <hr>
    <table>
        <tr>
        <th>Ingredient List</th>
        </tr>
        <tr>
           <td>  
            </td>
        </tr>
    </table>
    <table class='table'>    
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
            echo "</td><td>";
            echo "<input type='submit' class='btn btn-danger' value='Delete ". $item['ingredient']."' />\n";
            echo "</form>";
            echo "</td></tr>";
        }
        ?>
    </table>
    
    <hr>
    <div class= 'form-group'>
        <div class="row">
            <div class="col-md-5">
                <h4><label for = 'website'>Change the linked recipe url:</label></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
        <?php 
        $url = get_URL($db, $id);
        echo "<form method='post' action='' 
                 onsubmit=\"return confirm('Are you sure you want to change the linked website?');\">\n";
        echo "<input type='text' value='" . $url . "' name='website' id='website' class='form-control' />\n";
        echo "<input type='hidden' value='". $id ."' name='id' />";
        ?>
            </div>
        </div>
    </div>    
    <div class='row'>
        <input type='submit' class='btn btn-warning' value='Choose New Website' />
    </div>
    <?php echo "</form>"; ?>
    
    <br>
</div>