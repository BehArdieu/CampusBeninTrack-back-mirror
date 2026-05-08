<?php

namespace App\Http\Controllers\API;

use App\Enums\AnnonceStatus;
use App\Enums\PositionnementStatus;
use App\Http\Controllers\Controller;
use App\Rules\EnumValue;
use App\Models\Positionnement;
use Illuminate\Http\Request;

/**
 * Diaspora positioning and candidatures for housing requests
 *
 * Diaspora members express interest to help with housing searches.
 */
class PositionnementsController extends Controller
{
    /**
     * List positioning requests
     *
     * Diaspora members see only their own; students see all on their announcements.
     *
     * @authenticated
     * @response 200 {"data": [{"id": 1, "annonce_id": 1, "diaspora_id": 2, "message": "Je peux vous aider", "status": "en_attente"}]}
     */
    public function index(Request $request)
    {
        $query = Positionnement::with(['annonce', 'diaspora']);

        if (auth()->user()?->role === 'diaspora') {
            $query->where('diaspora_id', auth()->user()->id);
        }

        $positionnements = $query->paginate(15);

        return response()->json($positionnements, 200);
    }

    /**
     * Express interest to help with a housing request
     *
     * @authenticated
     * @bodyParam annonce_id integer required Housing request ID
     * @bodyParam message string Introduction message
     *
     * @response 201 {"id": 1, "annonce_id": 1, "diaspora_id": 2, "status": "en_attente"}
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'annonce_id' => 'required|exists:annonces,id',
            'message' => 'nullable|string',
        ]);

        $positionnement = Positionnement::create([
            'annonce_id' => $validated['annonce_id'],
            'diaspora_id' => $request->user()->id,
            'message' => $validated['message'] ?? null,
            'status' => PositionnementStatus::EN_ATTENTE,
        ]);

        return response()->json($positionnement->load(['annonce', 'diaspora']), 201);
    }

    public function show(Positionnement $positionnement)
    {

        if (auth()->user()?->id == $positionnement->annonce->user_id) {
            $positionnement->update([
                'status' => PositionnementStatus::LU,
                'lu_at' => now(),
            ]);
        }

        return response()->json($positionnement->load(['annonce', 'diaspora']), 200);
    }

    public function update(Request $request, Positionnement $positionnement)
    {
        $this->authorize('update', $positionnement);

        $validated = $request->validate([
            'status' => ['sometimes', new \App\Rules\EnumValue(PositionnementStatus::class)],
        ]);

        if (isset($validated['status']) && $validated['status'] === PositionnementStatus::ACCEPTE->value) {
            $positionnement->annonce->update([
                'status' => AnnonceStatus::EN_COURS,
                'diaspora_id' => $positionnement->diaspora_id
            ]);

            // Passer tous les autres positionnements de cette annonce à REFUSE
            $positionnement->annonce->positionnements()->where('id', '!=', $positionnement->id)->update([
                'status' => PositionnementStatus::REFUSE
            ]);
        }

        $positionnement->update($validated);
        return response()->json($positionnement->load(['annonce', 'diaspora']), 200);
    }

    public function destroy(Request $request, Positionnement $positionnement)
    {
        $this->authorize('delete', $positionnement);

        $positionnement->delete();

        return response()->json(['message' => 'Positionnement deleted'], 200);
    }
}
