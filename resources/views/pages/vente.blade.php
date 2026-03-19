{{-- @extends('pages.layouts.entete')

@section('title', 'Ventes')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="flex h-screen bg-gray-50">
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
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-shopping-cart text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Aujourd'hui</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $ventesAujourdhui ?? 0 }}</p>
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
                        <p class="text-2xl font-bold text-gray-800">{{ $ventesMois ?? 0 }}</p>
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
                        <p class="text-2xl font-bold text-gray-800">{{ $totalVentes ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-receipt text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Revenu total</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $revenuTotal ?? 0 }} $</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ventes Table -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Liste des ventes</h2>
                    <div class="flex items-center space-x-4">
                        <input type="text" placeholder="Rechercher une vente..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
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
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    #{{ str_pad($vente->id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $vente->date_vente->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-gray-600 text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $vente->client->name ?? 'Client inconnu' }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $vente->client->email ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <div class="max-w-xs">
                                        @if($vente->venteDetails && $vente->venteDetails->isNotEmpty())
                                            {{ $vente->venteDetails->count() }} produit(s)
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    @if($vente->venteDetails && $vente->venteDetails->isNotEmpty())
                                        {{ number_format($vente->venteDetails->sum('prix_vente'), 2, ',', ' ') }} $
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
                                    <button class="text-green-600 hover:text-green-700 mr-2" title="Imprimer">
                                        <i class="fas fa-print text-xl"></i>
                                    </button>
                                    <button class="text-yellow-600 hover:text-yellow-700 mr-2" title="Modifier">
                                        <i class="fas fa-edit text-xl"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-700" title="Supprimer">
                                        <i class="fas fa-trash text-xl"></i>
                                    </button>
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
            @if(isset($ventes) && $ventes->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $ventes->links() }}
                </div>
            @endif
        </div>
    </main>
</div>

<!-- Modal Nouvelle Vente -->
<div id="modalNouvelleVente" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-6 border w-[800px] shadow-lg rounded-md bg-white max-h-[90vh] overflow-y-auto">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Nouvelle Vente</h3>
                <button onclick="closeModal('modalNouvelleVente')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form class="space-y-4" method="POST" action="{{ route('ventes.ajout') }}">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                        <select name="client_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            <option value="">Sélectionner un client</option>
                            @if(isset($clients))
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de vente</label>
                        <input type="date" name="date_vente" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Référence</label>
                    <input type="text" name="reference" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Référence de la vente (optionnel)">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" rows="3" placeholder="Description de la vente"></textarea>
                </div>
                
                <div class="border-t pt-4">
                    <h4 class="text-md font-semibold text-gray-900 mb-3">Produits</h4>
                    <div id="produits-container" class="space-y-3">
                        <div class="grid grid-cols-5 gap-4 items-center">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Produit</label>
                                <select name="produits[]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 produit-select" data-placeholder="Sélectionner un produit">
                                    <option value=""></option>
                                    @if(isset($liste_produits))
                                        @foreach($liste_produits as $produit)
                                            <option value="{{ $produit->id }}" data-nom="{{ $produit->nom }}" data-serie="{{ $produit->produitUnites->first()?->numero_serie ?? 'N/A' }}">
                                                {{ $produit->nom }} - {{ $produit->produitUnites->first()?->numero_serie ?? 'N/A' }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Quantité</label>
                                <input type="number" name="quantites[]" min="1" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 quantite-input" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Prix unitaire</label>
                                <input type="number" name="prix_unitaires[]" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 prix-unitaire" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Total</label>
                                <input type="number" name="totaux[]" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 total-produit" readonly>
                            </div>
                            <div>
                                <button type="button" onclick="removeProductRow(this)" class="px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="addProductRow()" class="mt-3 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
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
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        
        // Initialiser Select2 quand le modal s'ouvre
        if (modalId === 'modalNouvelleVente') {
            setTimeout(() => {
                initializeSelect2();
            }, 100);
        }
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function initializeSelect2() {
        // Détruire les instances existantes pour éviter les conflits
        $('.produit-select').select2('destroy').each(function() {
            $(this).select2({
                theme: 'bootstrap-5',
                placeholder: function() {
                    return $(this).data('placeholder');
                },
                allowClear: true,
                width: '100%',
                templateResult: function(option) {
                    if (!option.id) {
                        return option.text;
                    }
                    
                    const $option = $(
                        '<div class="d-flex justify-content-between align-items-center">' +
                            '<div>' +
                                '<strong>' + $(option.element).data('nom') + '</strong>' +
                                '<br>' +
                                '<small class="text-muted">Série: ' + $(option.element).data('serie') + '</small>' +
                            '</div>' +
                        '</div>'
                    );
                    return $option;
                },
                templateSelection: function(option) {
                    if (!option.id) {
                        return option.text;
                    }
                    
                    return $(option.element).data('nom') + ' - ' + $(option.element).data('serie');
                },
                matcher: function(params, data) {
                    // Si pas de terme de recherche, retourner tous les résultats
                    if ($.trim(params.term) === '') {
                        return data;
                    }
                    
                    // Recherche insensible à la casse
                    const term = params.term.toLowerCase();
                    
                    // Récupérer le nom et le numéro de série
                    const nom = $(data.element).data('nom')?.toLowerCase() || '';
                    const serie = $(data.element).data('serie')?.toLowerCase() || '';
                    
                    // Chercher dans le nom ou le numéro de série
                    if (nom.indexOf(term) !== -1 || serie.indexOf(term) !== -1) {
                        return data;
                    }
                    
                    return null;
                }
            });
        });
    }

    // Gestion des produits dans le formulaire de vente
    let productRowCount = 1;

    function addProductRow() {
        productRowCount++;
        const container = document.getElementById('produits-container');
        const newRow = document.createElement('div');
        newRow.className = 'grid grid-cols-5 gap-4 items-center';
        newRow.innerHTML = `
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Produit</label>
                <select name="produits[]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 produit-select" data-placeholder="Sélectionner un produit">
                    <option value=""></option>
                    @if(isset($liste_produits))
                        @foreach($liste_produits as $produit)
                            <option value="{{ $produit->id }}" data-nom="{{ $produit->nom }}" data-serie="{{ $produit->produitUnites->first()?->numero_serie ?? 'N/A' }}">
                                {{ $produit->nom }} - {{ $produit->produitUnites->first()?->numero_serie ?? 'N/A' }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Quantité</label>
                <input type="number" name="quantites[]" min="1" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 quantite-input" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Prix unitaire</label>
                <input type="number" name="prix_unitaires[]" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 prix-unitaire" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Total</label>
                <input type="number" name="totaux[]" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 total-produit" readonly>
            </div>
            <div>
                <button type="button" onclick="removeProductRow(this)" class="px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(newRow);
        
        // Réinitialiser Select2 pour la nouvelle ligne
        setTimeout(() => {
            $(newRow).find('.produit-select').select2({
                theme: 'bootstrap-5',
                placeholder: function() {
                    return $(this).data('placeholder');
                },
                allowClear: true,
                width: '100%',
                templateResult: function(option) {
                    if (!option.id) {
                        return option.text;
                    }
                    
                    const $option = $(
                        '<div class="d-flex justify-content-between align-items-center">' +
                            '<div>' +
                                '<strong>' + $(option.element).data('nom') + '</strong>' +
                                '<br>' +
                                '<small class="text-muted">Série: ' + $(option.element).data('serie') + '</small>' +
                            '</div>' +
                        '</div>'
                    );
                    return $option;
                },
                templateSelection: function(option) {
                    if (!option.id) {
                        return option.text;
                    }
                    
                    return $(option.element).data('nom') + ' - ' + $(option.element).data('serie');
                },
                matcher: function(params, data) {
                    if ($.trim(params.term) === '') {
                        return data;
                    }
                    
                    const term = params.term.toLowerCase();
                    const nom = $(data.element).data('nom')?.toLowerCase() || '';
                    const serie = $(data.element).data('serie')?.toLowerCase() || '';
                    
                    if (nom.indexOf(term) !== -1 || serie.indexOf(term) !== -1) {
                        return data;
                    }
                    
                    return null;
                }
            });
        }, 200);
        
        attachProductListeners();
        calculateGrandTotal();
    }

    function removeProductRow(button) {
        if (productRowCount > 1) {
            button.parentElement.remove();
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
        const quantite = parseFloat(document.querySelectorAll('.quantite-input')[index].value) || 0;
        const prixUnitaire = parseFloat(document.querySelectorAll('.prix-unitaire')[index].value) || 0;
        const total = quantite * prixUnitaire;
        document.querySelectorAll('.total-produit')[index].value = total.toFixed(2);
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

    // Initialisation
    document.addEventListener('DOMContentLoaded', function() {
        attachProductListeners();
        calculateGrandTotal();
        
        // Initialiser Select2 au chargement de la page
        setTimeout(() => {
            initializeSelect2();
        }, 100);
    });

    // Fermer les modals en cliquant à l'extérieur
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('bg-opacity-50')) {
            const modals = ['modalNouvelleVente'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (!modal.classList.contains('hidden')) {
                    closeModal(modalId);
                }
            });
        }
    });
</script>
@endsection --}}