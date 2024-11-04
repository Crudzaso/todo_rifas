<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class DiscordWebhookService

    /**
     * Create a new class instance.
     */
{
    protected $webhookUrl;
    protected $cacheTimeout = 5; // Tiempo en minutos

    public function __construct()
    {
        $this->webhookUrl = config('services.discord.webhook_url');
    }

    public function logLogin(User $user)
    {
        if ($this->shouldNotifyUser($user->id, 'login')) {
            $message = [
                'content' => $this->formatMessage('NUEVO INICIO DE SESIÓN', $user),
                'username' => 'TODO RIFAS Bot',
                'avatar_url' => asset('images/todo_rifas_pet.png')
            ];

            $this->sendToDiscord($message);
            $this->markUserNotified($user->id, 'login');
        }
    }

    public function logRegistration(User $user)
    {
        if ($this->shouldNotifyUser($user->id, 'registration')) {
            $message = [
                'content' => $this->formatMessage('NUEVO REGISTRO DE USUARIO', $user),
                'username' => 'TODO RIFAS Bot',
                'avatar_url' => asset('images/todo_rifas_pet.png')
            ];

            $this->sendToDiscord($message);
            $this->markUserNotified($user->id, 'registration');
        }
    }

    private function formatMessage($type, User $user): string
    {
        return
            "**🏆 {$type}:**\n" . // Trofeo para el tipo
            "**ID de usuario:** {$user->id}\n" .
            "**Nombre de usuario:** {$user->name} 🥇\n" . // Medalla para el nombre
            "**Correo Electrónico:** {$user->email} 📧\n" . // Icono de correo
            "**Fecha:** " . now()->format('d-m-Y H:i') . " ⏰";
    }

    private function sendToDiscord(array $data): void
    {
        try {
            if (empty($this->webhookUrl)) {
                Log::error('Discord webhook URL no está configurada');
                return;
            }

            $response = Http::post($this->webhookUrl, $data);

            if (!$response->successful()) {
                Log::error('Error al enviar webhook a Discord', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'data' => $data
                ]);
            } else {
                Log::info('Mensaje enviado exitosamente a Discord', [
                    'type' => $data['content']
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Excepción al enviar webhook a Discord: ' . $e->getMessage(), [
                'exception' => $e,
                'data' => $data
            ]);
        }
    }

    private function shouldNotifyUser($userId, $eventType): bool
    {
        $cacheKey = "webhook_notification:{$userId}:{$eventType}";
        return !Cache::has($cacheKey);
    }

    private function markUserNotified($userId, $eventType): void
    {
        $cacheKey = "webhook_notification:{$userId}:{$eventType}";
        Cache::put($cacheKey, true, now()->addMinutes($this->cacheTimeout));
    }
}
