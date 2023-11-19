<div class="col-md-12 mb-3">
    <div class="row">
        <div class="box-header">
            <h2>Edit Project...</h2>
        </div>
    </div>
</div>  

<form action="<?php echo base_url('project/edit/'. $category['id']); ?>" method="post" class="form-horizontal p-5" enctype="multipart/form-data" />
    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Title:</label>
        <div class="col-md-10">
            <input type="text" name="title" value="<?= set_value('title', $category['title']) ?>" id="simpleinput" class="form-control">
        </div>
    </div>   

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Intro:</label>
        <div class="col-md-10">
            <input type="text" name="intro" value="<?= set_value('intro', $category['intro']) ?>" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Place:</label>
        <div class="col-md-10">
            <input type="text" name="place" value="<?= set_value('place', $category['place']) ?>" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Meta Title:</label>
        <div class="col-md-10">
            <input type="text" name="metatitle" value="<?= set_value('metatitle', $category['metatitle']) ?>" id="simpleinput" class="form-control">
        </div>
    </div>

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Meta Description:</label>
        <div class="col-md-10">
            <input type="text" name="metadesc" value="<?= set_value('metadesc', $category['metadesc']) ?>" id="simpleinput" class="form-control">
        </div>
    </div>

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Meta Keyword:</label>
        <div class="col-md-10">
            <input type="text" name="metakeyword" value="<?= set_value('metakeyword', $category['metakeyword']) ?>" id="simpleinput" class="form-control">
        </div>
    </div>

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Price:</label>
        <div class="col-md-5">
            <input type="text" name="amt" placeholder="Amount"  id="simpleinput" class="form-control">
        </div>
        <div class="col-md-5">
            <input type="text" name="amtdt" placeholder="New Amount" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
    <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Status: </label>
        <div class="col-md-6">
            <select name="status" class="form-select" id="inputGroupSelect01">
            <option value="1" <?= set_select('status', '1', ($category['status'] == 1)) ?>>Active</option>
            <option value="0" <?= set_select('status', '0', ($category['status'] == 0)) ?>>Inactive</option>
            </select>
        </div> 
    </div> 

    <div class="row mb-3">
        <label for="example-fileinput" class="col-md-2 pl-1 col-form-label">Feature Image</label>
        <div class="col-md-10">
            <input type="file" name="heroimg" accept="image/*" onchange="loadFile(event)" class="form-control mb-3">
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