<?php

namespace App\Http\Controllers\Api;

use App\Bookable;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookableIndexResource;
use App\Http\Resources\BookableShowResource;
use Illuminate\Http\Request;

class BookableController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return BookableIndexResource::collection(
            Bookable::all()
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return new BookableShowResource(Bookable::findOrFail($id));
    }

}
