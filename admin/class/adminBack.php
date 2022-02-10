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
}
