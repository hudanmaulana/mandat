<?php
/**
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Parser $parser
 * @property Ion_auth|Ion_auth_model $ion_auth
 * @property M_base_config $M_base_config
 * @property base_config $base_config
 * @property CI_Lang $lang
 * @property CI_URI $uri
 * @property CI_DB_query_builder|CI_DB_mysqli_driver $db
 * @property CI_Config $config
 * @property CI_User_agent $agent
 * @property CI_Email $email
 * @property Base_config Base_config
 * @property Slug slug
 * @property UserModel userModel
 * @property CI_Loader load
 */

class ApiModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('userModel');
	}

	/**
	 *  @property Rnquery rnquery
	 * @param $userID int
	 * @return mixed
	 */
	public function userExist($userID)
	{
		$this->db->where('id', $userID);
		return $this->db->get('rn_users',1)->row();
	}

	/**
	 * @param $userID int
	 * @param $token string
	 * @return bool
	 */
	public function validToken($userID, $token=null)
	{
		if( !$token ) return false;
		$this->db->where('id', $userID);
		$this->db->where('token', $token);
		return $this->db->get('rn_users',1)->num_rows();
	}

	/**
	 * @param $password string
	 * @return mixed
	 */
	public function encryptPassword($password)
	{
		$this->load->model('Ion_auth_model');
		$salt = $this->Ion_auth_model->store_salt ? $this->Ion_auth_model->salt() : FALSE;
		return $this->Ion_auth_model->hash_password($password, $salt);
	}

	/**
	 * @return string
	 */
	public function detectMethod() {
		$method = strtolower($this->input->server('REQUEST_METHOD'));

		if ($this->config->item('enable_emulate_request')) {
			if ($this->input->post('_method')) {
				$method = strtolower($this->input->post('_method'));
			} else if ($this->input->server('HTTP_X_HTTP_METHOD_OVERRIDE')) {
				$method = strtolower($this->input->server('HTTP_X_HTTP_METHOD_OVERRIDE'));
			}
		}

		if (in_array($method, array('get', 'delete', 'post', 'put'))) {
			return $method;
		}

		return 'get';
	}

	/**
	 * @param boolean $onlyNumber
	 * @param int $length
	 * @return string
	 */
	public function randomString($length=255, $onlyNumber=false)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		if( $onlyNumber ) $characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	/**
	 * @param $userIDs array
	 * @param $title string
	 * @param $body string
	 * @param $type string
	 * @param $group string
	 * @param $data array
	 * @return bool|mixed
	 */
	public function sendBulkNotificationToMobile($userIDs, $title, $body, $data=array())
	{
		$this->config->load('custom', TRUE);
		$custom_config = $this->config->item('custom');
		$registrationIDs = $this->apiModel->getFCM($userIDs);
		if( !$registrationIDs ) return false;
		$json_data = array(
			"registration_ids" => $registrationIDs,
			"notification" => array(
				"body"  => $body,
				"title" => $title,
				"sound" => "default"
			)
		);
		if( $data ) $json_data["data"] = $data;
		$data = json_encode($json_data);
		$url = $custom_config['custom_url_fcm'];
		$server_key = $custom_config['custom_server_key_firebase'];
		$headers = array(
			'Content-Type:application/json',
			'Authorization:key='.$server_key
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);
		if ($result === FALSE) {
			die('Oops! FCM Send Error: ' . curl_error($ch));
		}
		curl_close($ch);
		return $result;
	}

	/**
	 * @param $userId int|array
	 * @return mixed|boolean
	 */
	public function removeFCM($userId)
	{
		if( is_array($userId) ){
			$this->db->where_in('user_id', $userId);
		}else{
			$this->db->where('user_id', $userId);
		}
		return $this->db->delete('rn_fcm');
	}

	/**
	 * @param $userId int
	 * @param $token string
	 * @return object|boolean
	 */
	public function addFCM($userId, $token)
	{
		$exist = $this->getFCM($userId);
		if( !$exist ){
			$data = array(
				'user_id'   => $userId,
				'token'     => $token,
				'created'   => date("Y-m-d H:i:s")
			);
			return $this->db->insert('rn_fcm', $data);
		}else{
			$data = array(
				'user_id'   => $userId,
				'token'     => $token,
				'created'   => date("Y-m-d H:i:s")
			);
			return $this->db->update('rn_fcm', $data);
		}
	}

	/**
	 * @param $userId int|array
	 * @return array
	 */
	public function getFCM($userId)
	{
		if( is_array($userId) ){
			$this->db->where_in('user_id', $userId);
		}else{
			$this->db->where('user_id', $userId);
		}
		$results = $this->db->get('rn_fcm')->result_array();
		return array_values(array_unique(array_column($results, 'token')));
	}

	/**
	 * @param $token string
	 * @return object|array
	 */
	public function jwtDecode($token=null)
	{
		$this->config->load('jwt');
		try{
			$jwt = \Firebase\JWT\JWT::decode(
				$token,                                                 //Data to be encoded in the JWT
				$this->config->item('jwt_secret_key'),            // The signing key / secret key
				array($this->config->item('jwt_algorithm'))       // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
			);
		}
		catch(Exception $e) {
			$jwt = null;
		}
		return $jwt;
	}

	/**
	 * @param int $userId
	 * @return array|boolean
	 */
	public function jwtEncode($userId)
	{
		$this->config->load('jwt');
		$issuedAt   = time();
		$notBefore  = time();                     //Adding 10 seconds
		$expire     = strtotime('+1 hour'); // Adding 60 seconds
		$serverName = $this->config->item('jwt_server_name');
		$payload = array(
			'iat'  => $issuedAt,                    // Issued at: time when the token was generated
			'iss'  => $serverName,                  // Issuer
			'nbf'  => $notBefore,                   // Not before
			'exp'  => $expire,                      // Expire
			'data' => array('id'    => $userId)
		);
		try{
			$uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
			$this->userModel->update($userId, array('token' => $uuid));
		} catch (Exception $e) {
			return false;
		}
		try{
			$jwt = \Firebase\JWT\JWT::encode(
				$payload,                                       //Data to be encoded in the JWT
				$this->config->item('jwt_secret_key'),    // The signing key / secret key
				$this->config->item('jwt_algorithm')      // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
			);
		} catch(Exception $e) {
			return false;
		}
		$user = (array)$this->userModel->getByID($userId);
		$user['group'] = $this->userModel->getGroupsByUserid($userId);
		return array(
			'token'         => $jwt,
			'refresh_token' => $uuid,
			'id' 			=> $user['id'],
			'username' 		=> $user['username'],
			'email' 		=> $user['email'],
//			'user'          => $user
		);
	}

	/**
	 * @return array|object
	 */
	public function jwtAuth()
	{
		$token = $this->input->get_request_header('x-token');
		//list($token) = sscanf(  $this->input->get_request_header('Authorization'), 'Bearer %s');
		$jwt = $this->jwtDecode($token);
		if( !$jwt ) json_response("Unauthorized",401);
		return $jwt;
	}
	/**
	 * @param string $type
	 * @param array|object|string $message
	 * @return object
	 */
	public function log($type='logs', $message)
	{
		if( is_array($message) || is_object($message) ){
			$message = json_encode($message);
		}
		$data = array('type'=> $type,'log' => $message, 'created' => date('Y-m-d'));
		return $this->rnquery->insert(log,$data);
	}

	public function getByGroup($group_name='members')
	{
		$tmp = array();
		$this->db->select('rn_users.id,rn_users.username,rn_users.display_name,rn_users.avatar');
		$this->db->join('rn_users_groups','rn_users_groups.user_id=rn_users.id');
		$this->db->join('rn_groups','rn_groups.id=rn_users_groups.group_id');
		$this->db->where('rn_groups.name',$group_name );
		$this->db->group_by('rn_users.id');
		$this->db->order_by('username','asc');
		$result = $this->db->get('rn_users')->result_array();
		foreach ( $result as $item) {
			$tmpurl =  UPLOAD_DIR.'uploads';
			$tmp[] = array(
				'id' => $item['id'],
				'username' => $item['username'],
				'display_name' => $item['display_name'],
				'avatar' => $tmpurl.'/'.$item['avatar'],

			);
		}
		return $tmp;
	}

	public function getGrade(){
		return $this->rnquery->getAll(grade)->result();
	}
	public function getListwarehouseToday($status){


		$join = array(
			array(
				'table' => warehouse.' b',
				'on' => 'b.id = a.post_id'
			),
			array(
				'table' => rn_user.' c',
				'on' => 'c.id = b.id_supplier'
			)
		);


		$where = array(
			'terms_type' => 'masuk',
			'b.status' => $status
		);

		$this->db->select('b.id_supplier,b.id_warehouse,b.id,c.display_name,b.id_sample,b.id_bal,a.terms_date');
		$this->db->like('a.terms_date',date('Y-m-d'));
		return $this->rnquery->getJoin(rn_terms.' a',$join,$where,'','a.terms_date DESC')->result();
	}
	public  function  getgradewarehousetoday($param,$terms){
		$join = array(
			array(
				'table' => grade.' b',
				'on'		=> 'b.id = a.category_id'
			)
		);
		$where = array(
			'post_id' => $param,
			'terms_type'=>$terms
		);
		$this->db->select('b.grade_name,a.terms_type');
		return $this->rnquery->getJoin(rn_terms.' a',$join,$where,'','a.terms_date DESC','1')->result();
	}

	public function getwharehousestatus($param){
			$where = array(
				'id_sample' => $param
			);
			return $this->rnquery->getOne(warehouse,$where,'status');
	}


}
