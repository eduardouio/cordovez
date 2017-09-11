<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incoterm extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->library('twig');
		$data['title'] = "Incoterms";
		$data['iconTitle'] = "fa-gears";
		$data['titleContent'] = "Registro de Incoterm";
		$data['controller'] = "incoterm";
		$data['actionFrm'] =  "/validateForm";
		$this->twig->display('/pages/pageIncoterm.html', $data);
	
	}

	public function validateForm(){
		print ('Formulario recibido');

	}
}

