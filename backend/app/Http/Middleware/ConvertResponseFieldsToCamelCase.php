<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConvertResponseFieldsToCamelCase
{
    static function renameKeysCamel($array) {
      $newArray = array();
      foreach($array as $key => $value) {
          if(is_string($key)) $key = Str::camel($key);
          if(is_array($value)) $value = static::renameKeysCamel($value);
          $newArray[$key] = $value;
      }
      return $newArray;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $content = $response->getContent();

        try {
            $json = json_decode($content, true);
            $replaced = static::renameKeysCamel($json);
            // $replaced = [];
            // foreach ($json as $key => $value) {
            //     $replaced[Str::camel($key)] = $value;
            // }
            $response->setContent($replaced);
        } catch (\Exception $e) {
          // you can log an error here if you want
        }

        return $response;
    }
}
