<?php
$obj_adminBack = new adminBack();
if (isset($_GET['prostatus'])) {
    $get_id = $_GET['id'];
    if ($_GET['prostatus'] == 'edit') {
        $result = $obj_adminBack->editToShow($get_id);
    }
}

if (isset($_POST['u_ctg_btn'])) {
    $msg = $obj_adminBack->updateCategory($_POST);
}
?>

<form action="" method="POST" class="ctg-form w-100">
    <input name="id" id="id" type="hidden" class="form-control" value="<?php echo $result['id'] ?>">
    <div class="form-group">
        <label for="u_ctg_name" class="form-label">Category Name</label>
        <input name="u_ctg_name" id="u_ctg_name" type="text" class="form-control" required value="<?php echo $result['ctg_name'] ?>">
    </div>
    <div class="form-group">
        <label for="u_ctg_des" class="form-label">Category Description</label>
        <textarea name="u_ctg_des" id="u_ctg_des" type="text" class="form-control" required><?php echo $result['ctg_des'] ?></textarea>
    </div>
    <button name="u_ctg_btn" type="submit" class="btn btn-primary w-100 mb-2">Update Category</button>

    <?php if (isset($msg)) {
        echo $msg;
    } ?>
</form>