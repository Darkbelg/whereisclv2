<?php

namespace App\Http\Controllers;

use App\Service\YoutubeApi;
use App\Refresh;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\throwException;

class RefreshController extends Controller
{
    private $youtubeApi;

    public function __construct(YoutubeApi $youtubeApi)
    {
        $this->youtubeApi = $youtubeApi;
    }

    public function refreshAll()
    {
        try {
            Refresh::all($this->youtubeApi);
            return redirect('/');
        } catch (\Throwable $th) {
            Log::error($th);
            throwException($th);
            return redirect('/dashboard')->with('status', 'Refresh failed');
        }

    }
}
