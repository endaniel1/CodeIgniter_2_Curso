<?php namespace App\Controllers;

class Dashboard extends BaseController {

    public function index() {
        echo "Inside Dashboard!" . "<br>";
        $this->hello("dashboard-slug", 123);
    }
    protected function hello($val1 = null, $val2 = null) {
        echo $val1 . "<br>";
        echo $val2;
    }
    public function vista() {
        $data = [
            "midata1" => "testing1",
            "midata2" => "testing2",
        ];
        return view("my_view", $data);
    }
    public function template() {
        $parser = \Config\Services::parser();
        $data   = [
            "title"   => "Mi Sitio Web Es Bueno..!",
            "content" => "Este Es El Contenido De Mi Sitio",
            "footer"  => "Este Es Mi Footer",
        ];
        echo $parser->setData($data)->render("my_template");

    }
    //--------------------------------------------------------------------

}
