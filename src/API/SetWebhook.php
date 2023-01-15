<?php

namespace Debva\PhpTelegram\API;

trait SetWebhook
{
    public function setWebhook($parameter)
    {
        $this->url = "{$this->url}/setWebhook";
        $this->content = $parameter;
        return $this->send();
    }
}
