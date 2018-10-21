
<?php
/**
 * Created by PhpStorm.
 * User: sean
 * Date: 10/19/18
 * Time: 5:04 PM
 */
?>

<html>
<body>

<h1>Welcome to my home page!</h1>

<?php include 'pageHeader.php';?>

</body>
</html>



<html>
<title> PHP MYSQL - Search</title>
<head>
</head>

<body>
<form action="searchResult.php" method="POST">
    <center><h3>Search Database</h3></center>
    <center><table>
            <tr>
                <td>Search</td>
                <td><input type="text" name="name" size="100"></td>
                <td><input type="submit" name="submit"></td>
            </tr>
        </table></center>
</form>
</body>

</html>
