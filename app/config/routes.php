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


  PATH . "/cart" => [
    'controller' => 'cart',
    'action' => 'index'
  ],
  PATH . "/admin" => [
    'controller' => 'admin',
    'action' => 'index'
  ],
  PATH . "/admin/users" => [
    'controller' => 'admin',
    'action' => 'users'
  ],
  PATH . "/admin/products" => [
    'controller' => 'admin',
    'action' => 'products'
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
  ],

  PATH . "addToCart" => [
    'controller' => 'main',
    'action' => 'addToCartHandler'
  ],


];