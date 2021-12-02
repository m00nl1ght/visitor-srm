<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConvertRequestFieldsToCamelCase
{
  static function renameKeysSnake($array) {
    $newArray = array();
    foreach($array as $key => $value) {
        if(is_string($key)) $key = Str::snake($key);
        if(is_array($value)) $value = static::renameKeysSnake($value);
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
        // $replaced = [];
        // foreach ($request->all() as $key => $value) {
             // $replaced[Str::snake($key)] = $value;
        // }
        $replaced = static::renameKeysSnake($request->all());
        $request->replace($replaced);

        return $next($request);
    }

    static function renameKeysCamel($array) {
      $newArray = array();
      foreach($array as $key => $value) {
          if(is_string($key)) $key = Str::camel($key);
          if(is_array($value)) $value = static::renameKeysCamel($value);
          $newArray[$key] = $value;
      }
      return $newArray;
    }
}
