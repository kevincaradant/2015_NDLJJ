<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil extends MY_Controller {


    public function index()
    {
        $this->load->model('entreprise_model');
        $this->load->model('user_model');
        $this->data->entreprises = $this->entreprise_model->front_get_all();
        //$this->load->view('home');

        if($this->user_lib->connected()){
            $user = $this->user_model->get_once_by('id',$this->user_lib->user->id);
            $this->data->id_entreprises = array();
            if($user->entreprises){
                foreach($user->entreprises as $entreprise){
                    $this->data->id_entreprises[] = $entreprise->id;
                }
            }else{
                $this->data->id_entreprises = array();
            }

        }

        $this->template->set_layout('default')
            ->build('views/home/home', $this->data);
    }

    public function error(){
    	alert('Vous n\'avez pas accès à cette page, il faut être connecté','error',true);
    	$this->index();
    }
}
