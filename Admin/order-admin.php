<?php

require_once '../Security/redirectToIfNotAdmin.php';
require_once '../src/database.php';
include_once '../layout/header.php';
?>
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
    input[type=checkbox]{
        cursor: pointer;
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
    .myTable > tbody > tr >td:nth-last-child(2){
        background-color: #CCCCCC;
        cursor: pointer;
    }
    .myTable > tbody > tr >td:last-child:hover{
        background-color: #FF00FF;

    }
    .myTable > tbody > tr >td:nth-last-child(2):hover{
        background-color: #B4B4B4;
        color:#009900;

    }
    .myTable > tbody > tr >td:nth-last-child(9):hover{
        color: #080808;

    }
    .myTable > tbody > tr >td:nth-last-child(9){
        cursor: pointer;
        color: #009900;

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
    .box-input {
        padding-top: 10px;
        background-color: #f1f1f1;
        padding: 0.01em 16px;
        margin: 20px 0;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12) !important;
    }
    .form-input{
        width: 40%;
        margin-left: 30%;
        margin-top: 0px;
    }
</style>
<script>
    $(document).ready(function(){
       showOrderTable();

    });

    function showOrderTable(){
        $('#myTable').html("");
        $.post('../Security/jquery-process.php',{orderList:"orderList"},function(data){
            $('#myTable').append(getTableHeaderHtml());
            var orderList = JSON.parse(data);
            var order,html="";
            for(var i=0;i<orderList.length;i++){
                order = orderList[i];
                $('#orderTable').append("<tr id=\"row"+(i+1)+"\">\n" +
                    "                <td>"+(i+1)+"</td>\n" +
                    "                <td onclick=\"modalActivateUserDetail('"+order.username+"')\">"+order.username+"</td>\n" +
                    "                <td>"+order.orderdate+"</td>\n" +
                    "                <td>"+order.delivarydate+"</td>\n" +
                    "                <td>"+order.delivarytime+"</td>\n" +
                    "                <td><input type=\"checkbox\" id='validate"+(i+1)+"' onchange=\"validate(this,"+order.id+","+(i+1)+")\"></td>\n" +
                    "                <td><input type=\"checkbox\" id='receive"+(i+1)+"' onchange=\"receive(this,"+order.id+","+(i+1)+")\"></td>\n" +
                    "                <td><input type=\"checkbox\" id='serve"+(i+1)+"' onchange=\"serve(this,"+order.id+")\","+(i+1)+"></td>\n" +
                    "                <td onclick=\"modalActivateOrderDetail("+order.id+")\">Show</td>\n" +
                    "                <td onclick=\"deleteOrder("+order.id+","+(i+1)+")\">Delete</td>\n" +
                    "            </tr>");
                if(order.validity==1)$('#validate'+(i+1)).prop({'checked':true,'disabled':true});
                if(order.confirmation==1)$('#receive'+(i+1)).prop({'checked':true,"disabled":true});
                if(order.served==1)$('#serve'+(i+1)).prop({'checked':true,'disabled':true});
                if(order.confirmation==0) $('#row'+(i+1)).css({"background-color":"#CC9999"});
                //if(order.validity==1 && order.confirmation==1 && order.served==1) $('#row'+(i+1)).css({"background-color":"#66CC66"});
            }


        });
    }
    function getTableHeaderHtml(){
        var html = "<thead>\n" +
            "        <tr>\n" +
            "            <th>No</th>\n" +
            "            <th>UserName</th>\n" +
            "            <th>OrderDate</th>\n" +
            "            <th>DelivaryDate</th>\n" +
            "            <th>DelivaryTime</th>\n" +
            "            <th>Validity</th>\n" +
            "            <th>Received</th>\n" +
            "            <th>Served</th>\n" +
            "            <th>Details</th>\n" +
            "            <th></th>\n" +
            "        </tr>\n" +
            "        </thead>\n" +
            "\n" +
            "        <tbody id=\"orderTable\">\n" +
            "\n" +
            "\n" +
            "        </tbody>";
        return html;
    }

    function deleteOrder(orderId,rowId){
        if(confirm('Are you sure?')){
            $.post('../Security/jquery-process.php',{deleteOrderId:orderId});
            $('#row'+rowId).css({'display':'none'});
            showOrderTable();
        }

    }
    function modalActivateOrderDetail(orderId){
        modalActivate(orderId);
    }
    function modalActivateUserDetail(userName){
        infoModalActivate(userName);
        console.log(userName);
    }
    function validate(cbox,orderId,rowId){
        if(confirm('Are You Sure?')){
            $.post('../Security/jquery-process.php',{validate:"validate",validateOrderId:orderId});
            $('#'+cbox.id).prop({'disabled':true});
        }else  $('#'+cbox.id).prop({'checked':false});
    }
    function receive(cbox,orderId,rowId){
        if(confirm('Are You Sure?')){
            $.post('../Security/jquery-process.php',{receive:"receive",receiveOrderId:orderId});
            $('#'+cbox.id).prop({'disabled':true});
            $('#row'+rowId).css({"background-color":""});
            console.log(rowId);
        }else  $('#'+cbox.id).prop({'checked':false});
    }
    function serve(cbox,orderId,rowId){
        if(confirm('Are You Sure?')){
            $.post('../Security/jquery-process.php',{serve:"serve",serveOrderId:orderId});
            $('#'+cbox.id).prop({'disabled':true});
        }else  $('#'+cbox.id).prop({'checked':false});
    }

</script>
<!--specific order details modal-->
<script>
    var id;
    function modalShow() {
        $('#myModal').css({'display':'block'});
    }
    function modalClose(){
        var status = $('#statusText').val();
        $.post('../Security/jquery-process.php',{status:status,statusOrderId:id});
        $('#modalTable').html("");
        $('#myModal').css({'display':'none'});

    }
    function modalActivate(orderId){
        id=orderId;
        $.post('../Security/jquery-process.php',{orderId:orderId},function(data){
            var orderDetail = JSON.parse(data);
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
                "            <td colspan=\"4\"><textarea rows=\"1\" class=\"form-control\" id=\"statusText\" style=\"width: 100%\">"+orderDetail[orderDetail.length-3].status+"</textarea></td>\n" +
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

<!--customer info modal-->
<script>
    function infoModalShow() {
        $('#infoModal').css({'display':'block'});
    }
    function infoModalClose(){
       // $('#modalTable').html("");
        $('#infoModal').css({'display':'none'});

    }
    function infoModalActivate(userName){
        $.post('../Security/jquery-process.php',{userName:userName},function(data){
            var info = JSON.parse(data);
            info = info[0];
            $('#infoBody').html("");
            $('#infoBody').append("<div class=\"row\">\n" +
                "                    <div class=\" col-md-6\">\n" +
                "                        <label for=\"name\">FULL NAME :</label>\n" +
                "                    </div>\n" +
                "                    <div class=\" col-md-6\">\n" +
                "                        <label id=\"name\">"+info.fullname+"</label></div>\n" +
                "                </div>\n" +
                "                <div class=\"row\">\n" +
                "                    <div class=\" col-md-6\">\n" +
                "                        <label for=\"name\">ADDRESS :</label>\n" +
                "                    </div>\n" +
                "                    <div class=\" col-md-6\">\n" +
                "                        <label id=\"name\">"+info.address+"</label></div>\n" +
                "                </div>\n" +
                "                <div class=\"row\">\n" +
                "                    <div class=\" col-md-6\">\n" +
                "                        <label for=\"name\">CONTACT :</label>\n" +
                "                    </div>\n" +
                "                    <div class=\" col-md-6\">\n" +
                "                        <label id=\"name\">"+info.contact+"</label></div>\n" +
                "                </div>");
        })

        infoModalShow();
    }

</script>
<!--modal starts-->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close" id="close" onclick="modalClose()">&times;</span>
            <h4>Customer Order Detais</h4>
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

<!--Info modal starts-->
<div id="infoModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content" style="width: 50%">
        <div class="modal-header">
            <span class="close" id="close" onclick="infoModalClose()">&times;</span>
            <h4>Customer  Detail Info</h4>
        </div>
        <div class="modal-body" style="color: #0f0f0f">



                <!--            user name-->
            <div class="box-input" id="infoBody" style="padding: 10px">

            </div>



<!---->
<!--                <!--            Address-->
<!--                <div class="form-group">-->
<!--                    <label for="address" class="col-md-4">User Name</label>-->
<!--                    <div class="col-md-8">-->
<!--                        <label class="form-control" id="address" name="address" >Khulna Univarsity</label>-->
<!---->
<!--                    </div>-->
<!--                </div>-->

        </div>
        <!--        <div class="modal-footer">-->
        <!--            <h3>Modal Footer</h3>-->
        <!--        </div>-->
    </div>
</div>
<!--Info modal ends-->

<div class="table-responsive container row " style="margin-left: -30px;">
    <table class="table table-striped myTable" id="myTable">
<!--        <thead>-->
<!--        <tr>-->
<!--            <th>No</th>-->
<!--            <th>UserName</th>-->
<!--            <th>OrderDate</th>-->
<!--            <th>DelivaryDate</th>-->
<!--            <th>DelivaryTime</th>-->
<!--            <th>Validity</th>-->
<!--            <th>Received</th>-->
<!--            <th>Served</th>-->
<!--            <th>Details</th>-->
<!--            <th></th>-->
<!--        </tr>-->
<!--        </thead>-->
<!---->
<!--        <tbody id="orderTable">-->
<!--                    <tr>-->
<!--                        <td>1</td>-->
<!--                        <td onclick="modalActivateUserDetail(1)">username</td>-->
<!--                        <td>orderdate</td>-->
<!--                        <td>delivarydate</td>-->
<!--                        <td>delivarytime</td>-->
<!--                        <td><input type="checkbox" id="validity1" onchange="validate(this,1)" value="true"></td>-->
<!--                        <td><input type="checkbox" id="receive1" onchange="receive(this,1)"></td>-->
<!--                        <td><input type="checkbox" id="serve1" onchange="serve(this,1)"></td>-->
<!--                        <td onclick="modalActivateOrderDetail(1)">Show</td>-->
<!--                        <td onclick="deleteOrder(1)">Delete</td>-->
<!--                    </tr>-->
<!---->
<!--        </tbody>-->
    </table>
</div>


<?php
include_once '../layout/footer.php';
?>
