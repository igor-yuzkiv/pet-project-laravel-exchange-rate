<?php

namespace App\Repository\Translator;

use App\Repository\CoreRepository;
use Waavi\Translation\Models\Language as Model;

class LanguageRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }
}
