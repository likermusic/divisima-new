<?
return [
  PATH . "/" => [
    'controller' => 'main',
    'action' => 'index'
  ],

  PATH . "/search" => [
    'controller' => 'search',
    'action' => 'index'
  ],

  PATH . "/signup" => [
    'controller' => 'signup',
    'action' => 'index'
  ],

  PATH . "/signin" => [
    'controller' => 'signin',
    'action' => 'index'
  ],

  // Fetch routes
  PATH . "categoryProductsHandler" => [
    'controller' => 'main',
    'action' => 'categoryProductsHandler'
  ],

  PATH . "addToFavourites" => [
    'controller' => 'main',
    'action' => 'addToFavouritesHandler'
  ],

  PATH . "deleteFromFavourites" => [
    'controller' => 'main',
    'action' => 'deleteFromFavouritesHandler'
  ]


];