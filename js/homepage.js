let idx=0;
let namelist = [];
// let table = new DataTable('#printTable');

function details(){
    idx=0;
    // namelist=[];
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var response = JSON.parse(this.responseText);
        $('#computerlist').empty();
        response.forEach(item => {
            idx+=1;
            namelist.push(item.nama_penuh);
            $('#computerlist').append(`
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
