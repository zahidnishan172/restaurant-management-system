<?php

include_once '../layout/header.php';
require_once '../src/database.php';
$customerId = $_GET['id'];
$historyQuery = "select fullname,date from history,customer where customer.id = '".$customerId."' and customer.id=history.customerId";
$history = db_select($historyQuery);
?>

<style>
    .table thead {
        background-color: #3341FF;
        color: #fff;
    }

    .table > thead > tr > th {
        padding: 15px 0;
        text-align: center;
    }

    .table > thead > tr > th:first-child {
        border-top-left-radius: 10px;
    }

    .table > thead > tr > th:last-child {
        border-top-right-radius: 10px;
    }
</style>

<div class="table-responsive container row" style="margin-left: -30px;">


    <br>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>

        </tr>
        </thead>

        <tbody>
        <?php foreach ($history as $item): ?>
            <tr>

                <td style="text-align: center">
                    <?= $item['fullname']?></td>
                <td style="text-align:center; color: #2e6da4"><?= $item['date'] ?></td>

            </tr>

        <?php endforeach; ?>
        </tbody>

    </table>

</div>



<?php include_once '../layout/footer.php'?>
