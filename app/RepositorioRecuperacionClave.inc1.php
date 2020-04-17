<?php

class RepositorioRecuperacionClave1 {

    public static function generar_peticion($conexion, $id_usuario, $url_secreta) {
        $peticion_generada = false;

        if (isset($conexion)) {
            try {
                
                $connect = mysqli_connect("localhost", "root", "", "blog");
                $sql_id_proyecto = "SELECT COUNT(IFNULL(id, 1)) AS ID_GESTION FROM rec";

                $reg = mysqli_query($connect, $sql_id_proyecto) or die(mysqli_error($connect));
                $row_count = mysqli_fetch_array($reg);
                //echo $row_count['ID_GESTION'];

                if ($row_count['ID_GESTION'] == 0){
                    echo "URL generada con éxito, ya puedes cerrar la página";
                    //exit;
                    $sql_id_proyecto1 = "SELECT COUNT(IFNULL(id, 1))+1 AS ID_G FROM rec";
                    $reg = mysqli_query($connect, $sql_id_proyecto1) or die(mysqli_error($connect));
                    $row_count_id = mysqli_fetch_array($reg);

                } else {
                    $sql_id_proyecto1 = "SELECT MAX(id_proyecto)+1 AS ID_G FROM rec";
                    $reg = mysqli_query($connect, $sql_id_proyecto1) or die(mysqli_error($connect));
                    $row_count_id = mysqli_fetch_array($reg);
                }
                
                $sql = "INSERT INTO rec(usuario_id, url_secreta, fecha,id_proyecto) VALUES (:usuario_id, :url_secreta, NOW(), ".$row_count_id['ID_G'].")" ;

                $sentencia = $conexion -> prepare($sql);

                $sentencia -> bindParam(':usuario_id', $id_usuario, PDO :: PARAM_STR);
                $sentencia -> bindParam(':url_secreta', $url_secreta, PDO :: PARAM_STR);

                $peticion_generada = $sentencia -> execute();
            } catch(PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        return $peticion_generada;
    }

    public static function url_secreta_existe($conexion, $url_secreta) {
        $url_existe = false;
        
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM rec WHERE url_secreta = :url_secreta";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':url_secreta', $url_secreta, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    $url_existe = true;
                } else {
                    $url_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $url_existe;
    }

    public static function obtener_id_usuario_mediante_url_secreta($conexion, $url_secreta) {
        $id_usuario = null;
        
        if (isset($conexion)) {
            try {
                include_once 'RecuperacionClave.inc1.php';

                $sql = "SELECT * FROM rec WHERE url_secreta = :url_secreta";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':url_secreta', $url_secreta, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetch();
                
                if(!empty($resultado)) {
                    $id_usuario = $resultado['usuario_id'];
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $id_usuario;
    }
}