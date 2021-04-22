<div class="container">
    <table class="table table-hover">
        <thead>
            <th>user_id</th>
            <th>email</th>
            <th>user_name</th>
            <th>user_pass</th>
            <th>user_type</th>
            <th>user_rank</th>
        </thead>

        <tbody>
            <?php
            foreach ($users as $dt) {
                echo "<tr>";
                echo "<td>" . $dt['user_id'] . "</td>";
                echo "<td>" . $dt['email'] . "</td>";
                echo "<td>" . $dt['user_name'] . "</td>";
                echo "<td>" . $dt['user_pass'] . "</td>";
                echo "<td>" . $dt['user_type'] . "</td>";
                echo "<td>" . $dt['user_rank'] . "</td>";
                echo "</tr>";
            }

            ?>


        </tbody>
    </table>
</div>