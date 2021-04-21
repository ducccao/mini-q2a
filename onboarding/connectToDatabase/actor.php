<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>All actor</h1>

    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "sakila";
    $mysqli = new mysqli($servername, $username, $password, $db);




    if ($mysqli->connect_error) {
        die("Connection failed " . $mysqli->connect_error);
    }
    echo "Connected successfully";
    echo "<br>";

    $sql = 'SELECT * FROM `actor`  ';


    if (mysqli_query($mysqli, $sql)) {
        echo "New record created successfully!\n";

        $ret = $mysqli->query($sql);

        $row = $ret->fetch_array(MYSQLI_NUM);
        $row = $ret->fetch_array(MYSQLI_ASSOC);
        printf($row["first_name"] . $row["last_name"]);
    } else {
        echo "Error " . $sql . "<br>" . mysqli_error($mysqli);
    }

    ?>

    <table class="table">

        <thead>
            <th>
                actor_id
            </th>
            <th>
                first_name
            </th>
            <th>
                last_name
            </th>
            <th>
                last_update
            </th>
        </thead>

        <!-- <tbody>
            <td>
                <?php
                echo $rows['first_name'];
                ?>

            </td>
            <td>
                <?php
                echo $rows['first_name'];
                ?>

            </td>
            <td>
                <?php
                echo $rows['first_name'];
                ?>

            </td>

            <td>
                <?php
                echo $rows['first_name'];
                ?>

            </td>

        </tbody> -->

    </table>

</body>

</html>