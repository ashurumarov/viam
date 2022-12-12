<?php
declare(strict_types=1);

namespace App\Http\Controllers\APIv1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListPicsumRequest;
use App\Services\PicsumService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PicsumController extends Controller
{

    private PicsumService $service;

    public function __construct(PicsumService $service)
    {
        $this->service = $service;
    }

    public function index(): Factory|View|Application
    {
        $result = $this->service->discover();
        return view('welcome')->with(['img' => $result->picture, 'id' => $result->id]);
    }

    public function decline(ListPicsumRequest $request): Factory|View|Application
    {
        $result = $this->service->decline((int)$request->id, $request->height, $request->width);
        return view('welcome')->with(['img' => $result->picture, 'id' => $result->id]);
    }

    public function approve(ListPicsumRequest $request): Factory|View|Application
    {
        $result = $this->service->approve((int)$request->id, $request->height, $request->width);
        return view('welcome')->with(['img' => $result->picture, 'id' => $result->id]);
    }
}
