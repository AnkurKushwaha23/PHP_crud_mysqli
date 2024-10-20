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
    <h2>Delete Record</h2>
    <!-- Form using POST method -->
    <form action="delete.php" method="POST">
        <label>Id:</label>
        <input type="text" id="id" name="id" required><br><br>

        <label>Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Submit" name="submit">
    </form>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    // Retrieve the data using POST
    $password = $_POST['password'];
    $user_id = $_POST['id'];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $fetch_record = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $fetch_record);
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the user data
        $user = mysqli_fetch_assoc($result);
        $stored_hash = $user['password']; // Get the hashed password


        // Verify the current password
        if (password_verify($password, $stored_hash)) {
            // Password matches, proceed to delete
            $sql = "DELETE FROM users WHERE id = $user_id";
            try {
                mysqli_query($conn, $sql);
                echo "record deleted successfully";

                // Redirect to avoid resubmission on refresh
                header("Location: delete.php");
                exit; // Ensure script stops after the redirect
            } catch (mysqli_sql_exception) {
                echo "Query failed";
            }
        } else {
            echo "password not right! try again ";
        }
    }
}
mysqli_close($conn);
?>
