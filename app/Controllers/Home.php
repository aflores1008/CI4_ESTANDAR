<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('Bienvenido');
    }
       
    public function prueba ()
    {
        echo 'Bienvenido al API REST ';
    }

    
    public function login(){

        
return view('login');
    
    }
    public function getUsers()
    {
        echo 'Bienvenido a la informacion sobre el registro de usuarios en Facebook ';
        $this->db=\Config\Database::connect();
        $query=$this->db->query("SELECT * FROM usuarios");
        $result=$query->getResult();
      
        return $this->response->setJSON($result);
    
    
    
    }
    
   /* Function: select (getUser (usuario))*/
    public function getUser($usuario)
    {
        $this->db=\Config\Database::connect();
        $query=$this->db->query("SELECT * FROM usuarios where usuario='$usuario' ");
        $result=$query->getResult();
        return $this->response->setJSON($result);
    
    }

        /* Function: insert (create) data on the table usuarios */
        public function create($usuari,$nombr,$apellid,$correo,$telf,$fechar){
            $query = $this->db->query("insert into usuarios (usuario,nombre,apellido,correo_electronico,telefono,fecha_registro) 
                                        values('$usuari','$nombr','$apellid','$correo','$telf','$fechar')");
                if($query){
                    return "success";
                }else{
                    return "failed";
                }}


    public function deleteUser($id)
{
    $this->db = \Config\Database::connect();
    $this->db->transStart(); // Iniciar una transacción para asegurar consistencia de la base de datos
    
    // Verificar si el id existe antes de eliminarlo
    $query = $this->db->query("SELECT * FROM usuarios WHERE id = '$id'");
    $result = $query->getRow();
    
    if ($result) {
        // Si el id existe, proceder con la eliminación
        $this->db->query("DELETE FROM usuarios WHERE id = '$id'");
        $this->db->transComplete(); // Completar la transacción
        
        if ($this->db->transStatus() === false) {
            // Si ocurre algún error durante la transacción, se realiza un rollback
            $this->db->transRollback();
            return $this->response->setJSON(['Success' => False, 'Message' => 'Error al eliminar el usuario.']);
        } else {
            return $this->response->setJSON(['Success' => True, 'Message' => 'Usuario eliminado correctamente.']);
        }
    } else {
        return $this->response->setJSON(['Success' => False, 'Message' => 'El usuario no existe.']);
    }
}

    
    
    
}