<?php
namespace App\Controllers;

use App\Models\Blog;
use \Respect\Validation\Validator as v;

class BlogsController extends BaseController {
    
    // Función que maneja la acción de visualización y procesamiento de formularios de blogs
    public function blogsAction($request){
        // Verifica si la solicitud es de tipo POST
        if ($request->getMethod() == "POST"){
            
            // Define un validador utilizando Respect\Validation para validar los campos del formulario
            $validador = v::key('title', v::stringType()->notEmpty())
                ->key('author', v::stringType()->notEmpty())
                ->key('blog', v::stringType()->notEmpty())
                ->key('tags', v::stringType()->notEmpty());
            
            try {
                // Intenta validar los datos de la solicitud usando el validador
                $validador->assert($request->getParsedBody());

                // Crea una nueva instancia de la clase Blog y asigna valores a sus propiedades
                $blog = new Blog();
                $blog->title = $request->getParsedBody()['title'];
                $blog->author = $request->getParsedBody()['author'];
                $blog->blog = $request->getParsedBody()['blog'];
                $blog->tags = $request->getParsedBody()['tags'];

                // Manejo de la carga de imágenes
                $files = $request->getUploadedFiles();
                $image = $files['image'];
                if ($image->getError() == UPLOAD_ERR_OK) {
                    $fileName = $image->getClientFilename();
                    $fileName = uniqid().$fileName;
                    $image->moveTo("img/$fileName");
                    $blog->image = $fileName;
                }

                // Guarda el objeto Blog en la base de datos
                $blog->save();
                header("Location: /");

            } catch(\Exception $e) {
                // Captura excepciones y muestra un mensaje de error
                $response = "Error: ".$e->getMessage();
            }
        }

        // Datos para pasar a la plantilla de vista (twig)
        $data = [
            "response" => $response ?? "", // Si no hay mensaje de respuesta, se establece en cadena vacía
        ];

        // Renderiza la plantilla de formulario para agregar blogs con los datos proporcionados
        return $this->renderHTML("addBlog.twig", $data);
    }
}
?>
