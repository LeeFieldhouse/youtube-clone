<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function subscribe($channel){

        $channel = User::where('username', $channel)->first();
        $channel->subscriptions()->attach(auth()->id());

        return response()->json([
            'subcount' => $channel->subscriptions()->count(),
        ]);
    }

    public function unsubscribe($channel){
        $channel = User::where('username', $channel)->first();

        $channel->subscribers()->detach(auth()->id());

        return response()->json([
            'subcount' => $channel->subscriptions()->count(),
        ]);
    }
}
