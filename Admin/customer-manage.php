<?php


require_once '../Security/redirectToIfNotAdmin.php';
include_once '../layout/header.php';
include_once '../src/database.php';

$sql = "SELECT * FROM customer ;";
$customers = db_select($sql);

if(isset($_GET['delete-id']))
{
    $id=$_GET['delete-id'];
    $sql="Delete from customer WHERE id='$id'";
    db_delete($sql);
    $address = "Location: refresh.php?address=".$_SERVER['PHP_SELF'];
    header($address);
}

?>
    <script>
        function deleteRow(id) {

            if(confirm('Are you sure to delete ?'))window.open('../Admin/customer-manage.php?delete-id=' + id ,'_self');
        }
    </script>

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
                <th>FullName</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Visited Times</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>

                    <td style="text-align: center"><a href="customer-vist.php?id=<?=$customer['id']?>"><?= $customer['fullname'] ?></a></td>
                    <td style="text-align:center; color: #2e6da4"><?= $customer['address'] ?></td>
                    <td style="text-align:center; color: #2e6da4"><?= $customer['contact'] ?></td>
                    <td style="text-align:center; color: #2e6da4"><?= $customer['visits'] ?></td>

                    <td>
                        <a href="#"  class="delete" onclick="deleteRow('<?= $customer['id']?>')" >
                            Delete
                        </a>
                    </td>

                </tr>

            <?php endforeach; ?>
            </tbody>

        </table>

    </div>

<?php include_once '../layout/footer.php' ?>