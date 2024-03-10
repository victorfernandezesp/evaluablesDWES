:: Creacion arbol del directorios
mkdir public
mkdir app
mkdir app\Config
mkdir app\Core
mkdir app\Controllers
mkdir app\Views
mkdir app\Models

:: Copia de ficheros base
copy MVC_structure_generator\app\Models\DBAbstractModel.php app\Models\DBAbstractModel.php
echo Archivo DBAbstractModel.php copiado exitosamente.

copy MVC_structure_generator\app\Controllers\BaseController.php app\Controllers\BaseController.php
echo Archivo BaseController.php copiado exitosamente.
copy MVC_structure_generator\app\Controllers\IndexController.php app\Controllers\IndexController.php
echo Archivo IndexController.php copiado exitosamente.

copy MVC_structure_generator\app\Views\index_view.php app\Views\index_view.php
echo Archivo index_view.php copiado exitosamente.

copy MVC_structure_generator\app\Core\Router.php app\Core\Router.php
echo Archivo Router.php copiado exitosamente.

copy MVC_structure_generator\public\index.php .\public\index.php
echo Archivo index.php creado exitosamente.
copy MVC_structure_generator\public\.htaccess .\public\.htaccess
echo Archivo .htaccess creado exitosamente.

copy MVC_structure_generator\composer.json .\composer.json
echo Archivo composer.json creado exitosamente.
copy MVC_structure_generator\.gitignore .\.gitignore
echo Archivo .gitignore creado exitosamente.

:: Instalacion de composer
composer install
echo Instalación de dependencias completada.
