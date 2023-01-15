<?php

namespace Debva\PhpTelegram\API;

trait EditMessageText
{
    public function editMessageText($parameter)
    {
        $this->url = "{$this->url}/editMessageText";
        $this->content = $parameter;
        return $this->send();
    }
}
