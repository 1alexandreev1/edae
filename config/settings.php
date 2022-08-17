<?php

return [
    [
        'slug' => 'about',
        'settings' => json_encode([
            'text' => [
                'type' => 'text',
                'value' => 'Тут пока ничего нет, но обязательно скоро будет!'
            ],
        ])
    ], [
        'slug' => 'indexPage',
        'settings' => json_encode([
            'maxPostsInIndexPage' => [
                'type' => 'number',
                'value' => 10
            ],
        ])
    ]
];
