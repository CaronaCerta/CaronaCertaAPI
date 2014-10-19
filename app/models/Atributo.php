<?php

class Atributo extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'atributo';

    protected $fillable = array(
        'nome',
    );

    protected $guarded = array(
        'id_atributo',
    );

    public function avaliacao()
    {
        return $this->hasMany('Avaliacao', 'id_atributo');
    }
} 