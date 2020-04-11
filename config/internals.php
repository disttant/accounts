<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nodes API Internal URI
    |--------------------------------------------------------------------------
    |
    | This value determines the internal URI path where the Nodes server is running
    |
    */
    'nodes_api_uri' => env('NODES_API_URI', 'https://api.server'),



    /*
    |--------------------------------------------------------------------------
    | Results per page
    |--------------------------------------------------------------------------
    |
    | This value determines how much results per page when using a paginator
    |
    */
    'results_per_page' => env('RESULTS_PER_PAGE', 10),



];