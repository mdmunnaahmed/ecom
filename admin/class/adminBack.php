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

    function add_category($data)
    {
        $ctg_name = $data['ctg_name'];
        $ctg_des = $data['ctg_des'];
        $ctg_status = $data['ctg_status'];

        $query = "INSERT INTO category(ctg_name, ctg_des, ctg_status) VALUE ('$ctg_name', '$ctg_des', $ctg_status)";
        if (mysqli_query($this->conn, $query)) {
            $message = "Category Added Successfully";
            return $message;
        } else {
            $message = "Failded to Add Categroy";
            return $message;
        }
    }
}
