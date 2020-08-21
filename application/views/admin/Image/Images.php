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
                <div class="subTable">
                    <!-- <p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">จัดการรูปภาพ</p> -->
                    <div class="navBtn">                                    
                        <div class="btnGrp">
                            <button class="btn btn-sm amber lighten-1 font-weight-bolder albumBtn"><i class="fas fa-folder-open"></i>
                                อัลบั้ม
                            </button>                         
                            <button class="btn btn-sm green accent-2 font-weight-bolder" id="newGrp"><i class="fas fa-plus-circle"></i>
                                สร้างอัลบั้ม
                            </button>
                            <button class="btn btn-sm red accent-2 font-weight-bolder" id="delGrp"><i class="fas fa-minus-circle"></i>
                                ลบอัลบั้ม
                            </button>
                            <button class="btn btn-sm red accent-2 font-weight-bolder" id="newImg" style="display: none;"><i class="fas fa-file-upload"></i>
                                อัพโหลดภาพ
                            </button>
                        </div>
                    </div>
                    <div class="topicGator">
                        <div class="topicName"><a class="picText">อัลบั้ม</a></div>
                        <div class="topicArrow"><i class="fas fa-angle-right"></i></div>
                    </div>                    
                    <div class="navLine"></div>
                    <div class="spinner" style="display: none;">
                        <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                    </div>
                    <div id="spaceArea">                                             
                        <!-- <div class="folderRow col-12">
                            <div class="folderContent col-2 z-depth-1 waves-effect">
                                <div>
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <div>
                                    <p>ข่าวรายวันนนนนนนนนนนนนนนนนนนนนน</p>
                                </div>                                
                            </div>                                                                                                                                                     
                            <div class="folderContent col-2 z-depth-1 waves-effect">
                                <div>
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <div>
                                    <p>ข่าวรายวันนนนนนนนนนนนนนนนนนนนนน</p>
                                </div>                                
                            </div>                                                                                                                                                     
                            <div class="folderContent col-2 z-depth-1 waves-effect">
                                <div>
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <div>
                                    <p>ข่าวรายวันนนนนนนนนนนนนนนนนนนนนน</p>
                                </div>                                
                            </div>                                                                                                                                                     
                            <div class="folderContent col-2 z-depth-1 waves-effect">
                                <div>
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <div>
                                    <p>ข่าวรายวันนนนนนนนนนนนนนนนนนนนนน</p>
                                </div>                                
                            </div>                                                                                                                                                     
                            <div class="folderContent col-2 z-depth-1 waves-effect">
                                <div>
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <div>
                                    <p>ข่าวรายวันนนนนนนนนนนนนนนนนนนนนน</p>
                                </div>                                
                            </div>                                                                                                                                                     
                                                                                                                                                                                
                        </div> -->
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
                <a class="font-weight-bolder" style="font-size:24px;"> อัพโหลดรูปภาพ</a>
            </div>
            <div class="modal-body text-center" id="form_upload">
                <form id="form_file" enctype="multipart/form-data">
                    <p>เลือกไฟล์ :</p>
                    <input type="file" accept="image/*" id="file_input" multiple></input>
                </form>
            </div>
            <span id="f_null" value="0"></span>
            <div class="modal-body text-center">
                <div class="row justify-content-center mb-3">
                    <div class="col-4">
                        <button id="confirm_btn" type="submit" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>
                    </div>
                    <div class="col-4">
                        <button onclick=hideModal() class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;" id="closemodal">ยกเลิก</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------ MODAL : create new album ------------------------------------------------------->
<div class="modal fade " id="newGrpBtn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
			<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
				<div class="modal-body text-center">
					<br />
					<a class="font-weight-bolder" style="font-size:24px;"> สร้างอัลบั้ม</a>
				</div>
				<div class="modal-body text-center" id="grp_name">
					<p>ชื่อ</p>
					<input class="form-control" id="grp_name_val" maxlength="24"></input>					
				</div>
				<span class="spanCateError" id="spanCateError"></span>
				<div class="modal-body text-center">
					<div class="row justify-content-center mb-3">
						<div class="col-4">
							<button id="cateConbtn" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>
						</div>
						<div class="col-4">
							<button onclick=hideModal() class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;" id="closemodal">ยกเลิก</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script src="<?php echo base_url() . 'miscit-js/ImageEdit.js'; ?>"></script>
</body>

</html>