<?php

class Carona extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'usuario';

    protected $fillable = array(
        'id_carro',
        'lugar_saida',
        'lugar_destino',
        'lugares_disponiveis',
        'observacoes',
    );

    protected $guarded = array(
        'id_carona',
    );

    public function carro()
    {
        return $this->belongsTo('Carro', 'id_carro');
    }

    public function passageiros()
    {
        return $this->hasMany('Passageiro', 'id_carona');
    }

    public function avaliacoes()
    {
        return $this->hasMany('Avaliacao', 'id_carona');
    }
} 