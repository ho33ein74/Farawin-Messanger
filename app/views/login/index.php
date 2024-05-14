<?= "username:  ". $_SESSION['username']; ?>

<html>
<body>
<form action="login/check_data" method="post" >
    <label>Username:</label>
    <input id="username" name="username" placeholder="Enter username" />
    <label>Password:</label>
    <input id="password" name="password" type="password" placeholder="Enter password" />
    <label>Confirm Password:</label>
    <input type="submit" value="send data"/>
</form>
</body>
</html>