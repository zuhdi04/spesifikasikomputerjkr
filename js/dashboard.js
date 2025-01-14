function details(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var response = JSON.parse(this.responseText);
        $('#stafflist').empty();
        response.forEach(item => {
            $('#stafflist').append(`
                <tr>
                    <td>`+item.username+`</td>
                    <td>`+item.cawangan+`</td>
                    <td><a href="staff-edit.php?form=`+item.id+`" onclick="return false">Edit</a>
                    <a href="delete" class="delete_details" data-name="`+item.username+`" onclick="return false;">Delete</a></td>
                </tr>`);
        });
    }
    xhttp.open("GET", "getstaffList.php", true);
    xhttp.send();
}

$('#staffTable').on('click','.delete_details',function(){
    let n = $(this).data('name');
    
    if(confirm("Adakah anda mahu memadam akaun: "+n+"?")){
        // Perform AJAX request
        $.ajax({
            url: 'deletestaffList.php', // Replace with your API endpoint
            method: 'POST', // Use POST for updates
            data: {
                target: n
            },
            success: function(response) {
                // Handle successful response
                console.log('Update successful:', response);
                alert('Akaun telah dipadam!');
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