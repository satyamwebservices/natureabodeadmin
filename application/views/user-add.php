<div class="col-md-12 mb-3">
    <div class="row">
        <div class="box-header">
            <h2>Add New User...</h2>
        </div>
    </div>
</div>  

<form action="" method="post" class="form-horizontal p-5" enctype="multipart/form-data" />
<?php echo validation_errors(); ?>
    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Username:</label>
        <div class="col-md-10">
            <input type="text" name="username"  id="simpleinput" class="form-control">
        </div>
    </div>   

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Email:</label>
        <div class="col-md-10">
            <input type="email" name="email"  value="<?php echo set_value('email'); ?>" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Password:</label>
        <div class="col-md-10">
            <input type="password" name="password" id="simpleinput" class="form-control">
        </div>
    </div> 

   

    <div class="row mb-3">
    <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Status: </label>
        <div class="col-md-6">
            <select name="status" class="form-select" id="inputGroupSelect01">
            <option selected>Choose...</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
            </select>
        </div> 
    </div> 


    <div class="row mb-3">
        <div class="col-md-10 text-end">
        <button class="btn btn-primary btn-lg float-right" type="submit">Submit</button>
        </div>
    </div>

</form>
