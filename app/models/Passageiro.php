<?php

class Passageiro extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'passageiro';

    protected $fillable = array(
        'id_usuario',
        'id_carona',
    );

    protected $guarded = array(
        'id_passageiro',
    );

    public function Usuario()
    {
        return $this->hasMany('Usuario', 'id_usuario');
    }

    public function Carona()
    {
        return $this->hasMany('Carona', 'id_carona');
    }
} 