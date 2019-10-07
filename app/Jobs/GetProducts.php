<?php

namespace App\Jobs;

use App\Product;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Symfony\Component\DomCrawler\Crawler;

class GetProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $page;
    protected $url_base;


    public function __construct($url,$page)
    {
        $this->page = $page;
        $this->url_base = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $res = '';
        $url = (string)$this->url_base.$this->page;
        if( !$url  ){
            //error url not found or work
           echo 'ERROR","Error URL not found'.$this->url_base.$this->page;
        }
        $errors =  [];
        $client = new Client();
        $response = $client->get($url);
        if( $response->getStatusCode() == 200 ){
            $res = (string)$response->getBody();
        }else  {
            array_push($errors, $response->getReasonPhrase() );
        }
        if( empty($erros) ){
            $arr = [];
            try {

                $crawler = new Crawler($res);
                $next_page = $crawler->filter('div.search-results-footer.row > p > :last-child')->text();
                if( $next_page == 'last' || $next_page =='next'){ //end of pagination...
                    $this->page = $this->page+1;
                }else{
                    $this->page = 0;
                }
                $filter = $crawler->filter('.search-results-product');
                foreach ($filter as $row => $domElement) {
                    $_crawler = new Crawler($domElement);
                    $arr[$row] = array(
                        'title' => $_crawler->filter('div.product-description.col-xs-8.col-sm-8 > div > div.col-xs-12.col-sm-7.col-lg-8 > h4')->text(),
                        'price' => $_crawler->filter('div.product-description.col-xs-8.col-sm-8 > div > div.col-xs-12.col-sm-5.col-lg-4 > div:nth-child(1) > h3')->text(),
                        'url_ori' => $_crawler->filter('div.product-description.col-xs-8.col-sm-8 > div > div.col-xs-12.col-sm-7.col-lg-8 > h4 > a')->attr('href'),
                        'url_img' => $_crawler->filter('picture > source')->eq(0)->attr('data-srcset'),
                        'category' => 'small-appliances'
                    );
                }
            } catch (\Exception $ex) {
                //cath error....
                echo "Parse Error:";
            }
            foreach( $arr as $obj => $row ){
                if( DB::table('products')->where('title', $row['title'])->doesntExist() ){
                    $product = new Product;
                    $product->title = $row['title'];
                    $product->price = $row['price'];
                    $product->url_orig = $row['url_ori'];
                    $product->img_url = $row['url_img'];
                    $product->category = 'category';
                    if( $product->save() ){
                        //If ok save.. add job to get pic async...
                        GetRemotePic::dispatch($product->id);
                    }
                }
            }
            if( $this->page != 0 ) {
                GetProducts::dispatch($this->url_base,$this->page)->delay(now()->addSeconds(10));
            }
        }else{
            //reporting errors.. implement
            $response['Errors'] = $errors;
        }
    }



}
