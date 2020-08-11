<?php


namespace App\Services\Telegram;


/**
 * Class WebHook
 * @package App\Services\Telegram
 */
class WebHook
{
    /**
     * @var array
     */
    protected $WebHook = [];

    /**
     * @var mixed
     */
    protected $WebHookUpdateId;

    /**
     * WebHook constructor.
     * @param $bodyWebHook
     */
    public function __construct($bodyWebHook)
    {
        $this->WebHook = $bodyWebHook["message"];
        $this->WebHookUpdateId = $bodyWebHook["update_id"];
    }

    /**
     * @return mixed|null
     */
    public function getEntities()
    {
        if (isset($this->WebHook["entities"]) and !empty($this->WebHook["entities"])) {
            return $this->WebHook["entities"];
        } else
            return NULL;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->WebHook["text"];
    }

    /**
     * @return array
     */
    public function getChat(): array
    {
        return $this->WebHook["chat"];
    }

    /**
     * @return mixed
     */
    public function getChatId()
    {
        return $this->getChat()["id"];
    }

    /**
     * @return bool|string
     */
    public function getCommandName()
    {
        $entities = $this->getEntities();

        if (!empty($entities) and ($entities[0]["type"] == "bot_command")) {
            return substr($this->getText(), 1, $this->getEntitiesLength() - 1);
        } else
            return "null";
    }

    /**
     * @return mixed
     */
    public function getEntitiesLength()
    {
        return $this->getEntities()[0]["length"];
    }

    public function getFrom()
    {
        return $this->WebHook["from"];
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->getFrom()['first_name'];
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->getFrom()['last_name'];
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->getFrom()["username"];
    }

    /**
     * @return mixed
     */
    public function getLanguageCode()
    {
        return $this->getFrom()["language_code"];
    }

    /**
     * @return bool
     */
    public function hasArguments(): bool
    {
        $arguments = $this->getArguments();

        if (trim($arguments[0]) != "" or trim($arguments[0]) != null) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $delimiter
     * @return array
     */
    public function getArguments($delimiter = " "): array
    {
        $arguments = substr($this->getText(), $this->getEntitiesLength());
        return explode($delimiter, trim($arguments));
    }


}
