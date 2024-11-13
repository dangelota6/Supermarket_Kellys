/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */

document.addEventListener('DOMContentLoaded', function() {    
    const errorBar = document.querySelector('.error-bar');
    if (errorBar && errorBar.textContent.trim() !== '') {
        errorBar.classList.add('show-error-bar');


        setTimeout(() => {
            errorBar.classList.remove('show-error-bar');
        }, 5000);  // 5000 milisegundos = 5 segundos


        document.querySelectorAll('input').forEach(input => {
            input.classList.add('input-error');
        });
    }
});

