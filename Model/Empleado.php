<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once 'Conexion.php';

class Empleado{
    private $id_emp;
    private $nombre;
    private $apellido;
    private $dni_emp;
    private $correo;
    private $direc_emp;
    private $tel_emp;
    private $name_emp;
    private $pass_emp;
    private $img_usu;
    private $key_nivel;
    private $registro;
    
    // Métodos GET y SET

    // id_emp
    public function getIdEmp() {
        return $this->id_emp;
    }

    public function setIdEmp($id_emp) {
        $this->id_emp = $id_emp;
    }

    // nombre
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // apellido
    public function getApellido() {
        return $this->apellido;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    // dni_emp
    public function getDniEmp() {
        return $this->dni_emp;
    }

    public function setDniEmp($dni_emp) {
        $this->dni_emp = $dni_emp;
    }

    // correo
    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    // direc_emp
    public function getDirecEmp() {
        return $this->direc_emp;
    }

    public function setDirecEmp($direc_emp) {
        $this->direc_emp = $direc_emp;
    }

    // tel_emp
    public function getTelEmp() {
        return $this->tel_emp;
    }

    public function setTelEmp($tel_emp) {
        $this->tel_emp = $tel_emp;
    }

    // name_emp
    public function getNameEmp() {
        return $this->name_emp;
    }

    public function setNameEmp($name_emp) {
        $this->name_emp = $name_emp;
    }

    // pass_emp
    public function getPassEmp() {
        return $this->pass_emp;
    }

    public function setPassEmp($pass_emp) {
        $this->pass_emp = $pass_emp;
    }

    // img_usu
    public function getImgUsu() {
        return $this->img_usu;
    }

    public function setImgUsu($img_usu) {
        $this->img_usu = $img_usu;
    }

    // key_nivel
    public function getKeyNivel() {
        return $this->key_nivel;
    }

    public function setKeyNivel($key_nivel) {
        $this->key_nivel = $key_nivel;
    }

    // registro
    public function getRegistro() {
        return $this->registro;
    }

    public function setRegistro($registro) {
        $this->registro = $registro;
    }

    function Validar_Login($usuario, $password){
        $conectar = abrirConexion();

        try{
            $consulta = $conectar->prepare("EXEC spLogueo :ncredencial, :ncontra");
            $consulta->bindParam(':ncredencial', $usuario, PDO::PARAM_STR);
            $consulta->bindParam(':ncontra', $password, PDO::PARAM_STR);
            $consulta->execute();
            /*$estado = $consulta->fetchColumn();*/
            $estado = $consulta->fetch(PDO::FETCH_ASSOC);
            return $estado ?: null;
        } catch (PDOException $ex) {
            return "Error en la validación de login: " . $ex->getMessage();
        } finally {
            cerrarConexion($conectar);
        }
    }
    
    function ListarEmpleados(){
        $conectar = abrirConexion();
        
        try{
            $consulta = $conectar->prepare("EXEC ListarEmpleados");
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $resultado ?: [];
        } catch (Exception $ex) {
            return "Error al listar empleados: " . $ex->getMessage();
        } finally {
            cerrarConexion($conectar);
        }
    }
    
    function ObtenerEmpId($id_emp){
        $conectar = abrirConexion();
        
        try{
            $consulta = $conectar->prepare("EXEC Listar_empleado_ID :idemp");
            $consulta->bindParam(':idemp', $id_emp, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
        } catch (Exception $ex) {
            return "Error al obtener el empleado: " . $ex->getMessage();
        } finally {
            cerrarConexion($conectar);
        }
    }
    
    function ActualizarEmp($data){
        $conectar = abrirConexion();        
        try{
            $consulta = $conectar->prepare("EXEC Actualizar_empleado 
                @id_emp = :id_emp,
                @nombre = :nombre,
                @apellido = :apellido,
                @dni_emp = :dni_emp,
                @correo = :correo,
                @direc_emp = :direc_emp,
                @tel = :tel,
                @name_emp = :name_emp,
                @pass_emp = :pass_emp,
                @name_nivel = :name_nivel");
            $consulta->bindParam(':id_emp', $data['id']);
            $consulta->bindParam(':nombre', $data['nombre']);
            $consulta->bindParam(':apellido', $data['apellido']);
            $consulta->bindParam(':dni_emp', $data['dni']);
            $consulta->bindParam(':correo', $data['correo']);
            $consulta->bindParam(':direc_emp', $data['direccion']);
            $consulta->bindParam(':tel', $data['telefono']);
            $consulta->bindParam(':name_emp', $data['usuario']);
            $consulta->bindParam(':pass_emp', $data['contrasena']);
            $consulta->bindParam(':name_nivel', $data['nivel']);
            return $consulta->execute();
        } catch (Exception $ex) {
            return false; // o manejar el error de otra manera
        } finally {
            cerrarConexion($conectar);
        }
    }
}


