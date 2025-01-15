<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\m_usuarios;

class c_usuarios extends Controller
{
    public function inicio()
    {

        return view('v_usuarios/inicio');

    }

    public function registro()
    {

        return view('v_usuarios/registro');

    }

    public function perfil()
    {

        $usuario = session()->get('usuario');
        
        if (!$usuario) {

            return redirect()->to('http://localhost:8080');

        }
        
        return view('v_usuarios/perfil', ['usuario' => $usuario]);
    }
    
    public function validar_ingreso()
    {
        // Obtener los datos del formulario
        $correo = $this->request->getPost('correo');
        $contraseña = $this->request->getPost('contraseña');
    
        if (empty($correo) || empty($contraseña)) {
            return redirect()->to('http://localhost:8080')->with('error', 'El correo y la contraseña son obligatorios.');
        }

        $modelo = new m_usuarios();
    
        $usuario = $modelo->where('correo', $correo)->first();
    
        // Verificar si el usuario existe y la contraseña coincide
        if ($usuario && $usuario['contraseña'] === $contraseña) {
        
            // Guardar los datos del usuario en la sesión
            session()->set('usuario', $usuario);
    
            // Redirigir según el rol del usuario
            if ($usuario['rol'] == 1) { // Administrador
                return redirect()->to('http://localhost:8080/tabla');
            }
    
            // Usuario regular
            return redirect()->to('http://localhost:8080/perfil');

        } else {

            // Si no coincide, redirigir al inicio con un mensaje de error
            return redirect()->to('http://localhost:8080')->with('error', 'Correo o contraseña incorrectos.');

        }
    }
    


    public function tabla()
    {
        $usuario = session()->get('usuario');
    
        // Restringir acceso si no es administrador
        if (!$usuario || $usuario['rol'] != 1) {
            return redirect()->to('http://localhost:8080')->with('error', 'Acceso no autorizado.');
        }

        $modelo = new m_usuarios();
        // Obtener todos los usuarios
        $usuarios = $modelo->findAll();
    
        // Pasar los usuarios a la vista
        return view('v_usuarios/tabla', ['usuarios' => $usuarios]);
    }
    

    public function actualizar()
    {
        // Obtener los datos del formulario
        $data = $this->request->getPost();

        // Recuperar el correo original para buscar el usuario
        $correoOriginal = $data['correo_original'];

        // Datos a actualizar
        $usuarioData = [
            'nombre' => $data['nombre'],
            'correo' => $data['correo'],
            'contraseña' => $data['contraseña'],
            'rol' => $data['rol']
        ];

        $modelo = new m_usuarios();

        $resultado = $modelo->actualizarUsuario($correoOriginal, $usuarioData);

        if ($resultado) {

            return redirect()->to('/tabla');

        } else {

            return redirect()->to('/tabla')->with('error', 'Error al actualizar el usuario');
            
        }
    }


    public function actualizar_perfil()
    {
        $usuario = session()->get('usuario'); 

        if (!$usuario) {
            return redirect()->to('http://localhost:8080')->with('error', 'No estás logueado');
        }
        // Obtener el correo actual desde la sesión
        $correoActual = $usuario['correo'];

        // Obtener los datos del formulario
        $data = $this->request->getPost();

        // Validar que los campos no estén vacíos
        if (empty($data['nombre']) || empty($data['correo']) || empty($data['contraseña'])) {
            return redirect()->to('http://localhost:8080/perfil')->with('error', 'Todos los campos son obligatorios.');
        }

        $modelo = new m_usuarios();

        // Crear el array de datos a actualizar
        $datosActualizados = [
            'nombre' => $data['nombre'],
            'correo' => $data['correo'], 
            'contraseña' => $data['contraseña'],
        ];

        $resultado = $modelo->actualizarUsuario($correoActual, $datosActualizados);

        if ($resultado) {
            // Actualizar la sesión con los nuevos datos
            session()->set('usuario', array_merge(session()->get('usuario'), [
                'correo' => $data['correo'],
                'nombre' => $data['nombre'],
            ]));
            
            // Redirigir con mensaje de éxito
            return redirect()->to('http://localhost:8080/perfil')->with('success', 'Perfil actualizado correctamente.');
        } else {
            // Si no se pudo actualizar, dar retroalimentación
            return redirect()->back()->with('error', 'Hubo un problema al actualizar el perfil. Intenta de nuevo.');

        }
    }
    public function guardar_usuario()
    {
    // Obtener datos del formulario
    $nombre = $this->request->getPost('nombre');
    $correo = $this->request->getPost('correo');
    $contraseña = $this->request->getPost('contraseña');

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($correo) || empty($contraseña)) {
        return redirect()->back()->with('error_campos', 'Todos los campos son obligatorios');
    }

    // Instanciar el modelo
    $modelo = new m_usuarios();

    // Verificar si el correo ya existe
    $usuarioExistente = $modelo->where('correo', $correo)->first();
    if ($usuarioExistente) {
        return redirect()->to('http://localhost:8080/registro')->with('error_correo', 'El correo ya está registrado. Intenta con otro.');
    }

    // Preparar los datos para insertar
    $data = [
        'nombre' => $nombre,
        'correo' => $correo,
        'contraseña' => $contraseña,
    ];

    // Guardar usuario en la base de datos
    if ($modelo->insert($data)) {
        // Redirigir a la URL relativa del inicio
        return redirect()->to('http://localhost:8080/')->with('success', 'Usuario registrado con éxito');

    } else {
        // Redirigir a la URL relativa del registro
        return redirect()->to('http://localhost:8080/registro')->with('error', 'Error al registrar el usuario');
        
    }
    }
    public function eliminar_cuenta()
{
    $correo = session()->get('usuario')['correo'];

    if (!$correo) {
        return redirect()->to('/registro');
    }

    $modelo = new m_usuarios();

    // Eliminar el usuario de la base de datos usando el correo
    $modelo->where('correo', $correo)->delete();

    session()->remove('usuario');

    return redirect()->to('/');
}

public function eliminar_tabla()
{
    // Obtener el correo del usuario a eliminar desde el formulario
    $correo = $this->request->getPost('correo');

    $modelo = new m_usuarios();

    // Eliminar el usuario de la base de datos usando el correo
    if ($modelo->where('correo', $correo)->delete()) {
        return redirect()->to('/tabla')->with('success', 'Usuario eliminado correctamente.');
    } else {
        return redirect()->to('/tabla')->with('error', 'No se pudo eliminar el usuario. Inténtalo nuevamente.');
    }
}



}
