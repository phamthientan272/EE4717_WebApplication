var bordersize;
bordersize = prompt("Select a table border size \n" +
    " 0 (no border) \n" +
    "1 (1 pixel border) \n" +
    "4 (4 pixel border) \n" +
    "8 (8 pixel border)\n"
)

switch (bordersize) {
    case "0": document.write("<table>");
        break;
    case "1": document.write("<table border = '1'>");
        break;
    case "4": document.write("<table border = '4'>");
        break;
    case "8": document.write("<table border = '8'>");
        break;
    default: document.write("Error - invalid choices: ", bordersize, "<br />");
}

document.write("<caption> 20008 NFL Divisional", "Winner </caption>")
document.write("<tr>",
               "<th />",
               "<th> American Conference </th>",
               "<th> National Conference </th>",
               "</tr>",
               "<tr>",
               "<th> East </th>",
               "<td> Miami Dolphins </td>",
               "<td> New York Giants </td>",
               "</tr>",
               "</table>" )
