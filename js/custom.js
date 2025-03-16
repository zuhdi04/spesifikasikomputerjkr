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