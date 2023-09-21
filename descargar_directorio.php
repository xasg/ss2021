<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["directorio_a_comprimir"])) {
        $directorio_a_comprimir = $_POST["directorio_a_comprimir"];
        
        // Validar la ruta del directorio aquí si es necesario
        if (!is_dir($directorio_a_comprimir)) {
            echo ('La ruta del directorio no existe, consulte con el administrador:'.$directorio_a_comprimir);
            exit();
        }
        
        $zip = new ZipArchive();
        $nombre_zip = 'contenido.zip'; // Nombre del archivo ZIP resultante

        if ($zip->open($nombre_zip, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            // Itera sobre los archivos en el directorio y agrégalos al ZIP
            $archivos = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directorio_a_comprimir));
            
            foreach ($archivos as $archivo) {
                if (!$archivo->isDir()) {
                    $archivo_local = $archivo->getPathName();
                    $archivo_zip = substr($archivo_local, strlen($directorio_a_comprimir) + 1);
                    $zip->addFile($archivo_local, $archivo_zip);
                }
            }
            
            $zip->close();
            
            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename=' . $nombre_zip);
            header('Content-Length: ' . filesize($nombre_zip));
            readfile($nombre_zip);
            
            // Eliminar el archivo ZIP después de descargar si es necesario
            // unlink($nombre_zip);
            
        } else {
            echo 'No se pudo crear el archivo ZIP.';
            exit();
        }
    } else {
        echo 'No se proporcionó un directorio para comprimir.';
        exit();
    }
} else {
    echo 'Acceso no válido.';
    exit();
}
?>
