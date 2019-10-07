<?php

namespace App\Jobs;

use App\Product;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class GetRemotePic implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected  $id_product;
    public function __construct($id)
    {
        //
        $this->id_product = $id;
    }


    public function handle()
    {

        $product = Product::find($this->id_product);
        //if product exist continue
        if( $product !== null ){
            //Create file and open file
            $file_name = Str::slug($this->id_product.'-'.$product->title, '_');
            $file = fopen(base_path('storage/app/public/').$file_name, 'w' ) or die(" can't create");

            try {
                //Create connection and get
                $client = new Client();
                $response = $client->request('get',$product->img_url,['sink' => $file]);
                fclose($file);
                //If copy ok, save in DB
                if($response->getStatusCode()==200){
                    $product->img_url = $file_name;
                    $product->save(); //Save relative url
                }
            } catch (Exception $e) {
                // Log the error or something
                //echo $e->getMessage();
            }
        }
    }
}
