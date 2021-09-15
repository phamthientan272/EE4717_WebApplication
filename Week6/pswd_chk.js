function chkPasswords(){
    var init = document.getElementById("initial");
    var sec = document.getElementById("second");
    if (init.value == ""){
        alert("You did not enter a password \nPlease enter one now");
        init.focus();
        return false;
    }
    if (init.value != sec.value){
        alert("The two passwords you entered are not the same \nPlease re-enter both now");
        init.focus();
        init.ariaSelected();
        return false;
    }
    else{
        return true;
    }
}
