<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Background Remover</title>
    <style>
    @import URL("styl.css");    
    </style>
</head>
<body>
<div class="col-md-3"></div>
<div class="col-md-6 well"></div>
<h3 class="text-primary">Background Remover
</h3>


    <div class="col-md-2"></div>
    
    
    <br>
    
    
    
    <br>
    <div class="col-md-8">
        <?php
        if(isset($_SESSION['message'])):
        ?>
        <div class="alert alert-
            <?php echo $_SESSION['message']['alert']
                ?> msg">
            <?php echo $_SESSION['message']['text']
            ?>
    </div>
    <script>
        (function(){
            //USUWANIE WIADOMOŚCI PO 3sek od załadowania strony
                        setTimeout(function(){
document.querySelector('.msg').remove();
                        },3000)
        })();
        </script>

        <?php
        endif;
        //Czysczenie wiadomości
        unset($_SESSION['message']);
        ?>
        <form action = "login_query.php" method="POST">
    <h4 class = "text-succes">Zaloguj się</h4><br>


    <div class="form-group">
        <label> Nazwa użytkownika</label><br>
        <input type="text" name="username" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Hasło</label><br>
        <input type="password" name="password" class="form-control"/>
</div>
<br />
<div class="form-group">
<button class="button-17" role="button" name="register_button">Zaloguj się</button><br><br>
    </div>
    <h3>Nie masz jeszcze konta?</h3><br>
    <a href="registration.php">Zarejestruj się</a>
    </form>
    </div>
</div>

</body>
</html>