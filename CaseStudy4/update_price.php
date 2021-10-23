<?php
$mysqli = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');

// function get_price()
// {
//     global $mysqli;
//     $result = $mysqli->query("select * from price");
//     $num_results = $result->num_rows;
//     $data = array();

//     for ($i = 0; $i < $num_results; $i++) {
//         $row = $result->fetch_assoc();

//         if(!isset($data[$row['product']])) {
//             $data[$row['product']] = array();
//         }
//         $data[$row['product']] = $row['price'];

//     }
//     $result->free();

//     return $data;
// }

function get_price($product, $category)
{
    global $mysqli;
    $result = $mysqli->query("select price from menu where product = '" . $product . "' and category = '" . $category . "' ");
    $row = $result->fetch_assoc();
    $price = $row['price'];
    $price = number_format((float)$price, 2, '.', '');
    return "$" . $price;
}

if (isset($_POST['update'])) {

    if (isset($_POST["justjavacheckbox"]) and $_POST["justjavanewprice"] > 0) {
        $mysqli->query("update menu  set price = '" . $_POST["justjavanewprice"] . "' where product = 'Just Java' and category = 'endless' ");
    }

    if (isset($_POST["cafecheckbox"]) and $_POST["cafenewprice"] > 0) {
        if ($_POST["cafeselection"] == "single") {
            $mysqli->query("update menu set price = '" . $_POST["cafenewprice"] . "' where product = 'Cafe au Lait' and category = 'single' ");
        } elseif ($_POST["cafeselection"] == "double") {
            $mysqli->query("update menu set price = '" . $_POST["cafenewprice"] . "' where product = 'Cafe au Lait' and category = 'double' ");
        }
    }


    if (isset($_POST["capcheckbox"])  and $_POST["capnewprice"] > 0) {
        if ($_POST["capselection"] == "single") {
            $mysqli->query("update menu set price = '" . $_POST["capnewprice"] . "' where product = 'Iced Cappuccino' and category = 'single' ");
        } elseif ($_POST["capselection"] == "double") {
            $mysqli->query("update menu set price = '" . $_POST["capnewprice"] . "' where product = 'Iced Cappuccino' and category = 'double' ");
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Menu</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="javajam.css">
</head>

<body>
    <div id="wrapper">
        <header>
            <img id="logo" src="javalogo.jpg" height="100" alt="JavaLogo">
        </header>

        <div id="leftcolumn">
            <nav>
                <ul>
                    <li><a href="update_price.php">Update Menu</a></li>
                    <li><a href="sales_report.php?date=<?php echo date('Y-m-d'); ?>">Sales Report</a></li>
                </ul>
            </nav>
        </div>

        <div id="rightcolumn">
            <div id="content">
                <h2>Coffee at JavaJam</h2>
                <form action="update_price.php" method='POST'>
                    <table id="table_menu">
                        <tr>
                            <th>Drink</th>
                            <th>Description</th>
                            <th>Selected</th>
                            <th>New Price $</th>
                        </tr>
                        <tr>
                            <th>Just Java</th>
                            <td>Regular house blend, decaffeinated coffee, or flavor of the day.<br>
                                <span class="highlight">Endless Cup
                                    <?php
                                    echo get_price("Just Java", "endless");
                                    ?>

                                </span>
                            </td>
                            <td align="center"><input type="checkbox" name="justjavacheckbox" class="inputmenu" value="checked">
                            </td>
                            <td align="center"><input type="number" name="justjavanewprice" class="inputmenu" onchange="if(this.value<0){this.value= this.value * -1}"></td>
                        </tr>
                        <tr>
                            <th>Cafe au Lait</th>
                            <td>House blended coffee infused into a smooth, steamed milk. <br>
                                <span class="highlight">
                                    <p>
                                        <label> <input class="price-selection highlight" type="radio" name="cafeselection" value="single" checked />Single
                                            <?php
                                            echo get_price("Cafe au Lait", "single");
                                            ?>
                                        </label>
                                        <label> <input class="price-selection highlight" type="radio" name="cafeselection" value="double" />Double
                                            <?php
                                            echo get_price("Cafe au Lait", "double");
                                            ?>
                                        </label>
                                    </p>
                                </span>
                            </td>
                            <td align="center"><input type="checkbox" value='checked' name="cafecheckbox" class="inputmenu"></td>
                            <td align="center"><input type="number" name="cafenewprice" class="inputmenu" onchange="if(this.value<0){this.value= this.value * -1}"></td>
                        </tr>
                        <tr>
                            <th>Iced Cappuccino</th>
                            <td>Sweetened espresso blended with icy-cold milk and served in a chilled glass. <br>
                                <span class="highlight">
                                    <p>
                                        <label> <input class="price-selection" type="radio" name="capselection" value="single" checked />Single
                                            <?php
                                            echo get_price("Iced Cappuccino", "single");
                                            ?>
                                        </label>
                                        <label> <input class="price-selection" type="radio" name="capselection" value="double" />Double
                                            <?php
                                            echo get_price("Iced Cappuccino", "double");
                                            ?>
                                        </label>
                                    </p>
                                </span>
                            </td>
                            <td align="center"><input type="checkbox" value='checked' name="capcheckbox" class="inputmenu"></td>
                            <td align="center"><input type="number" name="capnewprice" class="inputmenu" onchange="if(this.value<0){this.value= this.value * -1}"></td>
                        </tr>
                        <td></td>
                        <td></td>
                        <td colspan="2" align="center">
                            <button type="submit" name='update' value="Update">Update</button>
                        </td>
                        </tr>
                    </table>
                </form>

            </div>

        </div>


        <div>
            <footer>
                <small><i>
                        Copyright&copy 2014 JavaJam Coffee House <br>
                        <a href="mailto:thientan@pham.com">thientan@pham.com</a>
                    </i></small>
            </footer>
        </div>

    </div>
</body>

</html>
