<?php
    class Proiect{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }
        public function denArray(){
            $this->db->query('SELECT * FROM proiect');
            $result = $this->db->resultSet();

            return $result;
        }

        public function checkForTitle($data){
            $this->db->query('SELECT * FROM proiect WHERE denumire = :denumire');
            $this->db->bind(':denumire', $data);

            $row = $this->db->single();

            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function adaugaProiect($data){
            $this->db->query('INSERT INTO proiect(denumire, descriere) VALUES (:denumire, :descriere)');
            $this->db->bind(':denumire', $data['den']);
            $this->db->bind(':descriere', $data['descriere']);
            
            
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function stergeProiect($id){
            $this->db->query('SELECT * FROM proiect_student WHERE id_proiect = :id');
            $this->db->bind(':id', $id);
            
            $result = $this->db->resultSet();
            if (!empty($result)){
                return 0;
            }else{
                $this->db->query('DELETE FROM proiect WHERE id = :id');
                $this->db->bind(':id', $id);
                if($this->db->execute()){
                    return 1;
                }else{
                    return -1;
                }
            }
        }

        public function getProjById($id){
            $this->db->query('SELECT * FROM proiect WHERE id = :id');
            $this->db->bind(':id' ,$id);

            $row = $this->db->single();
            return $row;
        }

        public function modificaProiect($data){
            $this->db->query('UPDATE proiect SET denumire = :den, descriere = :descriere WHERE id = :id');
            $this->db->bind(':den', $data['den']);
            $this->db->bind(':descriere', $data['descriere']);  
            $this->db->bind(':id' ,$data['id']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
    }