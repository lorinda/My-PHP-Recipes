<?php

function getAllRecipeTitles(){
    include "connection.php";
    try{
        $query = 'SELECT title, recipe_id
                    FROM recipe';
        $statement = $db->query($query);
        $result = $statement->fetchALL();
    }catch(Exception $e){
        echo "Unable to retrieve recipes";
        exit;
    }
    return $result;
}



function getRecipeTitle($id){
    include "connection.php";
    try{
        $query = 'SELECT title
                    FROM recipe
                    WHERE recipe_id = :id';
        
        $statement = $db->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }catch(Exception $e){
        echo "Unable to retrieve title";
        exit;
    }
    $title = $statement->fetch(PDO::FETCH_ASSOC);
    foreach($title as $item){
        return $item;
    }
    
}

function getRecipeSubTitle($id){
    include "connection.php";
    try{
        $query = 'SELECT subtitle
                    FROM recipe
                    WHERE recipe_id = :id';
        
        $statement = $db->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }catch(Exception $e){
        echo "Unable to retrieve title";
        exit;
    }
    $subtitle = $statement->fetch(PDO::FETCH_ASSOC);
    foreach($subtitle as $item){
        return $item;
    }
    
}

function getImage($id){
    include "connection.php";
    try{
        $query = 'SELECT img_src
                    FROM recipe
                    WHERE recipe_id = :id';
        
        $statement = $db->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }catch(Exception $e){
        echo "Unable to retrieve image";
        exit;
    }
    return $statement->fetch(PDO::FETCH_ASSOC);    
}

function getIngredients($id){
    include "connection.php";
    
    try{
    $query = 'SELECT ingredient
    			FROM recipe_ingredients
    			WHERE recipe_id = :id';

    $statement = $db->prepare($query);
    $statement->bindParam(':id', $id,PDO::PARAM_INT);
    $statement->execute();
    }catch(Exception $e){
        echo "Unable to retrieve ingredients";
        exit;
    
    }

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getDateUrl($id){
    include "connection.php";
    
    $query = 'SELECT cooked_on, url
              FROM recipe
              WHERE recipe_id = :id';
    
    try{
        $statement = $db->prepare($query);
        $statement->bindParam(':id',$id,PDO::PARAM_INT);
        $statement->execute();
    }catch(Exception $e){
        echo "Unable to retrieve date and url";
        exit;
    }
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function addRecipe($title, $subtitle, $cooked_on, $img_src, $url ){
    include "connection.php";
    
    $query = 'INSERT INTO recipe(title, subtitle, cooked_on, img_src, url)
                VALUES(:title, :subtitle, :cooked_on, :img_src, :url)';
    
    try{
        $statement = $db->prepare($query);
        $statement->bindParam(':title', $title, PDO::PARAM_STR);
        $statement->bindParam(':subtitle', $subtitle, PDO::PARAM_STR);
        $statement->bindParam(':cooked_on', $cooked_on, PDO::PARAM_STR);
        $statement->bindParam(':img_src', $img_src, PDO::PARAM_STR);
        $statement->bindParam(':url', $url, PDO::PARAM_STR);
        $statement->execute();
    }catch(Exception $e){
        echo "Unable to add this recipe";
        exit;
    }
    return true;
}

function addIngredient($recipe_id, $ingredient, $amount, $measurement){
    include "connection.php";
    
    $query = 'INSERT INTO recipe_ingredients(recipe_id,ingredient, amount, measurement)
                VALUES(:recipe_id, :ingredient, :amount, :measurement)';
    
    try{
        $statement = $db->prepare($query);
        $statement->bindParam(':recipe_id', $recipe_id, PDO::PARAM_INT);
        $statement->bindParam(':ingredient', $ingredient, PDO::PARAM_STR);
        $statement->bindParam(':amount', $amount, PDO::PARAM_INT);
        $statement->bindParam(':measurement', $measurement, PDO::PARAM_STR);
        $statement->execute();
    }catch(Exception $e){
        echo "Could not add this ingredient. ".$e->getMessage();
        exit;
    }
    echo "Ingredient added.";
    return true;
}

function isIDValid($id){
    include "connection.php";
    $query = 'SELECT recipe_id
            FROM recipe
            WHERE recipe_id = :id';
    try{
        $statement = $db->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }catch(Exception $e){
        return false;
    }
    return $statement->fetch();
}

function getLastID(){
    include "connection.php";
    
    $sql = 'SELECT max(recipe_id) AS id
                FROM recipe';
    
    try{
        $statement = $db->query($sql);
    }catch(Exception $e){
        echo "Unable to Retrieve Last ID";
        exit;
    }
    $result = $statement->fetch();
    return $result;
}

function random_recipe(){
    include "connection.php";
    
    $sql = 'SELECT recipe_id, img_src
                FROM recipe
                WHERE img_src NOT IN("/images/image.jpg","/images/","NULL")
                ORDER BY RAND()
                LIMIT 3';
    
    try{
        $statement = $db->query($sql);
    }catch(Exception $e){
        echo "Unable to Retrieve Last ID";
        exit;
    }
    $result = $statement->fetchAll();
    return $result;
}
?>

