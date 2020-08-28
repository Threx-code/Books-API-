<div class="createProduct">
    <h2>Create Book</h2>
    <form  method="post" role="form" id='new_product'>
    	<input type="hidden" name="crfToken" value="<?php echo $crfToken;?>">
    	<div class="form-group">
    		<label>Category</label>
    		<select class="form-control Productcategory reset" name="category"></select>
    	</div>
    	<div class="form-group">
    		<label>Book Name</label>
    		<input type="text" class="form-control reset" name="name"/>
       	</div>
       	<div class="form-group">
           	<label>Book author</label>
           	<input type="text" class="form-control reset" name="author"/>
       	</div>
       	<div class="form-group">
           	<label>Book ISBN</label>
           	<input type="text" class="form-control reset" name="isbn"/>
       	</div>
        	<div class="form-group">
	           <label>country</label>
	           <input type="text" class="form-control reset" name="country"/>
       	</div>
	       <div class="form-group">
	           <label>Publisher</label>
	           <input type="text" class="form-control reset" name="publisher"/>
	       </div>
	       <div class="form-group">
	           <label>Number of Pages</label>
	           <input type="text" class="form-control reset" name="pages"/>
	       </div>
	       <div class="form-group">
	           <label>Release Date (mm-dd-yyyy)</label>
	           <input type="text" class="form-control reset" name="date"/>
	       </div>
       	<button type='submit' class='btn btn-primary'>Post Book</button>
       	<div class="SubmitLoader Loader"></div>
    </form>
</div>