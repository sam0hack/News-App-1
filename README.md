# News App


This app is build with Laravel and React and fetch news from new.org , new York times and the Guardian. 


# Usage

To get started, make sure you have [Docker installed](https://docs.docker.com/) on your system, and then clone this repository.

Next, navigate in your terminal to the directory of this repo, and spin up the containers by running `docker-compose up -d --build app`.


You can change the port and other configration inside **docker-compose.yml** file.

**Please rename the `.env.example` to `.env` and set the API keys for news-api's**

in the project root Run `cp src/.env.example src/.env`


`NYTIMES_KEY=`
`NYTIMES_SECRET=`
`GUARDIAN_KEY=`
`NEWSORG_KEY=`

Run `chmod +x docker.sh`

Run `./docker.sh` to install the dependencies and migrations.

Run `docker compose up` OR `docker compose up -d` to run in background.

## Postman API
Import `News-App.postman_collection.json` into your postman.

## News API

 1. News.org - https://newsapi.org/
 2. New York times - https://developer.nytimes.com/
 3. The Guardian - https://developer.nytimes.com/

 ****




## Features

```markdown
- [x] Login
- [x] Registration
- [x] Home - lastest feed
- [x] For You - custom feed
- [x] create preference for custom feed
- [x] latest news
- [x] Implemented 3 different news API
- [x] Change Password
- [x] search - keyword
- [x] search filter (source,category,from-date,to-date,author)
```

## Why Two Projects

This can be done with laravel + react in one project or better with laravel + react + Inertia.js.
The Separation can allow us to deploy on different servers Also it was in the Project requirement/guidelines


## Todo
Add docker-compose.prod.yml and  docker-compose.dev.yml So it will easier to test develop and deploy on prod server.

Add scroll Pagination with news-api's.

Add singleton instance of redis cache to controll the cache and make api request faster.

Make more attractive UI.
