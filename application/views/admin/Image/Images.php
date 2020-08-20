<!DOCTYPE html>
<html lang="th">
<meta charset="utf8">

<head>
<link href="<?php echo base_url(); ?>/mdbootstrap/css/ImageEdit.css" rel="stylesheet">
</head>
<div class="wrapper">
    <?php $this->load->view('admin/admainEDIT'); ?>

    <body>
        <main>
            <div class="table-responsive">
                <p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รูปภาพ</p>
                <div class="navBtn">
                    <div class="btnGrp">
                        <form method="post" action="<?php echo base_url() . 'ImageEdit' ?>">
                            <button class="btn btn-sm amber lighten-1 font-weight-bolder" id="editFile"><i class="fas fa-image"></i>
                                รายการรูป
                            </button>
                        </form>
                        <button class="btn btn-sm red accent-2 font-weight-bolder" id="newImg"><i class="fas fa-file-upload"></i>
                            อัพโหลดรูป
                        </button>
                        <button class="btn btn-sm green accent-2 font-weight-bolder" id="newImg"><i class="fas fa-folder-open"></i>
                            หมวดหมู่
                        </button>
                    </div>
                </div>
            </div>
        </main>
</div>
<!------------------------------------------------------------ MODAL : upload image ------------------------------------------------------->
<div class="modal fade " id="imgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
        <div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
            <div class="modal-body text-center">
                <br />
                <i class="fas fa-file-pdf"></i><a class="font-weight-bolder" style="font-size:24px;"> อัพโหลดรูป</a>
            </div>
            <div class="modal-body text-center" id="form_upload">
                <form id="form_file" enctype="multipart/form-data">
                    <p>เลือกไฟล์ :</p>
                    <input type="file" accept="image/*" id="file_input" multiple></input>
                </form>
            </div>
            <span id="f_null" value="0"></span>
            <div class="pdf_grp_sel">
                <p>หมวดหมู่ :</p>
                <div class="add_grp">
                    <div class="grp_selector">
                        <select class="form-control" id="grp_val">
                            <?php foreach ($group_data as $row) {
                                echo '<option>' . $row->category . '</option>';
                            }
                            ?>
                        </select>
                        <div class="iPlus0"><i class="fas fa-plus-circle"></i></div>
                        <div class="iMinus0" style="display:none;"><i class="fas fa-minus-circle" onclick="rmv(this)"></i></div>
                    </div>
                </div>
            </div>
            <div class="modal-body text-center">
                <div class="row justify-content-center mb-3">
                    <div class="col-4">
                        <button id="confirm_btn" type="submit" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>
                    </div>
                    <div class="col-4">
                        <button id="hideModal" class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;" id="closemodal">ยกเลิก</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url().'miscit-js/ImageEdit.js';?>"></script>
</body>

</html>