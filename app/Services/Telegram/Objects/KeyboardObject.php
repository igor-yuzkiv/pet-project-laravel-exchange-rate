<?php


namespace App\Services\Telegram\Objects;


class KeyboardObject
{
    /**
     * @var array
     */
    private $keyboard = [];

    /**
     * @param $button
     * @return $this
     */
    public function addButton ($button)
    {
        if ( is_array($button) ) {

            foreach ($button as $item) {
                $this->addButton($item);
            }

        }elseif( is_string($button) ) {
            $this->keyboard[] = [$button];
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getKeyboard() {
        return $this->keyboard;
    }

}
