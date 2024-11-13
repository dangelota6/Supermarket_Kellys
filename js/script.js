/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */

function updateDateTime() {
    const dateElement = document.getElementById('date');
    const timeElement = document.getElementById('time');
    const now = new Date();

    // Formatear la fecha (día/mes/año)
    const day = String(now.getDate()).padStart(2, '0');
    const month = String(now.getMonth() + 1).padStart(2, '0'); // Los meses empiezan desde 0
    const year = now.getFullYear();
    dateElement.textContent = `${day}/${month}/${year}`;

    // Formatear la hora (hora:minutos:segundos)
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    timeElement.textContent = `${hours}:${minutes}:${seconds}`;
}

// Función para agregar número al campo de DNI
function addNumber(number) {
    const dniInput = document.getElementById('dni');
    if (dniInput.value.length < 8) { // Permitir solo hasta 8 números
        dniInput.value += number; // Agrega el número al final del valor existente
    } else {
        document.getElementById('error-message').textContent = "El DNI debe tener exactamente 8 dígitos."; // Mensaje de error
    }
}

// Función para limpiar el campo de DNI
function clearDNI() {
    document.getElementById('dni').value = '';
    document.getElementById('error-message').textContent = ''; // Limpiar mensaje de error
}

// Función para registrar el DNI
function submitDNI() {
    const dniInput = document.getElementById('dni');
    if (dniInput.value.length !== 8) { // Verificar longitud
        document.getElementById('error-message').textContent = "El DNI debe tener exactamente 8 dígitos."; // Mensaje de error
    } else {
        document.getElementById('error-message').textContent = ''; // Limpiar mensaje de error
        // Mostrar los botones de Ingreso y Salida
        document.getElementById('modal').style.display = 'flex';
        //alert(`DNI registrado: ${dniInput.value}`); // Aquí puedes implementar el registro
        // Puedes agregar la lógica para enviar el DNI al servidor o realizar alguna acción
    }
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
}

function submitAsistencia(tipo){
    const dniInput = document.getElementById('dni').value;
    const fecha = formatDate(document.getElementById('date').textContent);
    const hora = document.getElementById('time').textContent;
    
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../Controller/Opciones.php?opcion=2", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                //console.log(xhr.responseText);
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    closeModal(); // Cierra el modal de Ingreso/Salida
                    showSuccessModal(response.message);
                    document.getElementById('dni').value = '';// Muestra el modal de éxito
                } else {
                    alert("Error al registrar la asistencia: " + response.message);
                }
            } else {
                alert("Error en la solicitud: " + xhr.status);
            }
        }
    };
    const params = `dni=${encodeURIComponent(dniInput)}&fecha=${encodeURIComponent(fecha)}&hora=${encodeURIComponent(hora)}&tipo=${encodeURIComponent(tipo)}`;
    xhr.send(params);
}

// Función para mostrar el modal de éxito
function showSuccessModal(message) {
    document.getElementById('success-message').textContent = message;
    document.getElementById('success-modal').style.display = 'flex'; // Abre el modal de éxito
}

// Función para cerrar el modal de éxito
function closeSuccessModal() {
    document.getElementById('success-modal').style.display = 'none'; // Cierra el modal de éxito
}

function formatDate(dateString) {
    const parts = dateString.split('/');
    return `${parts[2]}-${parts[1]}-${parts[0]}`; // Cambiar a formato YYYY-MM-DD
}

// Actualizar la fecha y hora cada segundo
setInterval(updateDateTime, 1000);

// Inicializar con la hora actual
updateDateTime();


