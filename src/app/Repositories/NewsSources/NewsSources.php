<?php

	namespace App\Repositories\NewsSources;

	use App\Repositories\NewsSources\NewsOrg\NewsOrgRepository;
    use App\Repositories\NewsSources\NyTimes\NyTimesRepository;
    use App\Repositories\NewsSources\TheGuardian\TheGuardianRepository;


    class NewsSources
	{

        /**
         * @param string $source
         * @return NewsSourcesInterface
         */
        public function getNews(string $source): NewsSourcesInterface{

            return match ($source){
                'nyTimes' => new NyTimesRepository(),
                'newsOrg'=> new  NewsOrgRepository(),
                'theGuardian'=> new TheGuardianRepository(),
                default => throw new \Error('Please provide valid news source')
            };

        }

    }
