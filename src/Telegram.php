<?php

namespace Debva\PhpTelegram;

use Debva\PhpTelegram\Concerns\{
    AvailableMethods,
    AvailableTypes,
    GettingUpdates,
    UpdatingMessages
};

class Telegram
{
    use AvailableMethods, AvailableTypes, GettingUpdates, UpdatingMessages;

    public const PARSE_MODE_HTML = 'HTML';

    protected $url = 'https://api.telegram.org/bot';

    protected $content;

    public function __construct($token)
    {
        $this->url = "{$this->url}{$token}";
    }

    public function listenWebhook(\Closure $callback)
    {
        $listen = json_decode(file_get_contents('php://input'), true);
        if (!is_null($listen) and isset($listen['callback_query'])) {
            $callback($listen['callback_query'], $listen['update_id']);
            exit;
        }
    }

    protected function send()
    {
        return json_decode(file_get_contents($this->url, false, stream_context_create([
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($this->content)
            ]
        ])));
    }
}
