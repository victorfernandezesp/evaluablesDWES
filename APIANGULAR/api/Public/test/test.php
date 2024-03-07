<?php
    use App\Models\Contactos;
    require "../../bootstrap.php";

    $datos = array(
        'nombre' => 'Juan',
        'telefono' => '666666666',
        'email' => 'example@gmail.com');

    echo "Clases sin instanciar<br>";

    $sh_singleton1 = Contactos::getInstancia();

    // var_dump($sh_singleton1->get(7));
    // echo "<br>";
    // echo $sh_singleton1->getMensaje();

    $sh_singleton1->setID(7);
    $sh_singleton1->setNombre($datos['Pola']);
    $sh_singleton1->setTelefono($datos['123456789']);
    $sh_singleton1->setEmail("perezadevida@gmail.com");


    // $sh_singleton1->set();
    // $sh_singleton1->edit();
    // echo "<br>";
    // echo $sh_singleton1->getMensaje();

    $sh_singleton1->delete(10);
    echo "<br>";
    echo $sh_singleton1->getMensaje();
?>