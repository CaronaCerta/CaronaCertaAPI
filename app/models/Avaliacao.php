<?php
class Avaliacao extends DbHandler {
	/**
	 * Creating new Avaliation
	 * 
	 * @param String $email
	 *        	User login email id
	 * @param String $otherUserId
	 *        	the user being rated Id
	 * @param String $otherUserRole
	 *        	the role in which other user role as he is being rated
	 *        	TODO: turn into list of attributes being rated
	 * @param String $caracteristica
	 *        	the attribute which is being rated
	 * @param Integer $rating
	 *        	self-explanatory
	 */
	public function createAvaliacao($email, $otherUserId, $otherUserRole, $caracteristica, $rating) {
		$response = array ();
		
		// check if both users exist
		if ($this->isUserExists ( $email ) && $this->isUserExists ( $otherUserId )) {
			return			

			// insert query
			$stmt = $this->conn->prepare ( "INSERT INTO avaliacao(id_usuario_avaliador, id_carona, id_atributo, papel, rating) values(?, ?, ?, ?, ?)" );
			$stmt->bind_param ( "ssiii", $email, $otherUserId, $otherUserRole, $caracteristica, $rating );
			$result = $stmt->execute ();
			$stmt->close ();
			// Check for successful insertion
			if ($result) {
				// Avaliacao successfully inserted
				return AVAIL_CREATED_SUCCESSFULLY;
			} else {
				// Failed to create avaliacao
				return AVAIL_CREATE_FAILED;
			}
		} else {
			// User does't exist
			return USER_NOT_EXISTS;
		}
		
		return $response;
	}
}

	
