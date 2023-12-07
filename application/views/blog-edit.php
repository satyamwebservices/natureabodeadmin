<div class="col-md-12 mb-3">
    <div class="row">
        <div class="box-header">
            <h2>Edit Blog...</h2>
        </div>
    </div>
</div>  

<?php //echo "<pre>"; print_r($blog); ?>

<form action="<?php echo base_url('blog/edit/'. $blog['id']); ?>" method="post" class="dz-clickable p-3" enctype="multipart/form-data">
    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Title:</label>
        <div class="col-md-10">
            <input type="text" name="title" value="<?= set_value('title', $blog['title']) ?>" id="simpleinput" class="form-control">
        </div>
    </div>   

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Intro:</label>
        <div class="col-md-10">
            <input type="text" name="intro" value="<?= set_value('intro', $blog['intro']) ?>" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
        <label for="example-fileinput" class="col-md-2 pl-1 col-form-label">Feature Image (size: 700x400px)</label>
        <div class="col-md-10">
            <input type="file" name="heroimg" accept="image/*" onchange="loadFile(event)" class="form-control mb-3">
            <img src="<?php echo base_url('assets/uploads/') ?><?= set_value('heroimg', $blog['heroimg']) ?>" id="output" width="200px" height="auto"/>
        </div>
    </div>

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Body Content:</label>
        <div class="col-md-10">
            <?php //print_r($blog['content']); ?>
        <textarea id="summernote" name="content" style="height: 250px;"><?= set_value('content', $blog['content']) ?></textarea>
          
        </div>
    </div> 

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Meta Title:</label>
        <div class="col-md-10">
            <input type="text" name="metatitle" value="<?= set_value('metatitle', $blog['metatitle']) ?>" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Meta Keyword:</label>
        <div class="col-md-10">
            <input type="text" name="metakeyword" value="<?= set_value('metakeyword', $blog['metakeyword']) ?>" id="simpleinput" class="form-control">
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Meta Description:</label>
        <div class="col-md-10">
            <input type="text" name="metadesc" value="<?= set_value('metadesc', $blog['metadesc']) ?>" id="simpleinput" class="form-control">
        </div>
    </div> 


    <div class="row mb-3">
    <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Status: </label>
        <div class="col-md-6">
            <select name="status" class="form-select" id="inputGroupSelect01">
            <option value="1" <?= set_select('status', '1', ($blog['status'] == 1)) ?>>Active</option>
            <option value="2" <?= set_select('status', '2', ($blog['status'] == 2)) ?>> Inactive</option>
            </select>
        </div> 
    </div> 


    <div class="row mb-3">
        <div class="col-md-10 text-end">
        <button class="btn btn-primary btn-lg float-right" id="submitBtn" type="submit">Submit</button>
        </div>
    </div>

</form>

<!-- Preview -->
            


<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>

<script src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
<script>
    CKEDITOR.replace('content', {
        filebrowserUploadUrl: '<?php echo base_url('blog/add'); ?>',
        // Other configurations as needed
    });
</script>
