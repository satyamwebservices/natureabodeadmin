<?php //print_r($gallery); ?>
<div class="col-md-12 mb-3">
    <div class="row">
        <div class="box-header text-end">
            <a href="<?php echo base_url('gallery/add'); ?>"> <button class="btn btn-primary btn-lg float-right" type="submit">Add New Gallery</button></a>
        </div>
        <table class="table table-centered mb-0">
    <thead>
        <tr>
       
            <th>Name</th>
            <th>Images</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($gallery as $data): ?>
        <tr>
        <tr id="resortRow_<?= $data['id']; ?>">
        <td><?php echo $data['title']; ?></td>
        <td><img src="<?php echo base_url('assets/uploads/'); ?><?php echo $data['heroimg']; ?>" width="90px;" /></td>
        
        <td>
            <a href="gallery/edit/<?= $data['id']; ?>">Edit<i class="fa fa-pencil" aria-hidden="true"></i></a> | 
            <a href="javascript:void(0);" class="delete-link" onclick="deletegallery(<?php echo $data['id']; ?>)">Delete</a>
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
function deletegallery(dataid) {
    $.ajax({
       
       url: '<?php echo base_url("gallery/delete"); ?>', // Update the URL based on your controller method
        type: 'POST',
        dataType: 'json',
        data: { id: dataid },
        success: function(response) {
            if (response.status === 'Gallery deleted') {
                alert('Gallery deleted successfully!');
                // Remove the deleted blog element from the DOM
                $('#resortRow_' + itemid).remove();
            } else {
                alert('Error deleting gallery.');
            }
        },
        error: function() {
            alert('Some Error contact to admin.');
        }
    });
}
</script>
