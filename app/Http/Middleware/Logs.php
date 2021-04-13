<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Logs
{
    protected $type;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param String $type
     * @return mixed
     */
    public function handle($request, Closure $next,String $type = 'api')
    {
        $request->attributes->add(["request_type" => $type]);
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $method     = $request->server->get('REQUEST_METHOD');
        if($method != 'GET'){
            $ip         = $request->server->get('REMOTE_ADDR');
            $type       = $request->attributes->get('request_type');
            $url        = $request->url();
            $requestBody= json_encode($request->all());
            $userId     = null;
            $userName   = null;
            if(Auth::check()){
                $userId     = Auth::user()->id;
                $userName   = Auth::user()->nama;
            }
            $result = ($response)?$response->getData():null;

            \App\Log::create([
                'ip'        => $ip,
                'type'      => $type,
                'url'       => $url,
                'method'    => $method,
                'user_id'   => $userId,
                'user_name' => $userName,
                'request'   => $requestBody,
                'result'    => json_encode($result),
                'message'   => ($result->message)??$result,
                'created_at'=> now()
            ]);
        }
    }
}
