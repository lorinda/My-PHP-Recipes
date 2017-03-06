<?php

function display_ingredients($id){
    include "connection.php";
    
    try{
    $query = 'SELECT ingredient
    			FROM recipe_ingredients
    			WHERE recipe_id = :id';

    $statement = $db->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->execute();
    }catch(Exception $e){
        echo "Unable to retrieve results";
        exit;
    
    }
    $ingredients = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($ingredients as $item){
                    echo "<tr><td>";
                    echo $item['ingredient'];
                    echo "</td></tr>";
    }
}
?>