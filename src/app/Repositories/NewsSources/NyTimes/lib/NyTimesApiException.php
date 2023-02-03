<?php

	namespace App\Repositories\NewsSources\NyTimes\lib;

	class NyTimesApiException extends \Exception
	{

        public function errorMessage(): string
        {
            //error message
            return "{$this->getMessage()} on line {$this->getLine()} in file {$this->getFile()}";
        }

	}
