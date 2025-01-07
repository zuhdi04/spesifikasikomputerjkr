let idx = 0;
let namelist = [];

// $('#addStaffBtn').click(tableAddStaff);

function tableAddStaff(){
    idx+=1;
    let staffname=$('#fullname').val();
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
    else namelist.push(staffname);

    $('#stafflist').append(`
    <tr>
        <td>`+idx+`</td>
        <td>`+staffname+`</td>
        <td>`+second+`</td>
        <td>`+third+`</td>
        <td>`+kakitangan+`</td>
        <td>`+fifth+`</td>
        <td>`+pcage+`</td>
        <td>`+proc+`</td>
        <td>`+ram+`</td>
        <td>`+systemtype+`</td>
        <td>`+antivirus+`</td>
        <td>`+ipaddress+`</td>
        <td>`+catatan+`</td>
    </tr>`);
}

$('#otherProcRadio').click(function(){
    $('#otherProcTxtBox').removeAttr("disabled");
})