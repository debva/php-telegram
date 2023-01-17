<?php

namespace Debva\PhpTelegram;

use Debva\PhpTelegram\Exceptions\TelegramException;

class Telegram
{
    public const PARSE_MODE_HTML = 'HTML';

    public const PARSE_MODE_MARKDOWN = 'MarkdownV2';

    protected $url = 'https://api.telegram.org/bot';

    protected $endpoint;

    protected $parameter;

    public function __construct($token)
    {
        $this->url = "{$this->url}{$token}";
    }

    public function __call($endpoint, $parameter)
    {
        try {
            if (in_array($endpoint, $this->endpointList())) {
                $this->endpoint = $endpoint;
                $this->parameter = end($parameter);
                return $this->send();
            }

            throw new TelegramException('Endpoint not found');
        } catch (TelegramException $e) {
            echo $e->getMessage();
            return $e->getMessage();
        }
    }

    public function inlineKeyboardButton($keyboard)
    {
        return json_encode(["inline_keyboard" => [$keyboard]]);
    }

    public function listenWebhook(\Closure $closure)
    {
        $listen = json_decode(file_get_contents('php://input'), true);
        if (!is_null($listen) and isset($listen['callback_query'])) {
            $closure = $closure->bindTo($this, __CLASS__);
            $closure($listen['callback_query'], $listen['update_id']);
            exit;
        }
    }

    protected function send()
    {
        return json_decode(file_get_contents("{$this->url}/{$this->endpoint}", false, stream_context_create([
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($this->parameter)
            ]
        ])));
    }

    protected function endpointList()
    {
        return [
            'sendMessage',
            'editMessageText',
            'setWebhook',
        ];
    }
}
