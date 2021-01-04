
<?php
    class Evidenta{
            private $db;

            public function __construct(){
                $this->db = new Database;
            }

            public function display(){
                $this->db->query('SELECT nume, prenume, grupa, email, denumire
                                    FROM student JOIN proiect_student
                                    ON student.id = proiect_student.id_student
                                    JOIN proiect
                                    WHERE proiect_student.id_proiect = proiect.id');
                $results = $this->db->resultSet();

                return $results;
            }

            public function getIdProjByStud($id){
                $this->db->query('SELECT id_proiect FROM proiect_student WHERE id_student = :id_student');
                $this->db->bind(':id_student', $id);
                $result = $this->db->single();
                return $result->id_proiect;
            }

            public function getProjName($id){
                $this->db->query('SELECT denumire FROM proiect WHERE id = :id');
                $this->db->bind(':id', $id);
                $result = $this->db->single();
                return $result->denumire;
            }
    }