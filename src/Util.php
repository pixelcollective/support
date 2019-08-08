<?php

namespace TinyPixel\Support;

use Masterminds\Html5;
use queryPath\QueryPath;
use Illuminate\Support\Collection;
use TinyPixel\Support\Services\MimeTypes;
use TinyPixel\Support\Services\Utilities;
use TinyPixel\Support\Services\Hashing;
use TinyPixel\Support\BackingInstance;

/**
 * Utility
 *
 * @author  Kelly Mears <kelly@tinypixel.dev>
 * @license MIT
 * @version 1.0.0
 * @since   1.0.0
 *
 * @package TinyPixel\Support
 */
class Util extends BackingInstance
{
    /**
     * Inject core parameters
     *
     * @return void
     */
    protected function registerCoreParams() : void
    {
        // --
    }

    /**
     * Inject core services.
     *
     * @return void
     */
    protected function registerCore() : void
    {
        /**
         * Static services
         */
        $this->container['collection'] = function ($c) {
            return Collection::class;
        };

        $this->container['utility'] = function ($c) {
            return Utilities::class;
        };

        $this->container['hashing'] = function ($c) {
            return Hashing::class;
        };

        /**
         * Instantiated services
         */
        $this->container['html5'] = function ($c) {
            return new HTML5();
        };

        $this->container['querypath'] = function ($c) {
            return new QueryPath();
        };

        $this->container['mimetypes'] = function ($c) {
            return new MimeTypes();
        };
    }
}
