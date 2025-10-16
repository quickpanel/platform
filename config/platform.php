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
    'administrator_layout' => 'platform::layouts.administrator',
    'user_layout' => 'platform::layouts.user',
    'front_layout' => 'platform::layouts.front',
    'app_layout' => 'platform::layouts.app',
    'auth_layout' => 'platform::layouts.auth',
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
