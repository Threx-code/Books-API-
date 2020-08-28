<?php
require_once "nav_bar.php";
?>
<!-- container -->
<main role="main" class="container starter-template">
    <div class="row">
        <div class="col">
        	<!--error / success message will apprear here -->
            <div id="response"></div>
            <!-- product display -->
            <?php require_once "product_display.php" ?>
            <!-- this is create category form -->
           <?php require_once "category_form.php" ?>
            <!-- this is create book form -->
            <?php require_once "create_book.php" ?>
              <!-- fire ice api -->
            <?php require_once "fireice.php" ?>
        </div>
    </div>
</main>
<!-- this file holds the javascripts for processing the page -->
<?php require_once "processor.php"?>

<style type="text/css">
	.showEditable{
  float: right;
}

.showJson, .newSearch{
  display: none; float: right;
}
.editableFormat, #categoryCreate, .createProduct, .fireicediv{
  display: none;
}

.SubmitLoader{
  margin-top:8px; float:left; margin-right:10px; display: none;
}
</style>