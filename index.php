<?php
include("database.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>User Login</h2>
    <!-- Form using POST method -->
    <form action="index.php" method="POST">
        <label>Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label>Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Submit" name="submit">
    </form>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    // Retrieve the data using POST
    $name = $_POST['name'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (user_name, password) VALUES ('$name','$hash') ";

    try {
        mysqli_query($conn, $sql);
        echo "New record created successfully";
    } catch (mysqli_sql_exception) {
        echo "Query failed";
    }

    // Redirect to avoid resubmission on refresh
    header("Location: index.php");
    exit; // Ensure script stops after the redirect

}
mysqli_close($conn);
?>