function validate(formname,name,displayname){
    var value = document.forms[formname][name].value;
    let message = "PLEASE IN THE BLANK" + displayname;
    if(value == ""){
        alert(message);
        return false;
    }
    else{
        return true;
    }
}