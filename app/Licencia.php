<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
    protected $table      = 'licencia';
    protected $primaryKey = 'id_licencia';

    protected $fillable = [
        'id_licencia',
        'nombre',
        'descripcion',
        'imagen',
        'imagen_small',
        'nit',
        'direccion',
        'ciudad',
    ];

    public function responsable()
    {
        return $this->belongsTo(Tercero::class, 'id_tercero_responsable', 'id_tercero');
    }

    public function get_imagen()
    {
        if ($this->imagen != null and $this->imagen != '') {
            return asset('imagenes/licencia/' . $this->imagen);
        } else {
            return asset('plantilla/images/app/counter.png');
        }
    }

    public function get_imagen_email()
    {
        if ($this->imagen_url != null and $this->imagen_url != '') {
            return $this->imagen_url;
        }
        if ($this->imagen != null and $this->imagen != '') {
            return asset('imagenes/licencia/' . $this->imagen);
        }
        return "";
    }

    public function get_imagen_small()
    {
        if ($this->imagen_small != null and $this->imagen_small != '') {
            return asset('imagenes/licencia/' . $this->imagen_small);
        } else {
            return asset('plantilla/images/app/counter.png');
        }
    }

    public function get_imagen_public()
    {
        if ($this->imagen != null and $this->imagen != '') {
            return public_path() . '/imagenes/licencia/' . $this->imagen;
        } else {
            return null;
        }
    }

    public static function get_usuarios($id_licencia)
    {
        $terceros = Tercero::where('id_licencia', $id_licencia)->get();
        $usuarios = [];
        foreach ($terceros as $tercero) {
            $usuario = Usuario::where('id_tercero', $tercero->id_tercero)->first();
            if ($usuario) {
                $usuarios[] = $usuario;
            }
        }
        return $usuarios;
    }

    public function get_nombre()
    {
        return $this->nombre;
    }

    public function get_nit()
    {
        return $this->nit;
    }

    public function get_direccion()
    {
        return $this->direccion;
    }

    public function get_ciudad()
    {
        return $this->ciudad;
    }
}
