<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';
/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */

class Mail extends \Restserver\Libraries\REST_Controller {

	function __construct()
	{

		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->helper(array('form', 'url', 'string'));
		$this->load->helper(array('path'));

	}
	public function index_get()
	{
		$this->response(array(
			'status' => TRUE,
			'error' => FALSE,
			'message' => 'API for Mail'), REST_Controller::HTTP_OK);
	}

	public function index_post()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('from', 'From Email Address', 'required');
		$this->form_validation->set_rules('to', 'To Email Address', 'required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('body', 'Body Email', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->helper('form');
			$this->response(array(
				'status'            => FALSE,
				'error'             => TRUE,
				'message'           => 'Send Mail Failed'
			), REST_Controller::HTTP_OK);
		}
		else
		{
			$subject                          = $this->input->post('subject');
			$from                             = $this->input->post('from');
			$to                               = $this->input->post('to');
			$body                             = $this->input->post('body');

			require_once APPPATH.'../vendor/autoload.php';

			//Create the Transport. I created it using the gmail configuration
			$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587,'tls')
				->setUsername('gleenok@gmail.com')
				->setPassword('PK7^jE61');

			// You could alternatively use a different transport such as Sendmail or Mail:
			//Sendmail:
			//$transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
			//Mail
			// $transport = Swift_MailTransport::newInstance();

			//Create the message
			$message = Swift_Message::newInstance();

			//Give the message a subject
			$message->setSubject($subject)
				->setFrom($from)
				->setTo($to)
				->setBody($body,'text/html');
			// ->addPart('<q>Here is the message sent with swiftmailer</q>', 'text/html');

			//Create the Mailer using your created Transport
			$mailer = Swift_Mailer::newInstance($transport);

			//Send the message
			$result = $mailer->send($message);

			if ($result) {
				$this->response(array(
					'status'            => TRUE,
					'error'             => FALSE,
					'message'           => 'Your Mail Send Successfully'
				), REST_Controller::HTTP_OK);
			}
			else
			{
				$this->response(array(
					'status'            => FALSE,
					'error'             => TRUE,
					'message'           => 'Email failed to send'
				), REST_Controller::HTTP_OK);// echo "Email failed to send";
			}
		}
	}
}
