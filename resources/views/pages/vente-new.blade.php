@extends('pages.layouts.entete')

@section('content')
<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-6">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 mb-6">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Ventes</h1>
                        <p class="text-gray-600 text-sm">Gestion des ventes et transactions</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button onclick="openModal('modalNouvelleVente')" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Nouvelle vente
                        </button>
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-download mr-2"></i>
                            Exporter
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                            <i class="fas fa-filter mr-2"></i>
                            Filtrer
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-shopping-cart text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Aujourd'hui</p>
                        <p class="text-2xl font-bold text-gray-800">Unité {{ $venteJournalier ?? 0 }} | {{ $ventesSommeJournalier ?? 0 }} $</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-chart-line text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Ce mois</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $ventesSommeMois ?? 0 }} $</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-dollar-sign text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Total ventes</p>
                        <p class="text-2xl font-bold text-gray-800">Unité {{ $venteTotale ?? 0 }} | {{ $ventesSommeTotale ?? 0 }} $</p>
                    </div>
                </div>
            </div>

            {{-- <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-receipt text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Revenu total</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $revenuTotal ?? 0 }} $</p>
                    </div>
                </div>
            </div> --}}
        </div>

        <!-- Ventes Table -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Liste des ventes</h2>
                    <div class="flex items-center space-x-4">
                        <input type="text" id="searchVentes" placeholder="Rechercher une vente..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Toutes les périodes</option>
                            <option value="today">Aujourd'hui</option>
                            <option value="week">Cette semaine</option>
                            <option value="month">Ce mois</option>
                            <option value="year">Cette année</option>
                        </select>
                        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Tous les statuts</option>
                            <option value="completed">Complétées</option>
                            <option value="pending">En attente</option>
                            <option value="cancelled">Annulées</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="ventesTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Référence
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Client
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Produits
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Montant
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse (isset($ventes) ? $ventes : [] as $vente)
                            <tr class="hover:bg-gray-50 vente-row">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    #{{ str_pad($vente->id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $vente->reference }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($vente->date_vente)->format('d/m/Y') }}
                                </td>
                                {{-- <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-gray-600 text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $vente->client->nom ?? 'Client inconnu' }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $vente->client->email ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </td> --}}

                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $vente->client->nom_client}}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <div class="max-w-xs">
                                        @if($vente->venteDetails && $vente->venteDetails->isNotEmpty())
                                            @php
                                                $produits = $vente->venteDetails->map(function($detail) {
                                                    return $detail->produitUnite->produit->nom ?? 'Produit inconnu';
                                                })->unique()->implode(', ');
                                            @endphp
                                            {{ $produits }}
                                        @else
                                            <span class="text-gray-400">Aucun produit</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    @if($vente->venteDetails && $vente->venteDetails->isNotEmpty())
                                        {{ number_format($vente->venteDetails->sum('prix_unitaire'), 2, ',', ' ') }} $
                                    @else
                                        <span class="text-gray-400">0 $</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($vente->statut ?? 'completed')
                                        @case('completed')
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                <i class="fas fa-check mr-1"></i> Complétée
                                            </span>
                                            @break
                                        @case('pending')
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1"></i> En attente
                                            </span>
                                            @break
                                        @case('cancelled')
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                <i class="fas fa-times mr-1"></i> Annulée
                                            </span>
                                            @break
                                        @default
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                {{ $vente->statut ?? 'Inconnu' }}
                                            </span>
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-700 mr-2" title="Voir les détails">
                                        <i class="fas fa-eye text-xl"></i>
                                    </button>
                                    <button onclick="openEditVenteModal({{ $vente->id }}, '{{ $vente->reference }}', '{{ $vente->date_vente }}', '{{ $vente->client->nom_client ?? '' }}', '{{ $vente->statut ?? 'completed' }}')" class="text-green-600 hover:text-green-700 mr-2" title="Modifier">
                                        <i class="fas fa-edit text-xl"></i>
                                    </button>
                                    <form id="delete-vente-form-{{ $vente->id }}" action="{{ route('ventes.suppression', $vente->id)}}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700" title="Supprimer" onclick="event.preventDefault(); confirmSuppressionVente({{ $vente->id }}, '{{ $vente->reference }}')">
                                            <i class="fas fa-trash text-xl"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-shopping-cart text-4xl mb-3 text-gray-300"></i>
                                    <p>Aucune vente trouvée</p>
                                    <p class="text-sm">Commencez par enregistrer une nouvelle vente</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($ventes->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $ventes->links() }}
                </div>
            @endif
        </div>
    </main>
    <div class="mb-10"></div>

</div>

<!-- Modal Nouvelle Vente -->
<div id="modalNouvelleVente" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-6 border w-[900px] shadow-lg rounded-md bg-white max-h-[90vh] overflow-y-auto">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Nouvelle Vente</h3>
                <button onclick="closeModal('modalNouvelleVente')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form class="space-y-4" method="POST" action="{{ route('ventes.ajout') }}" onsubmit="return validateStock()">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    {{-- <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                        <select name="client_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            <option value="">Sélectionner un client</option>
                            @if(isset($clients))
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->nom }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div> --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom du client</label>
                        <input type="text" name="nom_client" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Nom du client (optionnel)">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de vente</label>
                        <input type="date" name="date_vente" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                
                <div class="border-t pt-4">
                    <h4 class="text-md font-semibold text-gray-900 mb-3">Produits</h4>
                    
                    <!-- Zone de recherche de produits -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rechercher un produit</label>
                        <div class="relative">
                            <input type="text" id="produitSearch" placeholder="Tapez le nom ou le numéro de série du produit..." 
                                   class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                        
                        <!-- Résultats de recherche -->
                        <div id="searchResults" class="hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
                        </div>
                    </div>
                    
                    <div id="produits-container" class="space-y-3">
                        <!-- Les produits sélectionnés apparaîtront ici -->
                    </div>
                    
                    <button type="button" onclick="showProductSearch()" class="mt-3 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>
                        Ajouter un produit
                    </button>
                </div>
                
                <div class="flex justify-between items-center mt-6 pt-4 border-t">
                    <div class="text-lg font-semibold text-gray-900">
                        Total: <span id="grand-total">0.00</span> $
                    </div>
                    <div class="flex space-x-3">
                        <button type="button" onclick="closeModal('modalNouvelleVente')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Enregistrer la vente
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
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modification Vente -->
<div id="modalModificationVente" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-6 border w-[900px] shadow-lg rounded-md bg-white max-h-[90vh] overflow-y-auto">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Modifier la Vente</h3>
                <button onclick="closeModal('modalModificationVente')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editVenteForm" class="space-y-4" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="editVenteId" name="id">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Référence</label>
                        <input type="text" id="editReference" name="reference" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Référence de la vente" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom du client</label>
                        <input type="text" id="editNomClient" name="nom_client" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Nom du client">
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de vente</label>
                        <input type="date" id="editDateVente" name="date_vente" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                        <select id="editStatut" name="statut" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            <option value="completed">Complétée</option>
                            <option value="pending">En attente</option>
                            <option value="cancelled">Annulée</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeModal('modalModificationVente')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                        Mettre à jour la vente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Données des produits
    const produits = @json(isset($liste_produits) ? $liste_produits : []);
    console.log('Produits chargés:', produits);
    
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        // Cacher les résultats de recherche
        document.getElementById('searchResults').classList.add('hidden');
        document.getElementById('produitSearch').value = '';
    }

    // Fonction pour ouvrir le modal de modification de vente
    function openEditVenteModal(id, reference, dateVente, nomClient, statut) {
        // Remplir les champs du formulaire
        document.getElementById('editVenteId').value = id;
        document.getElementById('editReference').value = reference;
        document.getElementById('editNomClient').value = nomClient;
        document.getElementById('editDateVente').value = dateVente;
        document.getElementById('editStatut').value = statut;
        
        // Définir l'action du formulaire
        document.getElementById('editVenteForm').action = '/ventes/modification/' + id;
        
        // Ouvrir le modal
        openModal('modalModificationVente');
    }

    // Fonction de confirmation de suppression de vente
    function confirmSuppressionVente(venteId, venteReference) {
        Swal.fire({
            title: 'Confirmation de suppression',
            text: `Êtes-vous sûr de vouloir supprimer la vente "${venteReference}" ?`,
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
                const form = document.getElementById(`delete-vente-form-${venteId}`);
                if (form) {
                    form.submit();
                } else {
                    console.error('Formulaire de suppression non trouvé pour la vente ID:', venteId);
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

    // Gestion des produits dans le formulaire de vente
    let selectedProducts = [];
    let productRowCount = 0;

    function showProductSearch() {
        document.getElementById('produitSearch').focus();
    }

    // Recherche de produits
    document.getElementById('produitSearch')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const resultsContainer = document.getElementById('searchResults');
        
        if (searchTerm.length < 2) {
            resultsContainer.classList.add('hidden');
            return;
        }
        
        const filteredProducts = produits.filter(produit => {
            const nom = produit.nom.toLowerCase();
            const serie = produit.produit_unites && produit.produit_unites.length > 0 
                ? produit.produit_unites[0].numero_serie.toLowerCase() 
                : '';
            
            // Vérifier si le produit a des unités en stock
            const hasStock = produit.produit_unites && produit.produit_unites.some(unite => unite.statut === 'en_stock');
            
            return hasStock && (nom.includes(searchTerm) || serie.includes(searchTerm));
        });
        
        if (filteredProducts.length === 0) {
            resultsContainer.innerHTML = '<div class="p-3 text-gray-500 text-sm">Aucun produit en stock trouvé</div>';
        } else {
            resultsContainer.innerHTML = filteredProducts.map(produit => {
                // Filtrer les unités en stock et prendre la première pour le numéro de série
                const stockUnites = produit.produit_unites ? produit.produit_unites.filter(unite => unite.statut === 'en_stock') : [];
                const firstStockUnit = stockUnites.length > 0 ? stockUnites[0] : null;
                const serie = firstStockUnit ? firstStockUnit.numero_serie : 'N/A';
                const stockCount = stockUnites.length;
                
                // Échapper correctement les guillemets pour éviter les erreurs JavaScript
                const nomEscaped = (produit.nom || '').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
                const serieEscaped = (serie || '').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
                
                return `
                    <div class="p-3 hover:bg-gray-50 cursor-pointer border-b border-gray-100 last:border-b-0" 
                         onclick="selectProduct(${produit.id}, '${nomEscaped}', '${serieEscaped}', ${produit.prix_vente || 0})">
                        <div class="font-medium text-gray-900">${produit.nom}</div>
                        <div class="text-sm text-gray-500">Série: ${serie}</div>
                        <div class="text-sm font-medium text-green-600">Prix: ${produit.prix_vente || 0} $</div>
                        <div class="text-xs text-blue-600 mt-1">
                            <i class="fas fa-box"></i> ${stockCount} unité(s) en stock
                        </div>
                    </div>
                `;
            }).join('');
        }
        
        resultsContainer.classList.remove('hidden');
    });

    function selectProduct(id, nom, serie, prix) {
        console.log('selectProduct appelé avec:', { id, nom, serie, prix });
        
        // Vérifier si le produit est déjà sélectionné
        if (selectedProducts.find(p => p.id === id)) {
            alert('Ce produit est déjà ajouté');
            return;
        }
        
        // Trouver le produit et calculer le stock disponible
        const produit = produits.find(p => p.id === id);
        console.log('Produit trouvé:', produit);
        
        if (!produit) {
            alert('Produit non trouvé');
            return;
        }
        
        const stockUnites = produit.produit_unites ? produit.produit_unites.filter(unite => unite.statut === 'en_stock') : [];
        const stockDisponible = stockUnites.length;
        
        console.log('Stock disponible:', stockDisponible);
        
        productRowCount++;
        const productId = `product_${productRowCount}`;
        
        selectedProducts.push({
            id: id,
            nom: nom,
            serie: serie,
            prix: prix,
            rowId: productId,
            stockDisponible: stockDisponible
        });
        
        console.log('Produits sélectionnés:', selectedProducts);
        
        const container = document.getElementById('produits-container');
        const productRow = document.createElement('div');
        productRow.className = 'grid grid-cols-5 gap-1 items-center p-3 bg-gray-50 rounded-lg';
        productRow.id = productId;
        productRow.innerHTML = `
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Produit</label>
                <input type="hidden" name="produits[]" value="${id}">
                <div class="text-sm font-medium text-gray-900">${nom}</div>
                <div class="text-xs text-gray-500">Série: ${serie}</div>
                <div class="text-xs text-blue-600">
                    <i class="fas fa-box"></i> Stock: ${stockDisponible}
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Quantité</label>
                <input type="number" name="quantites[]" min="1" max="${stockDisponible}" value="1" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 readonly">
                <div class="text-xs text-blue-600">
                 
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Prix unitaire</label>
                <input type="number" name="prix_unitaires[]" step="0.01" min="0" value="${prix}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 prix-unitaire" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Total</label>
                <input type="number" name="totaux[]" step="0.01" min="0" value="${prix}" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 total-produit" readonly>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">-</label>
                <button type="button" onclick="removeProductRow('${productId}')" class="px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        
        container.appendChild(productRow);
        
        // Cacher les résultats de recherche et vider le champ
        document.getElementById('searchResults').classList.add('hidden');
        document.getElementById('produitSearch').value = '';
        
        // Attacher les écouteurs d'événements
        attachProductListeners();
        calculateGrandTotal();
    }

    function removeProductRow(rowId) {
        const row = document.getElementById(rowId);
        if (row) {
            // Retirer du tableau des produits sélectionnés
            selectedProducts = selectedProducts.filter(p => p.rowId !== rowId);
            row.remove();
            productRowCount--;
            calculateGrandTotal();
        }
    }

    function attachProductListeners() {
        const quantiteInputs = document.querySelectorAll('.quantite-input');
        const prixInputs = document.querySelectorAll('.prix-unitaire');
        
        quantiteInputs.forEach((input, index) => {
            input.oninput = () => calculateProductTotal(index);
        });
        
        prixInputs.forEach((input, index) => {
            input.oninput = () => calculateProductTotal(index);
        });
    }

    function calculateProductTotal(index) {
        const quantiteInputs = document.querySelectorAll('.quantite-input');
        const prixInputs = document.querySelectorAll('.prix-unitaire');
        const totalInputs = document.querySelectorAll('.total-produit');
        
        const quantite = parseFloat(quantiteInputs[index].value) || 0;
        const prixUnitaire = parseFloat(prixInputs[index].value) || 0;
        const total = quantite * prixUnitaire;
        totalInputs[index].value = total.toFixed(2);
        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        const totals = document.querySelectorAll('.total-produit');
        let grandTotal = 0;
        totals.forEach(total => {
            grandTotal += parseFloat(total.value) || 0;
        });
        document.getElementById('grand-total').textContent = grandTotal.toFixed(2);
    }

    // Fermer les résultats de recherche en cliquant ailleurs
    document.addEventListener('click', function(event) {
        const searchContainer = document.querySelector('.relative');
        if (!searchContainer.contains(event.target)) {
            document.getElementById('searchResults').classList.add('hidden');
        }
    });

    // Recherche dans le tableau des ventes
    document.getElementById('searchVentes')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('.vente-row');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Validation du stock avant soumission
    function validateStock() {
        const quantiteInputs = document.querySelectorAll('.quantite-input');
        const produitInputs = document.querySelectorAll('input[name="produits[]"]');
        
        for (let i = 0; i < quantiteInputs.length; i++) {
            const quantite = parseInt(quantiteInputs[i].value);
            const produitId = parseInt(produitInputs[i].value);
            const selectedProduct = selectedProducts.find(p => p.id === produitId);
            
            if (selectedProduct && quantite > selectedProduct.stockDisponible) {
                alert(`La quantité sélectionnée pour "${selectedProduct.nom}" (${quantite}) dépasse le stock disponible (${selectedProduct.stockDisponible}).`);
                quantiteInputs[i].focus();
                return false;
            }
        }
        
        return true;
    }

    // Initialisation
    document.addEventListener('DOMContentLoaded', function() {
        attachProductListeners();
        calculateGrandTotal();
    });
</script>
@endsection
