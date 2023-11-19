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
            <h2>Edit Resort...</h2>
        </div>
    </div>
</div>  

<?php 
//echo "<pre>";
//print_r($resort); 
$resort = $resort;
$category = $categories;
//print_r($categories);
?>
<form action="<?= base_url('resort/edit/' . $resort['id']) ?>" method="post" class="dz-clickable p-5" enctype="multipart/form-data" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Title:</label>
        <div class="col-md-10">
            <input type="text" name="title" value="<?= set_value('title', $resort['title']) ?>" id="simpleinput" class="form-control">
        </div>
    </div>   

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Intro:</label>
        <div class="col-md-10">
            <input type="text" name="intro" value="<?= set_value('intro', $resort['intro']) ?>" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
    <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Select Place: </label>
        <div class="col-md-6">
            <select name="category" class="form-select" id="inputGroupSelect01">
            <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['title']; ?>"
                <?php echo ($category['title'] == $selectedCategory) ? 'selected' : ''; ?>>
                <?php echo $category['title']; ?>
            </option>
            <?php endforeach; ?>
            </select>
        </div> 
    </div> 

    <div class="row mb-3">
        <label for="example-fileinput" class="col-md-2 pl-1 col-form-label">Feature Image (size: 700x400px)</label>
        <div class="col-md-10">
            <input type="file" name="heroimg" accept="image/*" onchange="loadFile(event)" class="form-control mb-3">
            <img src="<?php echo base_url('assets/uploads/'); ?><?= set_value('heroimg', $resort['heroimg']) ?>" id="output" width="200px" height="auto"/>
        </div>
    </div>

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Body Content:</label>
        <div class="col-md-10">
        <textarea id="summernote" name="content" style="height: 250px;"><?= set_value('content', $resort['content']) ?></textarea>
            <!-- <div id="snow-editor"  style="height: 300px;">
            </div> -->
        </div>
    </div> 

    <!-- <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Image Gallery:</label>
        <div class="col-md-10 dropzone">
            <input type="file" name="gallery[]" accept="image/*" multiple id="galleryInput">
            <div id="imagePreviews" class="mt-3 imagedis"></div>
        </div>
    </div> -->

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Image Gallery:</label>
        <div class="col-md-10 dropzone">
            <div class="row">
            <?php
                $gallery_images = explode(',', $resort['gallery']);
                foreach ($gallery_images as $image_filename):
            ?>
            <div class="col-md-2">
                <img src="<?php echo base_url('assets/uploads/' . $image_filename); ?>" width="150px;"
                    height="100px">
                <a href="<?= base_url('resort/remove_image/' . $resort['id'] . '/' . $image_filename) ?>"
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
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Meta Title:</label>
        <div class="col-md-10">
            <input type="text" name="metatitle"  value="<?= set_value('metatitle', $resort['metatitle']) ?>" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Meta Description:</label>
        <div class="col-md-10">
            <input type="text" name="metadesc" value="<?= set_value('metadesc', $resort['metadesc']) ?>" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Meta Keyword:</label>
        <div class="col-md-10">
            <input type="text" name="metakeyword"  value="<?= set_value('metakeyword', $resort['metakeyword']) ?>" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
        <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Price:</label>
        <div class="col-md-5">
            <input type="text" name="amt" value="" placeholder="Amount" id="simpleinput" class="form-control">
        </div>
        <div class="col-md-5">
            <input type="text" name="amtdt" value="" placeholder="New Amount" id="simpleinput" class="form-control">
        </div>
    </div> 

    <div class="row mb-3">
    <label for="simpleinput" class="col-md-2 pl-1 col-form-label">Status: </label>
        <div class="col-md-6">
            <select name="status" class="form-select" id="inputGroupSelect01">
            <option value="1" <?= set_select('status', '1', ($resort['status'] == 1)) ?>>Active</option>
            <option value="0" <?= set_select('status', '0', ($resort['status'] == 0)) ?>>Inactive</option>
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
