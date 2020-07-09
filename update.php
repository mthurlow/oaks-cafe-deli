<?php session_start(); ?>
<?php
    function update() {
        $result = False;
        if ( ! empty( $_POST ) ) {
            if ( isset( $_POST['ItemId'] ) &&
                    isset( $_POST['ItemName'] ) && 
                    isset( $_POST['ItemType'] ) &&
                    isset( $_POST['ItemSubType'] ) && 
                    isset( $_POST['ItemDescription'] ) && 
                    isset( $_POST['ItemPrice'] ) &&
                    isset( $_POST['ItemOrder'] ) ) {
                $host_name = 'db5000153551.hosting-data.io';
                $database = 'dbs148622';
                $user_name = 'dbu150596';
                $password = '7jdlh46vYtjmApLuRWT0!';
                $connect = mysqli_connect($host_name, $user_name, $password, $database);
                if ( ! mysqli_connect_errno() ) {
                    // Get the maximum Item Order number
                    $stmt = $connect->prepare("SELECT IFNULL(MAX(`ItemOrder`),1) AS 'MaxItemOrder' FROM `Menu` WHERE `ItemType` = '" .$_POST['ItemType']. "' AND `ItemSubType` = '" .$_POST['ItemSubType']. "' AND `ID` <> " .$_POST['ItemId']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $maxRow = mysqli_fetch_assoc($result);
                    $max = $maxRow['MaxItemOrder'];
                    // Get this menu item's ID number
                    $stmt = $connect->prepare("SELECT `ItemOrder` AS 'ItemOrder' FROM `Menu` WHERE `ID` = " .$_POST['ItemId']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $orderRow = mysqli_fetch_assoc($result);
                    $prevOrder = $orderRow['ItemOrder'];
                    // Define the new order number
                    $order = $_POST['ItemOrder'];
                    // Is the ItemOrder - user-defined or otherwise - greater than the maximum ItemOrder
                    if ( $order > $max )
                    {
                        $order = ($max + 1);
                    }
                    if ( $prevOrder > $order ) {
                        // Move up the stack
                        $connect->query("UPDATE `Menu` SET `ItemOrder` = (`ItemOrder` + 1) WHERE `ItemType` = '" .$_POST['ItemType']. "' AND `ItemSubType` = '" .$_POST['ItemSubType']. "' AND `ItemOrder` >=" .$order. " AND `ItemOrder` <" .$prevOrder);
                    } elseif ( $order > $prevOrder ) { 
                        // Move down the stack
                        $connect->query("UPDATE `Menu` SET `ItemOrder` = (`ItemOrder` - 1) WHERE `ItemType` = '" .$_POST['ItemType']. "' AND `ItemSubType` = '" .$_POST['ItemSubType']. "' AND `ItemOrder` >" .$prevOrder. " AND `ItemOrder` <=" .$order);
                    }
                    $sql = "UPDATE `Menu` SET `ItemName` = ? , `ItemType` = ? , `ItemSubType` = ? , `ItemDescription` = ? , `ItemPrice` = ? , `ItemOrder` = ? WHERE `ID` = ?";
                    $stmt = $connect->prepare($sql);
                    $stmt->bind_param('ssssdii', $_POST['ItemName'], $_POST['ItemType'], $_POST['ItemSubType'], $_POST['ItemDescription'], floatval($_POST['ItemPrice']), $order, $_POST['ItemId']);
                    if ($stmt->execute()) {
                        $result = True;
                    }
                    mysqli_close($connect);
                }
            }
        }
        return $result;
    }
    update();
    header('Location: /overview.php');
?>