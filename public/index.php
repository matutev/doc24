<?php

use Slim\Factory\AppFactory;
use controllers\PersonaController;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->setBasePath("/doc24/public"); 

$app->addRoutingMiddleware();

/**
 * Add Error Middleware
 *
 * @param bool                  $displayErrorDetails -> Should be set to false in production
 * @param bool                  $logErrors -> Parameter is passed to the default ErrorHandler
 * @param bool                  $logErrorDetails -> Display error details in error log
 * @param LoggerInterface|null  $logger -> Optional PSR-3 Logger  
 *
 * Note: This middleware should be added last. It will not handle any exceptions/errors
 * for middleware added after it.
 */
$errorMiddleware = $app->addErrorMiddleware(true, true, true);                      

//ruta para procesar peticion POST
$app->post('/update-persona/{id}/{brand}', PersonaController::class . ':updatePersona');

// Run app
$app->run();