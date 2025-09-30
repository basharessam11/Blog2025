<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],  // حدد المسارات المسموح بها

    'allowed_methods' => ['*'],  // السماح بأي طريقة HTTP

     'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],  // السماح بأي هيدر

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,  // السماح باستخدام الكوكيز

];
