                </div>
            </div>
        </div>
    </div>
    <!-- txt editor -->


<!-- txt editor -->
    <script src="<?php echo base_url(); ?>assets/vendor/apexcharts/apexcharts.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/vendor.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/dropzone/min/dropzone.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/ui/component.fileupload.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>


    <script src="<?php echo base_url(); ?>assets/js/ui/component.todo.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


        <!-- Code Highlight js -->
    <script src="<?php echo base_url(); ?>assets/vendor/highlightjs/highlight.pack.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/clipboard/clipboard.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/hyper-syntax.js"></script>

    <script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
        }
    };
    </script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- summernote js -->
    <!-- <script src="<?php //echo base_url('assets/summernote/summernote-bs4.min.js'); ?>"></script>
    <script>
      $('#summernote').summernote({
        tabsize: 2,
        height: 300
      });
    </script> -->


</body>
</html>
