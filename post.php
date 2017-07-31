<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta http-equiv="Refresh" content="5; url=./" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <style>
  </style>
</head>
<body>
  <div class="container" style="margin-top: 3vh;">
    <div class="row">
      <div class="col-md-8 col-md-push-2">
        <?php

        $servername = "localhost";
        $database = "messages";
        $username = "user";
        $password = "password";

        $conn = new mysqli($servername, $username, $password, $database);

        $name1 = filter_var($_POST['name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $message1 = filter_var($_POST['message'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sql = "INSERT INTO data(name, message) VALUES ('".$name1."', '".$message1."');";

        if ($conn->query($sql) === TRUE) {
          ?>
          <div class="col-md-8 col-md-push-2 messages">
            <div class="alert alert-success" role="alert"><span style="font-weight: bold;">MessageBot: </span>New record created successfully!</div>
          </div>
          <?php
        } else {
          ?>
          <div class="col-md-8 col-md-push-2 messages">
            <div class="alert alert-danger" role="alert"><span style="font-weight: bold;">MessageBot: </span>Error( <?php echo $conn->error; ?> )"</div>
          </div>
          <?php
        }

        $conn->close();

        ?>
      </div>
    </div>
  </body>
  </html>
