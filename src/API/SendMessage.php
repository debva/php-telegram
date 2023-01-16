<?php

namespace Debva\PhpTelegram\API;

trait SendMessage
{
    public function sendMessage(array $parameter)
    {
        $this->endpoint = 'sendMessage';
        $this->content = $parameter;
        return $this->send();
    }
}
