"use strict";
// toggle "other processor" textbox
$("input[name='proc']").click( function(){
    const otherProc = $("input[id='otherProcRadio']:checked").val();
    if (otherProc){
        $("#otherProcTxtBox").removeAttr("disabled").focus();
    }
    else $("#otherProcTxtBox").attr("disabled",true);
});

// toggle "project date" textbox
$("input[name='jenispc']").click( function(){
    const projectdate = $("input[id='projekRadio']:checked").val();
    if (projectdate){
        $("#projekDateInput").removeAttr("disabled").focus();
    }
    else $("#projekDateInput").attr("disabled",true);
});