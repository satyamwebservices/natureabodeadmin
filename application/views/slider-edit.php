<?php //print_r($slider); ?>
<div class="col-md-12 mb-3">
    <div class="row">
        <div class="box-header">
            <h2>Edit Slider...</h2>
        </div>
    </div>
</div>  

<form action="<?php echo base_url('slider/edit/'. $slider['id']); ?>" method="post" class="dz-clickable p-3" enctype="multipart/form-data">
    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Title:</label>
        <div class="col-md-10">
            <input type="text" name="title" value="<?= set_value('title', $slider['title']) ?>" id="simpleinput" class="form-control">
        </div>
    </div>   

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Intro:</label>
        <div class="col-md-10">
            <input type="text" name="intro" value="<?= set_value('intro', $slider['intro']) ?>" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Button</label>
        <div class="col-md-4">
            <input type="text" name="button" value="<?= set_value('button', $slider['button']) ?>" placeholder="Button Name" id="simpleinput" class="form-control">
        </div>
        <div class="col-md-6">
            <input type="text" name="btnlink" value="<?= set_value('btnlink', $slider['btnlink']) ?>" placeholder="Button Link" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
    <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Status: </label>
        <div class="col-md-6">
            <select name="status" class="form-select" id="inputGroupSelect01">
            <option value="1" <?= set_select('status', '1', ($slider['status'] == 1)) ?>>Active</option>
            <option value="2" <?= set_select('status', '2', ($slider['status'] == 2)) ?>> Inactive</option>
            </select>
        </div> 
    </div> 

    <div class="row mb-3">
        <label for="example-fileinput" class="col-md-2 pl-1 col-form-label">Feature Image (Size: 1920x1080)</label>
        <div class="col-md-10">
            <input type="file" name="heroimg" accept="image/*" onchange="loadFile(event)" class="form-control mb-3">
            <img src="<?php echo base_url('assets/uploads/') ?><?= set_value('heroimg', $slider['heroimg']) ?>" id="output" width="200px" height="auto"/>
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