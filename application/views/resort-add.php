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
            <h2>Add New Resort...</h2>
        </div>
    </div>
</div>  


<form action="<?php echo base_url('resort/add'); ?>" method="post" class="dz-clickable p-5" enctype="multipart/form-data" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
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
    <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Select Place: </label>
        <div class="col-md-6">
            <select name="category" class="form-select" id="inputGroupSelect01">
            <option selected>Choose Place</option>
            <?php foreach($categories as $category) { ?>
            <option value="<?php echo $category['id'];?>"><?php echo $category['place'];?></option>
            <?php } ?>
            </select>
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
            <textarea id="summernote"  name="content" style="height: 300px;"></textarea>
        </div>
    </div> 

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Image Gallery:</label>
        <div class="col-md-10 dropzone">
            <input type="file" name="gallery[]" accept="image/*" multiple id="galleryInput">
            <div id="imagePreviews" class="mt-3 imagedis"></div>
        </div>
    </div>

    <!-- <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Image Gallery:</label>
        <div class="col-md-10 dropzone">
        <input type="file" name="gallery[]" accept="image/*" multiple> 
            <div class="dz-message needsclick">
                    <i class="h1 text-muted ri-upload-cloud-2-line"></i>
                    <h3>Drop files here or click to upload.</h3>
            </div>
        </div>

        <div class="dropzone-previews mt-3" id="file-previews"></div>
        <div class="d-none" id="uploadPreviewTemplate">
            <div class="card mt-1 mb-0 shadow-none border">
                <div class="p-2">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <img data-dz-thumbnail name="gallery[]" src="#" class="avatar-sm rounded bg-light" alt="" multiple>
                        </div>
                        <div class="col ps-0">
                            <a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name></a>
                            <p class="mb-0" data-dz-size></p>
                        </div>
                        <div class="col-auto">
                          
                            <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                <i class="ri-close-line"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Meta Title:</label>
        <div class="col-md-10">
            <input type="text" name="metatitle" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Meta Description:</label>
        <div class="col-md-10">
            <input type="text" name="metadesc" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Meta Keyword:</label>
        <div class="col-md-10">
            <input type="text" name="metakeyword" id="simpleinput" class="form-control">
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

<!-- Preview -->

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
