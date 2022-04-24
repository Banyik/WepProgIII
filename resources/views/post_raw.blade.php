<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Raw Post</title>
</head>
<body>
    <h1>{{$id->post_title}}</h1>
    <?php
    echo $text = $id->post;
    ?>
</body>
</html>
