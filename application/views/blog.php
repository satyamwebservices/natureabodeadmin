<div class="col-md-12 mb-3">
    <div class="row">
        <div class="box-header text-end">
            <a href="<?php echo base_url('blog/add'); ?>"> <button class="btn btn-primary btn-md float-right" type="submit">Add New Blog</button></a>
        </div>
        <table class="table table-centered mb-0">
    <thead>
        <tr>
            <th>S.no</th>
            <th>Title</th>
            <th>Intro</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; foreach ($blog as $blogs): ?>
            <tr id="blogRow_<?= $blogs['id']; ?>">
                <td><?= $i; ?></td>
                <td><?= substr($blogs['title'], 0, 40); ?></td>
                <td><?= substr($blogs['intro'], 0, 40); ?></td>
                <td>
                    <?php 
                    if ($blogs['status'] == 1) {
                        echo "Active";
                    } else {
                        echo "Inactive";
                    }
                    ?>
                </td>
                <td>
                    <a href="blog/edit/<?= $blogs['id']; ?>">Edit<i class="fa fa-pencil" aria-hidden="true"></i></a> | 
                    <a href="javascript:void(0);" class="delete-link" onclick="deleteBlog(<?= $blogs['id']; ?>)">Delete</a>
                </td>
            </tr>
            <?php $i++; endforeach; ?>
    </tbody>
</table>
    </div>
</div>  

<script>
function deleteBlog(blogId) {
    $.ajax({
        url: '<?php echo base_url("blog/delete/"); ?>', // Update the URL based on your controller method
        type: 'POST',
        dataType: 'json',
        data: { id: blogId },
        success: function(response) {
            if (response.status === 'Blog deleted') {
                alert('Blog deleted successfully!');
                // Remove the deleted blog element from the DOM
                $('#blogRow_' + blogId).remove();
            } else {
                alert('Error deleting blog.');
            }
        },
        error: function() {
            alert('Some Error contact to admin.');
        }
    });
}
</script>