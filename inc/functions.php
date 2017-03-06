<?php
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
?>;