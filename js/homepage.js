let idx = 0;
let namelist = [];
// let table = new DataTable('#printTable');


// # convert to ajax
function details(target) {
    idx = 0;
    // namelist=[];
    $.ajax({
        url: 'getList.php?u=' + target, // Replace with your API endpoint
        success: function (response) {
            if (response) { // use "response" for single variable 
                // or use "item = JSON.parse(response)" for multiple variable
                // let item =  JSON.parse(response);
                $('#computerlist').empty();
                response.forEach(item => {
                    idx += 1;
                    namelist.push(item.nama_penuh);
                    $("#nama_bahagian").html(item.nama)
                    $('#computerlist').append(`
                        <tr>
                            <td>` + item.nama_penuh + `</td>
                            <td>`+ item.jawatan_gred + `</td>
                            <td>`+ item.jenis_kakitangan + `</td>
                            <td>`+ item.jenis_komputer + `</td>
                            <td>`+ item.umur_komputer + `</td>
                            <td>`+ item.jenis_processor + `</td>
                            <td>`+ item.saiz_ram + `</td>
                            <td>`+ item.jenis_sistem + `</td>
                            <td>`+ item.antivirus + `</td>
                            <td>`+ item.ipv4_address + `</td>
                            <td>`+ item.catatan + `</td>
                            <td><a href="details-edit.php?form=`+ item.pcID + `">Edit</a><a href="#" class="delete_details" data-nama="` + item.nama_penuh + `" data-id="` + item.pcID + `" onclick="return false;">Delete</a></td>
                        </tr>`);
                });
                refreshTable();
            }
            else {
            }
        },

        error: function (jqXHR, textStatus, errorThrown) {
            // document.getElementById('username').innerHTML="";
        }
    });
}


function validateUser(target) {
    $.ajax({
        url: 'checkUnit.php?t=' + target, // Replace with your API endpoint
        success: function (response) {
            if (response) { // use "response" for single variable 
                // or use "item = JSON.parse(response)" for multiple variable
                // let item =  JSON.parse(response);

                $(("body")).removeAttr("hidden");
                sessionStorage.setItem("j_Tab", target);
                details(target);
            }
            else {
            }
        },

        error: function (jqXHR, textStatus, errorThrown) {
            // document.getElementById('username').innerHTML="";
        }
    });
}

function refreshTable() {
    $('#printTable').DataTable();
}

$('#printTable').on('click', '.delete_details', function () {

    let p = $(this).data('id');
    let n = $(this).data('nama');

    if (confirm("Adakah anda mahu memadam maklumat: " + n + "?")) {
        // Perform AJAX request
        $.ajax({
            url: 'deleteList.php', // Replace with your API endpoint
            method: 'POST', // Use POST for updates
            data: {
                target: p
            },
            success: function (response) {
                // Handle successful response
                console.log('Update successful:', response);
                alert('Maklumat telah dipadam!');
                details(sessionStorage.getItem('j_Tab'));
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Handle error
                console.error('Update failed:', textStatus, errorThrown);
                alert('Error updating data.');
            }
        });
    }
    // details();
});
