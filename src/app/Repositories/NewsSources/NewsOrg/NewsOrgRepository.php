<?php

    namespace App\Repositories\NewsSources\NewsOrg;

    use App\Repositories\NewsSources\NewsOrg\lib\NewsApi;
    use App\Repositories\NewsSources\NewsOrg\lib\NewsApiException;
    use App\Repositories\NewsSources\NewsSourcesInterface;


    class NewsOrgRepository implements NewsSourcesInterface
    {
        private NewsApi $news_api;

        public function __construct()
        {
            $this->news_api = new NewsApi();
        }


        /**
         * @throws NewsApiException
         */
        public function getSources(): \Illuminate\Support\Collection
        {
            return $this->news_api->getSources();
        }


        /**
         * @throws NewsApiException
         */
        public function getTopHeadlines(string $q = null, string $sources = null, string $country = 'us', string $category = null, string $author = null, int $page_size = null, int $page = null): \Illuminate\Support\Collection
        {
            return $this->news_api->getTopHeadLines($q, $sources, $country, $category, $page_size, $page);

        }

        /**
         * @throws NewsApiException
         */
        public function get($search = 'today', $from = null, $to = null, $source = null, $author = null): \Illuminate\Support\Collection
        {


            return $this->news_api->getEverything($search, $source, $from, $to, $author);

        }

    }
