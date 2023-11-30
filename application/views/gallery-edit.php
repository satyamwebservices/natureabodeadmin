<div class="col-md-12 mb-3">
    <div class="row">
        <div class="box-header">
            <h2>Edit Gallery...</h2>
        </div>
    </div>
</div>  

<form action="<?php echo base_url('gallery/edit/'. $gallery['id']); ?>" method="post" class="form-horizontal p-5" enctype="multipart/form-data" />
    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Title:</label>
        <div class="col-md-10">
            <input type="text" name="title" value="<?= set_value('title', $gallery['title']) ?>" id="simpleinput" class="form-control">
        </div>
    </div>   

    <div class="row mb-3">
        <label for="example-fileinput" class="col-md-2 pl-1 col-form-label">Feature Image(size 600x400px)</label>
        <div class="col-md-10">
            <input type="file" name="heroimg" accept="image/*" onchange="loadFile(event)" class="form-control mb-3">
            <img id="output" src="<?php echo base_url('assets/uploads/'); ?><?= $gallery['heroimg'] ?>" width="200px" height="auto"/>
        </div>
    </div>

    <div class="row mb-3">
    <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Status: </label>
        <div class="col-md-6">
        <select name="status" class="form-select" id="inputGroupSelect01">
            <option value="1" <?= set_select('status', '1', ($gallery['status'] == 1)) ?>>Active</option>
            <option value="0" <?= set_select('status', '0', ($gallery['status'] == 0)) ?>>Inactive</option>
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