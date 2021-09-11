<?php

require_once '../Security/redirectToLogin-notLogin.php';
include_once '../layout/header.php';
require_once '../src/database.php';
?>

<script>
    function modalShow() {
        $('#myModal').css({'display':'block'});
    }
    function modalClose(){
        $('#modalTable').html("");
        $('#myModal').css({'display':'none'});
    }
    function modalActivate(orderId){
        $.post('../Security/jquery-process.php',{orderId:orderId},function(data){
            var orderDetail = JSON.parse(data);
            //console.log(orderDetail);
            var totalCost = 0;
            for(var i=0;i<orderDetail.length-3;i++){
                $('#modalTable').append("<tr>\n" +
                    "    <td>"+(i+1)+"</td>\n" +
                    "    <td>"+orderDetail[i].name+"</td>\n" +
                    "    <td>"+orderDetail[i].price+" Tk</td>\n" +
                    "    <td>"+orderDetail[i].amount+"</td>\n" +
                    "    <td>"+orderDetail[i].cost+" Tk</td>\n" +
                    "</tr>");
                totalCost += parseInt(orderDetail[i].cost);
            }
            $('#modalTable').append("<tr class=\"blank_row\" style='height: 20px;'>\n" +
                "            <td colspan=\"5\" class=\"blank_col\"></td>\n" +
                "        </tr>");
            $('#modalTable').append("<tr>\n" +
                "            <td colspan=\"2\" style='color: #1B6D85;font-weight: bold'>Admin FeedBack:</td>\n" +
                "            <td colspan=\"2\"></td>\n" +
                "            <td colspan=\"1\" style='color: green;font-weight: bold'>Total Cost :</td>\n" +
                "        </tr>");
            $('#modalTable').append("<tr>\n" +
                "            <td colspan=\"4\"><textarea rows=\"1\" class=\"form-control\" id=\"statusText\" style=\"width: 100%\" readonly>"+orderDetail[orderDetail.length-3].status+"</textarea></td>\n" +
                "            <td colspan=\"1\">"+totalCost+" Tk</td>\n" +
                "        </tr>");
            $('#modalTable').append("<tr>\n" +
                "            <td colspan=\"2\" style='text-align: left'>Phone NO:</td>\n" +
                "            <td colspan=\"1\"></td>\n" +
                "            <td colspan=\"1\" >Address :</td>\n" +
                "            <td colspan=\"1\"></td>\n" +
                "        </tr>");
            $('#modalTable').append("<tr>\n" +
                "            <td colspan=\"2\"><input class=\"form-control\" style=\"width: 70%; text-align: left\" value=\""+orderDetail[orderDetail.length-1].phoneno+"\" readonly></td>\n" +
                "            <td colspan=\"3\"><textarea class=\"form-control\" style=\"width: 100%\" rows=\"1\" readonly>"+orderDetail[orderDetail.length-2].delivaryaddress+"</textarea></td>\n" +
                "        </tr>");
        });
        modalShow();
    }
</script>

<style>

    .myTable thead{
        background-color: rgb(140, 0, 45);
        color: #fff;
    }

    .myTable > thead > tr > th{
        padding:15px 0;
        text-align: center;
    }

    .myTable > thead > tr > th:first-child{
        border-top-left-radius: 10px;
    }

    .myTable > thead > tr > th:last-child{
        border-top-right-radius: 10px;
    }
    .table > tbody > tr > td {
        text-align: center;
    }
    .myTable > tbody > tr:last-child {
        border-bottom: 2px solid rgb(140, 0, 45);
    }
    .myTable > tbody > tr >td:last-child{
        background-color: #BCBCBC;
        cursor: pointer;
    }
    .myTable > tbody > tr >td:last-child:hover{
        background-color: #FF00FF;

    }
    .myTable > tbody >tr:nth-child(odd){
        background-color: #DCDCDC;
    }
    .myTable > tbody >tr:nth-child(even){
        background-color: #CCF1FA;

    }

    .modalTable thead{
        background-color: #1b6d85;
        color: white;
    }

    .modalTable > thead > tr > th{
        padding:15px 0;
        text-align: center;
    }
    .modalTable > thead > tr > th:first-child{
        border-top-left-radius: 6px;
    }

    .modalTable > thead > tr > th:last-child{
        border-top-right-radius: 6px;
    }

    .modalTable > tbody >tr:nth-child(odd){
        background-color: #CCCCCC;
    }
    .modalTable > tbody >tr:nth-child(even){
        background-color: #E3E3E3;

    }
    .modalTable > tbody{
        color: black;
    }


    /*ModalStarts*/

    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        position: relative;
        background-color: #F4F4F4;
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 60%;
        height: auto;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
    }

    @keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
    }

    /* The Close Button */
    .close {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header {
        padding: 2px 16px;
        background-color: #080808;
        color: white;
    }

    .modal-body {
        padding: 2px 16px;
        color: white;
    }

    .modal-footer {
        padding: 2px 16px;
        background-color: #7B7B7B;
        color: white;
    }
    /*Modal Ends*/
</style>

<!--modal starts-->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close" id="close" onclick="modalClose()">&times;</span>
            <h4>Your Order Detais</h4>
        </div>
        <div class="modal-body">
            <div class="table-responsive container row " style="width: inherit;">
                <table class="table table-striped modalTable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Food</th>
                        <th>Price/Unit</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                    </tr>
                    </thead>

                    <tbody id="modalTable">
<!--                    <tr>-->
<!--                        <td>a</td>-->
<!--                        <td>b</td>-->
<!--                        <td>c</td>-->
<!--                        <td>N/A</td>-->
<!--                        <td>Pending</td>-->
<!--                    </tr>-->

                    </tbody>
                </table>
            </div>
        </div>
        <!--        <div class="modal-footer">-->
        <!--            <h3>Modal Footer</h3>-->
        <!--        </div>-->
    </div>
</div>
<!--modal ends-->

<div class="table-responsive container row " style="margin-left: -30px;">
    <table class="table table-striped myTable">
        <thead>
        <tr>
            <th>No</th>
            <th>OrderDate</th>
            <th>DelivaryDate</th>
            <th>DelivaryTime</th>
            <th>Validity</th>
            <th>Status</th>
            <th>Details</th>
        </tr>
        </thead>

        <tbody>
        <?php
        $query = "select orders.id,orders.orderdate,orders.delivarydate,TIME_FORMAT(delivarytime, \"%h:%i %p\") as delivarytime,confirmation,validity from orders,customer where customer.id=orders.customerid && customer.username='".$_SESSION['username']."' order by orders.id desc";
        $customerOrders = db_select($query);
        $counter = 0;
        foreach ($customerOrders as $order): ?>
            <tr>
                <td>
                    <?= ++$counter;?>
                </td>
                <td><?= $order['orderdate'] ?></td>
                <td><?= $order['delivarydate'] ?></td>
                <td><?= $order['delivarytime']?></td>

                <?php if($order['confirmation']==0 && $order['validity']==0){?>
                    <td>N/A</td>
                <?php }elseif ($order['validity']==0){?>
                    <td style="color: red;font-weight: bold">Invalid</td>
                <?php }else{?>
                    <td style="color: green;font-weight: bold">Valid</td>
                <?php }?>


                <?php if($order['confirmation']==1){ ?>
                    <td style="color: green;font-weight: bold"> Received</td>
                <?php }else{?>
                    <td>Pending</td>
                <?php }?>

                <td onclick="modalActivate('<?= $order['id']?>')">Show</td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>


<?php
require_once '../layout/footer.php'
?>
