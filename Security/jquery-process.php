<?php

require_once '../src/database.php';
$foodMenuPrimaryKey = isset($_POST['foodMenuPrimaryKey'])?$_POST['foodMenuPrimaryKey']:null;
$orderId = isset($_POST['orderId'])?$_POST['orderId']:null;
$orderList = isset($_POST['orderList'])?$_POST['orderList']:null;
$receive = isset($_POST['receive'])?$_POST['receive']:null;
$receiveOrderId = isset($_POST['receiveOrderId'])?$_POST['receiveOrderId']:null;
$validateOrderId = isset($_POST['validateOrderId'])?$_POST['validateOrderId']:null;
$validate = isset($_POST['validate'])?$_POST['validate']:null;
$serveOrderId = isset($_POST['serveOrderId'])?$_POST['serveOrderId']:null;
$serve = isset($_POST['serve'])?$_POST['serve']:null;
$deleteOrderId = isset($_POST['deleteOrderId'])?$_POST['deleteOrderId']:null;
$status = isset($_POST['status'])?$_POST['status']:null;
$statusOrderId = isset($_POST['statusOrderId'])?$_POST['statusOrderId']:null;
$userName = isset($_POST['userName'])?$_POST['userName']:null;
$deleteComntId = isset($_POST['deleteComntId'])?$_POST['deleteComntId']:null;





//retrieving food according to primary key of food
//from food-menu-order page
if($foodMenuPrimaryKey!=null && !empty($foodMenuPrimaryKey)){
    $item = db_select("select * from foodmenu where id='".$foodMenuPrimaryKey."'");
    echo json_encode($item);

}
//retrieving order details according to order id
//from customer-order page
else if($orderId!=null && !empty($orderId)){
    $orderDetail = db_select("select foodmenu.name,foodmenu.price,orderitem.amount,(foodmenu.price*orderitem.amount) as cost from foodmenu,orderitem where foodmenu.id=orderitem.foodid and orderitem.orderid='".$orderId."'");
    $adminFeedBack = db_select("select status,delivaryaddress,phoneno from orders where id = '".$orderId."'");
    $orderDetail[count($orderDetail)]['status']=$adminFeedBack[0]['status'];
    $orderDetail[count($orderDetail)]['delivaryaddress']=$adminFeedBack[0]['delivaryaddress'];
    $orderDetail[count($orderDetail)]['phoneno']=$adminFeedBack[0]['phoneno'];
    echo json_encode($orderDetail);
}
//retreiving all order list with customer name
//from order-customer page
else if($orderList!=null && !empty($orderList)){
    $query = "select customer.username,orders.id,orders.orderdate,orders.delivarydate,TIME_FORMAT(delivarytime, \"%h:%i %p\") as delivarytime,orders.validity,orders.confirmation ,orders.served from customer,orders where customer.id=orders.customerid order by orders.id desc";
    $orderListData = db_select($query);
    echo json_encode($orderListData);
}
//updating receive/confirmation field of orderId
//from order-admin page
else if($receive!=null && !empty($receive)){
    $query = "UPDATE `orders` SET `confirmation` = '1' WHERE `orders`.`id` ='".$receiveOrderId."'";
    db_update($query);
}
//updating validate field of orderId
//from order-admin page
else if($validate!=null && !empty($validate)){
    $query = "UPDATE `orders` SET `validity` = '1' WHERE `orders`.`id` ='".$validateOrderId."'";
    db_update($query);
}

//updating served field of orderId
//from order-admin page
else if($serve!=null && !empty($serve)){
    $query = "UPDATE `orders` SET `served` = '1' WHERE `orders`.`id` ='".$serveOrderId."'";
    db_update($query);
}

//deleting all fields of orderId
//from order-admin page
else if($deleteOrderId!=null && !empty($deleteOrderId)){
    $query = "DELETE FROM `orders` WHERE `orders`.`id` = '".$deleteOrderId."'";
    db_delete($query);
}

//Updating admin order feedback status
//from order-admin page
else if($status!=null && !empty($status) && $statusOrderId!=null && !empty($statusOrderId)){
    $query = "UPDATE `orders` SET `status` = '".$status."' WHERE `orders`.`id` = '".$statusOrderId."';";
    db_update($query);
}
//retreiving user detail according to user name
//from order admin page
else if($userName!=null && !empty($userName)){
    $query = "SELECT fullname,address,contact from `customer` WHERE username='".$userName."';";
    $detail =db_select($query);
    echo json_encode($detail);
}
//delete the comment
//from food-review page
else if($deleteComntId!=null && !empty($deleteComntId)){
    $query = "delete from feedback where id='".$deleteComntId."'";
    db_delete($query);

}


