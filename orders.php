<html>
    <head>
    <title>Orders Page</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<body>
    <?
        require_once 'navbar.php';
    ?>

    <div id="container">

        <!--Database Query -->

    <?
            $host = 'localhost';
            $username = 'root';
            $password = '';
            $dbname = 'classicmodels';

    try {
            $conn = new
            PDO("mysql:host=$host;dbname=$dbname",$username,$password);

            $sql = 'SELECT orderNumber, orderDate, status, customerNumber, comments FROM orders WHERE status="In process" ORDER BY orderNumber';

            $q = $conn->query($sql);

            $q->setFetchMode(PDO::FETCH_ASSOC);
    }

            catch(PDOException $pe) {
                die("Could not Connect $dbname: ".$pe->getMessage());
        }
    ?>

        <h2> Orders in Progress</h2>
        <div id="ord_details"></div>
        <div id="cust_details"></div>
        <table border = 2>
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Order Date</th>
                    <th>Order Status</th>
                    <th>Customer Reference Number</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

                <?
                    while($r = $q->fetch()):
                ?>

                <?
                    $ordernum = htmlspecialchars($r['orderNumber']);
                    $custnum = htmlspecialchars($r['customerNumber']);

                    try {
                    $conn = new
                    PDO("mysql:host=$host;dbname=$dbname",$username,$password);

                    $sql1 = "SELECT o.comments, o.orderNumber, p.productCode, p.productLine, p.productName, c.customerNumber, c.phone, c.salesRepEmployeeNumber, c.creditLimit FROM products p, customers c, orders o, orderdetails od WHERE o.orderNumber='$ordernum' and o.customerNumber='$custnum' and o.orderNumber = od.orderNumber and od.productCode=p.productCode and o.customerNumber=c.customerNumber";

                    $q1 = $conn->query($sql1);

                    $q1->setFetchMode(PDO::FETCH_ASSOC);
            }

                    catch(PDOException $pe) {
                        die("Could not Connect $dbname: ".$pe->getMessage());
                }
                ?>

                <?

                    $text="";
                    while($r1 = $q1->fetch()):
                ?>

                <?

                    $text = "Order Number: " .htmlspecialchars($r1['orderNumber'])."<br>";
                    $text .="Product Code: " .htmlspecialchars($r1['productCode'])."<br>";
                    $text .="Product Line: " .htmlspecialchars($r1['productLine'])."<br>";
                    $text .="Product Name: " .htmlspecialchars($r1['productName'])."<br>";
                    $text .="Comments: " .htmlspecialchars($r1['comments'])."<br>";
                    $text1="";

                    $text1 .="Customer Contact: " .htmlspecialchars($r1['phone'])."<br>";
                    $text1 .="Sales Rep Number: " .htmlspecialchars($r1['salesRepEmployeeNumber'])."<br>";
                    $text1 .="Credit Limit: " .htmlspecialchars($r1['creditLimit'])."<br>";

                ?>
                <? endwhile; ?>

                <tr>
                     <td>
                            <?

                            echo"<button onClick = \"display('$text'),hide_display('$text')\">".$r['orderNumber']."</button>";
                            ?>
                    </td>

                    <td>
                        <?
                            echo htmlspecialchars($r['orderDate'])."<br>";
                        ?>
                    </td>
                    <td>
                        <?
                            echo htmlspecialchars($r['status'])."<br>";
                        ?>
                    </td>

                    <td>
                            <?

                            echo"<button onClick = \"display_order('$text1'),hide_custom('$text1')\">".$r['customerNumber']."</button>";
                            ?>
                    </td>

                </tr>
            <? endwhile; ?>
            </tbody>
        </table>

    </div>

  <div id="container2">
        <div id="rec_order"></div>
        <div id="rec_custom"></div>
        <!--Database Query -->

    <?
            $host = 'localhost';
            $username = 'root';
            $password = '';
            $dbname = 'classicmodels';

    try {
            $conn = new
            PDO("mysql:host=$host;dbname=$dbname",$username,$password);

            $sqla = 'SELECT orderNumber, orderDate, status, customerNumber FROM orders ORDER BY orderDate DESC LIMIT 0,20';

            $qa = $conn->query($sqla);

            $qa->setFetchMode(PDO::FETCH_ASSOC);
    }

            catch(PDOException $pe) {
                die("Could not Connect $dbname: ".$pe->getMessage());
        }
    ?>

        <h2> Recent Orders</h2>

        <table border = 2>
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Order Date</th>
                    <th>Order Status</th>
                    <th>Customer Reference Number</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

                <?
                    while($ra = $qa->fetch()):
                ?>

                <?
                    $ordernum = htmlspecialchars($ra['orderNumber']);
                    $custnum = htmlspecialchars($ra['customerNumber']);

                    try {
                    $conn = new
                    PDO("mysql:host=$host;dbname=$dbname",$username,$password);

                    $sqla1 = "SELECT o.comments, o.orderNumber, p.productCode, p.productLine, p.productName, c.customerNumber, c.phone, c.salesRepEmployeeNumber, c.creditLimit FROM products p, customers c, orders o, orderdetails od WHERE o.orderNumber='$ordernum' and o.customerNumber='$custnum' and o.orderNumber = od.orderNumber and od.productCode=p.productCode and o.customerNumber=c.customerNumber";

                    $qa1 = $conn->query($sqla1);

                    $qa1->setFetchMode(PDO::FETCH_ASSOC);
            }

                    catch(PDOException $pe) {
                        die("Could not Connect $dbname: ".$pe->getMessage());
                }
                ?>

                <?

                    $text="";
                    while($ra1 = $qa1->fetch()):
                ?>

                <?

                    $text = "Order Number: " .htmlspecialchars($ra1['orderNumber'])."<br>";
                    $text .="Product Code: " .htmlspecialchars($ra1['productCode'])."<br>";
                    $text .="Product Line: " .htmlspecialchars($ra1['productLine'])."<br>";
                    $text .="Product Name: " .htmlspecialchars($ra1['productName'])."<br>";
                    $text .="Comments: " .htmlspecialchars($ra1['comments'])."<br>";
                    $text1="";

                    $text1 .="Customer Contact: " .htmlspecialchars($ra1['phone'])."<br>";
                    $text1 .="Sales Rep Number: " .htmlspecialchars($ra1['salesRepEmployeeNumber'])."<br>";
                    $text1 .="Credit Limit: " .htmlspecialchars($ra1['creditLimit'])."<br>";

                ?>
                <? endwhile; ?>

                <tr>

                     <td>
                            <?

                            echo"<button onClick = \"display_record('$text'),hide_record('$text')\">".$ra['orderNumber']."</button>";
                            ?>
                    </td>

                    <td>
                        <?
                            echo htmlspecialchars($ra['orderDate'])."<br>";
                        ?>
                    </td>
                    <td>
                        <?
                            echo htmlspecialchars($ra['status'])."<br>";
                        ?>
                    </td>

                    <td>
                            <?

                            echo"<button onClick = \"display_recust('$text1'),hide_recust('$text1')\">".$ra['customerNumber']."</button>";
                            ?>
                    </td>

                </tr>
            <? endwhile; ?>
            </tbody>
        </table>

    </div>

    <?
        require_once 'footer.php';
    ?>


    <script>

        // Functions for Table 1

        //order Number
            function display(info) {
                document.getElementById('ord_details').innerHTML = info;
            }

            function hide_display() {
                var h1 = document.getElementById("ord_details");
                if(h1.style.display === "none"){
                    h1.style.display ="block";
                }
                else{
                    h1.style.display = "none";
                }
            }
        //customer Details
            function display_order(info1) {
                document.getElementById('cust_details').innerHTML = info1;
            }

            function hide_custom() {
                var h2 = document.getElementById('cust_details');
                if(h2.style.display === "none"){
                    h2.style.display = "block";
                }
                else{
                    h2.style.display = "none";
                }
            }


        //Functions For Table 2

            function display_record(info2) {
                document.getElementById('rec_order').innerHTML = info2;
            }

            function hide_record(){
                var h3 = document.getElementById("rec_order");
                if(h3.style.display === "none"){
                    h3.style.display = "block";
                }
                else{
                    h3.style.display = "none";
                }
            }

            function display_recust(info3) {
                document.getElementById('rec_custom').innerHTML = info3;
            }

            function hide_recust(){
                var h4 = document.getElementById("rec_custom");
                if(h4.style.display === "none"){
                    h4.style.display = "block";
                }
                else {
                    h4.style.display = "none";
                }
            }

    </script>
</body>
</html>
