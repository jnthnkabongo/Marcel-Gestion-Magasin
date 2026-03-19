<?php

namespace App\Http\Controllers;

use App\Http\Requests\Credentials;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    /** LES FONCTIONS DE L'API */
    public function ajouterHistorique(string $action, string $description = null)
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
        
        $this->ajouterHistorique('login', 'Connexion de l\'utilisateur');

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

    public function listeProduitsApi(){
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'message' => 'Utilisateur non authentifié'
            ], 401);
        }

        // Ajouter l'historique sans retourner la réponse
        $this->ajouterHistorique($user->id, 'liste_produits', 'Liste des produits');
        try {
            HistoriqueAction::create([
                'user_id' => $user->id,
                'action' => 'liste_produits',
                'description' => 'Liste des produits',
            ]);
        } catch (\Exception $e) {
            // Continuer même si l'historique échoue
            Log::error('Erreur historique: ' . $e->getMessage());
        }

        $produits = Produit::orderBy('created_at', 'desc')->with('categorie', 'produitUnites', 'marque')->get();
        return response()->json($produits);
    }

    public function getHistoriquesApi(){
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'utilisateur non authentifié'
            ], 401);
        }
        
        $historiques = HistoriqueAction::where(
            'user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return response()->json([
            'message' => 'Recuperation de toute l\'historiques',
            'historique' => $historiques
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
            $this->ajouterHistorique('login', 'Connexion de l\'utilisateur');
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
        
        $this->ajouterHistorique('register', 'Inscription de l\'utilisateur');
        return redirect()->route('index')->with('success', 'Inscription réussie');
    }

    public function dashboard()
    {
        $totalUtilisateurs = User::count();
        $totalProduts = Produit::count();
        $totalVentes = Vente::count();
        $totalClients = Client::count();
        $this->ajouterHistorique('dashboard', 'consultation', 'Dashboard');
        return view('pages.dashboard', compact('totalUtilisateurs', 'totalProduts', 'totalVentes', 'totalClients'));
    }

    // public function listeHistoriques()
    // {
    //     // Statistiques
    //     $historiquesAujourdhui = HistoriqueAction::whereDate('created_at', today())->count();
    //     $totalCreations = HistoriqueAction::where('action', 'creation')->count();
    //     $totalModifications = HistoriqueAction::where('action', 'modification')->count();
    //     $totalSuppressions = HistoriqueAction::where('action', 'suppression')->count();
        
    //     // Liste des historiques avec pagination
    //     $historiques = HistoriqueAction::with('user')
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(20);
            
    //     // Liste des utilisateurs pour le filtre
    //     $users = User::orderBy('name')->get();
        
    //     return view('pages.historiques', compact(
    //         'historiques', 
    //         'historiquesAujourdhui', 
    //         'totalCreations', 
    //         'totalModifications', 
    //         'totalSuppressions',
    //         'users'
    //     ));
    // }

    public function listeUtilisateurs()
    {
        $users = User::with('role')->get();
        $administrateurs = User::where('role_id', 1)->count();

        $this->ajouterHistorique('liste-utilisateurs', 'consultation', 'Liste des utilisateurs');

        return view('pages.liste-utilisateur', compact('users', 'administrateurs'));
    }

    public function listeProduits()
    {
        $totalProduit = Produit::count();
        // $totalProduit = DB::table('produits')
        //     ->join('produit_unites', 'produits.id', '=', 'produit_unites.produit_id')
        //     //->where('produit_unites.quantite', '>', 0)
        //     ->select('produits.*', 'produit_unites.numero_serie')
        //     ->count();

        $totalProduitStock = DB::table('produits')
            ->join('produit_unites', 'produits.id', '=', 'produit_unites.produit_id')
            ->where('produit_unites.statut', 'en_stock')
            ->select('produits.*', 'produit_unites.numero_serie')
            ->count();

        $totalProduitStockVendu = DB::table('produits')
            ->join('produit_unites', 'produits.id', '=', 'produit_unites.produit_id')
            ->where('produit_unites.statut', 'vendu')
            ->select('produits.*', 'produit_unites.numero_serie')
            ->count();

        $this->ajouterHistorique('liste-produits', 'consultation', 'Liste des produits');

        $produits = Produit::with('categorie','marque', 'produitUnites', 'approvisionnementDetails')->orderBy('created_at', 'desc')->paginate('7');
        $categories = Categorie::orderBy('created_at','desc')->get();
        $marques = Marque::orderBy('created_at','desc')->get();
        return view('pages.liste-produit', compact('produits', 'categories', 'marques', 'totalProduit', 'totalProduitStock', 'totalProduitStockVendu'));
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
            
            $this->ajouterHistorique('ajout-marque', 'creation', 'Marque "' . $marque->nom . '" créée');

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
            $categorie = new Categorie();
            $categorie->nom = $validated['nom'];
            $categorie->description = $validated['description'] ?? null;
            
            $categorie->save();

            $this->ajouterHistorique('ajout-categorie', 'creation', 'Catégorie "' . $categorie->nom . '" créée');
            
            return redirect()->route('produits')->with('success', 'Catégorie "' . $categorie->nom . '" créée avec succès');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la création de la catégorie: ' . $e->getMessage());
        }
    }

    public function ajoutProduit(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'marque_id' => 'required|exists:marques,id',
            'modele' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'prix_achat' => 'required|numeric',
            'prix_vente' => 'required|numeric',
            'stock_min' => 'required|numeric',
            'numero_serie' => 'required|string|max:255'
        ]);

        try {

            // Création du produit
            $produit = new Produit();
            $produit->nom = $validated['nom'];
            $produit->categorie_id = $validated['categorie_id'];
            $produit->marque_id = $validated['marque_id'];
            $produit->modele = $validated['modele'] ?? null;
            $produit->description = $validated['description'] ?? null;
            $produit->prix_achat = $validated['prix_achat'];
            $produit->prix_vente = $validated['prix_vente'];
            $produit->stock_min = $validated['stock_min'];
            $produit->save();

            // Création de l'unité produit
            $produitUnit = new ProduitUnite();
            $produitUnit->produit_id = $produit->id;
            $produitUnit->numero_serie = $validated['numero_serie'];
            $produitUnit->statut = 'en_stock';
            $produitUnit->save();

            $this->ajouterHistorique('ajout-produit', 'creation', 'Produit "' . $produit->nom . '" créé');

            return redirect()
                ->route('produits')
                ->with('success', 'Produit "' . $produit->nom . '" créé avec succès');

        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Erreur lors de la création du produit : ' . $e->getMessage());
        }
    }

    public function parametres()
    {
        $marques = Marque::all();
        $categories = Categorie::all();

        $this->ajouterHistorique('parametres', 'consultation', 'Page des paramètres');

        return view('pages.parametres', compact('marques', 'categories'));
    }

    public function historiques(){
        // Statistiques
        $historiquesAujourdhui = HistoriqueAction::whereDate('created_at', today())->count();
        $totalCreations = HistoriqueAction::where('action', 'creation')->count();
        $totalModifications = HistoriqueAction::where('action', 'modification')->count();
        $totalSuppressions = HistoriqueAction::where('action', 'suppression')->count();
        
        // Liste des historiques avec pagination
        $historiques = HistoriqueAction::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        // Liste des utilisateurs pour le filtre
        $users = User::orderBy('name')->get();
        
        return view('pages.historiques', compact(
            'historiques', 
            'historiquesAujourdhui', 
            'totalCreations', 
            'totalModifications', 
            'totalSuppressions',
            'users'
        ));
        //return view('pages.historiques');
    }

    public function vente(){
        $liste_produits = Produit::with('categorie', 'produitUnites')->orderBy('created_at','desc')->get();
        $clients = Client::orderBy('created_at', 'desc')->get();
        $ventes = Vente::with(['client', 'venteDetails.produitUnite.produit'])->orderBy('created_at', 'desc')->paginate('10');
        $venteJournalier = Vente::whereDate('created_at', today())->count();
        $ventesSommeJournalier = Vente::whereDate('created_at', today())->sum('total');
        $ventesSommeTotale = Vente::sum('total');
        $venteTotale = Vente::count();
        $ventesSommeMois = Vente::whereMonth('created_at', now()->month)->sum('total');
        return view('pages.vente-new', compact('liste_produits', 'clients', 'ventes', 'venteJournalier', 'ventesSommeJournalier', 'ventesSommeTotale', 'ventesSommeMois', 'venteTotale'));
    }

    public function ajouterVente(Request $request)
    {
        try {
            $request->validate([
                'client_id' => 'required|exists:users,id',
                'date_vente' => 'required|date',
                'produits' => 'required|array',
                'produits.*' => 'exists:produits,id',
                'quantites' => 'required|array',
                'quantites.*' => 'required|integer|min:1',
                'prix_unitaires' => 'required|array',
                'prix_unitaires.*' => 'required|numeric|min:0',
                'totaux' => 'required|array',
                'totaux.*' => 'required|numeric|min:0'
            ]);

            // Créer la vente
            $vente = new Vente();
            $vente->client_id = $request->client_id;
            $vente->user_id = Auth::id(); // Ajouter l'utilisateur qui effectue la vente
            $vente->date_vente = $request->date_vente;
            $vente->reference = $request->reference ?? 'VTE-' . date('YmdHis');
            //$vente->description = $request->description;
            //$vente->statut = 'completed';
            $vente->total = array_sum($request->totaux);
            $vente->save();

            // Traiter chaque produit
            foreach ($request->produits as $index => $produitId) {
                $quantite = $request->quantites[$index];
                $prixUnitaire = $request->prix_unitaires[$index];
                $total = $request->totaux[$index];

                // Récupérer les unités de produit spécifiques vendues
                $produitUnites = ProduitUnite::where('produit_id', $produitId)
                    ->where('statut', 'en_stock')
                    ->take($quantite)
                    ->get();

                foreach ($produitUnites as $unite) {
                    // Créer le détail de vente pour chaque unité
                    $venteDetail = new VenteDetail();
                    $venteDetail->vente_id = $vente->id;
                    $venteDetail->produit_unite_id = $unite->id; // Utiliser l'ID de l'unité
                    $venteDetail->prix_unitaire = $prixUnitaire;
                    $venteDetail->total = $total / $quantite; // Prix par unité
                    $venteDetail->save();

                    // Mettre à jour le statut de l'unité
                    $unite->statut = 'vendu';
                    $unite->save();
                }

                // Mettre à jour le statut du produit si plus d'unités en stock
                // Note: La table produits n'a pas de colonne statut, donc on ne met pas à jour
                // Le statut peut être calculé à la volée via les requêtes
                
                // Mettre à jour le stock minimum si nécessaire
                $produit = Produit::find($produitId);
                $stockRestant = ProduitUnite::where('produit_id', $produitId)
                    ->where('statut', 'en_stock')
                    ->count();
                
                // Si le stock restant est inférieur au stock minimum, on pourrait alerter
                // mais pour l'instant on ne fait rien car la table produits n'a pas de champ statut
            }

            // Ajouter l'historique
            HistoriqueAction::create([
                'user_id' => Auth::id(),
                'action' => 'creation',
                'table_concernee' => 'ventes',
                'id_concerne' => $vente->id,
                'details' => 'Nouvelle vente enregistrée: ' . $vente->reference
            ]);

            return redirect()->back()->with('success', 'Vente enregistrée avec succès!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'enregistrement de la vente: ' . $e->getMessage())->withInput();
        }
    }

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
        return redirect()->route('login');
    }

  
}
