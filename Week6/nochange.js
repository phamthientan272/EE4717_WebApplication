function computeCost()
{
    var french = document.getElementById("french").value;
    var hazlenut = document.getElementById("hazlenut").value;
    var columbian = document.getElementById("columbian").value;
    document.getElementById("cost").value = french*3.49 + hazlenut*3.95+columbian*4.59
}
