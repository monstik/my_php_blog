<?php
return[
    'admin/add' => [
        'controller' => 'admin',
        'action' => 'add'
    ],
    'admin/edit/{id:\d+}' =>[
        'controller' => 'admin',
        'action' => 'edit'
    ],
    'admin/logout' =>[
        'controller' => 'admin',
        'action' => 'logout'
    ],
    'admin/login' =>[
        'controller' => 'admin',
        'action' => 'login'
    ],
    'admin/posts/{id:\d+}' =>[
        'controller' => 'admin',
        'action' => 'posts'
    ],
    'admin/posts' =>[
        'controller' => 'admin',
        'action' => 'posts'
    ],
    'main/index/{page:\d+}' =>[
        'controller' => 'main',
        'action' => 'index'
    ],
    '' =>[
        'controller' => 'main',
        'action' => 'index'
    ],
    'about' =>[
        'controller' => 'main',
        'action' => 'about'
    ],
    'contact' =>[
        'controller' => 'main',
        'action' => 'contact'
    ],
    'post/{id:\d+}' =>[
        'controller' => 'main',
        'action' => 'post'
    ],
];