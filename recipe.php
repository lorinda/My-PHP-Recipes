<?php
include 'inc/connection.php';

$pageTitle = "My Blue Apron Meals";
$recipeTitle = 'Sunchoke & Egg Noodle Casserole';
$subTitle = 'with Kale & Mornay Sauce';
$addIngredient = '';
include 'inc/header.php';
include 'inc/functions.php';

if(isset($_POST['delete']) || isset($_POST['update'])){
    var_dump($_POST);
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = 2;
}
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
                $image = display_image($id);
                foreach($image as $item){
                    if($item != 'NULL'){
                          echo $item;
                    }else{
                        echo "/images/No_Image_Taken.jpg";
                    }
                }
                    
              ?>' class="img-responsive">
        </div>
        <div class="col-md-4">
            <table>
                <tr>
                    <th>Ingredients</th>
                </tr>
                <?php 
                $ingredients = display_ingredients($id);
                foreach ($ingredients as $item){
                    echo "<tr><td>";
                    echo $item['ingredient'];
                    echo "</td></tr>";
                }

                ?>
            </table>
        </div>
        <div class="col-md-4">
            <br>
            <b>Cooked on:</b>
            <?php 
            $dateURL = display_date_and_url($id);
            foreach ($dateURL as $item){
                echo $item['cooked_on'];
                echo "<br>";
                echo "<a href='".$item['url']."'>"."Link to Full Recipe on Blue Apron.com."."</a>";
            }
            ?>
            <br>
            
            <br>
            
            Update This Page Listing
        </div>
    </div>
    
    
    <br>
</div>
</div>


<?php include 'inc/footer.php'; ?>