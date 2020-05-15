<?php
namespace App\Models; //namespace obligatorio para los modelo
//clase obligatoria y q luego extiene a nuestros modelo
use CodeIgniter\Model;

/**
 * Modelo o Clase CommentModel
 */
class CommentModel extends Model {

    protected $table      = "comment"; //variable q carga, la tabla a utilizar
    protected $primaryKey = "id"; //variable q carga, la llave primaria a utilizar

    protected $returnType     = "array"; //variable q cargar como retornamos los datos
    protected $useSoftDeletes = true; //variable q carga, si vamos a utilizar el borrado suave
    protected $allowedFields  = ["post_id", "name", "email", "comment"]; //variable q carga, los datos q se puede modificar
}

?>