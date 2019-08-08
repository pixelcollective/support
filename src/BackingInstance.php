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
    protected static $instance;

    /**
     * Pimple container
     *
     * @var Pimple
     */
    protected $container;

    /**
     * Parameters
     *
     * @var array
     */
    protected $params;

    /**
     * Constructor.
     */
    private function __construct()
    {
        $this->container = new Container();

        $this->params();

        $this->registerCore();
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
