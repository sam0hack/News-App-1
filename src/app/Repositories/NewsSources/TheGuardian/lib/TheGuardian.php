<?php

    namespace App\Repositories\NewsSources\TheGuardian\lib;

    use Illuminate\Support\Facades\Http;

    class TheGuardian extends Params
    {
        public $api_key;
        public $param = array();

        public function __construct()
        {
            $this->api_key = env('GUARDIAN_KEY');
        }

        //tags
        public function get_tags()
        {
            $url = "https://content.guardianapis.com/tags?" . $this->determine();
            return Http::get($url)->collect();
        }

        //sections

        /**
         * @return string
         */
        public function determine(): string
        {
            if (count($this->param) == 0) {
                return http_build_query(array('api-key' => $this->api_key));
            } else {
                return http_build_query(array_merge($this->param, array('api-key' => $this->api_key)));
            }
        }

        //editions

        public function get_sections()
        {
            $url = "https://content.guardianapis.com/sections?" . $this->determine();
            return Http::get($url)->collect();
        }

        //content

        public function get_editions()
        {
            $url = "https://content.guardianapis.com/editions?" . $this->determine();
            return Http::get($url)->collect();
        }

        public function get_articles($q = null, $from_date = null, $to_date = null)
        {

            $url = "https://content.guardianapis.com/search?q=" . $q;

            if ($from_date != null) {
                $url .= '&from-date=' . $from_date;
            }
            if ($to_date != null) {
                $url .= '&to-date=' . $to_date;
            }

            $url .= '&show-fields=all&' . $this->determine();


            return Http::get($url)->collect();
        }

        public function get_article($id)
        {
            $url = "https://content.guardianapis.com/" . $id . "?" . $this->determine();
            return Http::get($url)->collect();
        }
    }
