<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cookie;

class ThemeController extends Controller
{
    public function createDarkMode(Request $request) {
        $theme = $request->theme;
        if($theme && in_array($theme, ['light', 'dark'])) {
            $cookie = cookie('theme',$theme, 60*24*365);
        }
        return redirect('dashboard')->withCookie($cookie);
    }
    // public function deleteCookie() {
    //     Cookie::queue(Cookie::forget(('theme')));
    //     return redirect('dashboard');
    // }
}
