<?php	
header("Access-Control-Allow-Origin: *");
header("Content-Type: text; charset=UTF-8");

require_once "../inc/classesholder.php";

$data = $FormProcessor->readProduct();

$response = http_response_code(200);

foreach($data as $value):	
?>

<div  style="margin:0px auto; border:1px solid #aaa; padding:10px; margin-bottom:10px; width:60%;" class="div<?php echo $value->id ?>">
<form  method="post" role="form" class='update<?php echo $value->id ?>'>
	<div class="form-group">
		
		<p><label>Category</label>: <span style="font-size: 20px;"><?php echo $value->book_category ?></span></p>
	</div>
	<div class="form-group">
		<label>Book Name</label>
		<input type="text" class="form-control" name="name" value="<?php echo $value->name ?>" />
	</div>
	<div class="form-group">
		<label>Book author</label>
		<input type="text" class="form-control" name="author" value="<?php echo $value->author ?>" />
	</div>
	<div class="form-group">
		<label>Book ISBN</label>
		<input type="text" class="form-control" name="isbn" value="<?php echo $value->isbn ?>" />
	</div>
	<div class="form-group">
		<label>country</label>
		<input type="text" class="form-control" name="country" value="<?php echo $value->country ?>" />
	</div>
	<div class="form-group">
		<label>Publisher</label>
		<input type="text" class="form-control" name="publisher" value="<?php echo $value->publisher ?>" />
	</div>
	<div class="form-group">
		<label>Number of Pages</label>
		<input type="text" class="form-control" name="pages" value="<?php echo $value->number_of_pages ?>" />
	</div>
	<div class="form-group">
		<label>Release Date (mm-dd-yyyy)</label>
		<input type="text" class="form-control" name="date" value="<?php echo $value->release_date ?>" />
	</div>


	<input type="hidden" name="id" value="<?php echo $value->id ?>">

	<button type='submit' class='btn btn-primary'>Update</button>

	<button type='button' class='btn btn-primary clickDelete<?php echo $value->id ?>' style="float:right;">Delete</button>

	
	<div class="SubmitLoader Loader" style="margin-top:8px; float:left; margin-right:10px; display: none;"></div>
</form>


<form  method="post" role="form" class='deletebooks<?php echo $value->id ?>' style="display: none;">
	<input type="button" name="delete" style="display: none;" class="delete<?php echo $value->id ?>">
	<input type="hidden" name="id" value="<?php echo $value->id ?>">
</form>
</div>

<script type="text/javascript">
$(document).ready(function(e){

$(".clickDelete<?php echo $value->id ?>").on('click', function(){
	$(".delete<?php echo $value->id ?>").click();
});


$(".update<?php echo $value->id ?>").on("submit",function(e){
	e.preventDefault();
var bookData<?php echo $value->id ?> = $(this);
			form_data<?php echo $value->id ?> = JSON.stringify(bookData<?php echo $value->id ?>.serializeObject<?php echo $value->id ?>());
$.ajax({
url:"<?php echo APP_URI ?>/update.php",
method: "POST",
contentType:"application/json",
data: form_data<?php echo $value->id ?>,
success:function(data){
alert(data.message);
location.reload()
}
});
});


$(".deletebooks<?php echo $value->id ?>").click(function(){
var bookData<?php echo $value->id ?> = $(this);
			form_data<?php echo $value->id ?> = JSON.stringify(bookData<?php echo $value->id ?>.serializeObject<?php echo $value->id ?>());
$.ajax({
url:"<?php echo APP_URI ?>/delete.php",
method: "POST",
contentType:"application/json",
data: form_data<?php echo $value->id ?>,
success:function(data){
	$(".div<?php echo $value->id ?>").fadeOut();
	}
	});
});



	$.fn.serializeObject<?php echo $value->id ?> = function(){
		var o = {};
		var a = this.serializeArray();
		$.each(a, function(){
			if(o[this.name] !== undefined){
				if(o[this.name].push){
					o[this.name] = [o[this.name]];
				}
				o[this.name].push(this.value || "");
			}
			else{
				o[this.name] = this.value || "";
			}

		});

		return o;
	}
})
</script>

<?php
endforeach;
?>
