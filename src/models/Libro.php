<?php 
    require_once "../connection/Connection.php";

    class Libro {

        public static function getAll(){
            $db = new Connection();
            $query = "SELECT * FROM libro";
            $result = $db->query($query);
            $datos = [];
            if($result->num_rows){
                while($row = $result->fetch_assoc()){
                    $datos[] = [
                        'id' => $row['ID'],
                        'nombreLibro' => $row['nombreLibro'],
                        'autor' => $row['autor'],
                        'editorial' => $row['editorial'],
                        'edicion' => $row['edicion'],
                    ];
                }
                return $datos;
            }

            return $datos;
        }

        public static function getWhere($id_libro){
            $db = new Connection();
            $query = "SELECT * FROM libro WHERE ID=$id_libro";
            $result = $db->query($query);
            $datos = [];
            if($result->num_rows){
                while($row = $result->fetch_assoc()){
                    $datos[] = [
                        'id' => $row['ID'],
                        'nombreLibro' => $row['nombreLibro'],
                        'autor' => $row['autor'],
                        'editorial' => $row['editorial'],
                        'edicion' => $row['edicion'],
                    ];
                }
                return $datos;
            }
            return $datos;
        }

        public static function insert($nombreLibro, $autor, $editorial, $edicion){
            $db = new Connection();
            $query = "INSERT INTO libro (nombreLibro, autor, editorial, edicion) 
            VALUES ('$nombreLibro', '$autor', '$editorial', '$edicion')";
            $db->query($query);
            if ($db->affected_rows){
                return TRUE;
            }
            return FALSE;
        }

        public static function update($ID, $nombreLibro, $autor, $editorial, $edicion){
            $db = new Connection();
            $query = "UPDATE libro SET 
                        nombreLibro = '$nombreLibro', 
                        autor = '$autor', 
                        editorial = '$editorial', 
                        edicion = '$edicion' 
                    WHERE ID = $ID";
            $db->query($query);
            if ($db->affected_rows){
                return TRUE;
            }
            return FALSE;
        }

        public static function delete($ID){
            $db = new Connection();
            $query = "DELETE FROM libro WHERE ID=$ID";
            $db->query($query);
            if ($db->affected_rows){
                return TRUE;
            }
            return FALSE;
        }
    }
?>