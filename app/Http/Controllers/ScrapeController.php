<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Goutte\Client;



class ScrapeController extends Controller
{



    public function get_data(Request $request)
    {
        // $client = new Client();
        //  $page = $client->request('GET', 'https://shopee.co.id/api/v4/search/search_items?by=relevancy&keyword=ssd&limit=20&newest=0&order=desc&page_type=search&scenario=PAGE_GLOBAL_SEARCH&version=2');
        // echo "<pre>";
        // // // print_r($page);

        // // // $total = $page->filter("._2o2XQg")->text();

        // $page = $client->request('GET', 'https://shopee.co.id/search?keyword=ssd');

        // $page->filter(".item-card-list__item-card-wrapper a")->each(function ($item) {
        //     echo $item->text() . '<br/>';
        // });


        // $crawler = $client->request('GET', 'https://www.symfony.com/blog/');
        // $client = new Client(HttpClient::create(['timeout' => 60]));
        // $link = $crawler->selectLink('Security Advisories')->link();
        // $crawler = $client->click($link);


        // $crawler->filter('h2 > a')->each(function ($node) {
        //     print $node->text() . "<br>";
        // });


        $name = [];

        if ($request->has('keyword')) {
            $keyword = $request->keyword;

            if ($request->keyword == null) {
                return redirect('/');
            }
            $product = Http::get('https://shopee.co.id/api/v4/search/search_items?by=relevancy&keyword=' . $keyword . '&limit=20&newest=0&order=desc&page_type=search&scenario=PAGE_GLOBAL_SEARCH&version=2')['items'];
            foreach ($product as $item) {
                $name[] = $item['item_basic'];
            }

            if (!$request->has('store')) {

                foreach ($product as $item) {
                    $product = new Product;
                    $product->Title = $item['item_basic']['name'];
                    $product->Product_URL = 'https://shopee.co.id/api/v2/item/get?itemid=' . $item['item_basic']['itemid'] . '&shopid=' . $item['item_basic']['shopid'];
                    $product->State = $item['item_basic']['shop_location'];
                    $product->Stock = $item['item_basic']['stock'];
                    $product->Price = $item['item_basic']['price'];
                    $product->save();
                }
            }
        } else {
            $keyword = 'ssd';
            $product = Http::get('https://shopee.co.id/api/v4/search/search_items?by=relevancy&keyword=' . $keyword . '&limit=20&newest=0&order=desc&page_type=search&scenario=PAGE_GLOBAL_SEARCH&version=2')['items'];



            foreach ($product as $item) {
                $name[] = $item['item_basic'];
            }
        }




        // $this->store();

        return view('result', compact(['name']));
    }

    public function store()
    {


        // foreach ($product as $item) {
        //     $product = new Product;
        //     $product->Title = $item['item_basic']['name'];
        //     $product->Product_URL = 'https://shopee.co.id/api/v2/item/get?itemid=' . $item['item_basic']['itemid'] . '&shopid=' . $item['item_basic']['shopid'];
        //     $product->State = $item['item_basic']['shop_location'];
        //     $product->Stock = $item['item_basic']['stock'];
        //     $product->Price = $item['item_basic']['price'];
        //     $product->save();
        // }

        // return $product;
    }
}