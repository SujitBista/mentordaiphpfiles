
<?php

if ($_SERVER['REQUEST_METHOD'] =='POST'){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];

    $password = password_hash($password, PASSWORD_DEFAULT);
    function register($name,$email,$password,$c_password){
        if(password_verify($c_password,$password)){
            require_once 'connect.php';

            $sql = "INSERT INTO mentor_users_table (name, email, password) VALUES ('$name', '$email', '$password')";

            if ( mysqli_query($connection, $sql) ) {
                $result["success"] = "1";
                $result["message"] = "success";

                echo json_encode($result);
                mysqli_close($connection);

            } else {

                $result["success"] = "0";
                $result["message"] = "error";

                echo json_encode($result);
                mysqli_close($connection);
            }
        }else{
            $result["success"] = "2";
            $result["message"] = "Password did not matched";
            echo json_encode($result);
        }
    }

    register($name,$email,$password,$c_password);
  
}


?>