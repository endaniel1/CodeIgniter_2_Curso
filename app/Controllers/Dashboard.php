<?php
namespace App\Controllers; //namespace obligatorio para el uso de los controladores
//Modelos de las clse a utilizar
use App\Models\CategoryModel;
use App\Models\CommentModel;
use App\Models\NewsletterModel;
use App\Models\PostModel;

class Dashboard extends BaseController {

    //cargando la vista index
    public function index() {
        $this->loadViews("index");
    }

    //cargando y añadiendo los posts
    public function uploadPost() {

        //categories
        $categoriesmodel    = new CategoryModel();
        $data["categories"] = $categoriesmodel->findAll();

        //posts
        $postmodel = new PostModel();

        helper(["url", "form"]); //helper q usamos
        $validation = \Config\Services::validation(); //clase para la validacion personalizada de otra manera
        //reglas de validaciondes como array y despues los mensajes de validaciones como array
        $validation->setRules([
            "title"    => "required",
            "intro"    => "required",
            "content"  => "required|min_length[50]",
            "category" => "required",
            "tags"     => "required",
        ], [
            "title"    => [
                "required" => "El Titulo Es Requerido. Escriba Uno!",
            ],
            "intro"    => [
                "required" => "La Intro Es Requerido. Escriba Uno!",
            ],
            "content"  => [
                "required"   => "El Contenido Es Requerido. Escriba Uno!",
                "min_length" => "El Contenido Minimo 50 Caracteres..!",
            ],
            "category" => [
                "required" => "El Categoria Es Requerido. Eliga Una!",
            ],
            "tags"     => [
                "required" => "El Tag Es Requerido. Eliga Uno!",
            ],
        ]);
        //vemos aqui s viene algo por la varible post
        if ($_POST) {
            //form validaciones de errores
            if (!$validation->withRequest($this->request)->run()) {
                $errores        = $validation->getErrors();
                $data["errors"] = true; //mostramos aqui unos mensaje de errores
            } else {
                //form validaciones de success
                //variable en donde esta el archivo
                $file     = $this->request->getFile("banner");
                $filename = $file->getRandomName(); //le generemos un nombre random
                if ($file) {
                    $file->move(ROOTPATH . "public/uploads", $filename); //guardamos y movemos el archivo en la carpeta writetable/uploads/
                }

                //seteamos las variables para agregarle las cosas bn
                $_POST["banner"]     = $filename;
                $_POST["slug"]       = url_title($_POST["title"]); //url_title() agrega "-" despues de casa espacio
                $_POST["created_at"] = date("Y-m-d h:i:s");

                $postmodel->insert($_POST); //insertamos todo lo q viene en post

            }

        }

        $this->loadViews("uploadPost", $data); //retornamos aqui la vista con la varible
    }

    //vista de categorias
    public function category() {
        $this->loadViews("category");
    }

    //añadiendo newsletter y el envio lo hacemos con AJAX
    public function add_newsletter() {

        //Comprobamos aqui si viene una varible llamada email
        if (isset($_POST["email"])) {

            //Cargamos el modelo NewsletterModel()
            $newslettermodel = new NewsletterModel();
            //Buscamos aqui si existe un email
            $email = $newslettermodel->where("email", $_POST["email"])->findAll();
            //print_r($_POST);

            //Verificamos si existe
            if ($email) {
                echo "El email ya existe"; //mostramos este mensaje si existe
            } else {
                $id = $newslettermodel->insert($_POST); //Aqui insertamos loq viene de la varible $_Post "lo grego en una varible pero no es necesario"
                echo 'Bienvenido Boletin Informativo!'; //Aqui mostramos este mensaje
            }

        }
    }

    //cargamos aqui la vista de los post
    public function post($slug = null, $id = null) {

        //vemos si exite las varibles ose las 2, una cosa es q sea su valor null otra q existan
        if ($slug && $id) {

            //Vemos aqui si viene algo por post
            if ($_POST) {
                $commentmodel = new CommentModel(); //cargamos el modelo CommentModel
                helper(["url", "form"]); //y los helper a utilizar
                //Aqui las validaciones
                $validacion = \Config\Services::validation();
                //Aqui las reglas de validaciones y sus mensajes
                $validacion = setRules([
                    "cName"    => "required",
                    "cEmail"   => "required",
                    "cMessage" => "required|min_length[15]",
                ], [
                    "cName"    => ["required" => " El Nombre es Requerido!"],
                    "cEmail"   => ["required" => " El Correo es Requerido!"],
                    "cMessage" => [
                        "required"   => "El Comentario es Requerido!",
                        "min_length" => "El Comentario debe ser de minimo 15 caracteres!",
                    ],
                ]);
            }

            //Despues aqui cargamos el modelo PostModel() y buscamos por su id
            //Y agregamos en una varible
            $postmodel    = new PostModel();
            $post         = $postmodel->where("id", $id)->findAll();
            $data["post"] = $post;

            //Aqui cargamos el model CategoryModel()
            //Buscamos por su id donde coincida con el id de la categoria del post y lo agragamos en una varible
            $category           = new CategoryModel();
            $data["categories"] = $category->where("id", $post[0]["category"])->findAll();

            //Aqui sencillamente llamos a el metodo q carga las vistas y le pasamos la variable
            $this->loadViews("posts", $data);
        }
    }

    //metodo q carga las vista
    public function loadViews($view = null, $data = null) {

        //vemos aqui si existe la variable data
        if ($data) {
            //Guardamos a $view en una varible y pasamos $data a las vistas
            $data["view"] = $view;
            echo view("includes/header", $data);
            echo view($view, $data);
            echo view("includes/footer", $data);
        } else {
            //sino existe $data no enviamos $data a las view
            echo view("includes/header");
            echo view($view);
            echo view("includes/footer");
        }

    }
}
