
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
    }