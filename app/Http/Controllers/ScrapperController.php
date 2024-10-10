<?php

namespace App\Http\Controllers;

use App\Models\Stocks;
use App\Models\StocksSymbols;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class ScrapperController extends Controller
{
    public function scrape()
    {
        set_time_limit(120);
        
        $url = 'https://www.psx.com.pk/market-summary/';
        $client = new Client();

        $response = $client->request('GET', $url);
        $html = $response->getBody()->getContents();

        $crawler = new Crawler($html);

        $greenRows = $crawler->filter('tr.green-text-td');
        $redRows = $crawler->filter('tr.red-text-td');

        $stocksData = [];

        $stocksData = array_merge($stocksData, $this->extractDataFromRows($greenRows));
        $stocksData = array_merge($stocksData, $this->extractDataFromRows($redRows));

        foreach ($stocksData as $stock) {
            Stocks::where('name', $stock['name'])
            ->update(['currentValue' => $stock['value']]);
        }
    }

    public function extractDataFromRows($rows)
    {
        $data = [];

        $rows->each(function (Crawler $row) use (&$data) {
            $data[] = [
                'name' => $row->filter('td.dataportal')->text(),
                'value' => $row->filter('td:nth-child(5)')->text(),
            ];
        });

        return $data;
    }

    public function setupStocks()
    {
        $file = public_path('stocks/stocks.csv');
        $csvData = array_map('str_getcsv', file($file));

        foreach ($csvData as $data) {
            Stocks::create([
                'symbol' => $data[0],
                'name' => $data[1]
            ]);
        }
    }
}
