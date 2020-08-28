<div class="fireicediv">
    <div class="searchresult">
        <!-- toggle the search button -->
        <button class="newSearch">New Search</button>
        <!-- fire ice results will be displayed here -->
        <div class="showsearchresult"></div>
    </div>
    <!-- form for searching fire ice -->
    <div class="searchFormdiv">
        <h2>Search External Server for Book</h2>
		<form  method="post" role="form" id='fireicesearch'>
            <input type="hidden" name="crfToken" value="<?php echo $crfToken;?>">
            <div class="form-group">
                <label>Book Name</label>
                <input type="text" class="form-control reset" name="search"/>
            </div>
            <button type='submit' class='btn btn-primary'>Post Book</button>
            <div class="SubmitLoader Loader"></div>
        </form>
    </div>
</div>