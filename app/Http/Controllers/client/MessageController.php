<?php
namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $conversations = Message::where('expediteur_id', $user->id)
            ->orWhere('recepteur_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('client.messages.index', compact('conversations'));
    }

    public function show($id)
    {
        $user = Auth::user();

        $interlocuteur = User::findOrFail($id);

        $messages = Message::where(function($q) use ($user, $interlocuteur) {
            $q->where('expediteur_id', $user->id)->where('recepteur_id', $interlocuteur->id);
        })->orWhere(function($q) use ($user, $interlocuteur) {
            $q->where('expediteur_id', $interlocuteur->id)->where('recepteur_id', $user->id);
        })->orderBy('created_at')->get();

        // Marquer comme lus
        Message::where('expediteur_id', $interlocuteur->id)
            ->where('recepteur_id', $user->id)
            ->where('lu', false)
            ->update(['lu' => true]);

        return view('client.messages.show', compact('messages', 'interlocuteur'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'recepteur_id' => 'required|exists:users,id|not_in:' . Auth::id(),
            'contenu' => 'required|string|max:1000',
        ]);

        Message::create([
            'expediteur_id' => Auth::id(),
            'recepteur_id' => $request->recepteur_id,
            'contenu' => $request->contenu,
            'lu' => false,
        ]);

        return redirect()->route('client.messages.show', $request->recepteur_id)
                         ->with('success', 'Message envoyé !');
    }
}
