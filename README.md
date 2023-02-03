# News App


This app is build with Laravel and React and fetch news from new.org , new York times and the Guardian. 


# Usage

To get started, make sure you have [Docker installed](https://docs.docker.com/docker-for-mac/install/) on your system, and then clone this repository.

Next, navigate in your terminal to the directory you cloned this, and spin up the containers for the web server by running `docker-compose up -d --build app`.




You can change the port and other configration inside **docker-compose.yml** file.

**Please rename the `.env.example` to `.env` and set the API keys for news-api's**

`NYTIMES_KEY=`
`NYTIMES_SECRET=`
`GUARDIAN_KEY=`
`NEWSORG_KEY=`

Run `./docker.sh` to install the dependencies and migrations.



## Postman API
Import `News-App.postman_collection.json` into your postman.

## News API

 1. News.org - https://newsapi.org/
 2. New York times - https://developer.nytimes.com/
 3. The Guardian - https://developer.nytimes.com/


## Containers
This docker stack has 4 containers

| Container | Service |
|--|--|
| `Backend_C` | Laravel |
| `FrontEnd_C` | React |
| `mysql_C` | Mysql DB |
| `redis_C` | Redis Cache |

The `docker-compose.yml` is using env variables and those variables are comming from **Laravel/.env** I'm using one env file so we don't have manage two or more env everytime we add remove something.



 ****




## Features

```markdown
- [x] Login
- [x] Registration
- [x] Home - lastest feed
- [x] For You - custom feed
- [x] create preference for custom feed
- [x] latest news
- [x] Change Password
- [x] search - keyword
- [x] search filter (source,category,from-date,to-date,author)
```

## Todo
Add docker-compose.prod.yml and  docker-compose.dev.yml So it will easier to test develop and deploy on prod server.

Add scroll Pagination with news-api's.

Add singleton instance of redis cache to controll the cache and make api request faster.

Make more attractive UI.
