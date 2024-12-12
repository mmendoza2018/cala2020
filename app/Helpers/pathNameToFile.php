<?php

if (!function_exists('pathNameToFile')) {
    /**
     * Obtiene los detalles de una imagen dado su nombre.
     *
     * @param string $fileName Nombre del archivo.
     * @param string $imageDirectory Directorio base de las imágenes.
     * @return array|null Información del archivo o null si no existe.
     */
    function pathNameToFile(?string $fileName, string $imageDirectory): ?array
    {

        // Si $fileName es null, retorna null inmediatamente
        if (is_null($fileName) || empty($fileName)) {
            return null;
        }

        $filePath = $imageDirectory . $fileName;

        if (file_exists($filePath)) {
            return [
                'name' => $fileName,
                'size' => filesize($filePath), // Tamaño en bytes
                'url' => '/storage/uploads/' . $fileName,
                'description' => 'Descripción del archivo', // Modifica según tus necesidades
                'status' => true, // Modifica según tus necesidades o lógicas
            ];
        }

        return null; // Retorna null si el archivo no existe
    }
}
