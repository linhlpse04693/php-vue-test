<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatusResource;
use App\Repositories\Status\StatusRepository;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    protected StatusRepository $statusRepository;

    public function __construct(StatusRepository $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    public function index()
    {
        $statuses = $this->statusRepository->all();

        return StatusResource::collection($statuses);
    }
}
