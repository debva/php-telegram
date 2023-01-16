<?php

namespace Debva\PhpTelegram;

use Debva\PhpTelegram\Concerns\{
    AvailableMethods,
    AvailableTypes,
    GettingUpdates,
    UpdatingMessages,
    Utilities
};

class Telegram
{
    use AvailableMethods, AvailableTypes, GettingUpdates, UpdatingMessages, Utilities;

    public const PARSE_MODE_HTML = 'HTML';

    public const PARSE_MODE_MARKDOWN = 'MarkdownV2';

    protected $url = 'https://api.telegram.org/bot';

    protected $endpoint;

    protected $content;

    public function __construct($token)
    {
        $this->url = "{$this->url}{$token}";
    }
}
