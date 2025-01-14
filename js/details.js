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
                // console.log(item);
                
                if(item==null)
                    document.getElementById('detailsform').submit();
                else {
                    if (confirm("Maklumat pengguna tersedia. Kemaskini maklumat pengguna?")){
                        $("#targetid").val(item);
                        $("#detailsform").attr("action","editList.php");
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