<?php

namespace App\Http\Controllers;

use App\Models\OrganizerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class OrganizerRequestController extends Controller
{
    /**
     * Muestra el formulario para crear una solicitud.
     */
    public function create()
    {
        return view('organizer.request-create');
    }

    /**
     * Almacena la solicitud de cambio de rol en la base de datos.
     */ 
    public function store(Request $request)
    {

        try {
            $documentPhotoUrl = null;
            if ($request->hasFile('document_photo')) {
                Log::info('Intentando subir la foto del documento a Cloudinary.');
                $documentPhoto = $request->file('document_photo');
                $documentPhotoUpload = Cloudinary::upload($documentPhoto->getRealPath());
                $documentPhotoUrl = $documentPhotoUpload->getSecurePath();  // Obtiene la URL segura del archivo
                
            }
            // Subir el contrato a Cloudinary
            $contractUrl = null;
            if ($request->hasFile('contract')) {
                Log::info('Intentando subir el contrato a Cloudinary.');
                $contract = $request->file('contract');
                $contractUpload = Cloudinary::upload($contract->getRealPath(), [
                    'resource_type' => 'auto'  // Auto detecta el tipo de archivo (imagen, video, PDF, etc.)
                ]);
                $contractUrl = $contractUpload->getSecurePath();  // Obtiene la URL segura del archivo
                Log::info('Contrato subido a Cloudinary: ' . $contractUrl);
            }

            // Verificar si ambos archivos fueron subidos
            if ($documentPhotoUrl && $contractUrl) {
                Log::info('Creando el registro en la tabla organizer_requests.');
                OrganizerRequest::create([
                    'user_id' => Auth::id(),
                    'reason' => $request->reason,
                    'document_number' => $request->document_number,
                    'document_photo' => $documentPhotoUrl,
                    'contract' => $contractUrl,
                ]);
                Log::info('Solicitud creada correctamente.');

                return redirect()->route('organizer.request.create')->with('success', 'Tu solicitud ha sido enviada.');
            } else {
                Log::error('No se pudieron subir ambos archivos. Solicitud no creada.');
                return redirect()->route('organizer.request.create')->with('error', 'No se pudieron subir los archivos. Por favor, inténtalo de nuevo.');
            }
        } catch (\Exception $e) {
            Log::error('Error al procesar la solicitud: ' . $e->getMessage());
            return redirect()->route('organizer.request.create')->with('error', 'Ocurrió un error al enviar tu solicitud. Por favor, intenta nuevamente.');
        }
    }

    /**
     * Muestra la lista de solicitudes pendientes al administrador.
     */
    public function index()
    {
        // Obtener solicitudes pendientes con información del usuario
        $requests = OrganizerRequest::with('user')->where('status', 'pending')->get();

        // Mostrar vista de solicitudes
        return view('admin.request-panel', compact('requests'));
    }

    /**
     * Aprobar una solicitud y asignar el rol de "organizer" al usuario.
     */
    public function approve(OrganizerRequest $request)
    {
        // Actualizar estado a 'approved' y asignar el rol
        $request->update(['status' => 'approved']);

        // Asignar el rol al usuario que hizo la solicitud
        $user = $request->user;
        if (!$user->hasRole('organizer')) {
            $user->assignRole('organizer');
        }

        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.organizer.requests')
            ->with('success', 'Solicitud aprobada y rol asignado.');

            
    }

    /**
     * Rechazar una solicitud.
     */
    public function reject(OrganizerRequest $request)
    {
        // Actualizar estado a 'rejected'
        $request->update(['status' => 'rejected']);

        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.organizer.requests')
            ->with('success', 'Solicitud rechazada.');
    }
}
