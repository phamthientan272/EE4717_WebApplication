var name_list = new Array("Al", "Betty", "Kasper", "Michael", "Roberto", "Zimbo");
var new_name, index, last;

while (new_name = prompt("Please type a new name", "")){
    last = name_list.length - 1;
    while (last >=0 && name_list[last] > new_name ){
        name_list[last + 1] = name_list[last];
        last --;
    }
    name_list[last + 1] = new_name;

    document.write("<p><b>The new name list is: </b> ", "<br />");
    for (index = 0; index < name_list.length; index++)
        document.write(name_list[index], "<br />");
    document.write("</p>");
}
