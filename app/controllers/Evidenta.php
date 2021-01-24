<?php

class Evidenta extends Controller
{
    public function __construct()
    {
        $this->studModel = $this->model('Student');
        $this->projModel = $this->model('Proiect');
        $this->evidModel = $this->model('Evidence');
    }

    public function index()
    {

        $data = ['title' => 'Proiecte Electronica', 'description1' => 'Fiecare student isi va alege maxim 3 proiecte', 'description2' => 'Termenul limita pentru predare va fi peste 2 saptamani'];
        $this->view('pages/index', $data);
    }


    public function evidenta()
    {
        $data = [
            'evidenta' =>  $this->evidModel->display()
        ];

        $data['displayProj'] = [];
        foreach ($data['evidenta'] as $stud) {
            $id = $stud->id;
            $display =  $this->evidModel->displayProj($id);
            array_push($data['displayProj'], $display);
        }

        $this->view('evidenta/evidenta', $data);
    }


    public function plusProiect($id_s)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id_s,
                'den' => $_POST['den'],
                'proiect' => $this->projModel->denArray(),
                'den_error' => ''
            ];

            if (!empty($data['den'])) {
                $data['id_p'] = $this->projModel->getProjByDen($data['den'])->id;
            }

            if (empty($data['id_p'])) {
                $data['den_error'] = 'The id of the project does not exist';
            }

            if (empty($data['den'])) {
                $data['den_error'] = 'Please choose the project you want';
            } else {
                if (!$this->evidModel->checkForAdd($id_s, $data['id_p'])) {
                    $data['den_error'] = 'You have already chosen this project';
                }
            }

            if (empty($data['den_error'])) {
                if ($this->evidModel->adaugaProiect($data)) {
                    redirect('evidenta/evidenta');
                } else {
                    die("Something went wrong");
                }
            } else {
                //load view with errors
                $this->view('evidenta/plusProiect', $data);
            }
        } else {
            $data = [
                'id' => $id_s,
                'proiect' => $this->projModel->denArray()
            ];
            $this->view('evidenta/plusProiect', $data);
        }
    }


    public function minusProiect($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $proj = $this->projModel->checkedProj($id);
            $data = [
                'id' => $id,
                'checkboxvar' => $_POST['checkboxvar'],
                'den_error' => ''
            ];


            if (empty($data['checkboxvar'])) {
                $data['den_error'] = 'Please choose the project you want to delete';
            }



            if (empty($data['den_error'])) {
                foreach ($data['checkboxvar'] as $den) {
                    $data['id_p'] = $this->projModel->getProjByDen($den)->id;

                    $do = $this->evidModel->stergeProiect($id, $data['id_p']);
                    if (!$do) {
                        die("Something went wrong");
                    }
                }
                redirect('evidenta/evidenta');
            } else {
                //load view with errors
                $this->view('evidenta/minusProiect', $data);
            }
        } else {
            $proj = $this->projModel->checkedProj($id);
            $data = [
                'id' => $id,
                'proiecte' => $proj
            ];
            $this->view('evidenta/minusProiect', $data);
        }
    }


    public function note($id_s, $id_p)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id_s' => $id_s,
                'id_p' => $id_p,
                'nota' => $_POST['nota'],
                'nota_err' => ''
            ];


            if (empty($data['nota'])) {
                $data['nota_err'] = 'Please enter a mark';
            } else {
                if ($data['nota'] > 10 || $data['nota'] < 0) {
                    $data['nota_err'] = 'Please enter a valid mark';
                }
            }

            if (empty($data['nota_err'])) {
                echo $data['nota'];
                if ($this->evidModel->notare($data)) {
                    redirect('evidenta/evidenta');
                } else {
                    die("Something went wrong");
                }
            } else {
                //load view with errors
                $this->view('evidenta/note', $data);
            }
        } else {
            $data = [
                'id_s' => $id_s,
                'id_p' => $id_p,
                'nota' => ''
            ];
            $this->view('evidenta/note', $data);
        }
    }
}
