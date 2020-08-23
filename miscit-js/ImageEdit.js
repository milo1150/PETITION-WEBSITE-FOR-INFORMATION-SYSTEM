/* --------------- DEFINE VALUE ------------- */
const area = document.getElementById("spaceArea");
const spinner = document.querySelector(".spinner");
const BASE_URL = 'http://localhost/codeig/';
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
        console.log(res.data);

        dataOne = [ '<div class="folderContent col-2 z-depth-1 waves-effect">' , '</div>' ];
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
	// loadContent();
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
	toolNav(true, title);
    axios.post('./fetchAlbum',{ folderName: title })
    .then(res => {
        $('#spaceArea').html('');
        const data = res.data;
        // console.log(data)
        for(let img of data){
            let imgUrl = BASE_URL+'image_db/'+img.category+'/'+img.name;
            
            $('#spaceArea').append(imgUrl+'<br>')
            console.log(imgUrl)
        }
        // console.log(BASE_URL)
    })


    // ------------------------------------------------- Onclick Confirm ------------------------------------------------
	const confirmBtn = document.getElementById("confirmBtn");
	confirmBtn.onclick = () => {		
        // --------------- Validate Image's name and exist ---------------
        const imgName = getImgName();
        axios.post("./imgCheck", {imgName: imgName, folderName: title})
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
        });
	};
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

	document.getElementById("grp_name_val").value = "";
    document.getElementById("spanCateError").innerHTML = "";

    fileInput.value = ""; //Clear fileInput selected
    $('#fileError').html(''); //Clear text Error fileInput
}

/* ---------------------------------------------- Image Category ----------------------------------------- */
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

/* --------------------------------------------- Delete ---------------------------------------------*/
const delBtn = document.getElementById('delGrp');
delBtn.onclick = () => {
    console.log('del')
    let x = document.querySelector('.contentDel');
    // x.classList.add('omg')
}
