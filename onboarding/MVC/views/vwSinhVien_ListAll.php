<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List all</title>
</head>

<body>
    <h1>
        sinh vien list all
    </h1>

    <?php

    foreach ($data as $item) {
        print($item->MSSV . " " . $item->HOTEN . "<br/>");
    }
    ?>
</body>

</html>