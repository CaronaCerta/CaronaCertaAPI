<?php

class Carro extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'carro';

    protected $fillable = array(
        'modelo',
        'descricao',
        'id_motorista',
    );

    protected $guarded = array(
        'id_carro',
    );

    public function motorista()
    {
        return $this->belongsTo('Motorista', 'id_motorista');
    }

    public function caronas()
    {
        return $this->hasMany('Carona', 'id_carro');
    }
} 