<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Http\Request;

class CreateRecommendationController extends Controller
{
    /**
     * RecommendationController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'title' => 'string',
        ]);

        $datasourceProviders = config('datasources.providers');

        $client = new \GuzzleHttp\Client();
        $promises = [];

        foreach ($datasourceProviders as $key => $provider) {
            $promises[$key] = $client->sendAsync(
                (new $provider)
                    ->request($request->toArray())
            );
        }

        $results = \GuzzleHttp\Promise\unwrap($promises);

        foreach ($datasourceProviders as $key => $provider) {
            $datasources[$key] = (new $provider)
                    ->process($results[$key]);
        }

        $recommendation = $request->user()->recommendations()->create([
            Recommendation::REQUEST => $request->toArray(),
            Recommendation::RESPONSE => [
                'waypoints' => [1, 2, 3],
                'algorithm' => "the algo",
            ],
            Recommendation::TITLE => "mytitle"
        ]);

        return response()->json($recommendation, 201);
    }
}
