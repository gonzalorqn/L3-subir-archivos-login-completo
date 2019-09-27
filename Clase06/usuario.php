<?php
class usuario
{
    public $id;
    public $nombre;
    public $apellido;
    public $clave;
    public $perfil;
    public $estado;
    public $correo;
    public $foto;

    public function MostrarDatos()
    {
        return $this->id." - ".$this->nombre." - ".$this->apellido." - ".$this->clave." - ".$this->perfil." - ".$this->estado." - ".$this->correo;
    }

    public static function TraerTodosLosUsuarios()
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT `id`, `nombre`, `apellido`, `clave`, `perfil`, `estado`, `correo`, `foto` FROM `usuarios` WHERE 1");        
        
        $consulta->execute();
        
        $consulta->setFetchMode(PDO::FETCH_INTO, new usuario);                                                

        return $consulta; 
    }

    public function InsertarElUsuario()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios(nombre, apellido, clave, perfil, estado, correo, foto) VALUES (:nombre,:apellido,:clave,:perfil,:estado,:correo, :foto)");
        
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':correo', $this->correo, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':perfil', $this->perfil, PDO::PARAM_INT);
        $consulta->bindValue(':estado', $this->estado, PDO::PARAM_INT);
        $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);

        $consulta->execute();
        return $consulta->rowCount();
    }

    public function ExisteEnBD($correo,$clave)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM `usuarios` WHERE `clave` = :clave && `correo` = :correo");        
        $consulta->bindValue(":clave",$clave,PDO::PARAM_STR);
        $consulta->bindValue(":correo",$correo,PDO::PARAM_STR);
        $consulta->execute();
        if($consulta->rowCount() == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}