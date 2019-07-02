<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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
 * @property CI_Loader load
 * @property ApiModel apiModel
 * @property Rnquery rnquery
 * @property TermModel termModel
 * @property UserModel userModel
 */
class Warehouse extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('apiModel');
		$this->load->model('userModel');
		$this->load->model('termModel');
		date_default_timezone_set('Asia/Jakarta'); #
	}
	public  function showsupplier(){
		$users=	$this->apiModel->getByGroup('supplier');
		json_response($users);

	}
	public  function  insertdata(){
		$_POST = json_decode(file_get_contents('php://input'), true);
		$this->form_validation->set_rules('id_supplier', 'supplier', 'required');
		$this->form_validation->set_rules('id_sample', 'barcode sample', 'required');
		$this->form_validation->set_rules('id_bal', 'barcode bal', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			json_response(  strip_tags(validation_errors()), 400 );
		}
		else {
			try {
				$data= array(
					'id_supplier' => $this->input->post('id_supplier'),
					'id_sample' => $this->input->post('id_sample'),
					'id_bal' => $this->input->post('id_bal'),
				);
				$date = date('Y-m-d H:i:s');
				$this->rnquery->insert(warehouse,$data);

				$insert_id = $this->db->insert_id();
				$data_terms = array(
					'terms_type'    => 'masuk',
					'category_id'   => '',
					'post_id'       => $insert_id,
					'terms_value'	=> '',
					'terms_date'	=> $date
				);
				$this->rnquery->insert(rn_terms,$data_terms);
				json_response( array('status' => 1, 'message' => 'success insert'));
			} catch (Exception $e) {
				json_response( array('status' => 0, 'message' => $e->getMessage() ) );
			}
		}
	}

	public  function getgrade(){
		$grade=	$this->apiModel->getGrade();
		json_response($grade);
	}

	public function getlistwarehousetoday(){
		//todo
		//di tambahi get status lolos apa tidak

		$status = $this->input->get('status');

		if(!$status) $status = '2';

		$warehouse=$this->apiModel->getListwarehouseToday($status);
		$arraywarehouse = array();
		foreach ($warehouse as $val){
			$warehousegradeone=$this->apiModel->getgradewarehousetoday($val->id,'insert_grade');
			$warehousegradetwo=$this->apiModel->getgradewarehousetoday($val->id,'update_grade');
//			$warehousegradethre=$this->apiModel->getgradewarehousetoday($val->id,'update_grade');

			if($status==1){
				$statusku = 'barang lolos';
			}
			if($status==2){
				$statusku = 'barang masuk';
			}
			if($status==3){
				$statusku = 'barang tidak lolos';
			}

			$arraywarehouse [] = array(
				'id_supplier'=> $val->id_supplier,
				'id_warehouse'=> $val->id_warehouse,
				'id'=> $val->id,
				'grade_name' => @$warehousegradeone[0]->grade_name ? : 'Not Set' ,
				'grade_two' => @$warehousegradetwo[0]->grade_name ? : 'Not Set' ,
//				'grade_three' => @$warehousegradethre[0]->grade_name ? : 'Not Set' ,
				'display_name'=> $val->display_name,
				'id_sample'=> $val->id_sample,
				'id_bal'=> $val->id_bal,
				'terms_date'=> $val->terms_date,
				'status' => $statusku
			);
		}
		json_response($arraywarehouse);

	}

	public  function updatewarehousecode(){
		$_POST = json_decode(file_get_contents('php://input'), true);
		$this->form_validation->set_rules('id_sample', 'sample', 'required');
		$this->form_validation->set_rules('id_grade', 'grade', 'required');
//		$this->form_validation->set_rules('id_warehouse', 'warehouse', 'required'); //todo
		// id wharehouse di kososngi terus di ganti status yes or no, jika wharehouse kosong maka isisan no jika isi, maka yes

		if ($this->form_validation->run() == FALSE)
		{
			json_response(  strip_tags(validation_errors()), 400 );
		} else {
			try{
				$id_warehouse = $this->input->post('id_warehouse');
				$id_sample = $this->input->post('id_sample');
				if ($id_warehouse){
					$data= array(
						'id_warehouse' =>  $id_warehouse,
						'status'	=>1
					);
				} else {
					$data= array(
						'id_warehouse' =>  $id_sample,
						'status'	=>3
					);
				}
				$where = array(
					'id_sample' => $id_sample
				);
				$this->rnquery->update(warehouse,$data,$where);
				$get_id = $this->rnquery->getOne(warehouse,$where,'id');
				$date = date('Y-m-d H:i:s');
				$data_terms = array(
					'terms_type' =>'insert_grade',
					'category_id' => $this->input->post('id_grade'),
					'post_id'       => $get_id->id,
					'terms_value'	=> 'grade first',
					'terms_date'	=> $date
				);



				$this->rnquery->insert(rn_terms,$data_terms);
				json_response( array('status' => 1, 'message' => 'success insert'));
			} catch (Exception $e){
				json_response( array('status' => 0, 'message' => $e->getMessage() ) );
			}
		}
	}

	public  function  updateweightfirst(){
		$_POST = json_decode(file_get_contents('php://input'), true);
		$this->form_validation->set_rules('id_warehouse', 'warehouse', 'required');
		$this->form_validation->set_rules('weight', 'weight', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			json_response(  strip_tags(validation_errors()), 400 );
		} else {
			try{
				$data= array(
					'id_warehouse' => $this->input->post('id_warehouse')
				);
				$where = array(
					'id_warehouse' => $this->input->post('id_warehouse')
				);
				$get_id = $this->rnquery->getOne(warehouse,$where,'id');
				$where_terms = array(
					'post_id' => $get_id->id,
					'terms_type' => 'insert_weight'
				);
				$get_data_exist= $this->rnquery->getOne(rn_terms,$where_terms,'post_id,terms_type');
				if(@$get_data_exist->post_id==$get_id->id && @$get_data_exist->terms_type=='insert_weight'){
					json_response( array('status' => 0, 'message' => 'duplicate weight' ));
				} else {
					$this->rnquery->update(warehouse,$data,$where);
					$date = date('Y-m-d H:i:s');
					$data_terms = array(
						'terms_type' =>'insert_weight',
						'post_id'       => $get_id->id,
						'terms_value'	=> $this->input->post('weight'),
						'terms_date'	=> $date
					);
					$this->rnquery->insert(rn_terms,$data_terms);
					json_response( array('status' => 1, 'message' => 'success insert'));
				}

			} catch (Exception $e){
				json_response( array('status' => 0, 'message' => $e->getMessage() ) );
			}
		}
	}

	public  function updatewarehousegrade(){
		$_POST = json_decode(file_get_contents('php://input'), true);
		$this->form_validation->set_rules('id_grade', 'grade', 'required');
		$this->form_validation->set_rules('id_warehouse', 'warehouse', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			json_response(  strip_tags(validation_errors()), 400 );
		} else {
			try{
				$where = array(
					'id_warehouse' => $this->input->post('id_warehouse')
				);
				$get_id = $this->rnquery->getOne(warehouse,$where,'id');
				$date = date('Y-m-d H:i:s');
				$data_terms = array(
					'terms_type' =>'update_grade',
					'category_id' => $this->input->post('id_grade'),
					'post_id'       => $get_id->id,
					'terms_value'	=> 'grade second',
					'terms_date'	=> $date
				);
				$this->rnquery->insert(rn_terms,$data_terms);
				json_response( array('status' => 1, 'message' => 'success update grade'));
			} catch (Exception $e){
				json_response( array('status' => 0, 'message' => $e->getMessage() ) );
			}
		}
	}

	public function getwharehousestatus(){



		$_POST = json_decode(file_get_contents('php://input'), true);
		$this->form_validation->set_rules('id_sample', 'sample', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			json_response(  strip_tags(validation_errors()), 400 );
		} else {
			try {

				$id_sample = $this->input->post('id_sample');
				$status=$this->apiModel->getwharehousestatus($id_sample);

				if($status->status==1){
					$statusku = 'barang lolos';
				}
				if($status->status==2){
					$statusku = 'barang masuk';
				}
				if($status->status==3){
					$statusku = 'barang tidak lolos';
				}
				json_response( array('status' => 1, 'message' => $statusku));
			}catch (Exception $e){
				json_response( array('status' => 0, 'message' => $e->getMessage() ) );
			}
		}
	}

}
