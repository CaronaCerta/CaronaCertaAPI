<?php

class Avaliacao extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'usuario';

    protected $fillable = array(
        'ic_atributo',
        'id_carona',
        'id_usuario_avaliador',
        'id_usuario_avaliado',
        'papel',
        'nota',
        'senha',
    );

    protected $guarded = array(
        'id_avaliacao',
    );

    public function atributo()
    {
        return $this->belongsTo('Atributo', 'id_atributo');
    }

    public function carona()
    {
        return $this->belongsTo('Carona', 'id_carona');
    }

    public function usuarioAvalidador()
    {
        return $this->belongsTo('Usuario', 'id_usuario_avaliador', 'id_usuario');
    }

    public function usuarioAvalidado()
    {
        return $this->belongsTo('Usuario', 'id_usuario_avaliado', 'id_usuario');
    }
} 