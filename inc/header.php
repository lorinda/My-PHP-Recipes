<?php
$siteTitle = 'My Meals';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    	<!-- Bootstrap 3.3.7 -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!--Google Font: Changa -->
        <link href="https://fonts.googleapis.com/css?family=Changa" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">
        <title><?php echo $siteTitle; ?></title>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-inverse">
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
                            <li <?php if(isset($home)){echo 'class="active"';}?>><a href="../index.php">Home</a></li>
                            <li <?php if(isset($view_recipe)){echo 'class="active"';}?>><a   
                            href="../recipe.php">View Recipes</a></li>
                            <li <?php if(isset($add_recipe)){echo 'class="active"';}?>><a href="../add.php">Add Recipe</a></li>
                            <li <?php if(isset($modify_recipe)){echo 'class="active"';}?>><a href="../modify-recipe.php">Update/Delete Recipe</a></li>
                        </ul>
                        <form class="navbar-form navbar-right" role="search" method="post" action="search.php">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
				</div>
			</nav>    
        </header>
     