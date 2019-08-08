<?php

namespace TinyPixel\Support\Services;

use Illuminate\Support\Collection;
use TinyPixel\Support\Services\Concerns\HashKeys;

/**
 * Hashing utility
 *
 * Based on PseudoCrypt by KevBurns
 * @see http://blog.kevburnsjr.com/php-unique-hash
 *
 * @author  Kelly Mears <kelly@tinypixel.dev>
 * @license MIT
 * @since   1.0.0
 *
 * @package    Acorn
 * @subpackage Support
 *
 */
class Hashing
{
    use HashKeys;

    /**
     * Base 62
     *
     * @param  int    int
     * @param  string key
     * @return string
     */
    public static function base62(int $int, string $key = '')
    {
        while (bccomp($int, 0) > 0) {
            $mod =  bcmod($int, 62);
            $key .= chr(self::$chars62[$mod]);
            $int =  bcdiv($int, 62);
        }

        return strrev($key);
    }

    /**
     * Hash
     *
     * @param  int    $num
     * @param  int    $length
     * @return string
     */
    public static function hash($num, $length = 5)
    {
        $ceil = bcpow(62, $len);
        $primes = array_keys(self::$golden_primes);
        $prime = $primes[$length];
        $dec = bcmod(bcmul($num, $prime), $ceil);

        return str_pad(self::base62($dec), $length, "0", STR_PAD_LEFT);
    }

    /**
     * Unbase 62
     *
     * @param  string $key
     * @return int
     */
    public static function unbase62($key)
    {
        $int = 0;

        Collection::make(str_split(strrev($key)))
            ->each(function ($char, $index) use ($int) {
                $dec = array_search(ord($char), self::$chars62);
                $int = bcadd(bcmul($dec, bcpow(62, $index)), $int);
            });

        return $int;
    }

    /**
     * Unhash
     *
     * @param  string $hash
     * @return string
     */
    public static function unhash($hash)
    {
        $length = strlen($hash);
        $ceil = bcpow(62, $length);
        $mmiprimes = array_values(self::$golden_primes);
        $mmi = $mmiprimes[$length];
        $num = self::unbase62($hash);

        return bcmod(bcmul($num, $mmi), $ceil);
    }
}
