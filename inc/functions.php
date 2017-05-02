<?php

function get_all_recipe_titles($db){
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



function get_title($db, $id){
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

function set_title($db, $title, $id){
    try{
        $query = 'UPDATE recipe 
                    SET title = :title
                    WHERE recipe_id = :id';
        $statement = $db->prepare($query);
        $statement->bindParam(':title',$title, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }catch(Exception $e){
        echo "Unable to Update title";
        exit;
    }
    return true;
    
}

function get_subtitle($db, $id){
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

function set_subtitle($db, $subtitle, $id){
    try{
        $query = 'UPDATE recipe 
                    SET subtitle = :subtitle
                    WHERE recipe_id = :id';
        $statement = $db->prepare($query);
        $statement->bindParam(':subtitle',$subtitle, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }catch(Exception $e){
        return false;
    }
    return true;
    
}

function get_image($db, $id){
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

function set_image($db, $image, $id){
    try{
        $query = 'UPDATE recipe 
                    SET img_src = :image
                    WHERE recipe_id = :id';
        $statement = $db->prepare($query);
        $statement->bindParam(':image',$image, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }catch(Exception $e){
        return false;
    }
    return true;
}

function get_ingredients($db, $id){
    try{
    $query = 'SELECT ingredient, amount, measurement
    			FROM ingredients
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

function get_all_distinct_ingredients($db){
    try{
        $query = 'SELECT distinct ingredient
                    FROM ingredients
                    ORDER BY ingredient ASC';
        
    $statement = $db->query($query);
    $ingredients = $statement->fetchAll();
    }catch(Exception $e){
        echo "Could not retrieve ingredients. ".$e->getMessage();
        exit;
    }
    return $ingredients;
}

function add_ingredient($db, $recipe_id, $ingredient, $amount, $measurement){
    $query = 'INSERT INTO ingredients(recipe_id,ingredient, amount, measurement)
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
    return true;
}

function delete_ingredient($db, $id, $ingredient){
    $query = "DELETE FROM ingredients
                WHERE recipe_id = :id AND ingredient = :ingredient";
    try{
        $statement = $db->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':ingredient', $ingredient, PDO::PARAM_STR);
        $statement->execute();        
    }catch(Exception $e){
        echo "Could not delete this ingredient. ".$e->getMessage();
        exit;
    }
    return true;
}

function add_recipe($db, $title, $subtitle, $cooked_on, $img_src, $url ){
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
        return false;
    }
    return true;
}

function delete_recipe($db, $id){
    try{
        $query1 = 'DELETE FROM recipe
                WHERE recipe_id = :id';
        $statement = $db->prepare($query1);
        $statement->bindParam(':id',$id, PDO::PARAM_INT);
        $statement->execute();
    }catch (Exception $e){
        echo "Unable to delete this recipe";
        return false;
    }
    try{
        $query2 = 'DELETE FROM ingredients
                WHERE recipe_id = :id';
        $statement = $db->prepare($query2);
        $statement->bindParam(':id',$id, PDO::PARAM_INT);
        $statement->execute();
    }catch (Exception $e){
        echo "Unable to delete ingredients for this recipe";
        return false;
    }
    return true;
}

function get_date_url($db, $id){
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

function get_URL($db, $id){
    try{
        $sql = 'SELECT url
                FROM recipe
                WHERE recipe_id = :id';
        $statement = $db->prepare($sql);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }catch (Exception $e){
        echo "Could not get linked website. ".$e->getMessage();
        exit;
    }
    return $statement->fetch(PDO::FETCH_ASSOC)['url'];
}
function change_website($db, $id, $url){
    try{
        $sql = 'UPDATE recipe
                SET url = :url
                WHERE recipe_id = :id';
        $statement = $db->prepare($sql);
        $statement->bindParam(":url", $url, PDO::PARAM_STR);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }catch(Exception $e){
        echo "Could not change linked website. ".$e->getMessage();
        exit;
    }
    return true;
}

function is_id_valid($db, $id){
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

function get_last_id($db){
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

function random_recipe($db){
    $sql = 'SELECT recipe_id, img_src, title
                FROM recipe
                WHERE img_src NOT IN("/images/image.jpg","/images/","NULL")
                ORDER BY RAND()
                LIMIT 3';
    
    try{
        $statement = $db->query($sql);
    }catch(Exception $e){
        echo "Unable to pull random recipes";
        exit;
    }
    $result = $statement->fetchAll();
    return $result;
}

function search_recipe($db, $search_term){
    $sql = 'SELECT distinct(recipe.title), recipe.recipe_id
            FROM recipe INNER JOIN ingredients
            ON recipe.recipe_id = ingredients.recipe_id
            WHERE recipe.title LIKE :search OR ingredients.ingredient LIKE :search';
    try{
        $statement = $db->prepare($sql);
        //No quotes needed in LIKE statement because of PDO::PARAM_STR
        $statement->bindParam(':search', $search_term, PDO::PARAM_STR);
        $statement->execute();
    }catch(Exception $e){
        echo "Could not search: ".$e->getMessage();
        exit;
    }
    $result = $statement->fetchAll();
    return $result;
}
?>

