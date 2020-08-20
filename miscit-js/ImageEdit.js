/* --------------- DEFINE VALUE ------------- */
const area = document.getElementById("spaceArea");
const spinner = document.querySelector(".spinner");
var spinnerValue = false;

/* ------------------------ Spinner ------------------------- */
const spinnerStatus = (status) => {
	if (status === true) {
        spinner.style.display = "";
        $('#spaceArea').html('');
	}
	if (status === false) {
        spinner.style.display = "none";        
	}
};

/* ---------------------------------------------------- Load Content ------------------------------------------------- */

const loadContent = () => {
	spinnerStatus(true);
    axios.get("./ImageEdit/folderList")
    .then((res) => {
        console.log(res.data);
        let folderBox = 
            '<div class="folderRow col-12">'+
                '<div class="folderContent col-2 z-depth-1 waves-effect">'+
                    '<div>'+
                        '<i class="fas fa-folder-open"></i>'+
                    '</div>'+
                    '<div>'+
                        '<p>ข่าวรายวันนนนนนนนนนนนนนนนนนนนนน</p>'+
                    '</div>'+                            
                '</div>'
            '</div>';
        // console.log(folderBox)  
        $('#spaceArea').html(folderBox)              
        spinnerStatus(false);        
	}).catch(error => {
        window.location.reload()
    })
};

document.querySelector('.picText').onclick = () => loadContent()
document.querySelector('.albumBtn').onclick = () => loadContent()


window.onload = () => {
	loadContent();
};

/* ---------------------------------------------------- Modal ------------------------------------------------- */
/* Show modal */
document.getElementById("newImg").onclick = () => {
	$("#imgModal").modal("show");
};
document.getElementById("newGrp").onclick = () => {
	$("#newGrpBtn").modal("show");
};
/* Hide modal */
function hideModal() {
	$("#imgModal").modal("hide");
	$("#newGrpBtn").modal("hide");

	document.getElementById("grp_name_val").value = "";
	document.getElementById("spanCateError").innerHTML = "";
}

/* ---------------------------------------------- Image Group ----------------------------------------- */
const cateConbtn = document.getElementById("cateConbtn");
cateConbtn.addEventListener("click", () => {
	const value = document.getElementById("grp_name_val").value;
	$.ajax({
		url: "./ImageEdit/cateCheck",
		method: "POST",
		dataType: "JSON",
		data: { cateName: value },
		success: (data) => {
			if (data.error_name) {
				$("#spanCateError").html(data.error_name);
			} else {
				hideModal();
			}
		},
	});
});
