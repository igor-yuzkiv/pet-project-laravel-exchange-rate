<?php

namespace App\Model;

use App\Model\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Class Bank
 * @package App\Model
 */
class Bank extends Model
{
    use ModelTrait;

    /**
     * @var array
     */
    protected $fillable = [
      "name",
      "alias"
    ];

    /**
     * @var array
     */
    protected $casts = [
        "is_enable" => "boolean"
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exchange_rates() {
        return $this->hasMany(ExchangeRate::class, "bank_id", "id");
    }

    public function banks_options() {
        return $this->hasOne(BanksOptions::class, "bank_id", "id");
    }

    /**
     * @param $id
     * @return bool
     */
    public function changeEnable($id) {
        $model = $this->whereId($id)->first();

        $result = false;
        if ($model !== null) {
            $is_enable = $model->getAttribute("is_enable");

            $model->setAttribute("is_enable", ($is_enable) ? false : true);
            $result = $model->save();
        }

        return $result;
    }

    /**
     * @param int $bank_id
     * @param UploadedFile $file
     * @return mixed
     */
    public function upload_log (int $bank_id, UploadedFile $file) {
        $fileName = $bank_id.".".$file->extension();
        $filePath = "public/banks/logo/";
        $path = Storage::disk("local") -> putFileAs ($filePath, $file, $fileName);

        $model = $this->whereId($bank_id)->first();
        $model->logo_path = $path;
        return $model->save();
    }

}
