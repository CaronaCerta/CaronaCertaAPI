<?php

class Motorista extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'motorista';
    protected $primaryKey = 'id_motorista';

    protected $fillable = array(
        'id_usuario',
        'numero_habilitacao',
        'data_habilitacao',
    );

    protected $guarded = array(
        'id_motorista',
    );

    public function usuario()
    {
        return $this->belongsTo('Usuario', 'id_usuario');
    }

    public function carro()
    {
        return $this->hasMany('Carro', 'id_motorista');
    }
} 