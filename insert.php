<?php session_start(); ?>
<?php
    function insert() {
        $result = False;
        if ( ! empty( $_POST ) ) {
            if ( isset( $_POST['ItemName'] ) && 
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
                    $stmt = $connect->prepare("SELECT IFNULL(MAX(`ItemOrder`),1) AS 'MaxItemOrder' FROM `Menu` WHERE `ItemType` = '" .$_POST['ItemType']. "' AND `ItemSubType` = '" .$_POST['ItemSubType']. "'");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $maxRow = mysqli_fetch_assoc($result);
                    $max = $maxRow['MaxItemOrder'];
                    $order = $_POST['ItemOrder'];
                    // Is the ItemOrder - user-defined or otherwise - greater than the maximum ItemOrder
                    if ( $order > $max ) {
                        $order = ($max + 1);
                    } else {
                        $connect->query("UPDATE `Menu` SET `ItemOrder` = (`ItemOrder` + 1) WHERE `ItemType` = '" .$_POST['ItemType']. "' AND `ItemSubType` = '" .$_POST['ItemSubType']. "' AND `ItemOrder` >=" .$order );
                    }
                    $sql = "INSERT INTO `Menu` (`ItemName`, `ItemType`, `ItemSubType`, `ItemDescription`, `ItemPrice`, `ItemOrder`) VALUES ( ?, ?, ?, ?, ?, ? );";
                    $stmt = $connect->prepare($sql);
                    $stmt->bind_param('ssssdi', $_POST['ItemName'], $_POST['ItemType'], $_POST['ItemSubType'], $_POST['ItemDescription'], floatval($_POST['ItemPrice']), $order);
                    if ($stmt->execute()) {
                        $result = True;
                    }
                    mysqli_close($connect);
                }
            }
        }
        return $result;
    }
    insert();
    header('Location: /overview.php');
?>