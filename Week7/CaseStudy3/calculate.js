function computeCost(){
    var justjavaqty = document.getElementById("justjavaqty").value;
    var cafeqty = document.getElementById("cafeqty").value;
    var capqty = document.getElementById("capqty").value;

    var cafeprice = document.querySelector('input[name="cafeprice"]:checked').value;
    var capprice = document.querySelector('input[name="capprice"]:checked').value;


    var justjavasubtotal = justjavaqty*2.0;
    var cafesubtotal = cafeqty*cafeprice;
    var capsubtotal = capqty*capprice;

    var total = justjavasubtotal + cafesubtotal + capsubtotal;

    document.getElementById("justjavasubtotal").value = justjavasubtotal;
    document.getElementById("cafesubtotal").value = cafesubtotal;
    document.getElementById("capsubtotal").value = capsubtotal;
    document.getElementById("total").value = total;
}

var javaNode = document.getElementById("justjavaqty");
javaNode.addEventListener("change", computeCost, false);

var cafeNode = document.getElementById("cafeqty");
cafeNode.addEventListener("change", computeCost, false);

var capNode = document.getElementById("capqty");
capNode.addEventListener("change", computeCost, false);
