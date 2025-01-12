let idx=0;
let namelist = [];
// let table = new DataTable('#printTable');

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
                    <td>`+item.nama_penuh+`</td>
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
                    <td><a href="details-edit.php?form=`+item.id+`">Edit</a><a id="delete_details" href="details-edit.php?form=`+item.id+`">Delete</a></td>
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