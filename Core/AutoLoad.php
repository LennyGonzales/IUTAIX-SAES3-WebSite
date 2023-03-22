<?php

set_include_path('../');
require 'Core/Constants.php';

final class AutoLoad
{
    public static function loadCoreClasses($S_className)
    {
        $S_file = Constants::coreDirectory() . "$S_className.php";
        return static::_load($S_file);
    }

    public static function loadExceptionClasses($S_className)
    {
        $S_file = Constants::exceptionsDirectory() . "$S_className.php";

        return static::_load($S_file);
    }

    public static function loadDataClasses($S_className)
    {
        $S_file = Constants::dataDirectory() . "$S_className.php";

        return static::_load($S_file);
    }

    public static function loadServiceClasses($S_className)
    {
        $S_file = Constants::serviceDirectory() . "$S_className.php";

        return static::_load($S_file);
    }

    public static function loadDomainClasses($S_className)
    {
        $S_file = Constants::domainDirectory() . "$S_className.php";

        return static::_load($S_file);
    }


    public static function loadViewClasses($S_className)
    {
        $S_file = Constants::viewsDirectory() . "$S_className.php";

        return static::_load($S_file);
    }

    public static function loadControllerClass($S_className)
    {
        $S_file = Constants::controllersDirectory() . "$S_className.php";

        return static::_load($S_file);
    }

    public static function loadDatabaseClass($S_className)
    {
        $S_file = Constants::databseDirectory() . "$S_className.php";

        return static::_load($S_file);
    }

    public static function loadPHPMailerClasses($S_className)
    {
        $S_file = Constants::phpMailerDirectory() . "$S_className.php";

        return static::_load($S_file);
    }

    public static function loadConstantsClasses($S_className)
    {
        $S_file = Constants::constantsDirectory() . "$S_className.php";

        return static::_load($S_file);
    }

    private static function _load($S_fileToLoad)
    {
        if (is_readable($S_fileToLoad)) {
            require $S_fileToLoad;
        }
    }
}

// J'empile tout ce beau monde comme j'ai toujours appris à le faire...
spl_autoload_register('AutoLoad::loadCoreClasses');
spl_autoload_register('AutoLoad::loadExceptionClasses');
spl_autoload_register('AutoLoad::loadDataClasses');
spl_autoload_register('AutoLoad::loadServiceClasses');
spl_autoload_register('AutoLoad::loadDomainClasses');
spl_autoload_register('AutoLoad::loadViewClasses');
spl_autoload_register('AutoLoad::loadControllerClass');
spl_autoload_register('AutoLoad::loadDatabaseClass');
spl_autoload_register('AutoLoad::loadPHPMailerClasses');
spl_autoload_register('AutoLoad::loadConstantsClasses');