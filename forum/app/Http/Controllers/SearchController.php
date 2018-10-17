<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Filters\ThreadFilters;
use App\Thread;
use App\Trending;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Channel       $channel
     * @param ThreadFilters $filters
     * @param Trending      $trending
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Trending $trending)
    {
        if (\request()->expectsJson()) {
            $threads = Thread::search(request('q'))->paginate(25);

            return $threads;
        }

        return view('threads.search', [
            'trending' => $trending->get(),
        ]);
    }
}
