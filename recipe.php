<?php
include 'inc/connection.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = 2;
}
include 'inc/functions.php';

$recipeTitle = getRecipeTitle($id);
$subTitle = getRecipeSubTitle($id);
include 'inc/header.php';

?>
<div class="jumbotron well">
    <div class="recipe">
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
                <table>
                    <tr>
                        <th>Ingredients</th>
                    </tr>
                    <?php 
                    $ingredients = getIngredients($id);
                    foreach ($ingredients as $item){
                        echo "<tr><td>";
                        echo $item['ingredient'];
                        echo "</td></tr>";
                    }

                    ?>
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
                    echo "<a href='".$item['url']."'>"."Link to Full Recipe on Blue Apron.com."."</a>";
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


<?php include 'inc/footer.php'; ?>