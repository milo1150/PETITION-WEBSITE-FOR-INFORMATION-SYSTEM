<!DOCTYPE html>
<html lang="en">

<head>
<script src="https://cdn.tiny.cloud/1/am92offi4ag2ekij6sn1zd9oknq3v9xdjzrihvl0r3bjyal0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<div class="wrapper">
    <?php $this->load->view('admin/admainEDIT'); ?>
    <body>
        <main>
            <div class="table-responsive">
                <p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">สำนักงาน - <?php echo $title_th;?></p>
                <form id="form-test" enctype="multipart/form-data" method="POST" action="<?php echo base_url()?>office/updateContent">
                    <div class="table-responsive-md pb-4 pt-4">
                        <div class="container" style="max-width:1000px;">
                            <div class="form-group">
                                <label></label>
                                <div style="display:none" id="v_content"></div>
                                <input value="<?php echo $id;?>" name="id" hidden>
                                <textarea class="form-control" id="txtEditor" name="txtEditor" rows="12"><?php echo $content;?></textarea>
                                <span style="color:red" id="error_txt"></span>
                            </div>
                            <div class="text-center pb-4">
                                <div class="row justify-content-center pt-2">
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-md btn-block green accent-3 text-white" style="font-size:20px;">ยืนยัน</button>
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="<?php echo base_url() ?>office/edit">
                                            <button type="button" class="btn btn-md btn-block red accent-4 text-white" style="font-size:20px;">ย้อนกลับ</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!----------------------------------------- modal------------------------------------------->
                <div class="modal fade " id="conf_modal" tabindex="-1" role="dialog" aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
                        <div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
                            <div class="modal-body text-center">
                                <br />
                                <i class="fas fa-file-alt" style="font-size:25px;"></i><a class="font-weight-bolder" style="font-size:24px;"> ยืนยันการแก้ไข</a>
                            </div>
                            <div class="modal-body text-center">
                                <div class="row justify-content-center mb-3">
                                    <div class="col-4">
                                        <button id="send_inf" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>
                                    </div>
                                    <div class="col-4">
                                        <button id="dis_modal" class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;" id="closemodal">ยกเลิก</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-------------------------------------------------------------------------------------------------------------------->

            </div>
        </main>
    </body>
<script>


tinymce.init({
    selector: '#txtEditor',
    plugins: 'print preview fullpage paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    imagetools_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    autosave_ask_before_unload: true,
    autosave_interval: "30s",
    autosave_prefix: "{path}{query}-{id}-",
    autosave_restore_when_empty: false,
    autosave_retention: "2m",
    image_advtab: true,
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        // '//fonts.googleapis.com/css2?family=Russo+One&display=swap',
        '//www.tiny.cloud/css/codepen.min.css'
    ],
    importcss_append: true,
    height: 400,
    file_picker_callback: function(callback, value, meta) {
        /* Provide file and text for the link dialog */
        if (meta.filetype === 'file') {
            callback('https://www.google.com/logos/google.jpg', {
                text: 'My text'
            });
        }

        /* Provide image and alt text for the image dialog */
        if (meta.filetype === 'image') {
            callback('https://www.google.com/logos/google.jpg', {
                alt: 'My alt text'
            });
        }

        /* Provide alternative source and posted for the media dialog */
        if (meta.filetype === 'media') {
            callback('movie.mp4', {
                source2: 'alt.ogg',
                poster: 'https://www.google.com/logos/google.jpg'
            });
        }
    },
    templates: [{
            title: 'New Table',
            description: 'creates a new table',
            content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
        },
        {
            title: 'Starting my story',
            description: 'A cure for writers block',
            content: 'Once upon a time...'
        },
        {
            title: 'New list with dates',
            description: 'New List with dates',
            content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
        }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: "mceNonEditable",
    toolbar_drawer: 'sliding',
    contextmenu: "link image imagetools table",
});

</script>

</html>