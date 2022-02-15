<?php
$obj_adminBack = new adminBack();
$product_result = $obj_adminBack->displayProduct();

if (isset($_GET['prostatus'])) {
    $pro_id = $_GET['id'];
    if ($_GET['prostatus'] == 'delete') {
        $msg = $obj_adminBack->deleteProduct($pro_id);
    }
}
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
            <th>Status</th>
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
                <td><?php
                    if ($ctg['product_status'] == 1) {
                        echo "Published";
                    } else {
                        echo "Unpublished";
                    }
                    ?></td>

                <td>
                    <a class="btn-sm btn btn-info" href="edit-product.php?prostatus=edit&&id=<?php echo $ctg['product_id'] ?>">Edit</a>
                    <a class="btn-sm btn btn-danger" href="?prostatus=delete&&id=<?php echo $ctg['product_id'] ?>">Delete</a>
                </td>
            </tr>

        <?php
        }
        ?>

    </tbody>
</table>