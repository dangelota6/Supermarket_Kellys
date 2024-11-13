/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */

document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.sidebar');
    const topBar = document.querySelector('.top-bar');
    const mainContent = document.querySelector('.main-content');
    const separator = document.querySelector('.separator'); // Selecciona el separador
    const toggleButton = document.getElementById('sidebar-toggle');

    toggleButton.addEventListener('click', function() {
        // Alternar la clase 'collapsed' en la barra lateral y la barra superior
        sidebar.classList.toggle('collapsed');
        topBar.classList.toggle('collapsed');

        // Ajustar el margen del contenido principal
        mainContent.style.marginLeft = sidebar.classList.contains('collapsed') ? '80px' : '250px';

        // Ajustar la posición del separador
        separator.style.left = sidebar.classList.contains('collapsed') ? '80px' : '250px';
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const rows = document.querySelectorAll("table tbody tr");
    
    rows.forEach(row => {
        row.addEventListener("click", function() {
            // Elimina la clase 'selected' de todas las filas
            rows.forEach(r => r.classList.remove("selected"));
            // Agrega la clase 'selected' a la fila que fue clicada
            this.classList.add("selected");
        });
    });
});

function actualizarEmpleado() {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../../Controller/Opciones.php?opcion=5", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    // Obtener los valores de los campos del formulario
    const data = {
        id: document.getElementById('id').value,
        nombre: document.getElementById('nombre').value,
        apellido: document.getElementById('apellido').value,
        dni: document.getElementById('dni').value,
        correo: document.getElementById('correo').value,
        direccion: document.getElementById('direccion').value,
        telefono: document.getElementById('telefono').value,
        usuario: document.getElementById('usuario').value,
        contrasena: document.getElementById('contrasena').value,
        nivel: document.getElementById('nivel').value
    };

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            console.log(xhr.responseText);
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    mostrarAlert('Empleado actualizado con éxito');
                    // cerrarModal(); Cierra el modal después de actualizar
                    // Aquí puedes agregar el código para actualizar la tabla de empleados
                     refrescarTablaEmpleados();
                } else {
                    mostrarAlert('Error al actualizar el empleado: ' + (response.error || 'Error desconocido'));
                }
            } else {
                mostrarAlert('Error en la solicitud: ' + xhr.status);
            }
        }
    };

    xhr.send(JSON.stringify(data));
}

function mostrarAlert(message) {
    const alertDiv = document.getElementById('alert');
    const alertMessage = document.getElementById('alert-message');
    alertMessage.textContent = message;
    alertDiv.style.display = 'block';

    // Ocultar el alert después de 5 segundos
    setTimeout(() => {
        alertDiv.style.display = 'none';
    }, 5000);
}

function refrescarTablaEmpleados() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../../Controller/Opciones.php?opcion=6", true); // Nuevo caso para listar empleados

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const empleados = JSON.parse(xhr.responseText);
                const tbody = document.querySelector("table tbody");
                tbody.innerHTML = ""; // Limpiar tabla

                empleados.forEach(empleado => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${empleado.nombre}</td>
                        <td>${empleado.apellido}</td>
                        <td>${empleado.dni_emp}</td>
                        <td>${empleado.correo}</td>
                        <td>${empleado.direc_emp}</td>
                        <td>${empleado.tel_emp}</td>
                        <td>${empleado.name_nivel}</td>
                        
                        <td>
                            <button onclick="editarEmpleado(${empleado.id_emp})" class="edit-button">
                                <img src="../../img/editar-informacion.png" alt="Editar" class="edit-icon"> Editar
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            } else {
                alert('Error al refrescar la tabla de empleados: ' + xhr.status);
            }
        }
    };

    xhr.send();
}

function editarEmpleado(idEmp) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../../Controller/Opciones.php?opcion=4", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            console.log(xhr.responseText); 
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (!response.error) {
                    // Llenar los campos del modal
                    document.getElementById('id').value = response.id_emp;
                    document.getElementById('nombre').value = response.nombre;
                    document.getElementById('apellido').value = response.apellido;
                    document.getElementById('dni').value = response.dni_emp;
                    document.getElementById('correo').value = response.correo;
                    document.getElementById('direccion').value = response.direc_emp;
                    document.getElementById('telefono').value = response.tel_emp;
                    document.getElementById('usuario').value = response.name_emp;
                    document.getElementById('contrasena').value = response.pass_emp;
                    document.getElementById('nivel').value = response.name_nivel;
                    // Mostrar el modal
                    mostrarModal();
                } else {
                    alert("Error: " + response.error);
                }
            } else {
                alert("Error en la solicitud: " + xhr.status);
            }
        }
    };

    const params = `id_emp=${encodeURIComponent(idEmp)}`;
    xhr.send(params);
}

function mostrarModal() {
    document.getElementById('editarModal').style.display = 'block';
}

// Cerrar el modal
function cerrarModal() {
    document.getElementById('editarModal').style.display = 'none';
}

document.addEventListener("DOMContentLoaded", function () {
    // Función para actualizar fecha y hora en tiempo real
    function updateDateTime() {
        const dateElement = document.getElementById('date');
        const timeElement = document.getElementById('time');
        const now = new Date();

        // Formatear la fecha (día/mes/año)
        const day = String(now.getDate()).padStart(2, '0');
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Los meses empiezan desde 0
        const year = now.getFullYear();
        dateElement.value = `${year}-${month}-${day}`; // Usa el formato correcto para el input date

        // Formatear la hora (hora:minutos:segundos)
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        timeElement.value = `${hours}:${minutes}:${seconds}`; // Asigna valor a la entrada de tiempo
    }

    // Actualizar la fecha y hora cada segundo
    setInterval(updateDateTime, 1000);

    // Inicializar con la hora actual
    updateDateTime();
});

function submitAsistencia(tipo) {
    const dniInput = document.getElementById('dni').value;
    const fecha = formatDate(document.getElementById('date').value); // Usar .value para obtener la fecha
    const hora = document.getElementById('time').value; // Usar .value para obtener la hora    

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../../Controller/Opciones.php?opcion=2", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    showAlert("Éxito al registrar la asistencia: " + response.message, "success");
                } else {
                    showAlert("Error al registrar la asistencia: " + response.message, "error");
                }
            } else {
                showAlert("Error en la solicitud: " + xhr.status, "error");
            }
        }
    };

    const params = `dni=${encodeURIComponent(dniInput)}&fecha=${encodeURIComponent(fecha)}&hora=${encodeURIComponent(hora)}&tipo=${encodeURIComponent(tipo)}`;
    xhr.send(params);
}

function formatDate(dateString) {
    const parts = dateString.split('-'); 
    return `${parts[0]}-${parts[1]}-${parts[2]}`; 
}

// Función para mostrar el mensaje de alerta personalizado
function showAlert(message, type) {
    const alertBox = document.getElementById('custom-alert');
    alertBox.innerText = message;
    alertBox.className = `custom-alert ${type}`; // Añadir clase según el tipo (success o error)

    // Mostrar el alert
    alertBox.style.display = 'block';

    // Ocultar el alert después de 5 segundos
    setTimeout(function() {
        alertBox.style.display = 'none';
    }, 5000);
}

