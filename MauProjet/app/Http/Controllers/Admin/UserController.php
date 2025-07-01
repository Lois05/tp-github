<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Afficher la liste des utilisateurs avec recherche, pagination et statut connecté/bloqué.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filtrage par recherche (nom, prénom, email, téléphone)
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%$search%")
                  ->orWhere('prenom', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('telephone', 'like', "%$search%");
            });
        }

        // Pagination
        $users = $query->paginate(10);

        // Trouver les utilisateurs connectés dans les 30 dernières minutes via la table sessions
        $thirtyMinutesAgo = now()->subMinutes(30)->timestamp;
        $activeUserIds = DB::table('sessions')
            ->where('last_activity', '>=', $thirtyMinutesAgo)
            ->pluck('user_id')
            ->filter()
            ->unique();

        return view('admin.users.index', compact('users', 'activeUserIds'));
    }

    /**
     * Afficher les détails d'un utilisateur.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Formulaire de modification d'un utilisateur.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Enregistrer les modifications de l'utilisateur.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'telephone' => 'required|string|max:20',
        ]);

        $user->update($request->only(['nom', 'prenom', 'email', 'telephone']));

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Supprimer un utilisateur.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé.');
    }

    /**
     * Bloquer ou débloquer un utilisateur.
     */
    public function toggleBlock(User $user)
    {
        $user->is_blocked = !$user->is_blocked;
        $user->save();

        $message = $user->is_blocked ? 'Utilisateur bloqué.' : 'Utilisateur débloqué.';
        return redirect()->route('admin.users.index')->with('success', $message);
    }
}
