<div class="col-md-12 mb-3">
    <div class="row">
        <div class="box-header text-end">
            <a href="<?php echo base_url('project/add'); ?>"> <button class="btn btn-primary btn-lg float-right" type="submit">Add New Project</button></a>
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
    <?php foreach ($categories as $item): ?>
        <tr>
        <td><?php echo $item['title']; ?></td>
        <td><?php echo $item['intro']; ?></td>
        <td><?php echo $item['status']; ?></td>
        <td>
            <a href="project/edit/<?php echo $item['id']; ?>">Edit<i class="fa fa-pencil" aria-hidden="true"></i></a> | 
            <a href="javascript:void(0);" class="delete-link" data-id="<?php echo $item['id']; ?>">Delete</a></td>
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
    $(document).ready(function() {
        // Function to handle the delete action
        function deleteItem(itemId) {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('project/delete/'); ?>' + itemId,
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        alert('Item deleted successfully.');
                        // You can reload the page or update the UI as needed
                        location.reload(); // Reloading the page as an example
                    } else {
                        alert('Failed to delete the item.');
                    }
                }
            });
        }

        // Handle click events for the "Delete" links
        $('.delete-link').on('click', function() {
            var itemId = $(this).data('id');
            var confirmation = confirm('Are you sure you want to delete this item?');
            if (confirmation) {
                deleteItem(itemId); // Call the deleteItem function
            }
        });
    });
</script>