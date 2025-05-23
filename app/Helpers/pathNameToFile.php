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
        if (is_null($fileName) || empty($fileName)) {
            return null;
        }

        $filePath = $imageDirectory . $fileName;

        if (file_exists($filePath)) {
            // Calcular la ruta relativa para URL
            $relativePath = str_replace(storage_path('app/public/'), '', $filePath);

            return [
                'name' => $fileName,
                'size' => filesize($filePath),
                'url' => '/storage/' . $relativePath,
                'description' => 'Descripción del archivo',
                'status' => true,
            ];
        }

        return null;
    }
}
