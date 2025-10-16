<?php
return [
    'slide_over_direction' => 'right',
    'sidebar_direction' => 'left',
    'logo_svg_blade' => 'platform::layouts.global.logo',
    'enable_front' => true,
    'enable_auth' => true,
    'enable_admin' => true,
    'enable_user' => true,
    'languages' => [
        'en' => 'English',
        'fa' => 'Persian',
    ],
    'types' => [
        'ticket' => 'Ticket',
        'article' => 'Article',
    ],
    'layouts' => [
        'administrator' => 'platform::layouts.administrator',
        'user' => 'platform::layouts.user',
        'front' => 'platform::layouts.front',
        'app' => 'platform::layouts.app',
        'auth' => 'platform::layouts.auth',
    ],

    'template' =>
    [
        'create-component' => 'src/stubs/components/Create.php',
        'edit-component' => 'src/stubs/components/Edit.php',
        'index-component' => 'src/stubs/components/Index.php',
        'table-component' => 'src/stubs/components/Table.php',

        'create-view' => 'src/stubs/views/create.blade.php',
        'edit-view' => 'src/stubs/views/edit.blade.php',
        'index-view' => 'src/stubs/views/index.blade.php',
        'actions-view' => 'src/stubs/views/actions.blade.php',
    ],
];
