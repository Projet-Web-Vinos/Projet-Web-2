<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cellar;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Récupère tous les utilisateurs depuis la base de données
        
        $users = User::all();        
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validation des données du formulaire
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
        ]);

        //Création d'un nouvel utilisateur
        $user = new User();
        $user->fill($request->all());
        $user->save();

        return redirect()->route('login')->with('success', 'Inscription réussie! Veuillez vous connecter.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function celliers()
    {
        return $this->hasMany(Cellar::class);
    }
    //TODO: Ajouter des méthodes pour l'oubli de mot de passe, la réinitialisation du mot de passe, etc.

    public function forgotPassword() {}
    public function passwordEmail() {}
    public function resetPassword() {}
}
