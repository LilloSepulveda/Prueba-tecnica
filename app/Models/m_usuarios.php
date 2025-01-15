<?php

namespace App\Models;

use CodeIgniter\Model;

class m_usuarios extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'correo', 'contraseña', 'rol'];

    public function registrarUsuario($data)
    {
        return $this->insert($data);
    }

    //actualizar un usuario
    public function actualizarUsuario($correoActual, $data)
    {
        $usuario = $this->where('correo', $correoActual)->first();

        if ($usuario) {

            return $this->where('correo', $correoActual)->set($data)->update();

        } else {

            return false;

        }
    }
    
}
