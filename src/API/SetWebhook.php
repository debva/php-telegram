<?php

namespace Debva\PhpTelegram\API;

trait SetWebhook
{
    public function setWebhook($parameter)
    {
        $this->endpoint = 'setWebhook';
        $this->content = $parameter;
        return $this->send();
    }
}
