<?php

class Pages extends Controller{
    public function __construct(){
        $this->studModel = $this->model('Student');
        $this->projModel = $this->model('Proiect');
        $this->evidModel = $this->model('Evidenta');

    }

    public function index(){
        
        $data = ['title' => 'Proiecte Electronica', 'description1' => 'Fiecare student isi va alege un singur proiect', 'description2' => 'Termenul limita pentru predare va fi peste 2 saptamani'];
        $this->view('pages/index', $data);
    }
    
    public function proiecte(){
        $data = [
            'proiect' => $this->projModel->denArray()
        ];
        $this->view('pages/proiecte', $data);
    }

    public function studenti(){
        $data = [
            'student' => $this->studModel->studArray()
        ];
        $this->view('pages/studenti', $data);
    }

    public function sterge($id){
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $stud = $this->studModel->getStudById($id);
            if($this->studModel->sterge($id)){
                redirect('pages/studenti');
            }else{
                die("Something went wrong");
            }
        }else{
            redirect('pages/studenti');
        }
    }

    public function stergeProiect($id){
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $stud = $this->projModel->getProjById($id);
            if($this->projModel->stergeProiect($id)){
                redirect('pages/proiecte');
            }else{
                die("Something went wrong");
            }
        }else{
            redirect('pages/proiecte');
        }
    }

    public function evidenta(){
        $data = [
            'evidenta' =>  $this->evidModel->display()
        ];
        $this->view('pages/evidenta', $data);
    }

    public function adaugaStudent(){
        //check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => trim($_POST['name']),
                'fname' => trim($_POST['fname']),
                'email' => trim($_POST['email']),
                'group' => trim($_POST['group']),
                'fname_error' =>  '',
                'name_error' =>  '',
                'email_error' =>  '',
                'group_error' =>  '',
                'proiect' => $this->projModel->denArray(),
                'den_error' => ''
            ];
            if(!empty($_POST['den'])){
                $data['den'] = $_POST['den'];
            }

            if(empty($data['email']))
            {
                $data['email_error'] = 'Please enter email';
            }else{
                if($this->studModel->findUserByEmail($data['email'])){
                    $data['email_error'] = 'Email is already taken';
                }
            }

            if(empty($data['name']))
            {
                $data['name_error'] = 'Please enter the name';
            }

            if(empty($data['group']))
            {
                $data['group_error'] = 'Please enter the group';
            }else{
                if(!$this->studModel->verifyGroup($data['group'])){
                    $data['group_error'] = 'Please enter a valid group';
                }
            }

            if(empty($data['fname']))
            {
                $data['fname_error'] = 'Please enter the first name';
            }

            if(empty($data['den'])){
                $data['den_error'] = 'Please choose the project you want';
            }

            //make sure errors are empty
            if(empty($data['email_error']) && empty($data['fname_error']) && empty($data['group_error'])
             && empty($data['name_error']) && empty($data['den_error'])){
                 //register user
                 if($this->studModel->adaugaStudent($data)){
                    redirect('pages/evidenta');
                 }else{
                     die("Something went wrong");
                 }
             }else{
                 //load view with errors
                 $this->view('pages/adauga_student', $data);
             }

        }else{
            //init data
            $data = [
                'name' =>  '',
                'proiect' => $this->projModel->denArray(),
                'fname' => '',
                'email' => '',
                'group' => '',
                'den' => '',
                'fname_error' =>  '',
                'name_error' =>  '',
                'email_error' =>  '',
                'group_error' =>  '',
                'den_error' => ''
            ];
            //load view
            $this->view('/pages/adauga_student', $data);

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
                    redirect('pages/proiecte');
                 }else{
                     die("Something went wrong");
                 }
             }else{
                 //load view with errors
                 $this->view('pages/adauga_proiect', $data);
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
            $this->view('/pages/adauga_proiect', $data);

        }
    }
}