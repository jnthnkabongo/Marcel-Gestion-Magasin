<?php

namespace App\Http\Controllers;

use App\Http\Requests\Credentials;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Historique;
use App\Models\HistoriqueAction;
use App\Models\Produit;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Marque;
use App\Models\Approvisionnement;
use App\Models\Categorie;
use App\Models\Fournisseur;
use App\Models\Role;
use App\Models\Client;
use App\Models\ProduitUnite;
use App\Models\Vente;
use App\Models\VenteDetail;
use App\Models\Garantie;
use App\Models\Paiement;
use App\Models\ApprovisionnementDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    /** LES FONCTIONS DE L'API */
    public function ajouterHistoriques(string $action, string $description = null)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Utilisateur non autorisé'
            ], 401);
        }

        if (is_null($user->role) || $user->role->nom !== 'admin') {
            return response()->json([
                'message' => 'Accès refusé - rôle admin requis'
            ], 403);
        }

        $historique = HistoriqueAction::create([
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description ?? 'Action effectuée',
        ]);

        return response()->json([
            'message' => 'Historique ajouté avec succès',
            'historique' => $historique
        ], 201);
       
    }

    public function login_api(Credentials $request){
        $credentials = $request->validated();
        
        $this->ajouterHistoriques('login', 'Connexion de l\'utilisateur');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth-token')->plainTextToken;
            
            return response()->json([
                'message' => 'Connexion réussie',
                'user' => $user,
                'token' => $token
            ], 200);
        }

        
        return response()->json([
            'message' => 'Identifiants invalides'
        ], 401);
    }

    public function register_api(RegisterRequest $request){
        $validated = $request->validated();
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' =>Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
        ]);
        
        $token = $user->createToken('auth-token')->plainTextToken;
        
        return response()->json([
            'message' => 'Inscription réussie',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function logout_api(Request $request){
        $request->user()->currentAccessToken()->delete();
        
        return response()->json([
            'message' => 'Déconnexion réussie'
        ], 200);
    }

    /**
     * LES FONCTIONS DE L'APPLICATION WEB
     */
    public function index()
    {
        return view('pages.auth');
    }

    public function login(Credentials $request){
        $credentials = $request->validated();
        
        if (Auth::attempt($credentials)) {
            $userId = Auth::id();
            DB::table('users')
                ->where('id', $userId)
                ->update(['last_login' => now()]);
            
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'Connexion réussie');
        }
        
        return redirect()->route('index')->withErrors(['error' => 'Identifiants invalides'])->onlyInput('email');
    }

    public function register(RegisterRequest $request){
        $validated = $request->validated();
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' =>Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
        ]);
        
        return redirect()->route('index')->with('success', 'Inscription réussie');
    }

    public function dashboard()
    {
        return view('pages.dashboard');
    }

    public function listeUtilisateurs()
    {
        $users = User::with('role')->get();
        $administrateurs = User::where('role_id', 1)->count();
        return view('pages.liste-utilisateur', compact('users', 'administrateurs'));
    }

    public function listeProduits()
    {
        $produits = Produit::with('categorie')->get();
        return view('pages.liste-produit', compact('produits'));
    }

    public function ajoutMarque(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100|unique:marques,nom',
            'description' => 'required|string|max:255',
            'logo' => 'nullable|string|max:255'
        ]);

        try {
            $marque = new Marque();
            $marque->nom = $validated['nom'];
            $marque->description = $validated['description'];
            $marque->logo = $validated['logo'] ?? null;
            
            $marque->save();
            
            return redirect()->route('produits')->with('success', 'Marque "' . $marque->nom . '" créée avec succès');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la création de la marque: ' . $e->getMessage());
        }
    }

    public function ajoutCategorie(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:categories,nom',
            'description' => 'nullable|string|max:1000'
        ]);

        try {
            $categorie = new \App\Models\Categorie();
            $categorie->nom = $validated['nom'];
            $categorie->description = $validated['description'] ?? null;
            
            $categorie->save();
            
            return redirect()->route('produits')->with('success', 'Catégorie "' . $categorie->nom . '" créée avec succès');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la création de la catégorie: ' . $e->getMessage());
        }
    }

    public function parametres()
    {
        $marques = Marque::all();
        $categories = Categorie::all();
        return view('pages.parametres', compact('marques', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $user = User::find($id);
        $user->delete();
        return redirect()->route('/')->with('success', 'Utilisateur supprimé');
    }

    /**
     * Déconnexion de l'utilisateur
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('index')->with('success', 'Déconnexion réussie');
    }
}

