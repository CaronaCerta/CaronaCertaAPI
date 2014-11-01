<?php

class Usuario extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';

    protected $fillable = array(
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

    public function avaliacoesRecebidas()
    {
        return $this->hasMany('Avaliacao', 'id_usuario_avaliado');
    }

    public function sessions()
    {
        return $this->hasMany('Session', 'id_usuario');
    }
    
	/**
    * Checking for duplicate user by email address
    * @param String $email email to check in db
    * @return boolean
    */
    private function isUserExists($email) {
    	$stmt = $this->conn->prepare("SELECT id from users WHERE email = ?");
    	$stmt->bind_param("s", $email);
    	$stmt->execute();
    	$stmt->store_result();
    	$num_rows = $stmt->num_rows;
    	$stmt->close();
    	return $num_rows > 0;
    }

    /**
    * Fetching user by email
    * @param String $email User email id
    */
    public function getUserByEmail($email) {
    	$stmt = $this->conn->prepare("SELECT name, email, api_key, status, created_at FROM users WHERE email = ?");
    	$stmt->bind_param("s", $email);
    	if ($stmt->execute()) {
    	// $user = $stmt->get_result()->fetch_assoc();
    		$stmt->bind_result($name, $email, $api_key, $status, $created_at);
    		$stmt->fetch();
    		$user = array();
    		$user["name"] = $name;
    		$user["email"] = $email;
    		$user["api_key"] = $api_key;
    		$user["status"] = $status;
    		$user["created_at"] = $created_at;
    		$stmt->close();
    		return $user;
    	} else {
    		return NULL;
    	}
    }
    
} 