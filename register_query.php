<?php
session_start();
//Dołaczenie conn.php
require_once 'conn.php';
// Sprawdzenie czy przycisk zostal klikniety
if(ISSET($_POST['register_button'])){
    //Sprawdzenie czy wszystkie pola są uzupelnione
    if($_POST['username'] != "" || $_POST['email'] != "" || $_POST['password'] != ""){
        try{
            //Przypisanie danych z formularza do zmiennych
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            //Warunek hasła
            if(!preg_match('/[A-Z]/', $password) || !preg_match('/\d/', $password)){
                echo "
                <script>
                alert('Hasło musi mieć conajmniej jedną dużą literę i cyfrę')
                </script>
                <script>
                window.location = 'registration.php'
                </script>";
                exit();
            }
            //Tryb raportowania błędów
$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$check = $conn->prepare("SELECT * FROM `data` WHERE `username` = :username OR `email` = :email");
$check -> execute(['username' => $username, 'email' => $email]);

if($check->rowCount()>0){
    echo"
<script>
alert('Nazwa użytkownika albo Email jest zajęte')
</script>
<script>
window.location = 'registration.php'
</script>
    ";
    exit();
}

$sql="INSERT INTO `data` (`id`, `username`, `email`, `password`) VALUES (NULL, '$username', '$email', '$password');";
                $conn->exec($sql);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        //Dodanei do sesji komunikatu o powodzeniu
    $_SESSION['message']=array("text"=> "Konto pomyślnie utworzone.","alert"=>"info");
    $conn=null;
    header('location:index.php');
    }else{
        echo "
        <script>
            alert('Uzupełnij potrzebne informacje!')
        </script>
        <script>
        window.location = 'registration.php'
        </script>";
    }
}
?>