<?php
declare(strict_types=1);

namespace App\Http\Controllers\APIv1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeletePicsumRequest;
use App\Http\Requests\ListPicsumRequest;
use App\Services\PicsumService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;

class AdminPicsumController extends Controller
{

    private PicsumService $service;

    public function __construct(PicsumService $service)
    {
        $this->service = $service;
    }

    public function index(): Factory|View|Application
    {
        $result = $this->service->listPicsum();
        return view('admin')->with(['pics' => $result]);
    }

    public function revert(DeletePicsumRequest $request): Application|RedirectResponse|Redirector
    {
        $this->service->revert($request->id);
        return redirect(env('API_URL') . '/admin/xyz123');
    }
}
