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
    protected $cacheTimeout = 5;

    public function __construct()
    {
        $this->webhookUrl = config('services.discord.webhook_url');
    }

    public function logLogin(User $user)
    {
        if ($this->shouldNotifyUser($user->id, 'login')) {

                $message = [
                    'embeds' => [[
                        'description' => $this->formatMessage('Inicio de sesion',$user),
                        'color' => 3066993 //
                    ]]
                ];

            $this->sendToDiscord($message);
            $this->markUserNotified($user->id, 'login');
        }
    }

    public function logRegistration(User $user)
    {
        if ($this->shouldNotifyUser($user->id, 'registration')) {
            $message = [
                'username' => 'Todo Rifas', // Nombre que aparecerá en Discord
                'embeds' => [[
                    'description' => $this->formatMessage('Registro de usuario',$user),
                    'color' => 3066993 // Color hexadecimal para el mensaje (rojo)
                ]]
            ];

            $this->sendToDiscord($message);
            $this->markUserNotified($user->id, 'registration');
        }
    }

    private function formatMessage( string $eventType, User $user): string
    {
        $roles = $user->getRoleNames()->implode(', ');
        return
            "🏆🎴 **TODO RIFAS - ¡La suerte en tus manos!**\n\n" .
            "**{$eventType}:**\n" . // Cambia según el evento
            "🔑 **ID de usuario:** `{$user->id}`\n" .
            "👤 **Nombre de usuario:** `{$user->name}`\n" .
            "👥 **Rol:** `{$roles}`\n" .
            "📧 **Correo Electrónico:** `{$user->email}`\n" .
            "🗓️ **Fecha:** `". now()->format('d-m-Y H:i') . "`\n";
    }

    private function sendToDiscord(array $data): void
    {
        try {
            if (empty($this->webhookUrl)) {
                Log::error('Discord webhook URL no está configurada');
                return;
            }
            $data['username'] = 'TODO RIFAS';

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
