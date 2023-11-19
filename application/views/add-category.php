<div class="col-md-12 mb-3">
    <div class="row">
        <div class="box-header">
            <h2>Add New Project...</h2>
        </div>
    </div>
</div>  

<form action="" method="post" class="form-horizontal" enctype="multipart/form-data" />
    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Title:</label>
        <div class="col-md-10">
            <input type="text" name="title" id="simpleinput" class="form-control">
        </div>
    </div>   

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Intro:</label>
        <div class="col-md-10">
            <input type="text" name="Intro" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Place:</label>
        <div class="col-md-10">
            <input type="text" name="place" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Price:</label>
        <div class="col-md-5">
            <input type="text" name="amt" placeholder="Amount" id="simpleinput" class="form-control">
        </div>
        <div class="col-md-5">
            <input type="text" name="amtdt" placeholder="New Amount" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
    <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Status: </label>
        <div class="col-md-6">
            <select class="form-select" id="inputGroupSelect01">
            <option selected>Choose...</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            </select>
        </div> 
    </div> 

    <div class="row mb-3">
        <label for="example-fileinput" class="col-md-2 pl-1 col-form-label">Feature Image</label>
        <div class="col-md-10">
            <input type="file" accept="image/*" onchange="loadFile(event)" class="form-control mb-3">
            <img id="output" width="200px" height="auto"/>
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