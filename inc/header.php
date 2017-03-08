<?php
$siteTitle = 'My Blue Apron Meals';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    	<!-- Bootstrap 3.3.7 -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
        <title><?php echo $siteTitle; ?></title>
    </head>
    <body>
        <header>
	        <nav class="navbar navbar-default">
				<div class="container-fluid">
					
                    
                    <div class="navbar-header">
				    	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="../index.php"><?php echo $siteTitle; ?></a>
				    </div>
                    
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="../index.php">Home</a></li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Recipes <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="../recipe.php">View Recipes</a></li>
                                    <li><a href="../add-recipe.php">Add a Recipe</a></li>
                                    <li><a href="../modify-recipe.php">Update/Delete Recipe</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Ingredients</a></li>
                            <li><a href="#">Report</a></li>
                        </ul>
                    </div>
				</div>
			</nav>    
        </header>
     