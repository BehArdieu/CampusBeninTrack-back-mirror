<?php

namespace App\Http\Controllers\API;

use App\Enums\AnnonceStatus;
use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;

/**
 * Housing request announcements management
 *
 * Students create requests for housing assistance. Diaspora members see available requests and can express interest.
 */
class AnnoncesController extends Controller
{
    /**
     * List all housing requests
     *
     * Authenticated diaspora members see all requests; students see only their own.
     *
     * @authenticated
     * @response 200 {"data": [{"id": 1, "titre": "Besoin d'un logement à Lyon", "description": "...", "universite": "Université Claude Bernard", "ville": {"id": 1, "ville": "Lyon"}, "status": "en_attente"}], "meta": {"per_page": 15}}
     */
    public function index(Request $request)
    {
        $query = Annonce::with(['user', 'diaspora', 'ville']);

        if (auth()->user()?->role === 'diaspora') {
            $query->where('diaspora_id', auth()->user()->id);
        } else if (auth()->user()?->role === 'user') {
            $query->where('user_id', auth()->user()->id);
        }

        $annonces = $query->paginate(15);

        return response()->json($annonces, 200);
    }

    /**
     * Create a new housing request
     *
     * @authenticated
     * @bodyParam titre string required Title of the request
     * @bodyParam description string required Detailed housing requirements
     * @bodyParam photo string Photo URL
     * @bodyParam universite string Target university name
     * @bodyParam ville_id integer required City ID
     *
     * @response 201 {"id": 1, "user_id": 1, "titre": "Besoin logement", "description": "...", "ville_id": 1}
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|string',
            'universite' => 'nullable|string',
            'ville_id' => 'required|exists:villes,id',
        ]);

        $annonce = Annonce::create([
            'user_id' => $request->user()->id,
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'photo' => $validated['photo'] ?? null,
            'universite' => $validated['universite'] ?? null,
            'ville_id' => $validated['ville_id'],
            'status' => AnnonceStatus::EN_ATTENTE,
        ]);

        return response()->json($annonce->load(['user', 'ville']), 201);
    }

    /**
     * Get a specific housing request with all related data
     *
     * @authenticated
     * @response 200 {"id": 1, "user_id": 1, "diaspora_id": null, "titre": "...", "description": "...", "positionnements": [], "reponses": []}
     */
    public function show(Annonce $annonce)
    {
        return response()->json(
            $annonce->load(['user', 'diaspora', 'ville', 'positionnements', 'reponses']),
            200
        );
    }

    /**
     * Update a housing request
     *
     * @authenticated
     * @bodyParam diaspora_id integer Assign a diaspora member to help
     * @bodyParam status string Update request status
     *
     * @response 200 {"id": 1, "diaspora_id": 2, "status": "..."}
     */
    public function update(Request $request, Annonce $annonce)
    {
        $this->authorize('update', $annonce);

        $validated = $request->validate([
            'titre' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'photo' => 'nullable|string',
            'universite' => 'nullable|string',
            'diaspora_id' => 'nullable|exists:users,id',
            'status' => ['sometimes', new \App\Rules\EnumValue(AnnonceStatus::class)],
        ]);

        $annonce->update($validated);

        return response()->json($annonce->load(['user', 'diaspora', 'ville']), 200);
    }

    /**
     * Delete a housing request
     *
     * @authenticated
     * @response 200 {"message": "Annonce deleted"}
     */
    public function destroy(Request $request, Annonce $annonce)
    {
        $this->authorize('delete', $annonce);

        $annonce->delete();

        return response()->json(['message' => 'Annonce deleted'], 200);
    }
}
