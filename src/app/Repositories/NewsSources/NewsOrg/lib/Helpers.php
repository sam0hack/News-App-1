<?php

	namespace App\Repositories\NewsSources\NewsOrg\lib;

	final class Helpers
	{
        private static string $api_url = "https://newsapi.org/v2"; //Api url and api version
        private static array $countries = array(
            'ae', 'ar', 'at', 'au', 'be', 'bg', 'br', 'ca', 'ch', 'cn', 'co', 'cu', 'cz', 'de', 'eg', 'fr', 'gb', 'gr',
            'hk', 'hu','id','ie','il','in','it','jp','kr','lt','lv','ma','mx','my','ng','nl','no','nz','ph','pl', 'pt',
            'ro','rs','ru','sa','se','sg','si','sk','th','tr','tw','ua','us','ve','za');

        private static array $languages = array('ar','en','cn','de','es','fr','he','it','nl','no','pt','ru','sv','ud');
        private static array $categories = array('business', 'entertainment', 'general', 'health', 'science', 'sports', 'technology');
        private static array $sort = array('relevancy', 'popularity', 'publishedAt');

        /**
         * @param $params
         * @return string
         */
        final static public function topHeadlinesUrl($params=null): string
        {
            if(!is_null($params)){
                return Helpers::$api_url."/top-headlines?{$params}";
            }
            return Helpers::$api_url.'/top-headlines';
        }

        /**
         * @param $params
         * @return string
         */
        final static public function everythingUrl($params=null): string
        {
            if(!is_null($params)){
                return Helpers::$api_url."/everything?{$params}";
            }
            return Helpers::$api_url.'/everything';
        }

        /**
         * @param $params
         * @return string
         */
        final static public function sourcesUrl($params=null): string
        {
            if(!is_null($params)){
                return "/v2/sources?{$params}";
            }
            return Helpers::$api_url.'/sources';
        }

        /**
         * @param $country
         * @return bool
         */
        final static public function isCountryValid($country): bool
        {
            if(in_array($country, Helpers::$countries)){ return true; }
            return false;
        }

        /**
         * @param $language
         * @return bool
         */
        final static public function isLanguageValid($language): bool
        {
            if(in_array($language, Helpers::$languages)){ return true; }
            return false;
        }

        /**
         * @param $category
         * @return bool
         */
        final static public function isCategoryValid($category): bool
        {
            if(in_array($category, Helpers::$categories)){ return true; }
            return false;
        }

        /**
         * @param $sort_by
         * @return bool
         */
        final static public function isSortByValid($sort_by): bool
        {
            if(in_array($sort_by, Helpers::$sort)){ return true; }
            return false;
        }

        /**
         * @param $key
         * @return array|string[]|void
         */
        final static public function __get__($key){
            if($key == 'countries'){ return Helpers::$countries;}
            if($key == 'languages'){ return Helpers::$languages;}
            if($key == 'categories'){ return Helpers::$categories;}
            if($key == 'sort'){ return Helpers::$sort;}
        }

	}
