<?php


namespace App\Services\Telegram;


abstract class Command
{
    protected $name = "";
    protected $description = "";

    protected $showInHelpList = true;

    /**
     * @var WebHook
     */
    protected $WebHook;

    /**
     * @var Telegram
     */
    protected $Telegram;



    abstract public function handle();

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    /**
     * @return bool
     */
    public function isShowInHelpList(): bool
    {
        return $this->showInHelpList;
    }

    /**
     * @param WebHook $WebHook
     */
    public function setWebHook(WebHook $WebHook): void
    {
        $this->WebHook = $WebHook;
    }

    /**
     * @param Telegram $Telegram
     */
    public function setTelegram(Telegram $Telegram): void
    {
        $this->Telegram = $Telegram;
    }
}
