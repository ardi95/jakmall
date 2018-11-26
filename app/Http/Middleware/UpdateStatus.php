<?php

namespace App\Http\Middleware;

use Closure;
use App\Order;

class UpdateStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $date_now = date('Y-m-d H:i:s');
        $date_minus = date('Y-m-d H:i:s', strtotime('-5 minute', strtotime($date_now)));
        $prepaid = Order::where('created_at','<',$date_minus)->where('status','waiting');
        $prepaid->update([
            'status' => 'Canceled'
        ]);

        return $next($request);
    }
}
