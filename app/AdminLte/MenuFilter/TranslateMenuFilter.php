<?php


namespace App\AdminLte\MenuFilter;


use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class TranslateMenuFilter implements FilterInterface
{
    public function transform($item)
    {
        if (isset($item['translation']))
        {
            $item["text"] = __($item['translation']);
        }
        return $item;
    }
}
