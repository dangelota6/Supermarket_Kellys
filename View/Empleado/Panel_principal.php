<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php include 'Header.php'; ?>

<main class="main-content">
    <h1>Asistencia</h1>
    <div id="custom-alert" class="custom-alert"></div>
    <!-- Campos de visualización de datos -->
    <form class="form-grid" id="asistenciaForm">
        <div class="form-group">
            <label for="nombres">Nombres</label>
            <input type="text" id="nombres" value="<?php echo $empleado['nombres']; ?>" readonly>
        </div>

        <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" value="<?php echo $empleado['apellidos']; ?>" readonly>
        </div>

        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" id="dni" value="<?php echo $empleado['dni']; ?>" readonly>
        </div>

        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" id="correo" value="<?php echo $empleado['correo']; ?>" readonly>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" value="<?php echo $empleado['direccion']; ?>" readonly>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" value="<?php echo $empleado['telefono']; ?>" readonly>
        </div>
        
        <div class="form-group">
            <label for="time">Hora</label>
            <input type="text" id="time" readonly>
        </div>
        
        <div class="form-group">
            <label for="date">Fecha</label>
            <input type="date" id="date" readonly>
        </div>
        
        <div class="button-container">
            <button type="button" class="btn left-btn" onclick="submitAsistencia('Ingreso')">Registrar Ingreso</button>
            <button type="button" class="btn right-btn" onclick="submitAsistencia('Salida')">Registrar Salida</button>
        </div>
    </form>
</main>

<?php include 'Footer.php'; ?>
