<?php


namespace App\Services\Telegram;


use App\Services\Telegram\Events\CommandEvent;
use App\Services\Telegram\Events\IgnoreEvent;
use App\Services\Telegram\Interfaces\EventInterface;
use Illuminate\Support\Facades\Storage;

/**
 * Class TelegramInitial
 * @package App\Services\Telegram
 */
class TelegramInitial
{
    /**
     * @var WebHook
     */
    private $WebHook = null;

    /**
     * @var null
     */
    private static $instance = null;

    /**
     * TelegramInitial constructor.
     */
    protected function __construct() {}

    /**
     *
     */
    protected function __clone() {}

    /**
     *
     */
    protected function __wakeup() {}

    /**
     *
     */
    public static function initWebHook() {
        if(self::$instance == null) {
            self::$instance = new self();
            self::$instance->setWebHookBody();
        }

        self::$instance->execute();
    }

    /**
     * Set instance WebHook
     */
    public function setWebHookBody(): void
    {
        Storage::put("public/telegram_dump.txt", file_get_contents("php://input"));

        $bodyWebHook = json_decode(file_get_contents("php://input"), true);
        if (!empty($bodyWebHook)) {
            $this->WebHook = new WebHook($bodyWebHook);
        }
    }

    /**
     *
     */
    public function execute() {
        if($this->WebHook !== null) {
            $event = new IgnoreEvent();

            if ($this->isCommand()) {
                $event = new CommandEvent();
            }

            $event->handle($this->WebHook);
        }
    }

    /**
     * @return bool
     */
    public function isCommand() : bool {
        $entities = $this->WebHook->getEntities();

        if (!empty($entities) and $entities[0]["type"] === "bot_command") {
            return true;
        }else {
            return false;
        }
    }


}
