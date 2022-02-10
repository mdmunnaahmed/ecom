<?php
$obj_adminBack = new adminBack();
$ctg_info = $obj_adminBack->displayCategory();
?>

<h2>Add Product</h2>

<form action="#0" name="product-form" method="POST" class="ctg-form w-100" enctype="multipart/form-data">
    <div class="form-group">
        <label for="product_name" class="form-label">Product Name</label>
        <input name="product_name" id="product_name" type="text" class="form-control" placeholder="Enter Product Name" required>
    </div>
    <div class="form-group">
        <label for="product_price" class="form-label">Product Name</label>
        <input name="product_price" id="product_price" type="number" class="form-control" placeholder="Enter Product Name" required>
    </div>
    <div class="form-group">
        <label for="product_des" class="form-label">Product Description</label>
        <textarea rows="3" name="product_des" id="product_des" type="text" class="form-control" placeholder="Enter Product Description" required></textarea>
    </div>
    <div class="form-group">
        <label for="product_img" class="form-label">Product Image</label>
        <input name="product_img" id="product_img" type="file" class="form-control" placeholder="Enter Product Image" required>
    </div>
    <div class="form-group">
        <label for="product_ctg" class="form-label">Product Category</label>
        <select name="product_ctg" id="product_ctg" class="form-select form-control">
            <option>Please Select a Category</option>
            <?php while ($ctg = mysqli_fetch_assoc($ctg_info)) { ?>
                <option> <?php echo $ctg['ctg_name'] ?> </option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="product_status" class="form-label">Product Category</label>
        <select name="product_status" id="product_status" class="form-select form-control">
            <option>Published</option>
            <option>Unpublished</option>
        </select>
    </div>
    <button name="product_btn" type="submit" class="btn btn-primary w-100 mb-2">Add Product</button>

    <?php if (isset($return_msg)) {
        echo $return_msg;
    } ?>
</form>