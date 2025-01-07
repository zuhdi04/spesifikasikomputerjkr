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

//unused
$('#addStaffBtn').click(function(){
    $('#new-form-container').toggle();
});

//unused
$('#reloadTable').click(function(){
    $('#new-form-container').hide();
});

//unused
$('#saveStaffBtn').click(function() {
    // Get values from input fields
    let rstaffname=$('#fullname').val();
    let staffname = rstaffname.toUpperCase();
    let second=$('#second').val();
    let third=$('#third').val();
    let kakitangan=$('#kakitangan').val();
    let fifth=$('#fifth').val();
    let pcage=$('#pcage').val();
    let rproc=$("input[type='radio'][name='proc']:checked").val();
    let proc=rproc==null?" ":rproc;
    let ram=$('#ram').val();
    let rsystemtype=$("input[type='radio'][name='systemtype']:checked").val();
    let systemtype=rsystemtype==null?" ":rsystemtype;
    let antivirus=$('#antivirus').val();
    let ipaddress=$('#ipaddress').val();
    let catatan=$('#catatan').val();

    if (staffname=="") return;

    if (namelist.indexOf(staffname)>-1){
        alert("data already exist");
        return;
    }
    
    // Perform AJAX request
    $.ajax({
        url: 'setList.php', // Replace with your API endpoint
        method: 'POST', // Use POST for updates
        data: {
            // tablename: dbtable, // Specify your table name
            staffname: staffname,
            second: second,
            third: third,
            kakitangan: kakitangan,
            fifth: fifth,
            pcage: pcage,
            proc: proc,
            ram: ram,
            systemtype: systemtype,
            antivirus: antivirus,
            ipaddress: ipaddress,
            catatan: catatan
        },
        success: function(response) {
            // Handle successful response
            details();
            $('#new-form-container').hide();
            console.log('Update successful:', response);
            alert('Data updated successfully!');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle error
            console.error('Update failed:', textStatus, errorThrown);
            alert('Error updating data.');
        }
    });
});

//unused
function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

//unused
function tableSearch() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchbar");
    filter = input.value.toUpperCase();
    table = document.getElementById("printTable");
    tr = table.getElementsByTagName("tr");
  
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 1; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
        if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
        }
    }
}

function refreshTable(){
    $('#printTable').DataTable();
}