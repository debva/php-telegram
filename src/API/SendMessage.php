<?php

namespace Debva\PhpTelegram\API;

trait SendMessage
{
    public function sendMessage(array $parameter)
    {
        $this->url = "{$this->url}/sendMessage";
        $this->content = $parameter;
        return $this->send();
    }
}
