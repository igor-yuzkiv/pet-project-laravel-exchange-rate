<?php
return array(

    "TELEGRAM_BOT_TOKEN" => env("TELEGRAM_BOT_TOKEN", "YOUR-BOT-TOKEN"),
    "TELEGRAM_BOT_NAME" => env("TELEGRAM_BOT_NAME", "YOUR-BOT-NAME"),

    "commands" => [
        "start" => \App\Telegram\Commands\StartCommand::class,
        "help" => \App\Telegram\Commands\HelpCommand::class,
        "rate" => \App\Telegram\Commands\RateCommand::class,
        "mailing" => \App\Telegram\Commands\MailingSubscribeCommand::class,
    ],

    "shareLink" => "https://t.me/IgorYuzkivBot",

);
