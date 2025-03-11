<?php
/**
 * Autoloader for PHPMailer
 * 
 * This file serves as a simple autoloader to load the PHPMailer classes
 * when they are required in your application.
 */

// Define the namespaces and their corresponding directories
$namespaces = [
    'PHPMailer\\PHPMailer\\' => __DIR__ . '/vendor/phpmailer/phpmailer/src/'
];

/**
 * PSR-4 compatible autoloader
 * 
 * @param string $class The fully-qualified class name to load
 * @return void
 */
spl_autoload_register(function ($class) use ($namespaces) {
    // Check if the class uses one of our namespaces
    foreach ($namespaces as $namespace => $dir) {
        // Check if the requested class is in this namespace
        if (strpos($class, $namespace) === 0) {
            // Get the relative class name (remove namespace)
            $relative_class = substr($class, strlen($namespace));
            
            // Convert namespace separators to directory separators
            $file = $dir . str_replace('\\', '/', $relative_class) . '.php';
            
            // If the file exists, include it
            if (file_exists($file)) {
                require $file;
                return;
            }
        }
    }
});

// If Composer's autoloader is available, use it too (recommended)
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($composer_autoload)) {
    require_once $composer_autoload;
}
?>