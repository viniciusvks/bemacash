<?php

return [

    'token' => [
        'created' => 'Token gerado com sucesso',
        'destroyed' => 'Token invalidado com sucesso',
        'invalidCredentials' => 'As credenciais informadas não são validas',
        'manyAttempts' => 'Foram realizadas muitas tentativas incorretas. Tente novamente em :seconds segundos',
        'notProvided' => 'Token não fornecido',
        'invalid' => 'Token fornecido é invalido',
        'expired' => 'Token fornecido está expirado',
        'refreshed' => 'Token atualizado com sucesso',
        'blacklisted' => 'Token atualizado foi colocado na lista negra',
    ],

    'order' => [

        'list' => 'Pedidos listados com sucesso',
        'show' => 'Detalhes do pedido retornado com sucesso',
        'not_found' => 'Pedido não encontrado'

    ],

    'request' => [

    ],

    'error' => [
        'unexpected' => 'Um erro inesperado ocorreu. Por favor entre em contato com o administrador do sistema',
        'http' => [
            'notFound' => 'A rota que você está procurando aparentemente não existe!!',
            'methodNotAllowed' => 'Esta rota não pode ser accessada utilizando este método Http',
        ]
    ],

    'access' => [
        'denied' => 'Este Usuário não tem permiss�o para acessar este recurso'
    ]

];
