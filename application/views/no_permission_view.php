<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Permission</title>
</head>
<body>
    <h1>Access Denied</h1>
    <p>You do not have permission to access this page.</p>
    <a href="<?php echo site_url('login'); ?>">Go to Login Page</a>
</body>
</html>
