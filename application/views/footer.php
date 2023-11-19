                </div>
            </div>
        </div>
    </div>
    <!-- txt editor -->
<script>
   $('#summernote').summernote({
  height: 300,                 // set editor height
  minHeight: null,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor
  focus: true                  // set focus to editable area after initializing summernote
});
    </script>

<script>
    function elfinderDialog(context){ // <------------------ +context
        var fm = $('<div/>').dialogelfinder({
            url : 'http://localhost/path/elfinder/php/connector.minimal.php',
            lang : 'en',
            width : 840,
            height: 250,
            destroyOnClose : true,
            getFileCallback : function(file, fm) {
                console.log(file);
                // $('.editor').summernote('editor.insertImage', fm.convAbsUrl(file.url)); ...before
                context.invoke('editor.insertImage', fm.convAbsUrl(file.url)); // <------------ after
            },
            commandsOptions : {
                getfile : {
                    oncomplete : 'close',
                    folders : false
                }
            }
        }).dialogelfinder('instance');
    }
</script>
<!-- txt editor -->
    <script src="<?php echo base_url(); ?>assets/js/pages/demo.dashboard.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/daterangepicker/moment.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/vendor.min.js"></script>
    <!-- <script src="<?php //echo base_url(); ?>assets/vendor/quill/quill.min.js"></script>
    <script src="<?php //echo base_url(); ?>assets/js/pages/demo.quilljs.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/vendor/dropzone/min/dropzone.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/ui/component.fileupload.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script src="<?php echo base_url(); ?>assets/js/ui/component.todo.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/demo.crm-dashboard.js"></script>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script>
        var bs_modal = $('#modal');
        var image = document.getElementById('image');
        var cropper, reader, file;

        $("body").on("change", ".image", function (e) {
            var files = e.target.files;
            var done = function (url) {
                image.src = url;
                bs_modal.modal('show');
            };

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        bs_modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 16 / 9, // Set the aspect ratio to 16:9
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function () {
            //alert ("success");
            alert = ("#crop");
            canvas = cropper.getCroppedCanvas({
                width: 1600, // Width for the 16:9 aspect ratio
                height: 900 // Height for the 16:9 aspect ratio
            });

            canvas.toBlob(function (blob) {
               
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    var base64data = reader.result;
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "crop_image_upload.php",
                        data: { image: base64data },
                        success: function (data) {
                            bs_modal.modal('hide');
                            alert("Success: Image uploaded");
                        }
                    });
                };
            });
        });
    </script>   



</body>
</html>
