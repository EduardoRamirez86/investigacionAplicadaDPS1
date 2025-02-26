<?php
    require_once "../connection/Connection.php";

    class Usuario {

        public static function getAll(){
            $db = new Connection();
            $query = "SELECT * FROM usuario";
            $result = $db->query($query);
            $datos = [];
            if($result-> num_rows){
                while($row = $result->fetch_assoc()){
                    $datos [] = [
                        'IDusuario' => $row ['IDusuario'],
                        'nombreUsuario' => $row['nombreUsuario'],
                        'apellidoUsuario' => $row ['apellidoUsuario'],
                        'contrasennia' => $row ['contrasennia'],
                        'IDrol' => $row['IDrol'],
                    ];
                }
                return $datos;
            }
            return $datos;
        }

        public static function getWhere($IDusuario){
            $db = new Connection();
            $query = "SELECT * FROM usuario WHERE IDusuario =$IDusuario";
            $result = $db->query($query);
            $datos = [];
            if($result->num_rows){
                while($row = $result->fetch_assoc()){
                    $datos[] = [
                        'IDusuario' => $row ['IDusuario'],
                        'nombreUsuario'=> $row ['nombreUsuario'],
                        'apellidoUsuario'=> $row ['apellidoUsuario'],
                        'contrasennia'=> $row ['contrasennia'],
                        'IDrol'=> $row ['IDrol'],
                    ];
                }
                return $datos;
            }
            return $datos;
        }

        public static function insert($nombreUsuario, $apellidoUsuario, $contrasennia, $IDrol){
            $db = new Connection();
            $query = "INSERT INTO usuario (nombreUsuario,apellidoUsuario,contrasennia,IDrol)
            VALUES ('$nombreUsuario', '$apellidoUsuario', '$contrasennia', '$IDrol')";
            $db->query($query);
            if ($db->affected_rows){
                return TRUE;
            }
            return FALSE;
        }

        public static function update($IDusuario, $nombreUsuario, $apellidoUsuario, $contrasennia, $IDrol){
            $db = new Connection();
            $query = "UPDATE usuario SET
                        nombreUsuario = '$nombreUsuario'
                        apellidoUsuario = '$apellidoUsuario',
                        contrasennia = '$contrasennia',
                        IDrol = 'IDrol'
                        WHERE IDusuario = $IDusuario";
            $db->query($query);
            if ($db->affected_rows) {
            return TRUE;
            }
            return FALSE;
        }

        public static function delete($IDusuario){
            $db = new Connection();
            $query ="DELETE FROM usuario WHERE IDusuario=$IDusuario";
            $db->query($query);
            if ($db->affected_rows) {
                return TRUE;
            }
            return FALSE;
        }
    }
?>