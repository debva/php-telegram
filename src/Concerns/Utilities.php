<?php

namespace Debva\PhpTelegram\Concerns;

trait Utilities
{
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
                'content' => http_build_query($this->content)
            ]
        ])));
    }
}
