<?php

class Autoloader
{
    private $baseDirectory;

    /**
     * @param string $baseDirectory
     * @return Autoloader
     */
    public static function from($baseDirectory)
    {
        $baseDirectory = rtrim($baseDirectory, '/') . '/';
        return new self($baseDirectory);
    }

    private function __construct($baseDirectory)
    {
        $this->baseDirectory = $baseDirectory;
    }

    public function __invoke($className)
    {
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        if ($lastNsPos = strripos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        $path = $this->baseDirectory . $fileName;
        if (file_exists($path)) {
            require_once $path;
            return true;
        }
        return false;
    }

    public function register()
    {
        spl_autoload_register($this);
    }
}

