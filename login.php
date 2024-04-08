<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $servername = "localhost";
    $db_username = "admin";
    $db_password = "k3HGicEbpEyw";
    $db_name = "website";

    $conn = new mysqli($servername, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    # mysql -u(user here) -p(put password here :D ) -h<host> -P<port>

    #insert INTO users (username, password) VALUES ("admin", "123");

    $sql_query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    $result = $conn->query($sql_query);

    if ($result->num_rows == 1 && (!(str_contains($username, "'")) || !(str_contains($password, "'")))) {


        $row = $result->fetch_object();
        $id = $row->id;

        $error = "Login successful - $id";



    } else {
        $error = 'Invalid username or password';

    }


}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>log in</h1>
    <?php if (isset($error)) : ?>
        <p><?php echo $error ?></p>
    <?php endif; ?>
    <form method="POST" action="">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>       
        <button type="submit" class="btn btn-primary" value = "Login" >Submit</button>
    </form>
</body>
</html>
