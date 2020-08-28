<div id="categoryCreate">
    <h2>Product Category</h2>
    <form id='product_category'>
        <input type="hidden" name="crfToken" value="<?php echo $crfToken;?>">
        <div class='form-group'>
            <label for='category_input'>Category Name</label>
            <input type='text' class='form-control' id='category_input' name='category' placeholder='Enter category name'>
        </div>
        <button type='submit' class='btn btn-primary'>Create Category</button>
        <div class="SubmitLoader Loader"></div>
    </form>
</div>