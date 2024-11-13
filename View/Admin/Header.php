<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php 

session_start();
if(!isset($_SESSION['empleado'])){
    header('Location: ../../index.php');
    exit();
}

$empleado = $_SESSION['empleado'];
$listaEmpleados = isset($_SESSION['lista_empleados']) ? $_SESSION['lista_empleados'] : [];

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Panel Principal</title>
        <link rel="icon" href="../../img/logo_kellys_icon.png"/>
        <link rel="stylesheet" href="../../css/Style_Panel.css"/>
        <script src="../../js/script_panel.js"></script>
    </head>
    <body>
        <aside class="sidebar">
            <div class="user-info">
                <img src="../../img/avatar.png" alt="Usuario" class="user-img">
                <span class="user-name"><?php echo $empleado['nombres'] . " " . $empleado['apellidos']; ?></span>
                <span class="user-role-1"><?php echo $empleado['nivel']; ?></span>
            </div>
            <div class="user-options">
                <ul>
                    <li onclick="location.reload();"><img src="../../img/humano.png" alt="Asistencia"> <span>Empleados</span></li>
                    <li><img src="../../img/inmigracion.png" alt="Permisos"> <span>Reportes</span></li>
                    <li><img src="../../img/evaluacion.png" alt="Lista"> <span>Lista de Asistencias</span></li>
                </ul>
            </div>
        </aside>
        
        <header class="top-bar">
            <button id="sidebar-toggle">
                <img src="../../img/sidebar.png" alt="Toggle Sidebar" class="toggle-icon">
            </button>
            <img src="../../img/logo_kellys_1.png" alt="Logo" class="logo-centered">
            <div class="top-bar-icons">
                <img src="../../img/campana.png" alt="Notificaciones" class="icon">
                <a href="../../Controller/Opciones.php?opcion=3">
                    <img src="../../img/logout.png" alt="Cerrar Sesión" class="icon">
                </a>
            </div>
        </header>
        <div class="separator"></div>
