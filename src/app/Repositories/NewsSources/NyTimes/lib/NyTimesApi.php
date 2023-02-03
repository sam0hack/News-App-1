<?php

    namespace App\Repositories\NewsSources\NyTimes\lib;

    use App\Repositories\NewsSources\NyTimes\lib\Helpers\Helpers;
    use Illuminate\Support\Facades\Http;

    class NyTimesApi
    {

        private string $api_url;
        private mixed $api_key;


        public function getEverything($q = null,$from=null,$to=null): \Illuminate\Support\Collection
        {

            $url = Helpers::everythingUrl($q,$from,$to);

            return Http::get($url)->collect();

        }

        public function getTopHeadLines(): \Illuminate\Support\Collection
        {

            $url = Helpers::topHeadlines();
            return Http::get($url)->collect();

        }

    }
