<?php

	namespace App\Repositories\NewsSources\NewsOrg\lib;

	class NewsApiException extends \Exception
	{

        /**
         * @return string
         */
        public function errorMessage(): string
        {
            //error message
            return "{$this->getMessage()} on line {$this->getLine()} in file {$this->getFile()}";
        }

	}
