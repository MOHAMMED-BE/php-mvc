<?php
if (isset($_SESSION['user'])) {
    header('Location: index.php?product/index');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="container mt-5">
        <form action="/phpmvc/index.php?user/logincheck" method="POST" enctype="multipart/form-data" id="loginForm" class="p-4 border rounded bg-light">
            <div class="mb-3">
                <label for="username" class="form-label">username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
                <!-- <div id="usernameHelp" class="form-text">Enter the login username (minimum 3 characters).</div> -->
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
                <!-- <div id="passwordHelp" class="form-text">Enter the login password (minimum 3 characters).</div> -->
            </div>
            <button type="submit" class="btn btn-success">Login</button>
            <hr>
            <div class="active">Need an account? <a href="index.php?user/signup" class="text-primary nav-link d-inline">Signup</a></div>
        </form>
    </div>

</body>

</html>