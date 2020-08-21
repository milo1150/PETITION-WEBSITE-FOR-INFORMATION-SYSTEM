/* --------------- DEFINE VALUE ------------- */
const area = document.getElementById("spaceArea");
const spinner = document.querySelector(".spinner");
var spinnerValue = false;

/* ------------------------ Spinner ------------------------- */
const spinnerStatus = (status) => {
	if (status === true) {
        spinner.style.display = "";
        // $('#spaceArea').html('');
	}
	if (status === false) {
        spinner.style.display = "none";        
	}
};

/* ---------------------------------------------------- Load Content ------------------------------------------------- */

const loadContent = () => {
	spinnerStatus(true);
    axios.get("./Image/folderList")
    .then((res) => {
        // console.log(res.data);

        dataOne = [ '<div class="folderContent col-2 z-depth-1 waves-effect">' , '</div>' ];
        dataTwo = res.data;
        dataHtml = [];    
               
        let maxRow = Math.ceil(res.data.length/5);
        dataRow = [];
        for(let i=0;i<maxRow;i++){
            dataRow.push('<div class="folderRow col-12" id="Frow'+i+'">');
        }
        for(let i of dataTwo){
            dataHtml.push('<div class="folderContent col-2 z-depth-1 waves-effect">'+
                                '<div><div>'+
                                    '<i class="fas fa-folder-open"></i>'+
                                '</div>'+
                                '<div>'+
                                    '<p>'+i.category+'</p>'+
                                '</div></div>'+
                                '<div>'+
                                    '<i class="fas fa-minus-circle contentDel"></i>'+  
                                '</div>'+          
                            '</div>')
        }
        // console.log(maxRow)
        /* ---------------- Append HTML Content ------------- */
        $('#spaceArea').html(dataRow)
        let count = 0;
        let countBtw = 0;
        let dLength = res.data.length;
        let parentRow = 0; // Parent Row
        while(count < dLength){
            // console.log(countBtw)
            // console.log(res.data[count].category)
            $('#Frow'+parentRow).append(dataHtml[count]);   
            countBtw++;           
            count++;     
            if( countBtw == 5 && parentRow < maxRow ){
                countBtw = 0;
                parentRow++;
            }                                                       
        }               
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
		url: "./Image/cateCheck",
		method: "POST",
		dataType: "JSON",
		data: { cateName: value },
		success: (data) => {
			if (data.error_name) {
				$("#spanCateError").html(data.error_name);
			} else {
                hideModal();
                loadContent();
			}
		},
	});
});

/* --------------------------------------------- Delete ---------------------------------------------*/
const delBtn = document.getElementById('delGrp');
delBtn.onclick = () => {
    console.log('del')
    let x = document.querySelector('.contentDel');
    x.classList.add('omg')
}
