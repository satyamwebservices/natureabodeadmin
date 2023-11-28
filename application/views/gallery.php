<?php //print_r($gallery); ?>
<div class="col-md-12 mb-3">
    <div class="row">
        <div class="box-header text-end">
            <a href="<?php echo base_url('gallery/add'); ?>"> <button class="btn btn-primary btn-lg float-right" type="submit">Add New Gallery</button></a>
        </div>
        <table class="table table-centered mb-0">
    <thead>
        <tr>
            <th>Images</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($gallery as $slider_item): ?>
        <tr>
        <td><img src="<?php echo base_url('assets/uploads/'); ?><?php echo $slider_item['gallery']; ?>" width="200px;" /></td>
        
        <td>
            <a href="edit/<?= $slider_item['id']; ?>">Edit<i class="fa fa-pencil" aria-hidden="true"></i></a> | 
            <a href="javascript:void(0);" class="delete-link" onclick="deleteBlog(<?= $slider_item['id']; ?>)">Delete</a>
        </td>
            <!-- <td>
                <div>
                    <input type="checkbox" id="switch01" checked data-switch="success"/>
                    <label for="switch01" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                </div>
            </td> -->
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    </div>
</div>  

<script>
function deleteBlog(blogId) {
    $.ajax({
        url: '<?php echo base_url("gallery/delete"); ?>', // Update the URL based on your controller method
        type: 'POST',
        dataType: 'json',
        data: { id: blogId },
        success: function(response) {
            if (response.status === 'gallery deleted') {
                alert('Gallery deleted successfully!');
                // Remove the deleted blog element from the DOM
                $('#galleryRow_' + blogId).remove();
            } else {
                alert('Error deleting Gallery.');
            }
        },
        error: function() {
            alert('Some Error contact to admin.');
        }
    });
}
</script>