<?php
include("database.php");

$sql = "SELECT * FROM users";

try {
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // echo "1 record fetched successfully <br>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row["user_name"] . "<br>";
            echo $row["password"] . "<br>";
        };
    } else {
        echo "no such record found";
    }
} catch (mysqli_sql_exception) {
    echo "Query failed";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Search</h2>
    <!-- Form using POST method -->
    <form action="read.php" method="POST">
        <label>Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <!-- <label>Password:</label>
        <input type="password" id="password" name="password" required><br><br> -->

        <input type="submit" value="Submit" name="submit">
    </form>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    // Retrieve the data using POST
    $name = $_POST['name'];
    // $password = $_POST['password'];
    // $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM users WHERE user_name = '$name'";

    try {
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "1 record fetched successfully <br>";
            $row = mysqli_fetch_assoc($result);
            echo $row["user_name"] . "<br>";
            echo $row["password"] . "<br>";
        } else {
            echo "no such record found";
        }
    } catch (mysqli_sql_exception) {
        echo "Query failed";
    }

    // // Redirect to avoid resubmission on refresh
    // header("Location: read.php");
    // exit; // Ensure script stops after the redirect

}
mysqli_close($conn);
?>