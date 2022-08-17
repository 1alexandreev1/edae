<?php

return [
    'permissions_map' => [
        'r' => 'read', //видит админку
        'c' => 'create', //может добавлять
        'e' => 'edit', //может обновлять
        'd' => 'delete', //может удалять
        'a' => 'additional', //для доп функций - комментарии, лайки и тп
        'p' => 'panel' //admin panel
    ],
    'permissions' => [
        'admin' => 'p',
        'news' => 'r,c,e,a,d',
        'recipes' => 'r,c,e,a,d',
        'users' => 'r,c,e,a,d',
        'settings' => 'r,c,e,a,d',
        'categories' => 'r,c,e,a,d',
    ],
    'roles' => [
        'admin' => 'all',
        'moderator' => [
            'categories' => 'r,c,e,a,p',
            'news' => 'r,c,e,a,p',
            'recipes' => 'r,c,e,a,p',
            'users' => 'r,e,a,p',
        ],
        'redactor' => [
            'categories' => 'r,c,e,a,p',
            'news' => 'r,c,e,a,p',
            'recipes' => 'r,c,e,a,p',
            'users' => 'e,a',
        ],
        'user' => [
            'users' => 'e,a',
        ],
        'ban' => [],

        // 'manager_salary' => [
        //     'customers' => 'r,e,d',
        //     'contact_people' => 'r,e,d',
        //     'task' => 'r,e,d',
        //     'sales_funnels' => 'r,e,d',
        // ],

    ],
    'display_name_roles' => [
        'admin' => 'Администратор',
        'moderator' => 'Модератор',
        'redactor' => 'Редактор',
        'user' => 'Пользователь',
        'ban' => 'Заблокированный',
    ],
];
