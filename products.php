<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Classic Models">
        <title>Products</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            body{
                background-image: url('images/bg-1.jpg');
            }
        </style>
    </head>
<body>

    <? require_once 'navbar.php';?>

<div id="container">
    <h2>Greetings from the Classic Company</h2>
    <p> We deliver above expectations. Check out our product lines below</p>
    <div id="selection">

    <form action="products.php" method="post">
    <select name="select" id="select">
        <option>Our Range</option>
        <option value="Classic Cars">Classic Cars</option>
        <option value="Motorcycles">Motorcycles</option>
        <option value="Planes">Planes</option>
        <option value="Ships">Ships</option>
        <option value="Trains">Trains</option>
        <option value="Trucks and Buses">Trucks and Buses</option>
        <option value="Vintage Cars">Vintage Cars</option>

    </select>

        <button type="submit" name="submit" value="submit"/>Submit

    </form>
    <br>

</div>

<div id="reserve">
<?

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'classicmodels';

  try {$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username, $password);

  if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_REQUEST['submit']))
  {
    global $selected_value;
  $selected_value = $_REQUEST['select'];

  }}
  global $selected_value;
  $sql = "SELECT productcode,
  productname,
  productline,
  productscale,
  productvendor,
  productdescription,
  quantityinstock,
  buyprice,
  msrp
  FROM products
  WHERE productline='$selected_value'";


  $q = $conn->query($sql);

  $q->setFetchMode(PDO::FETCH_ASSOC);
if( isset($selected_value) && ($selected_value!=null) && ($selected_value!=1))
{
echo"<table border = 2 id='table1'><thead><tr><th>Product Code</th><th>Product Name</th><th>Product Line</th><th>Product Scale</th><th>Product Vendor</th>
<th>Product Description</th><th>Quantity In stock</th><th>Buy price</th><th>MSRP</th></tr></thead>";
echo"<tbody>";
while ($r = $q->fetch()):
echo"<tr>";
echo"<td>$r[productcode] </td>";
echo"<td>$r[productname]</td>";
echo"<td>$r[productline]</td>";
echo"<td>$r[productscale]</td>";
echo"<td>$r[productvendor]</td>";
echo"<td>$r[productdescription]</td>";
echo"<td>$r[quantityinstock]</td>";
echo"<td>$r[buyprice]</td>";
echo"<td>$r[msrp]</td>";
echo"</tr>";
 endwhile;
echo"</tbody>";
echo"</table>";
  }
  }
  catch (PDOException $pe) {
  die("Could not connect to the database $dbname :" . $pe->getMessage());
  }
?>
</div>
    <br><br><br>
</div>


<script type="text/javascript">
  document.getElementById('select').value = "<?php echo $_POST['select'];?>";
</script>
</body>

</html>
