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
        console.log(res.data);

        
        dataOne = [ '<div class="folderContent col-2 z-depth-1 waves-effect">' , '</div>' ];
        dataTwo = res.data;
        dataHtml = [];     
               
        /* Head-End Loop */
        let row = Math.ceil(res.data.length/5);
        let a = 0; // start loop push res.data         
        let c = 6; // end loop push res.data
        for(let i=1;i<=row;i++,a+=7,c+=7){
            dataHtml[a] = '<div class="folderContent col-2 z-depth-1 waves-effect">';
            dataHtml[c] = '</div>';
        }

        /* Inside Loop */
        let dLength = res.data.length;
        let i = 0;
        let b = 1; // between loop push res.data
        let d = 1; // reset loop
        while( i < dLength ){
            dataHtml[b] = res.data[i];
            b++;           
            if( d == 5 ){
                d = 0;
                a = a + 7;
                b = b + 2;
            }
            d++;
            i++;
        }
        console.log(dataHtml)


        // for(let i=0;i<res.data.length;i++){
            // let contentText = 
            //     '<div class="folderContent col-2 z-depth-1 waves-effect">'+
            //         '<div>'+
            //             '<i class="fas fa-folder-open"></i>'+
            //         '</div>'+
            //         '<div>'+
            //             '<p>'+res.data[i-1].category+'</p>'+
            //         '</div>'+                            
            //     '</div>';
                // contetnText.push(folderBox);               
            // if( i == a ){
            //     contentHtml.push('<div class="folderRow col-12">')
            //     contentHtml.push(contetnText)
            //     contentHtml.push('</div>')
            //     a + 4;
            // }
        // }

        // let folderBox = 
        //     '<div class="folderRow col-12">'+
        //         '<div class="folderContent col-2 z-depth-1 waves-effect">'+
        //             '<div>'+
        //                 '<i class="fas fa-folder-open"></i>'+
        //             '</div>'+
        //             '<div>'+
        //                 '<p>ข่าวรายวันน</p>'+
        //             '</div>'+                            
        //         '</div>'+                
        //     '</div>';
        
        // console.log(contentHtml)  




        // $('#spaceArea').html(contentHtml)              
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
			}
		},
	});
});
