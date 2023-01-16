<?php

namespace Debva\PhpTelegram\API;

trait EditMessageText
{
    public function editMessageText($parameter)
    {
        $this->endpoint = 'editMessageText';
        $this->content = $parameter;
        return $this->send();
    }
}
