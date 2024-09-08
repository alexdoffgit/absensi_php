
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/absensi_php/assets/base.css" type="text/css">
    <link rel="stylesheet" href="/absensi_php/assets/login.css" type="text/css">
    <title>Login</title>
</head>
<body>
    <div class="login-container-center">
        <div class="formbox">
            <h1>Login</h1>
            <form action="/action/login.php" method="post">
                <div class="form-field">
                    <label for="fullname">Name</label>
                    <input type="text" name="fullname" id="fullname">
                </div>
                <div class="form-field">
                    <label for="passwd">Password</label>
                    <input type="password" name="passwd" id="passwd">
                </div>
                <button type="submit" class="btn">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>