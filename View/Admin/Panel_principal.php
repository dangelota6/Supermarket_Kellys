<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php include 'Header.php'; ?>

<main class="main-content">
    <div id="editarModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <h2>Editar Empleado</h2>
            <form id="form-editar-empleado" class="form-grid"> <!-- Agregada la clase form-grid -->
                <input type="hidden" id="id" name="id" required>
                <div class="form-group2">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="form-group2">
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" required>
                </div>
                <div class="form-group2">
                    <label for="dni">DNI:</label>
                    <input type="text" id="dni" name="dni" required>
                </div>
                <div class="form-group2">
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" required>
                </div>
                <div class="form-group2">
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" required>
                </div>
                <div class="form-group2">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" required>
                </div>
                <div class="form-group2">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" required>
                </div>
                <div class="form-group2">
                    <label for="contrasena">Contraseña:</label>
                    <input type="text" id="contrasena" name="contrasena" required>
                </div>
                <div class="form-group2">
                    <label for="nivel">Rango:</label>
                    <select id="nivel" name="nivel" required>
                        <option value="Administrador">Administrador</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Empleado">Empleado</option>
                    </select>
                    <!--<input type="text" id="nivel" name="nivel" readonly>-->
                </div>
                <div class="button-container">
                    <button type="button" class="btn left-btn" onclick="actualizarEmpleado()">Actualizar</button>
                    <button type="button" class="btn right-btn" onclick="cerrarModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    <div id="alert">
        <span id="alert-message"></span>
    </div>
    <h1>Lista de Empleados</h1>
    <table>
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>DNI</th>
                <th>Correo</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Rango</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($listaEmpleados)): ?>
                <?php foreach ($listaEmpleados as $empleado): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($empleado['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($empleado['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($empleado['dni_emp']); ?></td>
                        <td><?php echo htmlspecialchars($empleado['correo']); ?></td>
                        <td><?php echo htmlspecialchars($empleado['direc_emp']); ?></td>
                        <td><?php echo htmlspecialchars($empleado['tel_emp']); ?></td>
                        <td><?php echo htmlspecialchars($empleado['name_nivel']); ?></td>
                        <td>
                            <button onclick="editarEmpleado(<?php echo $empleado['id_emp']; ?>)" class="edit-button">
                                <img src="../../img/editar-informacion.png" alt="Editar" class="edit-icon"> Editar
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No hay empleados registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include 'Footer.php'; ?>
