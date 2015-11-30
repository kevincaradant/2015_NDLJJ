<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil extends MY_Controller {


    public function index()
    {   
        $this->load->model('user_model');
        //$this->load->view('home');

        if($this->user_lib->connected()){
            //zou
        }

        $this->template->set_layout('default')
            ->build('views/home/home', $this->data);
    }

    public function error(){
    	alert('Vous n\'avez pas accès à cette page, il faut être connecté','error',true);
    	$this->index();
    }
}
