<?php

namespace App\Http\Controllers\API;

use App\Enums\ReponseStatus;
use App\Http\Controllers\Controller;
use App\Rules\EnumValue;
use App\Models\Reponse;
use Illuminate\Http\Request;

/**
 * Housing proposals management
 *
 * Diaspora members propose housing options and track their lifecycle through multiple states.
 */
class ReponsesController extends Controller
{
    /**
     * List housing proposals
     *
     * Diaspora members see only their proposals; students see proposals for their announcements.
     *
     * @authenticated
     * @response 200 {"data": [{"id": 1, "annonce_id": 1, "diaspora_id": 2, "address": "123 Rue", "prix": 500, "status": "en_attente", "images": []}]}
     */
    public function index(Request $request)
    {
        $query = Reponse::with(['annonce', 'diaspora']);

        if (auth()->user()?->role === 'diaspora') {
            $query->where('diaspora_id', auth()->user()->id);
        } else if (auth()->user()?->role === 'user') {
            $query->whereHas('annonce', function ($q) {
                $q->where('user_id', auth()->user()->id);
            });
        }

        $reponses = $query->paginate(15);

        return response()->json($reponses, 200);
    }

    /**
     * Propose a housing option for a request
     *
     * Upload housing details and multiple images. Images stored as separate records.
     *
     * @authenticated
     * @bodyParam annonce_id integer required Housing request ID
     * @bodyParam address string required Full address of the housing
     * @bodyParam prix number required Monthly rent price
     * @bodyParam images file[] Image files (max 5MB each)
     *
     * @response 201 {"id": 1, "annonce_id": 1, "diaspora_id": 2, "address": "123 Rue", "prix": 500, "status": "en_attente", "images": [{"id": 1, "path": "reponses/xyz.jpg", "filename": "photo.jpg"}]}
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'annonce_id' => 'required|exists:annonces,id',
            'address' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'images' => 'nullable|array',
            'images.*' => 'file|image|max:5120',
        ]);

        $reponse = Reponse::create([
            'annonce_id' => $validated['annonce_id'],
            'diaspora_id' => $request->user()->id,
            'address' => $validated['address'],
            'prix' => $validated['prix'],
            'status' => ReponseStatus::EN_ATTENTE,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('reponses', 'public');

                $reponse->images()->create([
                    'path' => $path,
                    'filename' => $file->getClientOriginalName(),
                    'mime_type' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ]);
            }
        }

        return response()->json($reponse->load(['annonce', 'diaspora', 'images']), 201);
    }

    public function show(Reponse $reponse)
    {
        return response()->json($reponse->load(['annonce', 'diaspora']), 200);
    }

    public function update(Request $request, Reponse $reponse)
    {
        $this->authorize('update', $reponse);

        $allowedValues = implode(', ', array_column(ReponseStatus::cases(), 'value'));

        $validated = $request->validate([
            'address' => 'sometimes|string',
            'prix' => 'sometimes|numeric|min:0',
            'status' => ['sometimes', new EnumValue(ReponseStatus::class)],
            'images' => 'nullable|array',
        ], [
            'status.Illuminate\Validation\Rules\Enum' => "Le statut est invalide. Valeurs acceptées : {$allowedValues}.",
        ]);

        $reponse->update($validated);

        return response()->json($reponse->load(['annonce', 'diaspora']), 200);
    }

    public function destroy(Request $request, Reponse $reponse)
    {
        $this->authorize('delete', $reponse);

        $reponse->delete();

        return response()->json(['message' => 'Reponse deleted'], 200);
    }
}
