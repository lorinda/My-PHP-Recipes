# My PHP Recipes
My Code Louisville project explores learning PHP and MySQL by creating a web app for storing and retrieving meals cooked through Blue Apron's subscription service. Recipe ingredients are saved and searchable. Actual steps for each recipe are not included but accessible through the linked official recipe listing on blueapron.com.

## Installation
1. Install local server.
2. Clone Repo to web root.
3. Import my_apron.sql to phpmyadmin
    (Database name: my_apron, Table names: recipe, ingredients)
4. Update inc/connection.php
    * 4a. Delete line 2: ```require '/private/database-access.php';```
    * 4b. Change Line 5 to your local database connection parameters.
5. View site at index.php.

## Usage
###### READ a Recipe
1. Click "View Recipes" navigation link.
2. Choose recipe name in the dropdown or select random picture.
The recipe page will show a picture (if taken), the recipe title, subtitle, date cooked, ingredient list, and a link to the official recipe page on blueapron.com.

###### CREATE a Recipe
1. Click "Add Recipe" navigation link.
2. Fill in the form (minimum title and subtitle).
3. Click 'Continue' button.
4. Add the amount, measurement, and name of the ingredient.
(Example: 2 tbsp Butter)
5. Click 'Add Ingredient' button.
6. After adding last ingredient, click 'Recipe Finished' button.

###### UPDATE a Recipe
1. Click "UPDATE/DELTE Recipe" navigation link.
2. Choose recipe name in the dropdown.
3. Follow the directions on the page and click the red link to the right.

###### DELETE a Recipe
1. Click "UPDATE/DELTE Recipe" navigation link.
2. Choose recipe name in the dropdown.
3. Click the 'DELETE this Recipe' button.

## Credits
All code contributed by this user. No contributions accepted at this time. Recipes are copyright of Blue Apron, LLC.


