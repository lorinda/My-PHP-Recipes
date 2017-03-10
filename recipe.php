<?php
include 'inc/functions.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
     //if(checkID($id)){
        //if id is in recipe table
            $recipeTitle = getRecipeTitle($id);
            $subTitle = getRecipeSubTitle($id);
            //display recipe for id
}else{
    $id = '';
    //display main recipe page
}



include 'inc/header.php';

?>
<?php
if(isset($_GET['id'])){
?>
<div class="jumbotron well">
    <div class="container">
        <h1><?php 
            echo $recipeTitle; 
            ?>
        </h1>
        <h2><?php 
            echo $subTitle; 
            ?>
        </h2>
        <div class="container">
            <div class="col-md-4" style="padding-left: 0px;  padding-right: 0px;">
                <img src='<?php
                    $image = getImage($id);
                    foreach($image as $item){
                        if($item != 'NULL'){
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
                            echo $item['ingredient'];
                            echo "</td></tr>";
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div> <!--End col-md-4 div-->
            <div class="col-md-4">
                <br>
                <b>Cooked on:</b>
                <?php 
                $dateURL = getDateUrl($id);
                foreach ($dateURL as $item){
                    echo $item['cooked_on'];
                    echo "<br>";
                    echo "<a href='".$item['url']."' target='_blank'>"."Link to Full Recipe on Blue Apron.com."."</a>";
                }
                ?>
                <br>

                <br>

                Update This Page Listing
            </div> <!-- End col-md-4 div-->
        </div> <!-- End container div -->


        <br>
    </div><!-- End Recipe div -->
</div><!-- End Jumbotron Well div -->
<?php
}//Close if(isset)
//////////////No ID set /////////////////
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
                <form action="" method="get" class="">
                    <label for="selectRecipe">Choose a Recipe:</label>
                    <select name="selectRecipe" id="selectRecipe">
                        <option>Sunchoke &amp; Egg Noodle Casserole</option>
                    </select>
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
                    echo "<img src='".$item['img_src']."' class='img-responsive'>";
                    echo "</div>";
                }
                ?>							
            </ul>
<!-- DELETE LATER
            <div class="col-md-4">
                <img src="images/No_Image_Taken.jpg" class="img-responsive">
            </div>
            <div class="col-md-4">
                <img src="images/No_Image_Taken.jpg" class="img-responsive">
            </div>
            <div class="col-md-4">
                <img src="images/No_Image_Taken.jpg" class="img-responsive">
            </div>
DELETE LATER --> 
            
        </div>
    </div>
</div>

<?php
} //Close else
?>

<?php include 'inc/footer.php'; ?>