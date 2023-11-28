<style>
    .imagedis{display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 10px; /* Adjust the gap between images as needed */}
    .imagedis img{ width: 100%;
    height: auto;}
</style>

<div class="col-md-12 mb-3">
    <div class="row">
        <div class="box-header">
            <h2>Add Photo Gallery...</h2>
        </div>
    </div>
</div>  

<form action="<?php echo base_url('gallery/add'); ?>" method="post" class="form-horizontal p-5"  enctype="multipart/form-data">

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Image Gallery:</label>
        <div class="col-md-10 dropzone">
            <input type="file" name="gallery[]" accept="image/*" multiple id="galleryInput">
            <div id="imagePreviews" class="mt-3 imagedis"></div>
        </div>
    </div>

    
    <!-- <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Related Resort: </label>
        <div class="col-md-6">
            <select class="form-select" id="inputGroupSelect01">
            <option selected>Choose...</option>
            <option value="active">Resort one</option>
            <option value="inactive">Resort two</option>
            </select>
        </div> 
    </div>  -->
    
    <!-- <div class="row mb-3">
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
    </div>   -->

    <!-- <div class="row mb-3">
    <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Status: </label>
        <div class="col-md-6">
            <select class="form-select" id="inputGroupSelect01">
            <option selected>Choose...</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            </select>
        </div> 
    </div>  -->

    <!-- <div class="row mb-3">
        <label for="example-fileinput" class="col-md-2 pl-1 col-form-label">Feature Image</label>
        <div class="col-md-10">
            <input type="file" accept="image/*" onchange="loadFile(event)" class="form-control mb-3">
            <img id="output" width="200px" height="auto"/>
        </div>
    </div> -->

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

<script>
document.getElementById('galleryInput').addEventListener('change', handleFileSelect);

function handleFileSelect(event) {
    const galleryContainer = document.getElementById('imagePreviews');
    galleryContainer.innerHTML = ''; // Clear previous previews

    const files = event.target.files;

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = file.name;
            img.className = 'preview-image';
            galleryContainer.appendChild(img);
        };

        reader.readAsDataURL(file);
    }
}
</script>