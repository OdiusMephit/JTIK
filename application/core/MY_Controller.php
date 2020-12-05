<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $_roles = [];
	public function __construct()
	{
		parent::__construct();
        $role_id = $this->session->userdata('role_id') ?: 0;
        $role_id = intval($role_id);
        if (!empty($this->_roles) && !in_array($role_id, $this->_roles)) {
            // cek apakah login
            if ($role_id == 0) {
                $this->flash_danger('Silahkan login untuk melanjutkan!');
            } else {
                $this->flash_danger('Anda tidak dapat mengakses halaman ini!');
            }
            redirect('auth');
            return;
        }
    }

    protected function flash_danger($message)
    {
        $alert = '
            <div class="alert alert-danger alert-dismissible">
                '. $message .'
                <button class="close" data-dismiss="alert">&times;</button>
            </div>';
        $this->session->set_flashdata('message', $alert);
    }

    protected function flash_success($message)
    {
        $alert = '
            <div class="alert alert-success alert-dismissible">
                '. $message .'
                <button class="close" data-dismiss="alert">&times;</button>
            </div>';
        $this->session->set_flashdata('message', $alert);
    }
}