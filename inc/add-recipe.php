<!-- Display Add Recipe Form -->

<div class="jumbotron well">
    <h1>Add a Recipe</h1>
    <form action="" method="post" class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-sm-2" for="title">Recipe Title *required</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="title" id="title" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="subtitle">Recipe Subtitle *required</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="subtitle" id="subtitle"  />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="cooked_on">Date Cooked (MM/DD/YYYY)</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" pattern="(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](20)(1[6-7])" title="After 01/01/2016. Before 2018" name="cooked_on" id="cooked_on" />
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="control-label col-sm-2" for="img_src">Image Name <br>(include extension .jpg, etc)</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="img_src" id="img_src" aria-describedby="helpImage" />
                <span id="helpImage" class="help-block">Add image to /image folder.</span>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="control-label col-sm-2" for="url">Blue Apron Website Link</label>
            <div class="col-sm-6">
                <input type="url" pattern="https?://www.blueapron.com.+" class="form-control" name="url" id="url" value="https://www.blueapron.com/recipes/" title="Leave empty or begin with 'https://www.blueapron.com' . Thanks!"/>
            </div>
        </div>
        <br>
        <input type="hidden" name="recipe" value="addRecipe"/>
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-success" value="Continue" />
            </div>
        </div>
    </form>
</div>
<?php
require 'inc/footer.php';    
?>