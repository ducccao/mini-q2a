<form action="" method="GET">
    <div class="form-group">
        <label for="email">Email: </label>
        <input type="text" name="txtEmail" id="txtEmail" class="form-control" aria-describedby="helpId">
    </div>
    <div class="form-group">
        <label for="email">Username: </label>
        <input type="text" name="txtUsername" id="txtUsername" class="form-control" aria-describedby="helpId">
    </div>

    <div class="form-group">
        <label for="email">Password: </label>
        <input type="text" name="txtPassword" id="txtPassword" class="form-control" aria-describedby="helpId">
    </div>

    <button class="btn btn-success" type="submit">Submit</button>
</form>


<?php
$email = $_REQUEST['txtEmail'];
$user_name = $_REQUEST['txtUsername'];
$user_pass = $_REQUEST['txtPassword'];

$sql = "INSERT INTO `users`(email,user_name,user_pass,user_type,user_rank)
        VALUES ('$email','$user_name','$user_pass','user','200');";

$ret = $db->patchDb($sql);

if ($ret == 1) {
    echo "User was added successfully!";
} else {
    echo "Add user failed!";
    echo "Error: " . $ret;
}



?>

</div>