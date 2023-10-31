<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'SIWGCST',
    'title_prefix' => 'SOUTH TREKS |',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false, // No limitar a archivos .ico
    'use_full_favicon' => false, // No limitar a la versión completa del favicon
    'favicon' => 'img/favicon.png', // Ruta al archivo PNG de tu favicon


    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>SouthTreks</b>',
    'logo_img' => 'img/logo.png', //logo de la agencia
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'img' => [
            'path' => 'img/logo.png',
            'alt' => 'Custom Logo',
            'effect' => 'animation__shake',
            'width' => 160,
            'height' => 100,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => true, //usando fot en usuario a)
    'usermenu_desc' => true, //usando foto en usurario a)
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => true,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],

        [
            'text'        => 'Usuarios',
            'url'         => 'usuarios',
            'icon'        => 'fas fa-user',
            'style'        => 'fa-primary-color: #188c1f; --fa-secondary-color: #188c1f', //iconos del usuario
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'usuarios.index',

        ],


        ['header' => 'ACCESO'], //area de ventanas 
        [
            'text'        => 'Calendario',
            'url'         => 'calendarios',
            'icon'        => 'fas fa-calendar-check', //iconos del calendario
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'calendarios.index',
        ],

        [
            'text'        => 'Reserva',
            'url'         => 'reservas',
            'icon'        => 'fas fa-book', //reserva
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'reservas.index',
        ],

        [
            'text'        => 'Recibo',
            'url'         => 'recibos',
            'icon'        => 'fas fa-wallet', //iconos de Recibo
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'recibos.index',
        ],





        [
            'text'        => 'Alimentacion',
            'url'         => 'alimentos',
            'icon'        => 'fas fa-utensils',
            'style'       => 'fa-primary-color: #188c1f;', //iconos del Alimentacion
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'alimentos.index',
        ],

        [
            'text'        => 'Producto',
            'url'         => 'productos',
            'icon'        => 'fas fa-hotdog', //iconos del producto
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'productos.index',

        ],

        [
            'text'        => 'Lista de alimentos',
            'url'         => 'lisalis',
            'icon'        => ' fas fa-list-ul', //iconos del producto
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'lisalis.index',
        ],

        [
            'text'        => 'Transporte',
            'url'         => 'transportes',
            'icon'        => 'fas fa-bus', //iconos del Transporte
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            // 'can' =>   'administrador.transporte',//omostrando solo alos que tienenel permiso
            'can' => 'transportes.index',
        ],

        [
            'text'        => 'Destino',
            'url'         => 'destinos',
            'icon'        => 'fas fa-map-signs', //iconos del destino
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            // 'can' => 'administrador.destino',
            'can' => 'destinos.index',
        ],

        [
            'text'        => 'Hospedaje',
            'url'         => 'hospedajes',
            'icon'        => 'fas fa-hotel', //iconos del hospedaje
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'hospedajes.index',
        ],

        [
            'text'        => 'Incluye',
            'url'         => 'obs_includes',
            'icon'        => 'fas fa-plus-square', //iconos del include
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'obs_includes.index',
        ],

        [
            'text'        => 'No incluye',
            'url'         => 'obs_noincludes',
            'icon'        => 'fas fa-minus-square', //iconos del no include
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'obs_noincludes.index',
        ],

        [
            'text'        => 'Fotos del tour',
            'url'         => 'foto_tours',
            'icon'        => 'fas fa-images', //iconos del no include
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'foto_tours.index',
        ],

        [
            'text'        => 'Tour',
            'url'         => 'tours',
            'text'        => 'Tour',
            'icon'        => 'fas fa-map-marker-alt', //iconos de Tour
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'tours.index',
        ],

        [
            'text'        => 'Cliente',
            'url'         => 'clientes',
            'icon'        => 'fas fa-user-circle', //iconos del clientes
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'clientes.index',
        ],



        [
            'text'        => 'Estadistica',
            'url'         => 'estadisticas',
            'icon'        => 'fas fa-chart-bar', //iconos del Estadistica
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'estadisticas.index',
        ],

        [
            'text'        => 'Nivel jerarquico',
            'url'         => 'n_jerarquicos',
            'icon'        => 'fas fa-level-up-alt', //iconos del Estadistica
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'n_jerarquicos.index',
        ],

        [
            'text'        => 'Area',
            'url'         => 'areas',
            'icon'        => 'fas fa-square', //iconos del Estadistica
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'areas.index',
        ],

        [
            'text'        => 'Cargo',
            'url'         => 'cargos',
            'icon'        => 'far fa-address-card', //iconos del cargo
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'cargos.index',
        ],

        [
            'text'        => 'Empleado',
            'url'         => 'empleados',
            'icon'        => 'fas fa-users', //iconos del Personal
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'empleados.index',
        ],

        [
            'text'        => 'Descuento',
            'url'         => 'descuentos',
            'icon'        => 'fas fa-tag', //descuento
            'style'       => 'color: #188c1f;',
            //'label'       => 4,
            'label_color' => 'success',
            'can' => 'descuentos.index',
        ],



    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [ //son como buscadores
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
        'Chartjs' => [ //esto es para graficos
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [ //son los mensajes
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
