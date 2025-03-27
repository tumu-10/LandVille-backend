<?php

namespace App\Http\Controllers;

use App\Models\BgVideo;
use App\Models\User;
use App\Models\Blog;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
     public function dashboard()
    {
        session(['title' => 'Dashboard']);

        $blogs = number_format(Blog::count());
        $bgVideo = number_format(BgVideo::count());
        $services = number_format(Service::count());

        $active_clients = User::withCount(['posts', 'impacts'])
            ->where('role', 'client')
            ->orderByDesc(DB::raw('posts_count + impacts_count'))
            ->take(10)
            ->get();

        return view('dashboard', compact('bgVideo', 'blogs', 'active_clients', 'services'));
    }
}
