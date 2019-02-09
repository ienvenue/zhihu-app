<?php
/**
 * Created by PhpStorm.
 * User: cheny
 * Date: 2019/2/9
 * Time: 10:29
 */
if ( !function_exists('user') ) {

    /**
     * @param null $driver
     * @return mixed
     */
    function user($driver = null)
    {
        if ( $driver ) {
            return app('auth')->guard($driver)->user();
        }
        return app('auth')->user();
    }
}