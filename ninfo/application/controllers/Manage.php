<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends MY_Controller {


    public function index()
    {
        //$this->load->view('home');
        $this->template->set_layout('manage')
            ->build('views/manage/home', $this->data);
    }
}
