<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ville;
use Illuminate\Http\Request;

/**
 * Cities management
 */
class VillesController extends Controller
{
    /**
     * List all cities
     *
     * @authenticated
     * @response 200 [{"id": 1, "ville": "Lyon", "longitude": 4.8357, "latitude": 45.7640}]
     */
    public function index()
    {
        return response()->json(Ville::orderBy('ville')->get());
    }

    /**
     * Search cities by name
     *
     * @authenticated
     * @queryParam q string required Search term. Example: Lyon
     * @response 200 [{"id": 1, "ville": "Lyon", "longitude": 4.8357, "latitude": 45.7640}]
     */
    public function search(Request $request)
    {
        $request->validate(['q' => 'required|string|min:1']);

        $villes = Ville::where('ville', 'like', '%' . $request->q . '%')
            ->orderBy('ville')
            ->get();

        return response()->json($villes);
    }
}
