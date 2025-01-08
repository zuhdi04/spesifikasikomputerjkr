document.getElementById('detailsform').addEventListener('submit', function(e) {
    e.preventDefault();  // Prevent the form from submitting normally

    // Get the form data
    const target = document.getElementById('fullname').value;
    $.ajax({
        url: 'checkList.php?content='+target, // Replace with your API endpoint
        method: 'GET',
        success: function(response) {
            if(response!=""){
                let item =  JSON.parse(response);
                if(item==null)
                    document.getElementById('detailsform').submit();
                else alert("Update details?");
                // console.log(item);
            }
            else{
            }
        },
        
        error: function(jqXHR, textStatus, errorThrown) {
            // document.getElementById('username').innerHTML="";
        }
    });

});