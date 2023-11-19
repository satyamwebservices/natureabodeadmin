<div class="col-md-12 mb-3">
    <div class="row">
        <div class="box-header text-end">
            <a href="<?php echo base_url('resort/add'); ?>"> <button class="btn btn-primary btn-lg float-right" type="submit">Add New Resort</button></a>
        </div>
        <table class="table table-centered mb-0">
    <thead>
        <tr>
            <th>Title</th>
            <th>Intro</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($resort as $item): ?>
        <tr>
        <tr id="resortRow_<?= $item['id']; ?>">
        <td><?php echo $item['title']; ?></td>
        <td><?php echo $item['intro']; ?></td>
        <td><?php echo $item['status']; ?></td>
            <td>
            <a href="resort/edit/<?php echo $item['id']; ?>">Edit<i class="fa fa-pencil" aria-hidden="true"></i></a> | 
            <a href="javascript:void(0);" class="delete-link" onclick="deleteresort(<?php echo $item['id']; ?>)">Delete</a>
                <!-- Switch-->
                <!-- <div>
                    <input type="checkbox" id="switch01" checked data-switch="success"/>
                    <label for="switch01" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                </div> -->
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    </div>
</div>  

<script>
function deleteresort(itemid) {
    $.ajax({
       
       url: '<?php echo base_url("resorts/delete/"); ?>', // Update the URL based on your controller method
        type: 'POST',
        dataType: 'json',
        data: { id: itemid },
        success: function(response) {
            if (response.status === 'Resort deleted') {
                alert('Resort deleted successfully!');
                // Remove the deleted blog element from the DOM
                $('#resortRow_' + itemid).remove();
            } else {
                alert('Error deleting Resort.');
            }
        },
        error: function() {
            alert('Some Error contact to admin.');
        }
    });
}
</script>