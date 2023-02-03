<?php

	namespace App\Repositories\NewsSources;

	use Illuminate\Support\Collection;

    interface NewsSourcesInterface
	{

        /**
         * Return the List of the latest news from the news source.
         * @return Collection
         */
        public function get(): Collection;

        /**
         * Return the List of news source.
         * @return Collection
         */
        public function getSources(): Collection;

        /**
         * Return the List of the latest news Headlines from the news source.
         * @return Collection
         */
        public function getTopHeadlines(): Collection;



	}
