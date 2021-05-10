<html>
<head>
  <title> PRODUCT LINES </title>
  <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <? 
        require_once 'navbar.php';
    ?>

<div id="container">
    <h2> Our Product Lines</h2>
<?

  $conn = mysqli_connect("localhost", "root", "", "classicmodels");

  if(mysqli_connect_error())
  {
      echo "Failed to connect to Database ". msqli_connect_error();
  }

  $result = mysqli_query($conn, "SELECT productLine, textDescription FROM productlines");

  echo "<table border = 2, margin: 10%>
  <tr>
  <th>Product Line</th>
  <th>Description</th>
  </tr>";

  while($row = mysqli_fetch_array($result))
  {
    echo "<tr>";
    echo "<td>" . $row['productLine'] . "</td>";
    echo "<td>" . $row['textDescription'] . "</td>";
    echo "</tr>";
  }

  echo "</table>";

  mysqli_close($conn);

  ?>

</div>
</body>
    <?
        require_once 'footer.php';
    ?>
</html>
