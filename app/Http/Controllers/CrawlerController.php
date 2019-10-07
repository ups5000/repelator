<?php

namespace App\Http\Controllers;

use App\Jobs\GetProducts;
use App\Jobs\GetRemotePic;
use App\Product;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Str;


class CrawlerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * @var float|int
     */

    protected  $url_base;
    protected $page;

    public function __construct($url_base='https://www.appliancesdelivered.ie/search/dishwashers?page=',$page=1)
    {
        $this->page = $page;
        $this->url_base = $url_base;

    }

    public function index(){

       /* $id=1621;
        $product = Product::find($id);
        $file_name = Str::slug($id.'-'.$product->title, '_');
        $file = fopen(base_path('storage/app/public/').$file_name, 'w' ) or die(" can't create");

        try {
        $client = new Client();
        $response = $client->request('get',$product->img_url,['sink' => $file]);
        fclose($file);

        if($response->getStatusCode()==200){
            $product->img_url = $file_name;
            $product->save(); //Save relative url
        }
        } catch (Exception $e) {
            // Log the error or something
            //echo $e->getMessage();
            return false;
        }*/
    }
/*
    public function makeWebRequest($url, &$errors){
        $client = new Client();
        $response = $client->get($url);
        if( $response->getStatusCode() == 200 ){
            return (string)$response->getBody();
        }else  {
            array_push($errors, $response->getReasonPhrase() );
        }
    }

    public function get_productsByUrl(){

        $url = $this->url_base.$this->page;
        if( !$url  ){
            //error url not found or work
            return response()->json($this->getActionStatus("ERROR","Error URL not found"));
        }
        $errors =  [];
        $res = $this->makeWebRequest( $url, $errors );
        if( empty($erros) ){
            $data_array = $this->filterData($res, '');
            $this->saveData($data_array); //Save data in DB
        }else{
            //reporting errors.. implement
            $response['Errors'] = $errors;
        }

    }

    public function saveData($data){
        //check if it exists or save
            foreach( $data as $arr => $row ){
                if( DB::table('products')->where('title', $row['title'])->doesntExist() ){
                    $product = new Product;
                    $product->title = $row['title'];
                    $product->price = $row['price'];
                    $product->url_orig = $row['url_ori'];
                    $product->img_url = $row['url_img'];
                    $product->category = 'category';
                    $product->save();
                }
            }
    }


    public function checkIFLastPage($crawler)
    {

        $next_page = $crawler->filter('div.search-results-footer.row > p > a:last-child')->text();
        if( $next_page < $this->page ){ //end of pagination...
            $this->page = 1;

        }else{
            $this->page++;
        }
    }

    public function filterData($result, $category)
    {
        $arr = [];
        try {
            $crawler = new Crawler($result);
            $this->checkIFLastPage($crawler);
            //meanwhile $nextpage exists run next page, else if, page =1

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
        }
        return $arr;
    }*/
}
