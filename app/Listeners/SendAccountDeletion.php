<?php

namespace App\Listeners;

use App\Events\AccountDeletion;
use App\Services\DiscordWebhookService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAccountDeletion
{
    /**
     * Create the event listener.
     */

    protected $discordWebhook;

    public function __construct(DiscordWebhookService $discordWebhookService)
    {
        $this->discordWebhook=$discordWebhookService;
    }

    /**
     * Handle the event.
     */
    public function handle(AccountDeletion $deletionEvent): void
    {
        if ($deletionEvent->action === 'deleted') {
            $this->discordWebhook->logUserDeletion($deletionEvent->user);
        } elseif ($deletionEvent->action === 'restored') {
            $this->discordWebhook->logUserRestoration($deletionEvent->user);
        }

    }
}
