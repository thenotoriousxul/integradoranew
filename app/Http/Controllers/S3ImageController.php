<?php
namespace App\Http\Controllers;

use Aws\S3\S3Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class S3ImageController extends Controller
{
    public function getImage(Request $request)
    {
        $imagePath = $request->query('image'); // Obtiene el path relativo
        if (!$imagePath) {
            Log::error('Parámetro de imagen faltante');
            return response()->json(['error' => 'Falta el parámetro de la imagen.'], 400);
        }

        $bucket = env('AWS_BUCKET');

        // Configura el cliente S3
        $s3 = new S3Client([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        try {
            // Intenta obtener el objeto desde S3
            $result = $s3->getObject([
                'Bucket' => $bucket,
                'Key' => $imagePath, // Path relativo
            ]);

            Log::info('Imagen cargada correctamente desde S3:', ['path' => $imagePath]);

            return response($result['Body'], 200)
                ->header('Content-Type', $result['ContentType'])
                ->header('Cache-Control', 'public, max-age=3600');
        } catch (\Exception $e) {
            Log::error('Error al cargar la imagen desde S3:', ['message' => $e->getMessage(), 'path' => $imagePath]);
            return response()->json(['error' => 'Error al cargar la imagen: ' . $e->getMessage()], 500);
        }
    }
}
