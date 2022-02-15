<?php
class adminBack
{
    private $conn;
    public function __construct()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "ecom";

        $this->conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        if (!$this->conn) {
            die("Database Connection Error");
        } else {
        }
    }

    // Login Logout Method
    function admin_login($data)
    {
        $admin_email =  $_POST['admin_email'];
        $admin_pass =  md5($_POST['admin_pass']);

        $query = "SELECT * FROM adminLog WHERE admin_email = '$admin_email' AND admin_pass = '$admin_pass'";

        if (mysqli_query($this->conn, $query)) {
            $result = mysqli_query($this->conn, $query);
            $admin_info = mysqli_fetch_assoc($result);

            if ($admin_info) {
                header("Location: dashboard.php");
                session_start();
                $_SESSION['id'] = $admin_info['id'];
                $_SESSION['admin_email'] = $admin_info['admin_email'];
            } else {
                echo "Your Username or Password is Incorrect";
            }
        }
    }
    function adminLogout()
    {
        unset($_SESSION['id']);
        header('location: index.php');
    }


    // Category Method
    function add_category($data)
    {
        $ctg_name = $data['ctg_name'];
        $ctg_des = $data['ctg_des'];
        $ctg_status = $data['ctg_status'];

        $query = "INSERT INTO category(ctg_name, ctg_des, ctg_status) VALUE ('$ctg_name', '$ctg_des', $ctg_status)";
        if (mysqli_query($this->conn, $query)) {
            $message = "Category Added Successfully";
            return $message;
            header('location:manage-category.php');
        } else {
            $message = "Failded to Add Categroy";
            return $message;
        }
    }

    function displayCategory()
    {
        $query = "SELECT * FROM category";
        if (mysqli_query($this->conn, $query)) {
            $result_ctg = mysqli_query($this->conn, $query);
            return $result_ctg;
        } else {
            echo "Couldn't Load Data Correctly";
        }
    }

    function publishCategory($id)
    {
        $query = "UPDATE category SET ctg_status=1 WHERE id=$id";
        mysqli_query($this->conn, $query);
        $msg = "Category Successfully Published";
        return $msg;
    }
    function unPublishCategory($id)
    {
        $query = "UPDATE category SET ctg_status=0 WHERE id=$id";
        mysqli_query($this->conn, $query);
        $msg = "Category Successfully Unpublished";
        return $msg;
    }

    function deleteCategory($id)
    {
        $query = "DELETE FROM category WHERE id = $id";
        if (mysqli_query($this->conn, $query)) {
            $msg = "Category Successfully Deleted";
            return $msg;
        }
    }

    function editToShow($id)
    {
        $query = "SELECT * FROM category WHERE id = $id";
        if (mysqli_query($this->conn, $query)) {
            $cat_info = mysqli_query($this->conn, $query);
            $cat_fetch = mysqli_fetch_assoc($cat_info);
            return $cat_fetch;
        }
    }

    function updateCategory($recieve_data)
    {
        $ctg_name = $recieve_data['u_ctg_name'];
        $ctg_des = $recieve_data['u_ctg_des'];
        $id = $recieve_data['id'];

        $query = "UPDATE category SET ctg_name = '$ctg_name', ctg_des = '$ctg_des' WHERE id = '$id' ";
        if (mysqli_query($this->conn, $query)) {
            $msg = "Category Successfully Updated";
            return $msg;
        }
    }

    function addProduct($recieve_data)
    {
        $product_name = $recieve_data['product_name'];
        $product_price = $recieve_data['product_price'];
        $product_des = $recieve_data['product_des'];
        $product_ctg = $recieve_data['product_ctg'];

        $product_img_name = $_FILES['product_img']['name'];
        $product_img_size = $_FILES['product_img']['size'];
        $product_img_tmp_name = $_FILES['product_img']['tmp_name'];
        $product_ext = pathinfo($product_img_name, PATHINFO_EXTENSION);

        $product_status = $recieve_data['product_status'];

        if ($product_ext == 'png' or $product_ext == 'jpg' or $product_ext == 'jpeg') {
            if ($product_img_size <= 20097152) {

                $query = "INSERT INTO products(product_name, product_price, product_des, product_ctg, product_img ,product_status) VALUE ('$product_name',  $product_price, '$product_des', $product_ctg, '$product_img_name', $product_status)";

                if (mysqli_query($this->conn, $query)) {
                    move_uploaded_file($product_img_tmp_name, 'upload/' . $product_img_name);
                    $msg = "Product Added Successfully";
                    return $msg;
                } else {
                    $msg = "Faild to add Product";
                    return $msg;
                }
            } else {
                $msg = "your file size should be less than 2Mib";
                return $msg;
            }
        } else {
            $msg = "Your file format not supported";
            return $msg;
        }
    }

    function displayProduct() {
        $query = "SELECT * FROM product_info_ctg";
        if(mysqli_query($this->conn, $query)) {
            $product = mysqli_query($this->conn, $query);
            return $product;
        }
    }
}
