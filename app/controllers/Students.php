<?php

class Students extends Controller{
    public function __construct(){
        $this->studModel = $this->model('Student');
        $this->projModel = $this->model('Proiect');
        $this->evidModel = $this->model('Evidenta');

    }
    
    public function index(){
        
        $data = ['title' => 'Proiecte Electronica', 'description1' => 'Fiecare student isi va alege un singur proiect', 'description2' => 'Termenul limita pentru predare va fi peste 2 saptamani'];
        $this->view('pages/index', $data);
    }

    public function studenti(){
        $data = [
            'student' => $this->studModel->studArray()
        ];
        $this->view('students/studenti', $data);
    }

    public function sterge($id){
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            if($this->studModel->sterge($id)){
                redirect('students/studenti');
            }else{
                die("Something went wrong");
            }
        }else{
            redirect('students/studenti');
        }
    }

    public function evidenta(){
        $data = [
            'evidenta' =>  $this->evidModel->display()
        ];
        $this->view('students/evidenta', $data);
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
                'den' => $_POST['den'],
                'fname_error' =>  '',
                'name_error' =>  '',
                'email_error' =>  '',
                'group_error' =>  '',
                'proiect' => $this->projModel->denArray(),
                'den_error' => ''
            ];

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
                 
                 if($this->studModel->adaugaStudent($data)){
                    redirect('students/evidenta');
                 }else{
                     die("Something went wrong");
                 }
             }else{
                 //load view with errors
                 $this->view('students/adaugaStudent', $data);
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
            $this->view('students/adaugaStudent', $data);

        }
    }

    public function modificaStudent($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Sanitize post array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                $data = [
                    'id' => $id,
                    'name' => trim($_POST['name']),
                    'fname' => trim($_POST['fname']),
                    'email' => trim($_POST['email']),
                    'group' => trim($_POST['group']),
                    'den' => $_POST['den'],
                    'fname_error' =>  '',
                    'name_error' =>  '',
                    'email_error' =>  '',
                    'group_error' =>  '',
                    'proiect' => $this->projModel->denArray(),
                    'den_error' => ''
                ];

    
                if(empty($data['email']))
                {
                    $data['email_error'] = 'Please enter email';
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
    

                if(empty($data['email_error']) && empty($data['fname_error']) && empty($data['group_error'])
             && empty($data['name_error']) && empty($data['den_error'])){
                 
                 if($this->studModel->modificaStudent($data)){
                    redirect('students/evidenta');
                 }else{
                     die("Something went wrong");
                 }
             }else{
                 //load view with errors
                 $this->view('students/modificaStudent', $data);
             }

            }else{
                $student = $this->studModel->getStudById($id);
                $idProj = $this->evidModel->getIdProjByStud($id);
                $proj = $this->projModel->getProjById($idProj)->denumire;
                $data = [
                    'id' => $id,
                    'name' => $student->nume,
                    'fname' => $student->prenume,
                    'email' => $student->email,
                    'group' => $student->grupa,
                    'den' => $proj,
                    'proiect' => $this->projModel->denArray()
                ];
                $this->view('students/modificaStudent', $data);  
            }
        }
}