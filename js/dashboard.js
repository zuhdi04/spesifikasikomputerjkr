function details(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var response = JSON.parse(this.responseText);
        $('#stafflist').empty();
        response.forEach(item => {
            $('#stafflist').append(`
                <tr>
                    <td id="pc_`+item.id+`">`+item.username+`</td>
                    <td>`+item.cawangan+`</td>
                    <td><a href="staff-edit.php?form=`+item.id+`" onclick="return false">Edit</a><a href="#" class="delete_details" data-id="`+item.id+`" onclick="return false;">Delete</a></td>
                </tr>`);
        });
    }
    xhttp.open("GET", "getstaffList.php", true);
    xhttp.send();
}