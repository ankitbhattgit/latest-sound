    <?php
    if($_POST)
    {
      include("config.php");
      $soundcloud->setAccessToken($_POST['access_token']);

      $mytrack = array(
        'track[title]' => $_POST["audioname"],
        'track[asset_data]' => '@'.$_FILES["audiofile"]["tmp_name"]
         );

      $track = json_decode($soundcloud->post('tracks', $mytrack));
      echo '<p><b>Congrats your file successfully uploaded to <a target="_blank" href="'.$track->permalink_url.'">'.$track->permalink_url.'</a>';

            sleep(3);
      $embed_html = json_decode($soundcloud->get('oembed', array('url' => $track_url)));
      echo $embed_html->html;
    }
    else
    if($_GET['access_token']){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>Sound Cloud Tutorials:Uploading Audio Files:demo.techumber.com</title>
      <style type="text/css">
      body {
      font-family: "Comic Sans MS", Helvetica, Arial, sans-serif;
      font-size: 14px;
      line-height: 32px;
      color: #333333;
      font-weight: normal;
      }
      .container{
       width: 500px;
       margin: 0 auto;
       }
       #upload_result{
        border: 1px solid #cccccc;
        border-radius: 4px;
        padding: 0 20px 20px;
      }
      input[type="text"],input[type="file"] {
      border: 1px solid #cccccc;
      box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
      outline: none;
      padding: 4px 6px;
      font-size: 14px;
      line-height: 20px;
      color: #555555;
      border-radius: 3px;
      width: 325px;
      float: right;
      }
      input[type="submit"] {
      display: block;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
      margin: 5px 0 0 60px;
      padding: 6px 10px;
      border: 1px solid #777;
      background: #333537;
      border-radius: 5px;
      }
      </style>
    </head>
    <body>
      <div class="container">
      <div id="upload_result">
        <p>Download this <a href="airtelbirdmix.mp3">airtelbirdmix.mp3</a>(80k) file and use it for upload if you want to test fast</p>
      <form action="" method="post" enctype="multipart/form-data">
       <input type="hidden" name="access_token" value="<?php echo $_GET['access_token']; ?>" />
       <br />
       Audio Name:<input type="text" name="audioname" placeholder="My audio" /><br /><br />
       Audio File: <input type="file" name="audiofile" id="audiofile" />
       <br /><br />
       <input type="submit" />
      </form>
      </div>
      </div>
    </body>
    </html>

    <?php
    }
    else{
     die('erorr uploading');
    }
    ?>