<?php


namespace App\Services\Telegram;

use App\Services\Telegram\Helpers\TelegramReplyBuilder;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Config\Repository;

/**
 * Class Telegram
 * @package App\Services\Telegram
 */
class Telegram
{
    use TelegramReplyBuilder;

    /**
     * @var WebHook
     */
    private $webHook;

    /**
     *
     */
    const BASE_URI = "https://api.telegram.org/";

    /**
     * Telegram constructor.
     * @param WebHook $webHook
     */
    public function __construct(WebHook $webHook)
    {
        $this->webHook = $webHook;
    }

    /**
     * @param string $reply_method
     * @return string
     */
    public function reply($reply_method = "sendMessage")
    {
        $client = new Client(
            [
                "base_uri" => self::BASE_URI
            ]
        );

        $options = $this->prepareOptions();

        $response = $client->post("/bot{$this->getToken()}/{$reply_method}", $options);
        return $response->getBody()->getContents();
    }


    /**
     * @return Repository|mixed
     */
    public function getToken()
    {
        return config("telegram.TELEGRAM_BOT_TOKEN");
    }

    public function getCommands() {

        $commands = config("telegram.commands");

        foreach ($commands as $key => $command) {
            $commands[$key] = new $command;
        }
        return $commands;
    }


}
