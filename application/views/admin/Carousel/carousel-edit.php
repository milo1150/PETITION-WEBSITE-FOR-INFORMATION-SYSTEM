<!DOCTYPE html>
<html lang="th">

<head>
</head>
<meta charset="utf8">
<style>
    table {
        border-collapse: collapse;
    }
</style>

<head>
    <div class="wrapper">
        <?php $this->load->view('admin/admainEDIT'); ?>

<body>
    <main>
        <div class="table-responsive">
            <p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">แบนเนอร์ข่าว</p>
            <table class="table table-bordered table-hover text-nowrap mytable shadow" style="margin-top: 10px;" id="">
                <thead class="thead-light z-depth-1">
                    <tr>
                        <th class="text-center" style="width:10px;">#</th>
                        <th class="text-center" style="width: 13%;">ลำดับ</th>
                        <th class="text-center" style="width:250px;">ภาพ</th>
                        <th class="text-center" style="width:50px;">แก้ไข</th>
                    </tr>
                </thead>
                <?php
                foreach ($carousel as $row) {
                ?>
                    <tr>
                        <td class="text-center font-weight-bolder red accent-3" style="padding-top:21px; font-size:16px; width: 6%;"><?php echo $row->id; ?></td>
                        <td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;"><?php echo $row->slide_order; ?></td>
                        <td class="text-center font-weight-bolder imgNameCss" style="padding-top:21px; font-size:16px;"><?php echo $row->img_name; ?></td>
                        <td class="text-center font-weight-bolder" style="width: 15%;">
                            <!-- <form action="<?php echo base_url(); ?>office/content" method="POST"><button value="<?php echo $row->id; ?>" name="id" type="submit" class="btn orange accent-2"><i class="fas fa-edit"></i></button></form> -->
                            <button class="btn orange accent-2" onclick="edit(<?php echo $row->id; ?>,'<?php echo $row->img_name; ?>')"><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tr>
            </table>

    </main>
    </div>
    <!---------------------------------------------------------------------- Modal ----------------------------------------------------------------->
    <div class="modal fade " id="editModal" tabindex="-1" role="dialog" aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
            <div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
                <div class="modal-body text-center">
                    <br />
                    <a class="font-weight-bolder" style="font-size:24px;"> ลิ้งค์ภาพ</a>
                </div>
                <div class="modal-body text-center" id="grp_name">
                    <p>URL</p>
                    <input class="form-control" id="imgUrl"></input>
                </div>
                <div class="modal-body text-center">
                    <div class="row justify-content-center mb-3">
                        <div class="col-4">
                            <button id="sendData" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>
                        </div>
                        <div class="col-4">
                            <button id="hideModal" class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;" id="closemodal">ยกเลิก</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------->
<style>
.imgNameCss{
    vertical-align: middle;
    font-size: 16px;
    font-weight: bolder;
    text-overflow: ellipsis;
    overflow: hidden;
    max-width: 500px;
}    
</style>
<script>
document.getElementById('hideModal').onclick = () => {
    $('#editModal').modal('hide');
}
const input = document.getElementById('imgUrl');
function edit(id,url){
    // console.log(id, url)
    $('#editModal').modal('show');    
    input.value = url;    

    document.getElementById('sendData').onclick = () => {
        const newUrl = input.value;
        $.ajax({
            url: "<?php echo base_url()?>Banner/updateUrl",
            dataType: "JSON",
            method: "POST",
            data: {'id': id,'url': newUrl},
            success:(data) => {
                if(data){
                    window.location.reload();
                }
            }
        })
    }
}




$('.mytable').dataTable({
    order: [
        [0, 'asc']
    ],
    'orderable': false,
    "targets": 1
});
</script>
</body>

</html>