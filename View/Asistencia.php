<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Asistencia Kelly`s</title>
        <link rel="icon" href="../img/logo_kellys_icon.png"/>
        <link rel="stylesheet" href="../css/Style.css"/>
        <script src="../js/script.js" defer></script>
    </head>
    <body>
        <div class="container">
            <div class="form-box">
                <h2>REGISTRAR ASISTENCIA ENTRADA/SALIDA</h2>
                <div class="content">
                    <div class="left1">
                        <p>DNI: <input type="text" class="dni-select" id="dni"></p>                        
                        <div class="num-pad">
                            <button onclick="addNumber('1')">1</button>
                            <button onclick="addNumber('2')">2</button>
                            <button onclick="addNumber('3')">3</button>
                            <button onclick="addNumber('4')">4</button>
                            <button onclick="addNumber('5')">5</button>
                            <button onclick="addNumber('6')">6</button>
                            <button onclick="addNumber('7')">7</button>
                            <button onclick="addNumber('8')">8</button>
                            <button onclick="addNumber('9')">9</button>
                            <button onclick="addNumber('0')">0</button>
                        </div>
                    </div>
                    <div class="right2">
                        <p>Fecha: <span id="date"></span></p>
                        <p>Hora: <span id="time"></span></p>
                        <button class="clear-btn" onclick="clearDNI()">Borrar</button>
                    </div>
                </div>
                <button class="submit-btn" onclick="submitDNI()">REGISTRAR</button>
                <p id="error-message" style="color: red;"></p>
                <div id="modal" class="modal" style="display: none;">
                    <div class="modal-content">
                        <span class="close-button" onclick="closeModal()">&times;</span>
                        <h3>Selecciona la acción:</h3>
                        <button class="submit-btn" onclick="submitAsistencia('Ingreso')">Ingreso</button>
                        <button class="submit-btn" onclick="submitAsistencia('Salida')">Salida</button>
                    </div>
                </div>
                <div id="success-modal" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close-button" onclick="closeSuccessModal()">&times;</span>
                    <h3 id="success-message"></h3>
                </div>
            </div>
            </div>
        </div>
    </body>    
</html>
