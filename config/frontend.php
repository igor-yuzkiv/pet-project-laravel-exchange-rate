<?php
return [

    /*Title*/
    "title_prefix" => "",
    "title_postfix" => "| Exchange-Rate",

    "home_url" => "/",
    "home_route" => "frontend.home",

    /**
     * Social links
     */
    "social_links" => [
        "facebook" => [
            "title" => "Facebook",
            "icon" => "fa fa-facebook",
            "url" => "https://www.facebook.com/igor.yuzkiv.98"
        ],
        "twitter" => [
            "title" => "Twitter",
            "icon" => "fa fa-twitter",
            "url" => "https://twitter.com/"
        ],
        "linkedin" => [
            "title" => "LinkedIn",
            "icon" => "fa fa-linkedin",
            "url" => "https://www.linkedin.com/"
        ],
        "instagram" => [
            "title" => "Instagram",
            "icon" => "fa fa-instagram",
            "url" => "https://www.instagram.com/i.yuzkiv/"
        ],
        "github" => [
            "title" => "GitHub",
            "icon" => "fa fa-github",
            "url" => "https://github.com/igor-yuzkiv"
        ],
        "telegram" => [
            "title" => "Telegram",
            "icon" => "fa fa-telegram",
            "url" => "#"
        ],
    ],

    "email" => "igor97w@gmail.com",

    /**
     * Plugins
     *
     * Like in Laravel AdminLte
     */
    "plugins" => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/datatables/js/jquery.dataTables.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/datatables/js/dataTables.bootstrap4.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/datatables-plugins/responsive/js/dataTables.responsive.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/datatables-plugins/responsive/js/responsive.bootstrap4.js',
                ],

                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/vendor/datatables-plugins/responsive/css/responsive.bootstrap4.css',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/vendor/datatables/css/dataTables.bootstrap4.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        "daterangepicker" => [
            'name' => 'daterangepicker',
            'active' => false,
            'files' => [
                [
                    'type' => "js",
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js',
                ],
                [
                    'type' => "js",
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/trianglify/0.2.1/trianglify.min.js',
                ],
                [
                    'type' => "js",
                    'asset' => false,
                    'location' => '/vendor/daterangepicker/daterangepicker.js',
                ],
                [
                    'type' => "css",
                    'asset' => false,
                    'location' => '/vendor/daterangepicker/daterangepicker.css',
                ],
            ],
        ],

        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],

        "jquery-confirm" => [
            "name" => "jquery-confirm",
            'active' => false,
            'files' => [
                [
                    'type' => "js",
                    'asset' => false,
                    'location' => '/vendor/jquery-confirm/js/jquery-confirm.js',
                ],
                [
                    'type' => "css",
                    'asset' => false,
                    'location' => '/vendor/jquery-confirm/css/jquery-confirm.css',
                ],
            ]
        ],
        "LaravelWebpackMix" => [
            'name' => "LaravelWebpackMix",
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/js/app.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/css/app.css',
                ],
            ],
        ],
        "daterangepicker" => [
            'name' => 'daterangepicker',
            'active' => false,
            'files' => [
                [
                    'type' => "js",
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js',
                ],
                [
                    'type' => "js",
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/trianglify/0.2.1/trianglify.min.js',
                ],
                [
                    'type' => "js",
                    'asset' => false,
                    'location' => '/vendor/daterangepicker/daterangepicker.js',
                ],
                [
                    'type' => "css",
                    'asset' => false,
                    'location' => '/vendor/daterangepicker/daterangepicker.css',
                ],
            ],
        ],

    ],

    /**
     * Menu
     */
    "menu" => [
        [
            "translate" => "frontend.menu.exchange_rate.home",
            "route" => "frontend.home",
            "icon" => "fa fa-home",
        ],
        [
            "translate" => "frontend.menu.exchange_rate.index",
            "route" => "frontend.exchange-rate.index",
            "icon" => "fa fa-chart"
        ]
    ],

    "inner_banner" => [
        "show" => true,
        "breadcrumb" => false,
    ],

    "base_currency_code" => [
        "USD",
        "EUR",
        "PLZ",
        "GBP",
    ]

];
