<?php

	namespace App\Repositories\NewsSources\NewsOrg\lib;

	class NewsApiAuth
	{
        /**
         * @var string
         */
        private string $api_key;
        public function __construct($api_key)
        {
            $this->api_key = $api_key;
        }

        public function AuthHeaders(): array
        {
            return array(
                'Accept' => 'application/json',
                'X-Api-Key' => $this->api_key);
        }
	}
