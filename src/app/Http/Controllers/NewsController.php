<?php

    namespace App\Http\Controllers;


    use App\Http\Traits\NewsTrait;
    use App\Models\NewsCategories;
    use App\Repositories\NewsSources\NewsOrg\lib\NewsApiException;
    use App\Repositories\NewsSources\NewsSources;
    use Carbon\Carbon;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\Routing\ResponseFactory;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;


    class NewsController extends Controller
    {

        use NewsTrait;

        private \App\Repositories\NewsSources\NewsSourcesInterface $nyTimes;
        private \App\Repositories\NewsSources\NewsSourcesInterface $newsOrg;
        private \App\Repositories\NewsSources\NewsSourcesInterface $theGuardian;

        public function __construct(NewsSources $newsSource)
        {
            $this->nyTimes = $newsSource->getNews('nyTimes');
            $this->newsOrg = $newsSource->getNews('newsOrg');
            $this->theGuardian = $newsSource->getNews('theGuardian');
        }

        /**
         * @param Request $request
         * @return Response|Application|ResponseFactory
         */
        public function getArticles(Request $request): Response|Application|ResponseFactory
        {
            $source = $request->input('source');

            return match ($source) {
                'newsOrg' => response($this->format($this->newsOrg->get(), $source), 200),

                'nyTimes' => response($this->format($this->nyTimes->get(), $source), 200),

                'theGuardian' => response($this->format($this->theGuardian->get(), $source), 200),

                default => response('Please provide valid source name!', 403),
            };

        }

        /**
         * Return a list of sources
         * @param Request $request
         * @return Response|Application|ResponseFactory
         */
        public function getSources(Request $request): Response|Application|ResponseFactory
        {

            return response($this->newsOrg->getSources(), 200);

//            $sources = $request->input('source');
//
//            return match ($sources) {
//                'newsOrg' => response($this->newsOrg->getSources(), 200),
//                'nyTimes' => response($this->nyTimes->getSources(), 200),
//                default => response('Please provide valid source name!', 403)
//            };


        }

        public function search(Request $request)
        {

            $keywords = !empty($request->input('keywords')) ? $request->input('keywords') : null;
            $sources = !empty($request->input('source')) ? $request->input('source') : null;
            $category = !empty($request->input('category')) ? $request->input('category') : null;
            $author = !empty($request->input('author')) ? $request->input('author') : null;
            $from = !empty($request->input('from_date')) ? $request->input('from_date') : null;
            $to = !empty($request->input('to_date')) ? $request->input('to_date') : null;

            $from = !is_null($from) ? Carbon::create($from)->format('Y-m-d') : null;
            $to = !is_null($to) ? Carbon::create($to)->format('Y-m-d') : null;

            $newsOrg = [];
            $nyTimes = [];
            $theGuardian = [];


            try {
                //News Org {parametersIncompatible} Can't use category with sources and country
                if (!empty($category) and empty($sources)) {
                    $newsOrg = $this->format($newsOrg = $this->newsOrg->getTopHeadlines($keywords, $sources, 'us', $category, $author, null, null), 'newsOrg');
                } else {
                    $newsOrg = $this->format($this->newsOrg->get($keywords, $from, $to, $sources, $author), 'newsOrg');
                }
            } catch (NewsApiException) {
                //
            }

            $theGuardian = $this->format($this->theGuardian->get($keywords, $from, $to), 'theGuardian');

            $nyTimes = $this->format($this->nyTimes->get($keywords, $from, $to), 'nyTimes');

            $res = array_merge([...$newsOrg, ...$theGuardian, ...$nyTimes]);


            return response($res, 200);

        }

        public function getTopHeadLines(Request $request): Response|Application|ResponseFactory
        {

            $sources = $request->input('source');

            return match ($sources) {
                'newsOrg' => response($this->format($this->newsOrg->getTopHeadlines(), $sources), 200),
                'nyTimes' => response($this->format($this->nyTimes->getTopHeadlines(), $sources), 200),
                'theGuardian' => response($this->format($this->theGuardian->getTopHeadlines(), $sources), 200),
                default => response('Please provide valid source name!', 403)
            };

        }


        public function getCategories()
        {
            $categories = NewsCategories::get();
            return response($categories, 200);
        }

    }
