<?php

namespace App\Model;

use App\Services\Telegram\WebHook;
use Illuminate\Database\Eloquent\Model;

class TelegramSubscribers extends Model
{
    protected $table = "telegram_subscribers";

    protected $fillable = [
        "chat_id",
        "first_name",
        "last_name",
        "username",
        "language_code",
    ];

    protected $casts = [
        "is_subscriber" => "bool",
        "mailing_options" => "array"
    ];

    /**
     * @param WebHook $webHook
     * @return bool
     */
    public function createByWebHook(WebHook $webHook)
    {
        $model = clone $this;

        $model->chat_id = $webHook->getChatId();
        $model->first_name = $webHook->getFirstName();
        $model->last_name = $webHook->getLastName();
        $model->username = $webHook->getUserName();
        $model->language_code = $webHook->getLanguageCode();

        $result = $model->save();

        return $result;
    }

    /**
     * @param WebHook $webHook
     * @return bool
     */
    public function setSubscribeOptionsByWebHook(WebHook $webHook, array $options)
    {
        $model = $this->whereChatId($webHook->getChatId())->first();

        if ($model !== null) {
            $model->setAttribute("is_subscriber", true);
            $model->setAttribute("mailing_options", $options);
            return $model->save();
        } else {
            return false;
        }
    }

}
