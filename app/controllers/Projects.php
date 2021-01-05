<?php

class Projects extends Controller{
    public function __construct(){
        $this->studModel = $this->model('Student');
        $this->projModel = $this->model('Proiect');
        $this->evidModel = $this->model('Evidenta');

    }

    public function proiecte(){
        $data = [
            'proiect' => $this->projModel->denArray()
        ];
        $this->view('projects/proiecte', $data);
    }

    public function stergeProiect($id){
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $var = $this->projModel->stergeProiect($id);
            if ($var == 1) {
                $data =  [
                    'error' => '',
                    'proiect' => $this->projModel->denArray()
                ];
                $this->view('projects/proiecte', $data);
            } else {
                if ($var == -1) {
                    die("Something went wrong");
                } else {
                    $data =  [
                        'error' => "Project has already been choosen. You can not delete it.",
                        'proiect' => $this->projModel->denArray()
                    ];
                    $this->view('projects/proiecte', $data);
                }
            }
        } else {
            redirect('projects/proiecte');
        }
    }

    public function adaugaProiect(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'den' => trim($_POST['den']),
                'descriere' => trim($_POST['descriere']),
                'den_error' =>  '',
                'desc_error' =>  ''
            ];

            if(empty($data['den']))
            {
                $data['den_error'] = 'Please enter the title of project';
            }else{
                if($this->projModel->checkForTitle($data['den'])){
                    $data['den_error'] = 'Title already exist';
                }
            }

            if(empty($data['descriere']))
            {
                $data['desc_error'] = 'Please enter the description';
            }

            //make sure errors are empty
            if(empty($data['den_error']) && empty($data['desc_error'])){
                 //register user
                 if($this->projModel->adaugaProiect($data)){
                    redirect('projects/proiecte');
                 }else{
                     die("Something went wrong");
                 }
             }else{
                 //load view with errors
                 $this->view('projects/adaugaProiect', $data);
             }

        }else{
            //init data
            $data = [
                'den' => '',
                'descriere' => '',
                'den_error' =>  '',
                'desc_error' =>  ''
            ];
            //load view
            $this->view('projects/adaugaProiect', $data);

        }
    }

    public function modificaProiect($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Sanitize post array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'id' => $id,
                'den' => trim($_POST['den']),
                'descriere' => trim($_POST['descriere']),
                'den_error' =>  '',
                'desc_error' =>  ''
            ];

            if(empty($data['den']))
            {
                $data['den_error'] = 'Please enter the title of project';
            }

            if(empty($data['descriere']))
            {
                $data['desc_error'] = 'Please enter the description';
            }

            if(empty($data['den_error']) && empty($data['desc_error'])){
             
             if($this->projModel->modificaProiect($data)){
                redirect('projects/proiecte');
             }else{
                 die("Something went wrong");
             }
         }else{
            //load view with errors
            $this->view('projects/modificaProiect', $data);
         }

        }else{
            $proiect = $this->projModel->getProjById($id);
            $data = [
                'id' => $id,
                'den' => $proiect->denumire,
                'descriere' => $proiect->descriere
            ];
            $this->view('projects/modificaProiect', $data);  
        }
    }
}