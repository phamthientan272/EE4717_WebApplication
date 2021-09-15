function tst_phone_num(num){
    var ok = num.search(/^\d{3}-\d{4}$/);

    if (ok==0)
        return true;
    else
        return false;
}

var tst = tst_phone_num("444-4312");
if (tst){
    document.write("444-4321 is a valid phone number <br />");
}
else{
    document.write("Program error <br />");
}

tst = tst_phone_num("312-r134")
if (tst){
    document.write("Program error <br />");

}
else{
    document.write("312-r134 is a valid phone number <br />");
}
