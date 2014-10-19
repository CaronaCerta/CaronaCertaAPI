<?php

class Usuario extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'usuario';

    protected $fillable = array(
        'username',
        'email',
        'senha',
        'nome',
        'data_nascimento',
        'telefone',
        'endereco',
        'cidade',
    );

    protected $hidden = array(
        'senha',
    );

    protected $guarded = array(
        'id_usuario',
    );

    public function motorista()
    {
        return $this->hasOne('Motorista', 'id_usuario');
    }

    public function passageiros()
    {
        return $this->hasMany('Passageiro', 'id_usuario');
    }

    public function avaliacoesFeitas()
    {
        return $this->hasMany('Avaliacao', 'id_usuario_avaliador');
    }

    public function passageirosRecebidas()
    {
        return $this->hasMany('Avaliacao', 'id_usuario_avaliado');
    }

    public function sessions()
    {
        return $this->hasMany('Session', 'id_usuario');
    }
} 