<?php


namespace App\Services\Telegram\Helpers;


use App\Services\Telegram\Objects\KeyboardObject;
use GuzzleHttp\RequestOptions;

/**
 * Trait TelegramReplyBuilder
 * @package App\Services\Telegram\Helpers
 */
trait TelegramReplyBuilder
{
    /**
     * @var
     */
    protected $replyOptions;

    /**
     * @param string $text
     * @return $this
     */
    public function setText(string $text) {
        $this->replyOptions["text"] = $text;
        return $this;
    }

    /**
     * @param KeyboardObject $keyboardObject
     * @param string $text
     * @return $this
     */
    public function setKeyboard(KeyboardObject $keyboardObject, $text = null) {
        $this->replyOptions["reply_markup"] = [
            'keyboard' => $keyboardObject->getKeyboard(),
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ];

        if ($text !== null) {
            $this->setText($text);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function removeKeyboard() {
        $this->replyOptions["reply_markup"] = [
            'remove_keyboard' => true
        ];
        return $this;
    }

    /**
     * @return array
     */
    protected function prepareOptions() {
        $this->replyOptions["chat_id"] = $this->webHook->getChatId();
        return [RequestOptions::JSON => $this->replyOptions];
    }

}
