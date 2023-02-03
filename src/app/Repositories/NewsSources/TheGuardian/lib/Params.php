<?php

	namespace App\Repositories\NewsSources\TheGuardian\lib;

    class Params {
        //Filters
        private array $param;

        public function get($param): static
        {
            $this->param = array_merge($param, $this->param);
            return $this;
        }

        public function section ($section): static
        {
            $this->param['section'] = $section;
            return $this;
        }

        public function search ($search): static
        {
            $this->param['q'] = $search;
            return $this;
        }

        public function format ($format): static
        {
            $this->param['format'] = $format;
            return $this;
        }

        public function call_back ($call_back): static
        {
            $this->param['callback'] = $call_back;
            return $this;
        }

        public function query_fields ($query_fields): static
        {
            $this->param['query-fields'] = $query_fields;
            return $this;
        }

        public function reference ($reference): static
        {
            $this->param['reference'] = $reference;
            return $this;
        }

        public function reference_type ($reference_type): static
        {
            $this->param['reference-type'] = $reference_type;
            return $this;
        }

        public function tags ($tags): static
        {
            $this->param['tags'] = $tags;
            return $this;
        }

        public function rights ($rights): static
        {
            $this->param['rights'] = $rights;
            return $this;
        }

        public function ids ($ids): static
        {
            $this->param['ids'] = $ids;
            return $this;
        }

        public function production_office ($production_office): static
        {
            $this->param['production-office'] = $production_office;
            return $this;
        }

        public function lang ($lang): static
        {
            $this->param['lang'] = $lang;
            return $this;
        }

        public function star_rating ($star_rating): static
        {
            $this->param['star-rating'] = $star_rating;
            return $this;
        }

        //Dates
        public function from_date ($from_date): static
        {
            $this->param['from-date'] = $from_date;
            return $this;
        }

        public function to_date ($to_date): static
        {
            $this->param['to-date'] = $to_date;
            return $this;
        }

        public function use_date ($use_date): static
        {
            $this->param['use-date'] = $use_date;
            return $this;
        }

        //Pages
        public function page ($page): static
        {
            $this->param['page'] = $page;
            return $this;
        }

        public function page_size ($page_size): static
        {
            $this->param['page-size'] = $page_size;
            return $this;
        }

        //Ordering
        public function order_by ($order_by): static
        {
            $this->param['order-by'] = $order_by;
            return $this;
        }

        public function order_date ($order_date): static
        {
            $this->param['order-date'] = $order_date;
            return $this;
        }

        //Show Fields
        public function show_fields ($show_fields): static
        {
            $this->param['show-fields'] = $show_fields;
            return $this;
        }

        //Show Tags
        public function show_tags ($show_tags): static
        {
            $this->param['show-tags'] = $show_tags;
            return $this;
        }

        //Show Section
        public function show_section ($show_section): static
        {
            $this->param['show-section'] = $show_section;
            return $this;
        }

        //Show Blocks
        public function show_blocks ($show_blocks): static
        {
            $this->param['show-blocks'] = $show_blocks;
            return $this;
        }

        //Show Elements
        public function show_elements ($show_elements): static
        {
            $this->param['show-elements'] = $show_elements;
            return $this;
        }

        //Show references
        public function show_references ($show_references): static
        {
            $this->param['show-references'] = $show_references;
            return $this;
        }

        //Show Rights
        public function show_rights ($show_rights): static
        {
            $this->param['show-rights'] = $show_rights;
            return $this;
        }

        //Others
        public function web_title ($web_title): static
        {
            $this->param['web-title'] = $web_title;
            return $this;
        }
    }
