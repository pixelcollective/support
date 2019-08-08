<?php

namespace TinyPixel\Support;

use Pimple\Container;

/**
 * Container
 */
abstract class BackingInstance
{
     /**
     * Util instance
     *
     * @var Util
     */
    private static $instance;

    /**
     * Parameters
     *
     * @var array
     */
    protected $params;

    /**
     * Pimple container
     *
     * @var Pimple
     */
    public $container;

    /**
     * Constructor.
     */
    private function __construct()
    {
        $this->container = new Container();

        $this->registerCoreParams();

        $this->registerCoreServices();
    }

    /**
     * Singleton pattern.
     *
     * @return Util
     */
    public static function getInstance() : Util
    {
        if (!self::$instance instanceOf Util) {
            self::$instance = new Util();
        }

        return self::$instance;
    }
}
