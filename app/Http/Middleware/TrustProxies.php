<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Symfony\Component\HttpFoundation\Request;

class TrustProxies extends Middleware
{
    /**
     * Los proxies confiables para la aplicación.
     *
     * @var array|string|null
     */
    protected $proxies = '*';

    /**
     * Encabezados que se deben usar para detectar proxies.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_FOR 
                        | Request::HEADER_X_FORWARDED_HOST 
                        | Request::HEADER_X_FORWARDED_PORT 
                        | Request::HEADER_X_FORWARDED_PROTO 
                        | Request::HEADER_X_FORWARDED_AWS_ELB;
}
