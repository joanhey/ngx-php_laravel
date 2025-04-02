<?php

namespace App\Ngx;

use Illuminate\Http\Request;

class NgxRequest extends Request
{
    public static function new()
    {
        $uri = ngx_request_uri();
        $method = ngx_request_method();
        $parameters = ngx_query_args(); // @FIXME Add post args
        parse_str(str_replace('; ', '&', ngx_cookie_get_all()), $cookies);

        $server = [
            'SERVER_NAME' => ngx_request_server_name(),
            'SERVER_PORT' => ngx_request_server_port(),
            'REMOTE_ADDR' => ngx_request_remote_addr(),
            'SERVER_PROTOCOL' => ngx_request_server_protocol(),
        ];

        return parent::createFromBase(parent::create($uri, $method, $parameters, $cookies, server: $server));
    }
}
