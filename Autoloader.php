<?php

namespace Core;

final class Autoloader
{
    private array $prefixes = [];
    public function register(): void
    {
        spl_autoload_register([$this, 'loadClass']);
    }
    public function addNamespace(string $prefix, string $baseDir): void
    {
        $prefix = trim($prefix, '\\') . '\\';
        print_r($baseDir);
        $baseDir = rtrim($baseDir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
        $this->prefixes[$prefix] = $baseDir;
        print_r($this->prefixes);
    }

    public function loadClass(string $class): bool
    {
        foreach ($this->prefixes as $prefix => $baseDir) {
            //необходимо отрезать префикс от полного имени класса
            if(str_starts_with($class, $prefix)) {
                $className = substr($class, strlen($prefix));
                $file = $baseDir.str_replace('\\', DIRECTORY_SEPARATOR, $className).'.php';
                echo $file;

                if($this->requireFile($file)){
                    return true;
                }
            }
        }
        return false;
    }
    private function requireFile(string $file): bool
    {
        if(is_file($file)){
            require_once $file;
            return true;
        }
        return false;
    }
}