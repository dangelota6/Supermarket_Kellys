<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Kelly`s</title>
        <link rel="icon" href="img/logo_kellys_icon.png"/>
        <link rel="stylesheet" href="css/Style.css"/>
        <script src="js/script_login.js"></script>
        <style>       
    </style>
    </head>
    <body>
        <div class="error-bar"><?php session_start(); if (isset($_SESSION['error_log'])) { echo $_SESSION['error_log']; unset($_SESSION['error_log']); } ?></div>
        <div class="container">
            <div class="login-box">
                <div class="left">
                    <img class="logo" src="img/logo_kellys_1.png" alt="alt"/>
                    <h2>Iniciar sesión</h2>
                    <form action="Controller/Opciones.php?opcion=1" method="post">
                        <div class="input-box">
                            <label for="username">Usuario: </label>
                            <input type="text" id="username" name="username" placeholder="Ingrese su nombre de usuario" required>
                        </div>
                        <div class="input-box">
                            <label for="password">Contraseña: </label>
                            <input type="password" id="password" name="password" placeholder="********" required>
                        </div>
                        <button type="submit">Ingresar</button>
                    </form>
                </div>
                <div class="right">
                    <img src="img/pexels-canvastudio-3194519_s.jpg" alt="alt"/>
                </div>
            </div>
        </div>
    </body>
</html>
