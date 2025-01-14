let idx=0;
let namelist = [];
// let table = new DataTable('#printTable');

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
}
function deleteCookie(cname) {
    const d = new Date();
    d.setTime(d.getTime() - 1);
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=;" + expires + ";path=/";
}

function details(){
    idx=0;
    // namelist=[];
    $('#stafflist').empty();
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var response = JSON.parse(this.responseText);
        response.forEach(item => {
            idx+=1;
            namelist.push(item.nama_penuh);
            $('#stafflist').append(`
                <tr>
                    <td>`+idx+`</td>
                    <td id="pc_`+item.id+`">`+item.nama_penuh+`</td>
                    <td>`+item.bahagian_cawangan_daerah+`</td>
                    <td>`+item.jawatan_gred+`</td>
                    <td>`+item.jenis_kakitangan+`</td>
                    <td>`+item.jenis_komputer+`</td>
                    <td>`+item.umur_komputer+`</td>
                    <td>`+item.jenis_processor+`</td>
                    <td>`+item.saiz_ram+`</td>
                    <td>`+item.jenis_sistem+`</td>
                    <td>`+item.antivirus+`</td>
                    <td>`+item.ipv4_address+`</td>
                    <td>`+item.catatan+`</td>
                    <td><a href="details-edit.php?form=`+item.id+`">Edit</a><a href="#" class="delete_details" data-id="`+item.id+`" onclick="return false;">Delete</a></td>
                </tr>`);
        });
        refreshTable();
    }
    xhttp.open("GET", "getList.php", true);
    xhttp.send();
}

function validateDetails(){
    // xhttp
    return false;
}

function refreshTable(){
    $('#printTable').DataTable();
}

$('#printTable').on('click','.delete_details',function(){
    let p = $(this).data('id');
    let targetelem="pc_"+p.toString();
    // console.log(document.getElementById(targetelem));
    
    let n = document.getElementById(targetelem).innerText;
    if(confirm("Adakah anda mahu memadam maklumat: "+n+"?")){
        // Perform AJAX request
        $.ajax({
            url: 'deleteList.php', // Replace with your API endpoint
            method: 'POST', // Use POST for updates
            data: {
                target: p
            },
            success: function(response) {
                // Handle successful response
                console.log('Update successful:', response);
                alert('Maklumat telah dipadam!');
                details();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle error
                console.error('Update failed:', textStatus, errorThrown);
                alert('Error updating data.');
            }
        });
    }
    details();
});

function showAlert(){
    let popup = getCookie("alert");
    if(popup=="success_add"){
        alert("Maklumat berjaya ditambah.");
        deleteCookie("alert");
    }
    else if (popup=="success_edit"){
        alert("Maklumat berjaya dikemaskini.");
        deleteCookie("alert");
    }
    
    deleteCookie("alert");
}