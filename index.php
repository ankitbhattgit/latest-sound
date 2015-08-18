<?php
include("config.php");
$authorizeUrl = $soundcloud->getAuthorizeUrl();
?>


<!DOCTYPE html>

<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>demo.techumber.com</title>
  <style type="text/css">
  .container{
    width: 700px;
    margin: 0 auto;

  }
  .logo{
    text-align: center;
  }
  .login{
  text-align: center;
  }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="logo">
    <a href="http://techumber.com">
      <img src="img/logostd.png" alt="techumber logo" title="techumber logo" />
    </a>
  </h1>
  <a class="login"href="<?php echo $authorizeUrl; ?>">
    <img src="img/btn-connect-sc-l.png" />
  </a>
  </div>
</body>
</html>
