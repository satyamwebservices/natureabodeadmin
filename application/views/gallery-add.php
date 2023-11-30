<div class="col-md-12 mb-3">
    <div class="row">
        <div class="box-header">
            <h2>Add New Gallery...</h2>
        </div>
    </div>
</div>  

<form action="<?php echo base_url('gallery/add'); ?>" method="post" class="form-horizontal p-5" enctype="multipart/form-data" />
    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Title:</label>
        <div class="col-md-10">
            <input type="text" name="title" id="simpleinput" class="form-control">
        </div>
    </div>   

    <div class="row mb-3">
        <label for="example-fileinput" class="col-md-2 pl-1 col-form-label">Feature Image (size 600x400px)</label>
        <div class="col-md-10">
            <input type="file" name="heroimg" accept="image/*" onchange="loadFile(event)" class="form-control mb-3">
            <img id="output" width="200px" height="auto"/>
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
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>