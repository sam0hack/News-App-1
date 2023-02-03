<?php

    namespace App\Repositories\NewsSources\NyTimes\lib\Helpers;

    final class Helpers
    {
        private static string $api_url_search = 'https://api.nytimes.com/svc/search/v2/articlesearch.json';
        private static string $api_url_top_headlines = 'https://api.nytimes.com/svc/topstories/v2/';


        /**
         * @param $params
         * @return string
         */
        final static public function everythingUrl($params = null, $begin_date = null, $end_date = null): string
        {
            $query = '';


            if (!is_null($params)) {

                $query .= 'q=' . $params;
            }
            if (!is_null($begin_date)) {
                $query .= '&begin_date=' . Helpers::formatDateForApi($begin_date);
            }
            if (!is_null($end_date)) {
                $query .= '&end_date=' . Helpers::formatDateForApi($end_date);
            }



            return Helpers::$api_url_search . "?" . $query . "&api-key=" . env('NYTIMES_KEY');

            //return Helpers::$api_url_search;
        }

        /**
         * @param string $params
         * @return string
         */
        final static public function topHeadlines(string $params = 'world'): string
        {
            return Helpers::$api_url_search . "?{$params}.json&api-key=" . env('NYTIMES_KEY');
        }

        /**
         * @param $date
         * @return array|string
         */
        static private function formatDateForApi($date): array|string
         {

            $date  = str_replace("/","",$date);
            return str_replace("-","",$date);


        }


    }
