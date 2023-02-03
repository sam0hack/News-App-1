<?php

	namespace App\Repositories\NewsSources\TheGuardian;

	use App\Repositories\NewsSources\NewsSourcesInterface;
    use App\Repositories\NewsSources\TheGuardian\lib\TheGuardian;
    use Carbon\Carbon;
    use Illuminate\Support\Collection;

    class TheGuardianRepository implements NewsSourcesInterface
	{

        /**
         * @inheritDoc
         */
        public function get($q=null,$from=null,$to=null): Collection
        {
            $guardian = new TheGuardian();
            return $guardian->get_articles($q,$from,$to);
        }

        /**
         * @inheritDoc
         */
        public function getSources(): Collection
        {
            $guardian = new TheGuardian();
            return $guardian->get_sections();
        }

        /**
         * @inheritDoc
         */
        public function getTopHeadlines(): Collection
        {
            $guardian = new TheGuardian();
            return $guardian->get_articles('',Carbon::now()->format('Y-m-d'));
        }
    }
