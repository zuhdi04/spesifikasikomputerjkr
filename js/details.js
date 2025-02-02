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