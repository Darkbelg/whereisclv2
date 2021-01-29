<?php

namespace App\Http\Controllers;

use App\Service\YoutubeApi;
use App\Refresh;
use Illuminate\Support\Facades\Log;

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
        } catch (\Exception $e) {
            Log::error($e);

            return redirect('/dashboard')->with('status','Refresh failed');
        }

    }
}
