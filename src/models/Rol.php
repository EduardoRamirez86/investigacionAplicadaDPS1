<?php 
    require_once "../connection/Connection.php";

    class Rol {

        public static function getAll(){
            $db = new Connection();
            $query = "SELECT * FROM rol";
            $result = $db->query($query);
            $datos = [];
            if($result->num_rows){
                while($row = $result->fetch_assoc()){
                    $datos[] = [
                        'IDrol' => $row['IDrol'],
                        'nombreRol' => $row['nombreRol']
                    ];
                }
                return $datos;
            }
            return $datos;
        } 

        public static function getWhere($id_rol){
            $db = new Connection();
            $query = "SELECT * FROM rol WHERE IDrol = $id_rol";
            $result = $db->query($query);
            $datos = [];
            if($result->num_rows){
                while($row = $result->fetch_assoc()){
                    $datos[] = [
                        'IDrol' => $row['IDrol'],
                        'nombreRol' => $row['nombreRol']
                    ];
                }
                return $datos;
            }
            return $datos;
        } 

        public static function insert($nombreRol){
            $db = new Connection();
            $query = "INSERT INTO rol (nombreRol) VALUES ('$nombreRol')";
            $db->query($query);
            if ($db->affected_rows){
                return TRUE;
            }
            return FALSE;
        } 

        public static function update($IDrol, $nombreRol){
            $db = new Connection();
            $query = "UPDATE rol SET nombreRol = '$nombreRol' WHERE IDrol = $IDrol";
            $db->query($query);
            if ($db->affected_rows){
                return TRUE;
            }
            return FALSE;
        } 

        public static function delete($IDrol){
            $db = new Connection();
            $query = "DELETE FROM rol WHERE IDrol = $IDrol";
            $db->query($query);
            if ($db->affected_rows){
                return TRUE;
            }
            return FALSE;
        } 
    }
?>
