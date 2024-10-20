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
    <h2>Reset Password</h2>
    <!-- Form using POST method -->
    <form action="update.php" method="POST">
        <label>Id:</label>
        <input type="text" id="id" name="id" required><br><br>

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
    $user_id = $_POST['id'];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // $sql = "INSERT INTO users (user_name, password) VALUES ('$name','$hash') ";
    // Assuming you have $user_id of the user you want to update
    $sql = "UPDATE users SET user_name = '$name', password = '$hash' WHERE id = $user_id";


    try {
        mysqli_query($conn, $sql);
        echo "record updated successfully";
    } catch (mysqli_sql_exception) {
        echo "Query failed";
    }

    // Redirect to avoid resubmission on refresh
    header("Location: update.php");
    exit; // Ensure script stops after the redirect

}
mysqli_close($conn);
?>