<?php

class Session extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'session';

    protected $fillable = array(
        'key',
        'id_usuario',
    );

    protected $guarded = array(
        'id_session',
    );

    public function usuario()
    {
        return $this->belongsTo('Usuario', 'id_usuario');
    }

    public static function generateKey()
    {
        return md5(uniqid(rand(), true));
    }
}