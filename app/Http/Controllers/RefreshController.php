<?php

namespace App\Http\Controllers;

use App\Service\YoutubeApi;
use App\Refresh;

class RefreshController extends Controller
{
    private $youtubeApi;

    public function __construct(YoutubeApi $youtubeApi)
    {
        $this->youtubeApi = $youtubeApi;
        $this->middleware('auth');
    }

    public function refreshAll()
    {
        try {
            Refresh::all($this->youtubeApi);

            return redirect('/');
        } catch (\Throwable $th) {
            return redirect('/dashboard')->with('status','Refresh failed');
        }

    }
}
