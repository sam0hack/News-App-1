<?php

    namespace App\Repositories\NewsSources\NewsOrg\lib;

    use Exception;
    use Illuminate\Support\Collection;
    use Illuminate\Support\Facades\Http;

    class NewsApi
    {

        private NewsApiAuth $auth;
        private array $request_header;

        public function __construct()
        {
            $this->auth = new NewsApiAuth(env('NEWSORG_KEY'));
            $this->request_header = $this->auth->AuthHeaders();

        }

        /**
         * @param string|null $q
         * @param string|null $sources
         * @param string $country
         * @param string|null $category
         * @param int|null $page_size
         * @param int|null $page
         * @return Collection
         * @throws NewsApiException
         */
        public function getTopHeadLines(string $q = null, string $sources = null, string $country = 'us', string $category = null, string $author = null, int $page_size = null, int $page = null): \Illuminate\Support\Collection
        {
            //Returns live top and breaking headlines for a country, specific category in a country, single source, or multiple sources
            $payload = array();

            //Add Search keyword if provided
            if (!is_null($q)) {
                $payload['q'] = $q;
            }

            //Ensure sources is not mixed with country or category.
            if (!is_null($sources) && (!is_null($country) || !is_null($category))) {
                throw new NewsApiException("You Cannot Use Sources with Country or Category at the same time.");
            }

            //Add Sources if provided
            if (!is_null($sources)) {
                $payload['sources'] = $sources;
            }

            //Add author if provided
            if (!is_null($author)) {
                $payload['author'] = $author;
            }


            //Add country if provided
            if (!is_null($country)) {
                if (Helpers::isCountryValid($country)) {
                    $payload['country'] = $country;
                } else {
                    throw new NewsApiException("Invalid Country Identifier Provided");
                }
            }

            //Add category if provided
            if (!is_null($category)) {
                if (Helpers::isCategoryValid($category)) {
                    $payload['category'] = $category;
                } else {
                    throw new NewsApiException("Invalid Category Identifier Provided");
                }
            }

            if (!is_null($page_size)) {
                if ($page_size >= 1 && $page_size <= 100) {
                    $payload['pageSize'] = $page_size;
                } else {
                    throw new NewsApiException("Invalid Page_size Value Provided");
                }
            }

            if (!is_null($page)) {
                $payload['page'] = $page;
            }

            //Make Request
            $url = Helpers::topHeadlinesUrl();
            try {

                $response = Http::withHeaders($this->request_header)->get($url, $payload);
                if ($response->status() == 200) {
                    return $response->collect();
                } else {
                    $response_body = $response->collect();
                    throw new NewsApiException($response_body['message']);
                }
            } catch (Exception $e) {
                throw new NewsApiException($e->getMessage());
            }


        }

        /**
         * @param string|null $q
         * @param string|null $sources
         * @param string|null $from
         * @param string|null $to
         * @param string|null $domains
         * @param string|null $exclude_domains
         * @param string $language
         * @param string|null $sort_by
         * @param int|null $page_size
         * @param int|null $page
         * @return Collection
         * @throws NewsApiException
         */
        public function getEverything(string $q = null, string $sources = null, string $from = null, string $to = null, string $author = null, string $domains = null, string $exclude_domains = null, string $language = 'en', string $sort_by = null, int $page_size = null, int $page = null): \Illuminate\Support\Collection
        {
            //Search through millions of articles from small and big blogs.

            $payload = array();

            //Add Search keyword if provided
            if (!is_null($q)) {
                $payload['q'] = $q;
            }

            //Add Sources if provided
            if (!is_null($sources)) {
                $payload['sources'] = $sources;
            }

            //Add author if provided
            if (!is_null($author)) {
                $payload['author'] = $author;
            }

            //Add Domains if provided
            if (!is_null($domains)) {
                $payload['domains'] = $domains;
            }

            //Add ExcludeDomains if provided
            if (!is_null($exclude_domains)) {
                $payload['excludeDomains'] = $exclude_domains;
            }

            //Add From if provided
            if (!is_null($from)) {
                if (strlen($from) < 10) {
                    throw new NewsApiException('from argument must be YYYY-MM-DD format');
                } else {
                    $payload['from'] = $from;
                }
            }

            //Add To if provided
            if (!is_null($to)) {
                if (strlen($to) < 10) {
                    throw new NewsApiException('to argument must be YYYY-MM-DD format');
                } else {
                    $payload['to'] = $to;
                }
            }

            //Add Language if provided
            if (!is_null($language)) {
                if (Helpers::isLanguageValid($language)) {
                    $payload['language'] = $language;
                } else {
                    throw new NewsApiException("Invalid Language Identifier Provided ");
                }
            }

            //Add SortBy if provided
            if (!is_null($sort_by)) {
                if (Helpers::isSortByValid($sort_by)) {
                    $payload['sortBy'] = $sort_by;
                } else {
                    throw new NewsApiException("Invalid SortBy Identifier Provided ");
                }
            }

            if (!is_null($page_size)) {
                if ($page_size >= 1 && $page_size <= 100) {
                    $payload['pageSize'] = $page_size;
                } else {
                    throw new NewsApiException("Invalid Page_size Value Provided");
                }
            }

            if (!is_null($page)) {
                $payload['page'] = $page;
            }

            //Make Request
            $url = Helpers::everythingUrl();
            try {

                $response = Http::withHeaders($this->request_header)->get($url, $payload);

                if ($response->status() == 200) {
                    return $response->collect();
                } else {
                    $response_body = $response->collect();
                    throw new NewsApiException($response_body['message']);
                }
            } catch (Exception $e) {
                throw new NewsApiException($e);
            }

        }

        /**
         * @param string|null $category
         * @param string|null $language
         * @param string $country
         * @return Collection
         * @throws NewsApiException
         */
        public function getSources(string $category = null, string $language = null, string $country = 'us'): \Illuminate\Support\Collection
        {
            //Get News Sources

            $payload = [];

            //Add category if provided
            if (!is_null($category)) {
                if (Helpers::isCategoryValid($category)) {
                    $payload['category'] = $category;
                } else {
                    throw new NewsApiException("Invalid Category Identifier Provided");
                }
            }

            //Add Language if provided
            if (!is_null($language)) {
                if (Helpers::isLanguageValid($language)) {
                    $payload['language'] = $language;
                } else {
                    throw new NewsApiException("Invalid Language Identifier Provided ");
                }
            }

            //Add country if provided
            if (!is_null($country)) {
                if (Helpers::isCountryValid($country)) {
                    $payload['country'] = $country;
                } else {
                    throw new NewsApiException("Invalid Country Identifier Provided");
                }
            }

            //Make Request
            $url = Helpers::sourcesUrl();
            try {

                $response = Http::withHeaders($this->request_header)->get($url, $payload);
                if ($response->status() == 200) {
                    return $response->collect();
                } else {
                    $response_body = $response->collect();
                    throw new NewsApiException($response_body['message']);
                }
            } catch (Exception $e) {
                throw new NewsApiException($e->getMessage());

            }

        }

        public function getCountries(): ?array
        {
            return Helpers::__get__('countries');
        }

        public function getLanguages(): ?array
        {
            return Helpers::__get__('languages');
        }

        public function getCategories(): ?array
        {
            return Helpers::__get__('categories');
        }

        public function getSortBy(): ?array
        {
            return Helpers::__get__('sort');
        }


    }
