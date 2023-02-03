<?php

    namespace App\Http\Traits;

    use Carbon\Carbon;

    trait NewsTrait
    {


        public function format($data, $source): array
        {

            $res = [];

            if ($source == 'nyTimes') {

                foreach ($data['response']['docs'] as $datum) {
                    $image = '';

                    if (isset($datum['multimedia'][0])){
                        $image = "https://www.nytimes.com/" . $datum['multimedia'][0]['url'];
                    }


                    $res[] = ['title' => $datum['abstract'], 'web_url' => $datum['web_url'], 'content' => $datum['lead_paragraph'], 'source' => $datum['source'],
                        'image' => $image,
                        'date'=> Carbon::create($datum['pub_date'])->format('Y-m-d H:i:s'),'author'=>'New york times'
                    ];
                }
            } elseif ($source == 'newsOrg') {

                foreach ($data['articles'] as $datum) {
                    $res[] = ['title' => $datum['title'], 'web_url' => $datum['url'], 'content' => $datum['description'], 'source' => $datum['source']['name'],
                        'image' => $datum['urlToImage'],'date'=> Carbon::create($datum['publishedAt'])->format('Y-m-d H:i:s'),'author'=>$datum['author']
                    ];
                }

            } elseif ($source == 'theGuardian') {


                foreach ($data['response']['results'] as $datum) {

                    $image = '';
                    if (isset($datum['multimedia'][0])){
                        $image = $datum['fields']['thumbnail'];
                    }

                    $res[] = ['title' => $datum['webTitle'], 'web_url' => $datum['webUrl'], 'content' => $datum['fields']['bodyText'], 'source' => $source,
                        'image' => $image,'date'=> Carbon::create($datum['webPublicationDate'])->format('Y-m-d H:i:s'),'author'=>'The Guardian'

                    ];
                }
            }


            return $res;
        }

    }
