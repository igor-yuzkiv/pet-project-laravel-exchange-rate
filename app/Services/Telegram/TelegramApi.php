<?php


namespace App\Services\Telegram;


use App\Services\Telegram\Helpers\TelegramReplyBuilder;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Config\Repository;

class TelegramApi
{

    use TelegramReplyBuilder;

    /**
     * @var string
     */
    private $chat_id = "";

    /**
     *
     */
    const BASE_URI = "https://api.telegram.org/";


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
     * @return array
     */
    protected function prepareOptions() {
        $this->replyOptions["chat_id"] = $this->getChatId();
        return [RequestOptions::JSON => $this->replyOptions];
    }

    /**
     * @return mixed
     */
    public function getChatId()
    {
        return $this->chat_id;
    }

    /**
     * @param mixed $chat_id
     */
    public function setChatId($chat_id): void
    {
        $this->chat_id = $chat_id;
    }

    /**
     * @return Repository|mixed
     */
    public function getToken()
    {
        return config("telegram.TELEGRAM_BOT_TOKEN");
    }
}
