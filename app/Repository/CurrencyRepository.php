<?php

namespace App\Repository;

use App\Model\Currency as Model;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;

class CurrencyRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param null $date
     * @return \Exception|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCurrenciesNBU($date = null)
    {
        if ($date == null) {
            $date = Carbon::now()->format("Ymd");
        } else {
            $date = Carbon::createFromDate($date)->format("Ymd");
        }
        $url = "http://bank.gov.ua//NBUStatService/v1/statdirectory/exchange?${date}=&json";

        try {
            $client = new Client();
            $request = $client->request("POST", $url);

            return json_decode($request->getBody()->getContents(), true);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

}
