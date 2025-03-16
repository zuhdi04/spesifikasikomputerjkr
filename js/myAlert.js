function showAlert() {
    let popup = getCookie("alert");
    if (popup == "success_add") {
        alert("Maklumat berjaya ditambah.");
    }
    else if (popup == "success_edit") {
        alert("Maklumat berjaya dikemaskini.");
    }

    deleteCookie("alert");
}