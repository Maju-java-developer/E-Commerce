<?php
$user_Heading = array("UID", "User Name", "Gmail", "Date");
$get_orders = get_orders();

$get_users = get_user();

?>

<!-- Creating List Table OF Orders PRODUCT -->
<div class="col-md-12">
    <div class="card strpied-tabled-with-hover">
        <div class="card-header ">
            <h4 class="card-title">Orders Products</h4>
            <!-- <p class="card-category">List Products</p> -->
        </div>

        <!-- <h1>Hello word</h1>
        <h1>Hello word</h1>
        <h1>Hello word</h1>
        <h1>Hello word</h1>
        <h1>Hello word</h1>
        <h1>Hello word</h1> -->
        <div class="card-body table-full-width table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <?php
                    for ($i = 0; $i < sizeof($user_Heading); $i++) {
                        echo "<th>$user_Heading[$i]</th>";
                    }
                    ?>
                    <td class=" float-right">
                        Action
                    </td>
                    <?php
                    ?>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < sizeof($get_users); $i++) {

                        echo "<tr>
                        <td>" . $get_users[$i][0] . " </td>
                        <td>" . $get_users[$i][1] . " " . $get_users[$i][2] . " </td>
                        <td>" . $get_users[$i][3] . "</td>
                        <td>" . $get_users[$i][6] . " </td>";

                    ?>
                        <td class="float-right">
                            <span class="material-icons" style="cursor: pointer;">
                                create
                            </span>
                            <span class="material-icons" style="cursor: pointer;" onclick="redirectTo('?page=view_orders_details&user_id=<?php echo $get_users[$i][0] ?>');">
                                launch
                            </span>
                            <span class="material-icons" style="cursor: pointer;" data-toggle="modal" data-target="#delete_user_<?php echo $get_users[$i][0] ?>">
                                delete
                            </span>

                            <!-- Confirm Modal For Delete User And Orders -->
                            <div class="modal fade" id="delete_user_<?php echo $get_users[$i][0] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">DELETE USER: <?php echo $get_users[$i][0] ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Are u sure to delete it?</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                            <button type="button" class="btn btn-primary" onclick="redirectTo('?page=delete_user&user_id=<?php echo $get_users[$i][0] ?>');">YES</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Confirm Modal For Delete User And Orders -->

                        </td>
                    <?php
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- $product_Heading = array("ID", "Product Image","Product Name","Product Category","QTY","Date","Status"); -->