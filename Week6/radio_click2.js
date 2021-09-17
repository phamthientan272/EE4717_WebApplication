function planeChoice(plane){
    var dom = document.getElementById("myForm");
    for (var index=0; index<dom.planeButton.length; index++){
        if (dom.planeButton[index].checked){
            plane = don.planeButton[index].value;
            break;
        }
    }
    switch(plane){
        case 152:
            alert("A small 152");
            break;
        case 172:
            alert("The smaller of 172");
            break;
        case 182:
            alert("The larger of 182");
            break;
        default:
            alert("Error");
            break;
    }

}
