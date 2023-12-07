<div class="col-md-12 mb-3">
    <div class="row">
        <div class="box-header">
            <h2>Add New Blog...</h2>
        </div>
    </div>
</div>  



<form action="<?php echo base_url('blog/add'); ?>" method="post" class="dz-clickable p-5" enctype="multipart/form-data">
    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Title:</label>
        <div class="col-md-10">
            <input type="text" name="title" id="simpleinput" class="form-control">
        </div>
    </div>   

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Intro:</label>
        <div class="col-md-10">
            <input type="text" name="intro" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
        <label for="example-fileinput" class="col-md-2 pl-1 col-form-label">Feature Image (size: 700x400px)</label>
        <div class="col-md-10">
            <input type="file" name="heroimg" accept="image/*" onchange="loadFile(event)" class="form-control mb-3">
            <img id="output" width="200px" height="auto"/>
        </div>
    </div>

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Body Content:</label>
        <div class="col-md-10">
        <textarea id="imgfile" name="content" style="height: 250px;"></textarea>
            <!-- <div id="snow-editor" style="height: 300px;">
            </div> -->
        </div>
    </div> 

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Meta Title:</label>
        <div class="col-md-10">
            <input type="text" name="metatitle" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Meta Keyword:</label>
        <div class="col-md-10">
            <input type="text" name="metakeyword" id="simpleinput" class="form-control">
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Meta Description:</label>
        <div class="col-md-10">
            <input type="text" name="metadesc" id="simpleinput" class="form-control">
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
        <button class="btn btn-primary btn-lg float-right" id="submitBtn" type="submit">Submit</button>
        </div>
    </div>

</form>

<!-- Preview -->
            
<script src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>

<script>
    CKEDITOR.replace('content');
    document.getElementById('submitBtn').addEventListener('click', function () {
        var formData = new FormData();
        var content = CKEDITOR.instances.content.getData();
        var imageFile = document.getElementById('imgfile').files[0];

        formData.append('content', content);
        formData.append('imgfile', imageFile);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= base_url('blog/add') ?>', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                alert('Content saved successfully!');
                // Handle success if needed
            } else {
                alert('Error occurred while saving content.');
                // Handle error if needed
            }
        };
        xhr.send(formData);
    });
</script>
