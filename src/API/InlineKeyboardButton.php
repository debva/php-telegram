<?php

namespace Debva\PhpTelegram\API;

trait InlineKeyboardButton
{
    public function inlineKeyboardButton($keyboard)
    {
        return json_encode(["inline_keyboard" => [$keyboard]]);
    }
}
