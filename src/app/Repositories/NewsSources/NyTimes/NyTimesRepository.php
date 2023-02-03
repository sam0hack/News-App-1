<?php

    namespace App\Repositories\NewsSources\NyTimes;

    use App\Repositories\NewsSources\NewsSourcesInterface;

    use App\Repositories\NewsSources\NyTimes\lib\NyTimesApi;
    use Illuminate\Support\Collection;

    class NyTimesRepository implements NewsSourcesInterface
    {

        public function get($q='today',$from=null,$to=null): Collection
        {



            $nytimes = new NyTimesApi();
            return $nytimes->getEverything($q,$from,$to);

        }

        public function getSources(): Collection
        {

        }

        public function getTopHeadlines(): Collection
        {
            $nyTimes = new NyTimesApi();
            return $nyTimes->getTopHeadLines();
        }
    }
