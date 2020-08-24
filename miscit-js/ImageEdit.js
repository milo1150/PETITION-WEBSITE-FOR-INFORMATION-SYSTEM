/* --------------- DEFINE VALUE ------------- */
const area = document.getElementById("spaceArea");
const spinner = document.querySelector(".spinner");
const BASE_URL = 'http://localhost/codeig/';
var spinnerValue = false;

/* ------------------------ Spinner ------------------------- */
const spinnerStatus = (status) => {
	if (status === true) {
        $('#spaceArea').html('');
        spinner.style.display = "";
	}
	if (status === false) {
        spinner.style.display = "none";        
	}
};
/* ----------------------- Tool Navigator --------------------*/
const toolNav = (status, title) => {
    let topicArrow = document.querySelector('.topicArrow');
    let contentText = document.querySelector('.contentText');
    let newGrp = document.querySelector('#newGrp');
    let delGrp = document.querySelector('#delGrp');
    let newImg = document.querySelector('#newImg');
    if(!status){
        topicArrow.style.display = "none";
        contentText.innerHTML = "";
        newGrp.style.display = 'block';
        delGrp.style.display = 'none';
        newImg.style.display = 'none';
    }
    if(status){
        topicArrow.style.display = "block";
        contentText.innerHTML = title;
        newGrp.style.display = 'none';
        delGrp.style.display = 'block';
        newImg.style.display = 'block';             
    }
}

/* ---------------------------------------------------- Load Content ------------------------------------------------- */

const loadContent = () => {
    spinnerStatus(true);    
    axios.get("./folderList")
    .then((res) => {
        // console.log(res.data);

        dataTwo = res.data;
        dataHtml = [];    
               
        let maxRow = Math.ceil(res.data.length/5);
        dataRow = [];
        for(let i=0;i<maxRow;i++){
            dataRow.push('<div class="folderRow col-12" id="Frow'+i+'">');
        }
        for(let i of dataTwo){
            dataHtml.push('<div class="folderContent col-2 z-depth-1 waves-effect" id="fd'+i.id+'" title="'+i.category+'" onclick="loadInsideData(id, title)">'+
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
        toolNav(false);       
	}).catch(error => {
        console.log(error)
        // window.location.reload()
    })
};

document.querySelector('.picText').onclick = () => loadContent()
document.querySelector('.albumBtn').onclick = () => loadContent()


window.onload = () => {
	loadContent();
};


/* ----------------------------------------------------- Upload Image --------------------------------------------------*/
const fileInput = document.getElementById("fileInput");
const getImgName = () => {   
    const imgName = [];
    for(const i of fileInput.files){
        imgName.push(i.name);
    }
    return imgName;
}
const getImgFiles = (title) => {
    const fileCount = fileInput.files.length
    let ImgFile = new FormData();    
    ImgFile.append('folderName',title);
    for(let i = 0 ; i < fileCount ; i++ ){
        ImgFile.append('img' + i, fileInput.files[i] );
    };    
    return ImgFile;
}


/* ---------------------------------------------------- Load Content : on click folder ------------------------------------------------- */
function loadInsideData(id, title) {  
    spinnerStatus(true);
    axios.post('./fetchAlbum',{ folderName: title })
    .then(res => {        
        toolNav(true, title);
        $('#spaceArea').html('');
        const data = res.data;
        // console.log(data)

        // ---- Delete Folder Button ----
        const delFold = document.getElementById('delGrp');
        if(data.length == []){
            delFold.style.display = 'block'
        }else{
            delFold.style.display = 'none'
        }

        // --- Parent Row ---
        const maxRow = Math.ceil(data.length/5);
        const dataRow = [];
        for(let i=0;i<maxRow;i++){
            dataRow.push('<div class="folderRowImg" id="imgRowPar'+i+'">');
        }

        // --- Child Row ---
        const dataHtml = [];
        for(let img of data){
            const imgUrl = BASE_URL+'image_db/'+img.category+'/'+img.name;
            dataHtml.push(
                '<div class="ImgBox" id="'+img.id+'">'+
                    '<img src="'+imgUrl+'" width="250" height="250">'+
                        '<div class="overlayImg">'+
                            '<div>'+
                                '<a href="'+imgUrl+'" target="_blank"><i class="fas fa-external-link-square-alt"></i></a>'+
                                '<i class="fas fa-link" id="'+img.id+'" onclick="copyLink(id)"></i>'+
                                '<i class="fas fa-minus-circle minus-circle" onclick=deleteImageModal('+img.id+',"'+img.name+'","'+img.category+'")></i>'+
                                // '<i class="fas fa-minus-circle minus-circle" onclick=deleteImage('+img.id+',"'+img.name+'","'+img.category+'")></i>'+
                                '</div>'+
                            '<div><input value="'+imgUrl+'" id="picInput'+img.id+'"></input></div>'+
                        '</div>'+                                
                '</div>'
            );          
            // console.log(img)
        }
        // console.log(dataRow)
        // console.log(dataHtml)
        $('#spaceArea').html(dataRow)       
        let start = 0;
        let count = 0;
        let end = 5;
        let parentRow = 0;
        while(start < data.length){
            // console.log(start, count);
            $( '#imgRowPar' + parentRow ).append(dataHtml[start]);
            count++;
            start++;
            if( count == end ){
                parentRow++;
                count = 0;
            }            
        }   
        spinnerStatus(false)     
    })


    // ------------------------------------------------- Onclick Confirm Upload Image ------------------------------------------------
	const confirmBtn = document.getElementById("confirmBtn");
	confirmBtn.onclick = async () => {		
        // --------------- Validate Image's name and exist ---------------
        const imgName = getImgName();
        await axios.post("./imgCheck", {imgName: imgName, folderName: title})
        .then((res) => {
            const data = res.data;
            console.log(data)
            if(!data.status){
                $('#fileError').html(data.text);
                return;
            }
            if(data.status == 'imgError'){
                const errorMsg = [];
                for(let i of data.error){
                    errorMsg.push(i+'<br>');
                }
                $('#fileError').html(errorMsg);
                return;
            }
            if(data.status){
                // --------------- Upload Image ---------------
                const imgFiles = getImgFiles(title);
                axios.post('./imgUpload',imgFiles)
                .then( () => {
                    $("#fileError").html("");
                    document.getElementById("confirmBtn").disabled = true;
                    document.getElementById("closemodal").disabled = true;
                    document.querySelector('.spinner2').style.display = "block";
                })
                .then(res => {
                    document.getElementById("confirmBtn").disabled = false;
                    document.getElementById("closemodal").disabled = false;
                    document.querySelector('.spinner2').style.display = "none";
                    hideModal();
                    // console.log(res)
                })
            }
        })
        await setTimeout(()=>{
            loadInsideData(null, title)
        },500);
    };
}

/* ----------------------------------- Overlay Image Function ----------------------------------*/
// ----------- Copy Image URL ----------
function copyLink(id) {
    let x = document.getElementById('picInput'+id);
    x.select();
    console.log(x.value)
    document.execCommand("copy");
}
// ----------- Delete Modal : IMAGE -------------
function deleteImageModal(imgId, imgName, imgCategory) {
    $('#deleteImageModal').modal('show');
    document.getElementById('confDelImg').onclick = () => {
        deleteImage(imgId, imgName, imgCategory);
    }
}
// ----------- Delete Image -------------
async function deleteImage(imgId, imgName, imgCategory) {
    // console.log(imgName,imgCategory)
    const data = new FormData();
    data.append('imgId',imgId);
    data.append('imgName',imgName);
    data.append('imgCategory',imgCategory);
    await axios.post('./deleteImage',data)
    .then(res => {
        if(res.data){
            hideModal();
            setTimeout(() => {
                loadInsideData(null, imgCategory)
            },500);
        }
    })
}


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
	$("#deleteImageModal").modal("hide");
	$("#deleteFolderModal").modal("hide");
    
	document.getElementById("grp_name_val").value = "";
    document.getElementById("spanCateError").innerHTML = "";

    fileInput.value = ""; //Clear fileInput selected
    $('#fileError').html(''); //Clear text Error fileInput
}

/* ---------------------------------------------- Create new Image Folder ----------------------------------------- */
const cateConbtn = document.getElementById("cateConbtn");
cateConbtn.addEventListener("click", () => {
	const value = document.getElementById("grp_name_val").value;
	$.ajax({
		url: "./cateCheck",
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

/* --------------------------------------------- Delete Folder ---------------------------------------------*/
document.getElementById('delGrp').onclick = () => {
    $('#deleteFolderModal').modal('show');
    const title = document.querySelector('.contentText').innerHTML
    document.getElementById('confDelFolder').onclick = () => {
        const data = new FormData();
        data.append('folderName',title);
        axios.post('./deleteCategory',data)
        .then(res => {
            hideModal();
            if(res.data){
                loadContent();
            }
        })
    }
}

