<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Oaks Cafe Deli, Swanley, Kent">
		<meta name="keywords" content="Oaks, Cafe, Deli, Swanley, Kent">
		<meta name="author" content="Michael Robert Thurlow">
        <title>Oaks Cafe Deli | Admin</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="shortcut icon" type="image/png" href="resources/favicon.png"/>
        <link rel="stylesheet" href="admin.css"/>
	</head>
    <?php
        function setSessionCreds($u, $p) {
            $_SESSION['username'] = $u;
            $_SESSION['password'] = $p;
        }
        if ( ! empty( $_POST ) ) {
            if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
                setSessionCreds( $_POST['username'] , $_POST['password'] );
            }
        }
        if ( isset( $_SESSION['username'] ) && isset( $_SESSION['password'] ) ) {
            $host_name = 'db5000153551.hosting-data.io';
            $database = 'dbs148622';
            $user_name = 'dbu150596';
            $password = '7jdlh46vYtjmApLuRWT0!';
            $connect = mysqli_connect($host_name, $user_name, $password, $database);
            if (mysqli_connect_errno()) {
                echo    "<script language='javascript'>
                            alert('Failed to connect to MySQL: '".mysqli_connect_error()."');
                        </script>'";
            } else {
                $sql = "SELECT `username`, `password` FROM `Users` WHERE `username` = ? AND `password` = ?";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param('ss', $_SESSION['username'], $_SESSION['password']);
                $stmt->execute();
                $result = $stmt->get_result();
                if (mysqli_num_rows($result) > 0) {
                    echo "
                    <body>
                        <div class='container'>
                            <div class='table-wrapper filterable'>
                                <div class='table-title'>
                                    <div class='row'>
                                        <div class='col-sm-4'>
                                            <h2>File <b>Upload</b></h2>
                                        </div>
                                        <div class='col-sm-12'>
                                            <form action='upload.php' method='post' enctype='multipart/form-data'>
                                                <input type='submit' class='btn btn-primary' value='Upload Image' name='submit'>
                                                <input type='file' class='btn btn-primary' name='photo' id='photo'>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <table class='table table-striped table-hover'>
                                    <thead>
                                        <tr></tr>
                                    </thead>
                                    <tbody>";
                                        $uploads = glob('resources/uploads/*.*');
                                        foreach($uploads as $upload) {
                                            echo '<tr><img src="' .$upload. '" /></tr>';
                                        };
                                    echo "
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class='container'>
                            <div class='table-wrapper filterable'>
                                <div class='table-title'>
                                    <div class='row'>
                                        <div class='col-sm-4'>
                                            <h2>Manage <b>Menu</b></h2>
                                        </div>
                                        <div class='col-sm-8'>
                                            <a href='#addMenuItemModal' class='btn btn-success' data-toggle='modal'><i class='material-icons'>&#xE147;</i> <span>Add New Menu Item</span></a>
                                            <a href='#deleteMenuItemModal' class='btn btn-danger' data-toggle='modal'><i class='material-icons'>&#xE15C;</i> <span>Delete</span></a>
                                            <a href='#filterMenuItemModal' class='btn btn-info' data-toggle='modal'><i class='material-icons'>&#xe152;</i> <span>Filter</span></a>
                                        </div>
                                    </div>
                                </div>
                                <table class='table table-striped table-hover'>
                                    <thead>
                                        <tr class='filters'>
                                            <th>
                                                <span class='custom-checkbox'>
                                                    <input type='checkbox' id='selectAll'>
                                                    <label for='selectAll'></label>
                                                </span>
                                            </th>
                                            <th><input type='text' class='filterableHeading form-control' placeholder='Name' disabled></th>
                                            <th><input type='text' class='filterableHeading form-control' placeholder='Type' disabled></th>
                                            <th><input type='text' class='filterableHeading form-control' placeholder='SubType' disabled></th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Order</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                                    $sql = "SELECT * FROM `Menu` ORDER BY `ItemType`, `ItemSubType`, `ItemOrder`";
                                    $stmt = $connect->prepare($sql);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
            
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $price = number_format($row["ItemPrice"], 2, '.', '');
                                        echo "
                                        <tr id='menuItem" .$row["ID"]. "'>
                                            <td>
                                                <span class='custom-checkbox'>
                                                    <input type='checkbox' id='checkbox" .$row["ID"]. "' name='options[]' value='1'>
                                                    <label for='checkbox" .$row["ID"]. "'></label>
                                                </span>
                                            </td>
                                            <td>" .$row["ItemName"]. "</td>
                                            <td>" .$row["ItemType"]. "</td>
                                            <td>" .$row["ItemSubType"]. "</td>
                                            <td>" .$row["ItemDescription"]. "</td>
                                            <td>" .$price. "</td>
                                            <td>" .$row["ItemOrder"]. "</td>
                                            <td>
                                                <a href='#editMenuItemModal' class='edit' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>
                                                <a href='#deleteMenuItemModal' class='delete' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a>
                                            </td>
                                        </tr>";
                                    }
                                    echo "
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Add Modal HTML -->
                        <div id='addMenuItemModal' class='modal fade'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <form id='addMenuItemModalForm' action='insert.php' method='post'>
                                        <div class='modal-header'>						
                                            <h4 class='modal-title'>Add Menu Item</h4>
                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                        </div>
                                        <div class='modal-body'>
                                            <div class='form-group'>
                                                <label>Item Name</label>
                                                <input type='text' id='addMenuItemModalItemName' name='ItemName' class='form-control' required>
                                            </div>
                                            <div class='form-group'>
                                                <label>Item Type</label>
                                                <select id='addMenuItemModalItemType' name='ItemType'>
                                                    <option value='Food'>Food</option>
                                                    <option value='Drinks'>Drinks</option>
                                                    <option value='Takeaway'>Takeaway</option>
                                                </select>
                                            </div>
                                            <div class='form-group'>
                                                <label>Item Sub Type</label>
                                                <select id='addMenuItemModalItemSubType' name='ItemSubType'>
                                                    <option value='Breakfast'>Breakfast</option>
                                                    <option value='Lunch'>Lunch</option>
                                                    <option value='Sandwiches'>Sandwiches</option>
                                                    <option value='Extras'>Extras</option>
                                                    <option value='Paninis'>Paninis</option>
                                                    <option value='Drinks'>Drinks</option>
                                                </select>
                                            </div>
                                            <div class='form-group'>
                                                <label>Item Description</label>
                                                <textarea id='addMenuItemModalItemDescription' name='ItemDescription' class='form-control' required></textarea>
                                            </div>
                                            <div class='form-group'>
                                                <label>Item Price</label>
                                                <input type='number' id='addMenuItemModalItemPrice' name='ItemPrice' class='form-control' min='0' step='0.01' required>
                                            </div>
                                            <div class='form-group'>
                                                <label>Item Order</label>
                                                <input type='number' id='addMenuItemModalItemOrder' name='ItemOrder' class='form-control' min='1' step='1' required>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='button' class='btn btn-default' data-dismiss='modal' value='Cancel'>
                                            <input type='submit' class='btn btn-success' value='Add'>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Edit Modal HTML -->
                        <div id='editMenuItemModal' class='modal fade'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <form id='editMenuItemModalForm' action='update.php' method='post'>
                                        <div class='modal-header'>						
                                            <h4 class='modal-title'>Edit Menu Item</h4>
                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                        </div>
                                        <div class='modal-body'>					
                                            <div class='form-group'>
                                                <label>Item ID</label>
                                                <input type='text' id='editMenuItemModalItemId' name='ItemId' class='form-control' required readonly>
                                            </div>
                                            <div class='form-group'>
                                                <label>Item Name</label>
                                                <input type='text' id='editMenuItemModalItemName' name='ItemName' class='form-control' required>
                                            </div>
                                            <div class='form-group'>
                                                <label>Item Type</label>
                                                <select id='editMenuItemModalItemType' name='ItemType'>
                                                    <option value='Food'>Food</option>
                                                    <option value='Drinks'>Drinks</option>
                                                    <option value='Takeaway'>Takeaway</option>
                                                </select>
                                            </div>
                                            <div class='form-group'>
                                                <label>Item Sub Type</label>
                                                <select id='editMenuItemModalItemSubType' name='ItemSubType'>
                                                    <option value='Breakfast'>Breakfast</option>
                                                    <option value='Lunch'>Lunch</option>
                                                    <option value='Sandwiches'>Sandwiches</option>
                                                    <option value='Extras'>Extras</option>
                                                    <option value='Paninis'>Paninis</option>
                                                    <option value='Drinks'>Drinks</option>
                                                </select>
                                            </div>
                                            <div class='form-group'>
                                                <label>Item Description</label>
                                                <textarea id='editMenuItemModalItemDescription' name='ItemDescription' class='form-control' required></textarea>
                                            </div>
                                            <div class='form-group'>
                                                <label>Item Price</label>
                                                <input type='number' id='editMenuItemModalItemPrice' name='ItemPrice' class='form-control' min='0' step='0.01' required>
                                            </div>
                                            <div class='form-group'>
                                                <label>Item Order</label>
                                                <input type='number' id='editMenuItemModalItemOrder' name='ItemOrder' class='form-control' min='1' step='1' required>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='button' class='btn btn-default' data-dismiss='modal' value='Cancel'>
                                            <input type='submit' id='editMenuItemModalSave' class='btn btn-info' value='Save'>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Modal HTML -->
                        <div id='deleteMenuItemModal' class='modal fade'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <form id='deleteMenuItemModalForm' action='delete.php' method='post'>
                                        <div class='modal-header'>						
                                            <h4 class='modal-title'>Delete Menu Item</h4>
                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                        </div>
                                        <div class='modal-body'>					
                                            <p>Are you sure you want to delete these Records?</p>
                                            <p class='text-warning'><small>This action cannot be undone.</small></p>
                                            <div class='form-group'>
                                                <label>Item ID</label>
                                                <input type='text' id='deleteMenuItemModalItemId' name='ItemId' class='form-control' required readonly>
                                            </div>
                                            <div class='form-group'>
                                                <label>Item Name</label>
                                                <input type='text' id='deleteMenuItemModalItemName' name='ItemName' class='form-control' required>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='button' class='btn btn-default' data-dismiss='modal' value='Cancel'>
                                            <input type='submit' class='btn btn-danger' value='Delete'>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
                        <script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
                        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
                        <script src='overview.js'></script>
                    </body>
                    ";
                } else {
                    echo    "<script language='javascript'>
                                alert('Invalid Username and/or Password!');
                            </script>'";
                    echo "<p>Invalid Username and/or Password!</p>";
                }
            }
            mysqli_close($connect);
        }
    ?>
</html>