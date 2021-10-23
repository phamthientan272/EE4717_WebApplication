<?php
$mysqli = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');

function get_quantity($date, $product, $category)
{
    global $mysqli;
    $query = "select sum(quantity) from transaction where
    date = '" . $date . "' and product = '" . $product . "' and category = '" . $category . "' ";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $quantity = $row['sum(quantity)'];
    if (is_null($quantity)) {
        $quantity = 0;
    }
    return  $quantity;
}

function get_total_quantity($date)
{
    global $mysqli;
    $query = "select sum(quantity) from transaction where
    date = '" . $date . "' ";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $quantity = $row['sum(quantity)'];
    if (is_null($quantity)) {
        $quantity = 0;
    }
    return  $quantity;
}

function get_sales($date, $product)
{
    global $mysqli;

    $query = "select category from menu where product = '" . $product . "' ";
    $result = $mysqli->query($query);
    $num_results = $result->num_rows;
    $total_price = 0;
    for ($i = 0; $i < $num_results; $i++) {
        $row = $result->fetch_assoc();
        $category = $row["category"];

        $query = "select price from menu where product = '" . $product . "' and category = '" . $category . "' ";
        $price_request = $mysqli->query($query);
        $price_row = $price_request->fetch_assoc();
        $price = $price_row["price"];

        $quantity = get_quantity($date, $product, $category);

        $total_price += $price * $quantity;
    }
    $total_price = number_format((float)$total_price, 2, '.', '');
    return $total_price;
}

function get_total_sales($date)
{
    $justjava_sales = get_sales($date, "Just Java");
    $cafe_sales = get_sales($date, "Cafe au Lait");
    $cap_sales = get_sales($date, "Iced Cappuccino");
    $total_price = $justjava_sales + $cafe_sales + $cap_sales;
    $total_price = number_format((float)$total_price, 2, '.', '');
    return $total_price;
}

function get_price($product, $category)
{
    global $mysqli;
    $query = "select price from menu where product = '" . $product . "' and category = '" . $category . "' ";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    return $row["price"];
}

function get_max_sale_product_category($date)
{
    global $mysqli;
    $query = "SELECT distinct product, category from menu";
    $result = $mysqli->query($query);
    $num_results = $result->num_rows;
    $max_profit = 0;
    $max_profit_product = "";
    $max_profit_category = "";
    for ($i = 0; $i < $num_results; $i++) {
        $row = $result->fetch_assoc();
        $product = $row["product"];
        $category = $row["category"];

        $quantity =  get_quantity($date, $product, $category);
        $price = get_price($product, $category);
        $sales = $quantity * $price;
        if ($sales >= $max_profit) {
            $max_profit = $sales;
            $max_profit_product =  $product;
            $max_profit_category = $category;
        }
    }

    $max_profit = number_format((float)$max_profit, 2, '.', '');
    return $max_profit_product . " " . $max_profit_category . " cup has the highest dollar sales with $" . $max_profit;
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
                <label for="startDate"><span class="highlight"> Sales Report For Date:</span></label>
                <input class='job-fields' type="date" name="startDate" id="startDate" onchange="changeDate(this)" max="<?php echo date('Y-m-d'); ?>" value="<?php
                                                                                                                                                            if (isset($_GET['date'])) {
                                                                                                                                                                echo $_GET['date'];
                                                                                                                                                            } else echo date('Y-m-d'); ?>" />
                <script>
                    function changeDate(event) {
                        new_path = `sales_report.php?date=${event.value}`;
                        location.replace(new_path);
                    }
                </script>
                <div>
                    <h2>Total dollar sales by products:</h2>
                    <table id="table_menu">
                        <tr>
                            <th>Product</th>
                            <th>Sales $</th>
                        </tr>
                        <tr>
                            <th>Just Java</th>
                            <td>
                                <?php
                                if (isset($_GET['date'])) {
                                    echo get_sales($_GET['date'], "Just Java");
                                } else {
                                    echo get_sales(date("Y-m-d"), "Just Java");
                                }

                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Cafe au Lait</th>
                            <td>
                                <?php
                                if (isset($_GET['date'])) {
                                    echo get_sales($_GET['date'], "Cafe au Lait");
                                } else {
                                    echo get_sales(date("Y-m-d"), "Cafe au Lait");
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Iced Cappuccino</th>
                            <td>
                                <?php
                                if (isset($_GET['date'])) {
                                    echo get_sales($_GET['date'], "Iced Cappuccino");
                                } else {
                                    echo get_sales(date("Y-m-d"), "Iced Cappuccino");
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>
                                <?php
                                if (isset($_GET['date'])) {
                                    echo get_total_sales($_GET['date']);
                                } else {
                                    echo get_total_sales(date("Y-m-d"));
                                }
                                ?>
                            </td>
                        </tr>
                    </table>

                </div>


                <div>
                    <h2>Sales quantities by product categories</h2>
                    <table id="table_menu">
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Quantity</th>
                        </tr>
                        <tr>
                            <th>Just Java</th>
                            <td>Endless Cup</td>
                            <td>
                                <?php
                                if (isset($_GET['date'])) {
                                    echo get_quantity($_GET['date'], "Just Java", "endless");
                                } else {
                                    echo get_quantity(date("Y-m-d"), "Just Java", "endless");
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th rowspan="2">Cafe au Lait</th>
                            <td>Single Cup</td>
                            <td>
                                <?php
                                if (isset($_GET['date'])) {
                                    echo get_quantity($_GET['date'], "Cafe au Lait", "single");
                                } else {
                                    echo get_quantity(date("Y-m-d"), "Cafe au Lait", "single");
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Double Cup</td>
                            <td>
                                <?php
                                if (isset($_GET['date'])) {
                                    echo get_quantity($_GET['date'], "Cafe au Lait", "double");
                                } else {
                                    echo get_quantity(date("Y-m-d"), "Cafe au Lait", "double");
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th rowspan="2">Iced Cappuccino</th>
                            <td>Single Cup</td>
                            <td>
                                <?php
                                if (isset($_GET['date'])) {
                                    echo get_quantity($_GET['date'], "Iced Cappuccino", "single");
                                } else {
                                    echo get_quantity(date("Y-m-d"), "Iced Cappuccino", "single");
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Double Cup</td>
                            <td>
                                <?php
                                if (isset($_GET['date'])) {
                                    echo get_quantity($_GET['date'], "Iced Cappuccino", "double");
                                } else {
                                    echo get_quantity(date("Y-m-d"), "Iced Cappuccino", "double");
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2">Total</th>
                            <td>
                                <?php
                                if (isset($_GET['date'])) {
                                    echo get_total_quantity($_GET['date']);
                                } else {
                                    echo get_total_quantity(date("Y-m-d"));
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <p>
                    <?php
                    if (isset($_GET['date'])) {
                        echo get_max_sale_product_category($_GET['date']);
                    } else {
                        echo get_total_quantity(date("Y-m-d"));
                    }
                    ?>
                </p>



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
