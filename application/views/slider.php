<div class="col-md-12 mb-3">
    <div class="row">
        <div class="box-header text-end">
            <a href="<?php echo base_url('slider/add'); ?>"> <button class="btn btn-primary btn-lg float-right" type="submit">Add New slider</button></a>
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
    <?php foreach ($slider as $slider_item): ?>
        <tr>
        <td><?php echo $slider_item['title']; ?></td>
        <td><?php echo $slider_item['intro']; ?></td>
        <td><?php echo $slider_item['status']; ?></td>
            <td>
                <!-- Switch-->
                <div>
                    <input type="checkbox" id="switch01" checked data-switch="success"/>
                    <label for="switch01" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    </div>
</div>  