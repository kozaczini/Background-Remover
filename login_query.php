<?php
session_start();

require_once 'conn.php';

if(ISSET($_POST['register_button'])){
    if($_POST['username'] != "" || $_POST['password'] != ""){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql="SELECT * FROM `data` WHERE `username` =? AND `password` =?";
        $query = $conn->prepare($sql);
        $query->execute(array($username,$password));
        $row = $query->rowCount();
        $fetch = $query->fetch();
        if($row>0){
            $_SESSION['user'] = $fetch['id'];
            header("location:home.php");
        }else{
            echo "
            <script>
            alert('Nieprawidłowe hasło lub nazwa użytkownika')
            </script>
            <script>
            window.location='index.php'</script>
            ";
        }
        }else{
            echo "
            <script>
            alert('Wprowadź wszystkie dane!')
            </script>

            <script>
            window.location= 'index.php'</script>
            ";
        }
    }



?>