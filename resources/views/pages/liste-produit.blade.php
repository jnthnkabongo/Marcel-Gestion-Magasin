@extends('pages.layouts.entete')

@section('content')
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Main content area -->
        <main class="flex-1 overflow-y-auto p-6">
            <!-- Header section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Gestion des produits</h1>
                        <p class="text-gray-600">Consultez et gérez tous les produits du système</p>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="openModal('modalNouveauProduit')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                            <i class="fas fa-plus mr-2"></i>
                            Nouveau produit
                        </button>
                        <button onclick="openModal('modalNouvelleCategorie')" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors flex items-center">
                            <i class="fas fa-tags mr-2"></i>
                            Nouvelle catégorie
                        </button>
                        <button onclick="openModal('modalNouvelleMarque')" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors flex items-center">
                            <i class="fas fa-trademark mr-2"></i>
                            Nouvelle marque
                        </button>
                    </div>
                </div>
            </div>

            <!-- Stats cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-box text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Total produits</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalProduit }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-warehouse text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Total quantité en stock</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalProduitStock }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-chart-line text-purple-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Produits vendus</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalProduitStockVendu }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users table -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-800">Liste des produits venus</h3>
                        <div class="flex items-center space-x-2">
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-print"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                               
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Catégorie
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Marque
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Modéle
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Numéro série
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Code-barres
                                </th>
                                {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Deescription
                                </th> --}}
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Prix d'achat
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider col-prix-vente">
                                    Prix de vente
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider col-actions">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($produits as $produit)
                                <tr class="hover:bg-gray-50">
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                                <i class="fas fa-box text-gray-600 text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ \Illuminate\Support\Str::limit($produit->categorie->nom, 10, '...') }}</div>
                                                <div class="text-xs text-gray-500">ID: {{ $produit->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 w-24 truncate">
                                        {{ $produit->categorie ? $produit->marque->nom : 'Non défini' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ">
                                            
                                            {{ $produit->marque ? $produit->nom : 'Non défini' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $produit->modele ?? 'Non défini' }}
                                        
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($produit->produitUnites && $produit->produitUnites->isNotEmpty())
                                            @php
                                                $firstUnite = $produit->produitUnites->first();
                                                $statut = $firstUnite->statut;
                                            @endphp
                                            
                                            @switch($statut)
                                                @case('en_stock')
                                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        En Stock
                                                    </span>
                                                    @break
                                                @case('vendu')
                                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Vendu
                                                    </span>
                                                    @break
                                                @case('defectueux')
                                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Défectueux
                                                    </span>
                                                    @break
                                                
                                                @default
                                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                        {{ $statut }}
                                                    </span>
                                            @endswitch
                                        @else
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Aucune unité
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $produit->produitUnites && $produit->produitUnites->isNotEmpty() ? $produit->produitUnites->first()->numero_serie : 'Aucun' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($produit->produitUnites && $produit->produitUnites->isNotEmpty())
                                            <svg id="barcode-{{ $produit->id }}" class="barcode"></svg>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    {{-- </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $produit->description ?? 'Aucune description' }}
                                    </td> --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $produit->prix_achat ?? '0' }} $
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $produit->prix_vente ?? '0' }} $
                                    </td>
                                    {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $produit->stock_min ?? '0' }}
                                    </td> --}}
                                   
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button onclick="openEditModal({{ $produit->id }}, '{{ $produit->nom }}', '{{ $produit->modele ?? '' }}', {{ $produit->marque_id ?? 'null' }}, {{ $produit->categorie_id ?? 'null' }}, '{{ $produit->prix_achat ?? 0 }}', '{{ $produit->prix_vente ?? 0 }}', '{{ $produit->produitUnites->first()->numero_serie ?? '' }}', '{{ $produit->description ?? '' }}')" class="text-blue-600 hover:text-blue-700 mr-2">
                                            <i class="fas fa-edit text-xl"></i>
                                        </button>
                                        <form id="delete-form-{{ $produit->id }}" action="{{ route('produits.suppression', $produit->id)}}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700" onclick="event.preventDefault(); confirmSuppression({{ $produit->id }}, '{{ $produit->nom }}')">
                                                <i class="fas fa-trash text-xl"></i>
                                            </button>
                                             @if(session('success'))
                                                <script>
                                                    setTimeout(function() {
                                                        Swal.fire({
                                                            title: "Succès!",
                                                            text: "{{ session('success') }}",
                                                            icon: "success",
                                                            timer: 3000,
                                                            showConfirmButton: false,
                                                            showCancelButton: false
                                                        });
                                                    }, 500);
                                                </script>
                                                @endif
                                        </form>
                                        {{-- <form action="" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                                        </form>  --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-8 text-center text-gray-500">
                                        <i class="fas fa-box text-4xl mb-3 text-gray-300"></i>
                                        <p>Aucun produit trouvé</p>
                                        <p class="text-sm">Commencez par ajouter un nouvel produit</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if ($produits->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $produits->links() }}
                    </div>
                @endif
            </div>
        </main>
        <div class="mb-10"></div>
    </div>

    <!-- Modal Nouveau Produit -->
    <div id="modalNouveauProduit" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-10 mx-auto p-6 border w-[800px] shadow-lg rounded-md bg-white max-h-[150vh] overflow-y-auto">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Nouveau Produit</h3>
                    <button onclick="closeModal('modalNouveauProduit')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form class="space-y-4" method="POST" action="{{ route('produits.ajout') }}">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nom du produit</label>
                            <input type="text" name="nom" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Entrez le nom" required>
                        </div>


                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Modèle</label>
                            <input type="text" name="modele" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Entrez le modèle">
                        </div>
                        
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Marque</label>
                            <select name="marque_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="">Sélectionner une marque</option>
                                @foreach ($marques as $marque)
                                    <option value="{{ $marque->id }}">{{ $marque->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                            <select name="categorie_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="">Sélectionner une catégorie</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        
                        {{-- <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Stock minimum</label>
                            <input type="number" name="stock_min" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Entrez le stock minimum" required>
                        </div> --}}
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Prix d'achat</label>
                            <input type="number" step="0.01" name="prix_achat" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Entrez le prix d'achat" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Prix de vente</label>
                            <input type="number" step="0.01" name="prix_vente" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Entrez le prix de vente" required>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Numéro série</label>
                            <input type="text" name="numero_serie" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Entrez le numéro de série" required>
                        </div>
                        <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Entrez la description du produit"></textarea>
                    
                        </div>
                  </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeModal('modalNouveauProduit')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Modification Produit -->
    <div id="modalModificationProduit" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-10 mx-auto p-6 border w-[800px] shadow-lg rounded-md bg-white max-h-[150vh] overflow-y-auto">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Modifier le Produit</h3>
                    <button onclick="closeModal('modalModificationProduit')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="editForm" class="space-y-4" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editProductId" name="id">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nom du produit</label>
                            <input type="text" id="editNom" name="nom" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Entrez le nom" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Modèle</label>
                            <input type="text" id="editModele" name="modele" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Entrez le modèle">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Marque</label>
                            <select id="editMarqueId" name="marque_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="">Sélectionner une marque</option>
                                @foreach ($marques as $marque)
                                    <option value="{{ $marque->id }}">{{ $marque->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                            <select id="editCategorieId" name="categorie_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="">Sélectionner une catégorie</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Prix d'achat</label>
                            <input type="number" step="0.01" id="editPrixAchat" name="prix_achat" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Entrez le prix d'achat" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Prix de vente</label>
                            <input type="number" step="0.01" id="editPrixVente" name="prix_vente" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Entrez le prix de vente" required>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Numéro série</label>
                            <input type="text" id="editNumeroSerie" name="numero_serie" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Entrez le numéro de série" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea id="editDescription" name="description" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Entrez la description du produit"></textarea>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeModal('modalModificationProduit')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Nouvelle Catégorie -->
    <div id="modalNouvelleCategorie" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-10 mx-auto p-6 border w-[800px] shadow-lg rounded-md bg-white max-h-[150vh] overflow-y-auto">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Nouvelle Catégorie</h3>
                    <button onclick="closeModal('modalNouvelleCategorie')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form action="{{ route('categories.ajout') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom de la catégorie</label>
                        <input type="text" name="nom" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Entrez le nom de la catégorie" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" rows="3" placeholder="Description de la catégorie"></textarea>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeModal('modalNouvelleCategorie')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Enregistrer
                        </button>
                    </div>
                    @if(session('success'))
                        <script>
                            setTimeout(function() {
                                Swal.fire({
                                    title: "Succès!",
                                    text: "{{ session('success') }}",
                                    icon: "success",
                                    timer: 3000,
                                    showConfirmButton: false,
                                    showCancelButton: false
                                });
                            }, 500);
                        </script>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Nouvelle Marque -->
    <div id="modalNouvelleMarque" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-6 border w-[800px] shadow-lg rounded-md bg-white max-h-[150vh] overflow-y-auto">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Nouvelle Marque</h3>
                    <button onclick="closeModal('modalNouvelleMarque')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form action="{{ route('marques.ajout') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom de la marque</label>
                        <input type="text" name="nom" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Entrez le nom de la marque" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" rows="3" placeholder="Description de la marque" required></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Logo (URL)</label>
                        <input type="text" name="logo" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="URL du logo (optionnel)">
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeModal('modalNouvelleMarque')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700">
                            Enregistrer
                        </button>
                    </div>
                    @if(session('success'))
                        <script>
                            setTimeout(function() {
                                Swal.fire({
                                    title: "Succès!",
                                    text: "{{ session('success') }}",
                                    icon: "success",
                                    timer: 3000,
                                    showConfirmButton: false,
                                    showCancelButton: false
                                });
                            }, 500);
                        </script>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Fermer les modals en cliquant à l'extérieur
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('bg-opacity-50')) {
                const modals = ['modalNouveauProduit', 'modalModificationProduit', 'modalNouvelleCategorie', 'modalNouvelleMarque'];
                modals.forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (!modal.classList.contains('hidden')) {
                        closeModal(modalId);
                    }
                });
            }
        });
    </script>
@endsection

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

<script>
    // Fonction de confirmation avec SweetAlert2
    function confirmSuppression(produitId, produitNom) {
        Swal.fire({
            title: 'Confirmation de suppression',
            text: `Êtes-vous sûr de vouloir supprimer le produit "${produitNom}" ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Soumettre le formulaire de suppression avec l'ID unique
                const form = document.getElementById(`delete-form-${produitId}`);
                if (form) {
                    form.submit();
                } else {
                    console.error('Formulaire de suppression non trouvé pour le produit ID:', produitId);
                    Swal.fire({
                        title: 'Erreur!',
                        text: 'Formulaire de suppression non trouvé',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            }
        });
    }

    // Fonction pour ouvrir le modal de modification
    function openEditModal(id, nom, modele, marqueId, categorieId, prixAchat, prixVente, numeroSerie, description) {
        // Remplir les champs du formulaire
        document.getElementById('editProductId').value = id;
        document.getElementById('editNom').value = nom;
        document.getElementById('editModele').value = modele;
        document.getElementById('editMarqueId').value = marqueId || '';
        document.getElementById('editCategorieId').value = categorieId || '';
        document.getElementById('editPrixAchat').value = prixAchat;
        document.getElementById('editPrixVente').value = prixVente;
        document.getElementById('editNumeroSerie').value = numeroSerie;
        document.getElementById('editDescription').value = description;
        
        // Définir l'action du formulaire
        document.getElementById('editForm').action = '/produits/modification/' + id;
        
        // Ouvrir le modal
        openModal('modalModificationProduit');
    }

    document.addEventListener('DOMContentLoaded', function() {
        console.log('JsBarcode chargé:', typeof JsBarcode);
        
        // Générer les codes-barres pour chaque produit
        @foreach($produits as $produit)
            @if($produit->produitUnites && $produit->produitUnites->isNotEmpty())
                <?php $numeroSerie = $produit->produitUnites->first()->numero_serie; ?>
                console.log('Génération code-barres pour produit {{ $produit->id }}: {{ $numeroSerie }}');
                
                try {
                    JsBarcode("#barcode-{{ $produit->id }}", "{{ $numeroSerie }}", {
                        format: "CODE128",
                        width: 1.5,      // Plus fin
                        height: 30,       // Plus court
                        displayValue: true,
                        fontSize: 10,     // Texte plus petit
                        margin: 3         // Marge réduite
                    });
                    console.log('Code-barres généré pour produit {{ $produit->id }}');
                } catch (error) {
                    console.error('Erreur génération code-barres pour produit {{ $produit->id }}:', error);
                }
            @endif
        @endforeach
    });

    
</script>
@endpush