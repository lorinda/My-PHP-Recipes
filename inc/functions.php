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

function display_image($id){
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

function display_ingredients($id){
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

function display_date_and_url($id){
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