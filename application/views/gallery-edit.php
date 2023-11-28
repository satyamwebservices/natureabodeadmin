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
            <h2>Edit Photo Gallery...</h2>
        </div>
    </div>
</div>  

<form action="<?= base_url('gallery/edit/' . $gallery['id']) ?>" method="post" class="form-horizontal p-5"  enctype="multipart/form-data">

<div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Image Gallery:</label>
        <div class="col-md-10 dropzone">
            <div class="row">
            <?php
                $gallery_images = explode(',', $gallery['gallery']);
                foreach ($gallery_images as $image_filename):
            ?>
            <div class="col-md-2">
                <img src="<?php echo base_url('assets/uploads/' . $image_filename); ?>" width="150px;"
                    height="100px">
                <a href="<?= base_url('gallery/remove_image/' . $gallery['id'] . '/' . $image_filename) ?>"
                    class="btn btn-danger">Remove</a>
            </div>
            <?php endforeach; ?>
            </div>
        </div>
        </div>
    </div>

    
   <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Add More Images:</label>
        <div class="col-md-10 dropzone">
            <input type="file" name="gallery[]" accept="image/*" multiple id="galleryInput">
            <div id="imagePreviews" class="mt-3 imagedis"></div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-10 text-end">
        <button class="btn btn-primary btn-lg float-right" type="submit">Submit</button>
        </div>
    </div>

</form>
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

<script>
$(document).ready(function() {
    // Function to add more file input fields
    $("#add-more-images").click(function() {
        var fileInput = `
    <input type="file" name="gallery[]" accept="image/*" multiple><br/>
    `;
            $("#image-container").append(fileInput);
        });
    });
</script>