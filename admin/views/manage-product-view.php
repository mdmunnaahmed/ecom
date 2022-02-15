<?php
$obj_adminBack = new adminBack();
$product_result = $obj_adminBack->displayProduct();

// if (isset($_GET['status'])) {
//     $get_id = $_GET['id'];
//     if ($_GET['status'] == 'publish') {
//         $msg = $obj_adminBack->publishProduct($get_id);
//     } else if ($_GET['status'] == 'unpublish') {
//         $msg = $obj_adminBack->unpublishProduct($get_id);
//     } else if ($_GET['status'] == 'delete') {
//         $msg = $obj_adminBack->deletepublishProduct($get_id);
//     } else if ($_GET['status'] == 'edit') {
//         $msg = $obj_adminBack->editpublishProduct($get_id);
//     }
// }
?>


<h2 class="">Manage Category</h2>
<p class="alert">
    <?php if (isset($msg)) {
        echo $msg;
    } ?>
</p>

<table class="table bg-white">
    <thead>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>Categroy</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php
        while ($ctg = mysqli_fetch_assoc($product_result)) {
        ?>

            <tr>
                <td><?php echo $ctg['product_id'] ?></td>
                <td><?php echo $ctg['product_name'] ?></td>
                <td>$<?php echo $ctg['product_price'] ?></td>
                <td><?php echo $ctg['product_des'] ?></td>
                <td><img src="upload/<?php echo $ctg['product_img'] ?>" alt=""></td>
                <td><?php echo $ctg['ctg_name'] ?></td>

                <td>
                    <a class="btn-sm btn btn-info" href="edit-category.php?status=edit&&id=<?php echo $ctg['product_id'] ?>">Edit</a>
                    <a class="btn-sm btn btn-danger" href="?status=delete&&id=<?php echo $ctg['product_id'] ?>">Delete</a>
                </td>
            </tr>

        <?php
        }
        ?>

    </tbody>
</table>