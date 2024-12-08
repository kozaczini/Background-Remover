<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarejestruj się</title>
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

    <div class="col-md-8">
    <form action="register_query.php" method="POST">
    <h4 class="text-succes">Zarejestruj się</h4><br>

    <div class=" form-group">
        <label>
            Nazwa Użytkownika<br>
        </label>
        <input type="text" class="form-control" name="username"/>
    </div>
    <div class=" form-group">
        <label>
            Email
        </label><br>
        <input type="text" class="form-control" name="email"/>
    </div>
    <div class=" form-group">
        <label>
            Hasło
        </label><br>
        <input type="password" class="form-control" name="password"/>
    </div>
    <button class="button-17" role="button" name="register_button">Stwórz</button><br>
 
    <h3>Masz już konto?</h3>
    <a href="index.php">Zaloguj się</a>
    </div>
</form>
</div>
</div>
</body>
</html>