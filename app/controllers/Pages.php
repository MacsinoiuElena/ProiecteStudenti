<?php

class Pages extends Controller{
    public function __construct(){

    }

    public function index(){
        
        $data = ['title' => 'Proiecte Electronica', 'description1' => 'Fiecare student isi va alege maxim 3 proiecte', 'description2' => 'Termenul limita pentru predare va fi peste 2 saptamani'];
        $this->view('pages/index', $data);
    }
    
}