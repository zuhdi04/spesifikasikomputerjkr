// ALL

function validateUser(target) {
    $.ajax({
        url: 'checkUnit.php?t=' + target, // Replace with your API endpoint
        success: function (response) {
            if (response) { 
                // response.forEach(item => {});

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

let j_Tab = getCookie("j_Tab");
deleteCookie("j_Tab");

// #use unique value checkup
if (j_Tab != "") { // directed from login.html / cookie
    validateUser(j_Tab);

    // $("head").val(j_Tab);
    // history.replaceState(j_Tab,"");
}
else if (sessionStorage.getItem("j_Tab") != null) {
    validateUser(sessionStorage.getItem("j_Tab"));
}
else {
    location.href = "login.html";
}

showAlert();



// Spesifikasi

// fetch items from database and display in table
function details(target) {
    idx = 0;
    $.ajax({
        url: 'getList.php?u=' + target, // Replace with your API endpoint
        success: function (response) {
            if (response) { // use "response" for single variable 
                // or use "item = JSON.parse(response)" for multiple variable
                // let item =  JSON.parse(response);
                $('#computerlist').empty();
                response.forEach(item => {
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
});



// ADD/EDIT Form
if(document.getElementById('detailsform'))
document.getElementById('detailsform').addEventListener('submit', function(e) {
    e.preventDefault();  // Prevent the form from submitting normally

    // Get the form data
    const target = document.getElementById('fullname').value;
    $.ajax({
        url: 'checkList.php?content='+target, // Replace with your API endpoint
        method: 'GET',
        success: function(response) {
            if(response!=""){ // use "response" for single variable 
                // let item =  JSON.parse(response);
                
                if(response==null){
                    $("#detailsform").attr("action","setList.php?u="+sessionStorage.j_Tab);
                    document.getElementById('detailsform').submit();
                } 
                
                else {
                    if (confirm("Maklumat pengguna tersedia. Kemaskini maklumat pengguna?")){
                        $("#targetid").val(item);
                        $("#detailsform").attr("action","editList.php?u="+sessionStorage.j_Tab);
                        document.getElementById('detailsform').submit();
                    }
                    else $("#targetid").val("");
                }
            }
            else{
            }
        },
        
        error: function(jqXHR, textStatus, errorThrown) {
            // document.getElementById('username').innerHTML="";
        }
    });

});

$.ajax({
    url: 'getUnitName.php?u=' + sessionStorage.getItem('j_Tab'), // Replace with your API endpoint
    success: function (response) {
        if (response) { // use "response" for single variable 
            $("#nama_bahagian").html(response);
            // or use "item = JSON.parse(response)" for multiple variable
            // let item =  JSON.parse(response);
            
        }
        else {
        }
    },

    error: function (jqXHR, textStatus, errorThrown) {
        // document.getElementById('username').innerHTML="";
    }
});

// toggle processor textbox
$("input[type='radio']").click(function(){
    const otherProc = $("input[id='otherProcRadio']:checked").val();
    if (otherProc){
        $("#otherProcTxtBox").removeAttr("disabled").focus();
    }
    else $("#otherProcTxtBox").attr("disabled",true);
})

// update other process value
function setOtherProcValue(){
    $("#otherProcRadio").val( $("#otherProcTxtBox").val() );
}