<?php

namespace App\Http\Controllers;

use App\Http\Hateoas\Index;

class IndexController extends Controller
{
    public function __construct(
        Index $indexHateoas
    ) {
        $this->indexHateoas = $indexHateoas;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $links = $this->indexHateoas->links();

        return response()->json([
            'links' => $links
        ]);
    }
}
