<?php

namespace App\Http\Controllers\Api;

use App\Bookable;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookableReviewIndexResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BookableReviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return AnonymousResourceCollection|Response
     */
    public function __invoke($id, Request $request)
    {
        $bookable = Bookable::findOrFail($id);

        return BookableReviewIndexResource::collection(
            $bookable->review()->latest()->get()
        );

    }
}
