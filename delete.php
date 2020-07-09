<?php session_start(); ?>
<?php
    function delete() {
        $result = False;
        if ( ! empty( $_POST ) ) {
            if ( isset( $_POST['ItemId'] ) ) {
                $host_name = 'db5000153551.hosting-data.io';
                $database = 'dbs148622';
                $user_name = 'dbu150596';
                $password = '7jdlh46vYtjmApLuRWT0!';
                $connect = mysqli_connect($host_name, $user_name, $password, $database);
                if ( ! mysqli_connect_errno() ) {
                    // Get this menu item's ID number
                    $stmt = $connect->prepare("SELECT `ItemType` AS 'ItemType', `ItemSubType` AS 'ItemSubType', `ItemOrder` AS 'ItemOrder' FROM `Menu` WHERE `ID` = " .$_POST['ItemId']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = mysqli_fetch_assoc($result);
                    $type = $row['ItemType'];
                    $subType = $row['ItemSubType'];
                    $order = $row['ItemOrder'];
                    // Move any following items down one in the ordering
                    $connect->query("UPDATE `Menu` SET `ItemOrder` = (`ItemOrder` - 1) WHERE `ItemType` = '" .$type. "' AND `ItemSubType` = '" .$subType. "' AND `ItemOrder` >" .$order);
                    // Delete menu item
                    $sql = "DELETE FROM `Menu` WHERE `ID` = ?";
                    $stmt = $connect->prepare($sql);
                    $stmt->bind_param('i', $_POST['ItemId']);
                    if ($stmt->execute()) {
                        $result = True;
                    }
                    mysqli_close($connect);
                }
            }
        }
        return $result;
    }
    delete();
    header('Location: /overview.php');
?>