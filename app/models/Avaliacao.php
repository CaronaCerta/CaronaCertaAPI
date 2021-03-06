<?php

class Avaliacao extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'avaliacao';
    protected $primaryKey = 'id_avaliacao';

    protected $fillable = array(
        'id_atributo',
        'id_carona',
        'id_usuario_avaliador',
        'id_usuario_avaliado',
        'papel',
        'nota',
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