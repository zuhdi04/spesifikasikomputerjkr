function showAlert(){
    let popup = getCookie("alert");
    if(popup=="success_add"){
        alert("Maklumat berjaya ditambah.");
        deleteCookie("alert");
    }
    else if (popup=="success_edit"){
        alert("Maklumat berjaya dikemaskini.");
        deleteCookie("alert");
    }
    
    deleteCookie("alert");
}