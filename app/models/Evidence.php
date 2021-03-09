
<?php
    class Evidence{
            private $db;

            public function __construct(){
                $this->db = new Database;
            }
            
            public function display(){
                $this->db->query('SELECT DISTINCT id, nume, prenume, email, grupa FROM student JOIN proiect_student ON student.id = proiect_student.id_student');
                $results = $this->db->resultSet();

                return $results;
            }

            public function displayProj($id_s){
                $this->db->query("SELECT GROUP_CONCAT(denumire SEPARATOR '/') AS denumire, GROUP_CONCAT(nota SEPARATOR '/') AS nota, id_student, GROUP_CONCAT(id_proiect SEPARATOR '/') AS id_proiect FROM proiect JOIN proiect_student ON proiect.id = proiect_student.id_proiect AND proiect_student.id_student = :id GROUP BY id_student;");
                $this->db->bind(':id', $id_s);
                $result = $this->db->single();

                return $result;
            }
            public function notare($data){
                $this->db->query('UPDATE proiect_student SET nota = :nota  WHERE id_student = :id_s AND id_proiect = :id_p');
                $this->db->bind(':id_s', $data['id_s']);
                $this->db->bind(':id_p', $data['id_p']);  
                $this->db->bind(':nota' ,$data['nota']);
    
                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }

            public function adaugaProiect($data){
                $this->db->query('INSERT INTO proiect_student(id_student, id_proiect) VALUES (:id, :id_p)');
                $this->db->bind(':id', $data['id']);
                $this->db->bind(':id_p', $data['id_p']);
                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            
        }

            public function stergeProiect($id_s, $id_p){
                $this->db->query('DELETE FROM proiect_student WHERE id_student = :id AND id_proiect = :id_p');
                $this->db->bind(':id', $id_s);
                $this->db->bind(':id_p', $id_p);
                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }
        

            public function checkForAdd($id, $id_proiect){
                $this->db->query('SELECT id_proiect, id_student FROM proiect_student WHERE id_proiect = :id_p AND id_student= :id');
                $this->db->bind(':id', $id);
                $this->db->bind(':id_p', $id_proiect);
                $row = $this->db->single();
                
                if($this->db->rowCount() > 0){
                    return false;
                }else{
                    return true;
                }
        }

    }