<?php
    class Student{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

       
        public function adaugaStudent($data){
            $this->db->query('INSERT INTO student(nume, prenume, email, grupa) VALUES (:name, :fname, :email, :group)');
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':fname', $data['fname']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':group', $data['group']); 
            
            
            if($this->db->execute()){
                $this->db->query('SELECT id FROM student WHERE email = :email');
                $this->db->bind(':email', $data['email']);
                $row = $this->db->single();
                $id = $row->id;

                $this->db->query('SELECT id FROM proiect WHERE denumire = :denumire');
                $this->db->bind(':denumire', $data['den']);
                $row_proiect = $this->db->single();
                $id_proiect = $row_proiect->id;

                $this->db->query('INSERT INTO proiect_student(id_student, id_proiect) VALUES (:id_student, :id_proiect)');
                $this->db->bind(':id_student', $id);
                $this->db->bind(':id_proiect', $id_proiect);

                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM student WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function verifyGroup($group){
            if (strlen($group) != 4){
                return false;
            }else{
                if ($group[0] == '4' and ($group[1] <= '4' and $group[1] >= '1') and ($group[2] <= '4' and $group[2] >= '1') 
            and ($group[3] >= 'A' and $group[3] <= 'G')){
                return true;
            }else{
                return false;
            }
            }
        }

        public function studArray(){
            $this->db->query('SELECT * FROM student');
            $result = $this->db->resultSet();

            return $result;
        }

        public function sterge($id){
            $this->db->query('DELETE FROM proiect_student WHERE id_student = :id');
            $this->db->bind(':id', $id);
            if($this->db->execute()){
                $this->db->query('DELETE FROM student WHERE id = :id');
                $this->db->bind(':id', $id);
                if($this->db->execute()){
                return true;
            }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function getStudById($id){
            $this->db->query('SELECT * FROM student WHERE id = :id');
            $this->db->bind(':id' ,$id);

            $row = $this->db->single();
            return $row;
        }

        public function modificaStudent($data){
            $this->db->query('UPDATE student SET nume = :name, prenume =  :fname, email = :email, grupa = :grupa WHERE id = :id');
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':fname', $data['fname']); 
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':grupa', $data['group']);  
            
            if($this->db->execute()){
                $this->db->query('SELECT id FROM proiect WHERE denumire = :denumire');
                $this->db->bind(':denumire', $data['den']);
                $row_proiect = $this->db->single();
                $id_proiect = $row_proiect->id;

                $this->db->query('UPDATE proiect_student SET id_proiect = :id_proiect WHERE id_student = :id');
                $this->db->bind(':id_proiect', $id_proiect);
                $this->db->bind(':id', $data['id']);
                if($this->db->execute()){
                return true;
            }else{
                return false;
            }
            }else{
                return false;
            }
        }
    }