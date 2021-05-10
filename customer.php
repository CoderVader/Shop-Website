<?
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'classicmodels';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);

        $sql = 'SELECT customerName, city, country,phone,salesRepEmployeeNumber, creditLimit
                FROM customers
                ORDER BY country';

        $q = $conn->query($sql);

        $q->setFetchMode(PDO::FETCH_ASSOC);

        }

        catch(PDOException $pe) {
            die("Could not Connect $dbname :".$pe->getMessage());
        }
?>


<!DOCTYPE html>
<html>
    <head>
    <title>Customers Page</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<body>
    <?
        require_once 'navbar.php';
    ?>


    <div id="container">

        <h2>CUSTOMERS</h2>
        <div id ="details"></div>
        <table border =2>
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>More Details</th>
                </tr>
            </thead>

            <tbody>
                <?
                    while($r = $q->fetch()):
                ?>

                <tr>
                    <td>
                        <?
                            echo htmlspecialchars($r['customerName']);
                        ?>
                    </td>

                    <td>
                        <?
                            echo htmlspecialchars($r['city']);
                        ?>
                    </td>

                    <td>
                        <?
                            echo htmlspecialchars($r['country']);
                        ?>
                    </td>


                    <td>

                        <?

                            $text = "Customer Contact: ".htmlspecialchars($r['phone'])."<br>";

                            $text .= "Sale Representative Number: ".htmlspecialchars($r['salesRepEmployeeNumber'])."<br>";

                            $text .= "Credit Limit: ".htmlspecialchars($r['creditLimit'])."<br>";

                            echo "<button onClick = \"display('$text'),hide('$text')\">More</button>";

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


        function display(msg) {
            document.getElementById("details").innerHTML = msg;
        }

        function hide(){
            var h = document.getElementById("details");
            if(h.style.display === "none"){
                h.style.display = "block";
            }
            else{
                h.style.display = "none";
            }
        }

    </script>
</body>
</html>
