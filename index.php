<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Message Board</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <style>
  .name {
    font-weight: bold;
  }
  .message{
    margin-left: 1em;
    font-style: italic;
  }
  .messages, .messagebox {
    margin-top: 3vh;
  }
  .row {
    padding-bottom: 0;
  }
  .input-group{
    width: 100%;
  }
  button{
    margin-top: 15px;
    float:right;
  }
  </style>
</head>
<body>
  <div class="container messagebox">
    <div class="row">
      <div class="col-md-8 col-md-push-2">
        <form action="post.php" method="post">
          <div class="input-group">
            <span class="input-group-addon">Name: </span>
            <input type="text" class="form-control" placeholder="John" name="name" required>
          </div>
          <br />
          <div class="input-group">
            <span class="input-group-addon">Message: </span>
            <input type="text" class="form-control" placeholder="Hello World!" name="message" required>
          </div>
          <div class="input-group">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <div class="container">

        <?php
        $servername = "localhost";
        $database = "messages";
        $username = "user";
        $password = "password";

        $conn = new mysqli($servername, $username, $password, $database);

        if($conn->connect_error) {
          ?>
          <script>alert("Connection to database failed.");</script>
          <?php
          die($conn->connect_error);
        }

        $selectMessagesSQL = "SELECT * FROM data ORDER BY id DESC";
        $messageList = $conn->query($selectMessagesSQL);

        if($messageList->num_rows > 0){
          $colors = array(" alert-success "," alert-info ", " alert-warning ", " alert-danger ");
          ?>
          <div class="row">
            <div class="col-md-8 col-md-push-2 messages">
              <?php
              while($row = $messageList->fetch_assoc()) {
                ?>
                <div class="alert <?php echo $colors[array_rand($colors)]; ?>" role="alert">
                  <?php
                  echo "<span class='name'>".$row["name"].": </span><span class='message'>".$row["message"]."</span>";
                  ?>
                </div>
                <?php
              }
              ?>
            </div>
            <?php
          }else{
            ?>
            <div class="row">
              <div class="col-md-8 col-md-push-2 messages">
                <div class="alert alert-danger" role="alert"><span style="font-weight: bold;">MessageBot: </span>There are no messages in the database!</div>
              </div>
              <?php
            }

            $conn->close();
            ?>
          </div>
        </body>
        </html>
