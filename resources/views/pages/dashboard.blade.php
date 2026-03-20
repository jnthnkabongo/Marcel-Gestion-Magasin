@extends('pages.layouts.entete')

@section('content')
<!-- Main content -->
    <div class="flex-1 flex flex-col overflow-hidden">


        <!-- Main content area -->
        <main class="flex-1 overflow-y-auto p-6">
            <!-- Welcome section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Bienvenue sur votre tableau de bord</h1>
                <p class="text-gray-600">Voici un aperçu de votre activité commerciale</p>
            </div>

            <!-- Stats grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-users text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Utilisateurs</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalUtilisateurs }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-box text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Produits</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalProduts }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-shopping-cart text-yellow-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Ventes</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalVentes}}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-chart-line text-purple-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Revenus</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalClients }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphiques et Ventes du jour -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Graphique des ventes mensuelles -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Ventes mensuelles</h3>
                        <select class="text-sm border rounded-lg px-3 py-1">
                            <option>6 derniers mois</option>
                            <option>12 derniers mois</option>
                            <option>Cette année</option>
                        </select>
                    </div>
                    <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                        <canvas id="salesChart" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Graphique des produits populaires -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Produits populaires</h3>
                    <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                        <canvas id="productsChart" width="200" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Tableau des ventes du jour -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-800">Ventes du jour</h3>
                        <div class="flex items-center space-x-3">
                            <span class="text-sm text-gray-500">Total aujourd'hui:</span>
                            <span class="text-lg font-bold text-green-600">{{ $totalVentesAujourdhui }} $</span>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Client
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Produits
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Catégorie
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Modèle
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Heure
                                </th>
                                 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="salesTableBody">
                                @forelse($ventes as $vente)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{{ $vente->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                <i class="fas fa-user text-blue-600 text-sm"></i>
                                            </div>
                                            <div>
                                                {{-- <div class="font-medium text-gray-900">{{ $vente->client->nom ?? 'Client inconnu' }}</div> --}}
                                                <div class="font-medium text-gray-900">{{ $vente->nom_client ?? 'Client inconnu'}}</div>
                                                <div class="text-xs text-gray-500">ID: {{ $vente->client_id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $vente->venteDetails->count() }} produits
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $vente->venteDetails->first()->produitUnite && $vente->venteDetails->first()->produitUnite->produit && $vente->venteDetails->first()->produitUnite->produit->categorie ? $vente->venteDetails->first()->produitUnite->produit->categorie->nom : 'Non défini' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $vente->venteDetails->first()->produitUnite && $vente->venteDetails->first()->produitUnite->produit ? $vente->venteDetails->first()->produitUnite->produit->modele : 'Non défini' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full">
                                            {{ $vente->venteDetails->first()->produitUnite && $vente->venteDetails->first()->produitUnite->produit ? 
                                            $vente->venteDetails->first()->produitUnite->produit->nom : 'Non défini' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        {{ number_format($vente->total, 0, ',', ' ') }} $
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @switch($vente->statut)
                                            @case('terminé')
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Terminé
                                                </span>
                                                @break
                                            @case('en_cours')
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    En cours
                                                </span>
                                                @break
                                            @case('annulé')
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Annulé
                                                </span>
                                                @break
                                            @default
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    {{ $vente->statut }}
                                                </span>
                                        @endswitch
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <i class="fas fa-clock text-gray-400 mr-2"></i>
                                            {{ $vente->created_at->format('H:i') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <i class="fas fa-clock text-gray-400 mr-2"></i>
                                            {{ $vente->created_at->format('d/m/Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button onclick="showVenteDetails({{ $vente->id }})" class="px-3 py-1 bg-blue-500 text-white rounded-md text-sm hover:bg-blue-600 transition-colors duration-200">
                                            <i class="fas fa-eye mr-1"></i>
                                            Voir
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                                            <i class="fas fa-shopping-cart text-4xl mb-3 text-gray-300"></i>
                                            <p>Aucune vente aujourd'hui</p>
                                            <p class="text-sm">Les ventes apparaîtront ici dès qu'elles seront enregistrées</p>
                                        </td>
                                    </tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Affichage de <span class="font-medium">0</span> à <span class="font-medium">0</span> sur <span class="font-medium">0</span> résultats
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-500 hover:bg-gray-50 disabled:opacity-50" disabled>
                            Précédent
                        </button>
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-500 hover:bg-gray-50 disabled:opacity-50" disabled>
                            Suivant
                        </button>
                    </div>
                </div>
            </div>          
        </main>
    </div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Graphique des ventes mensuelles
const salesCtx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(salesCtx, {
    type: 'line',
    data: {
        labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin'],
        datasets: [{
            label: 'Ventes (FCFA)',
            data: [1200000, 1900000, 1500000, 2500000, 2200000, 3000000],
            borderColor: 'rgb(99, 102, 241)',
            backgroundColor: 'rgba(99, 102, 241, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value.toLocaleString() + ' FCFA';
                    }
                }
            }
        }
    }
});

// Graphique des produits populaires
const productsCtx = document.getElementById('productsChart').getContext('2d');
const productsChart = new Chart(productsCtx, {
    type: 'doughnut',
    data: {
        labels: ['Produit A', 'Produit B', 'Produit C', 'Produit D'],
        datasets: [{
            data: [30, 25, 20, 25],
            backgroundColor: [
                'rgb(99, 102, 241)',
                'rgb(34, 197, 94)',
                'rgb(250, 204, 21)',
                'rgb(168, 85, 247)'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

// Fonction pour charger les ventes du jour
function loadTodaySales() {
    const token = localStorage.getItem('auth_token');
    
    fetch('http://127.0.0.1:8001/api/ventes/aujourdhui', {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.ventes.length > 0) {
            displaySales(data.ventes);
            updateTotal(data.total);
        }
    })
    .catch(error => {
        console.error('Erreur lors du chargement des ventes:', error);
    });
}

// Fonction pour afficher les ventes dans le tableau
function displaySales(sales) {
    const tbody = document.getElementById('salesTableBody');
    
    if (sales.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                    <i class="fas fa-shopping-cart text-4xl mb-3 text-gray-300"></i>
                    <p>Aucune vente aujourd'hui</p>
                    <p class="text-sm">Les ventes apparaîtront ici dès qu'elles seront enregistrées</p>
                </td>
            </tr>
        `;
        return;
    }
    
    tbody.innerHTML = sales.map(sale => `
        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                #${sale.id}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                ${sale.client_nom || 'Client anonyme'}
            </td>
            <td class="px-6 py-4 text-sm text-gray-900">
                <div class="max-w-xs truncate">
                    ${sale.produits.map(p => p.nom).join(', ')}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                ${sale.produits.reduce((sum, p) => sum + p.quantite, 0)}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">
                ${sale.total.toLocaleString()} FCFA
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Complété
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                ${new Date(sale.created_at).toLocaleTimeString('fr-FR', {hour: '2-digit', minute: '2-digit'})}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button class="text-indigo-600 hover:text-indigo-900 mr-3">Voir</button>
                <button class="text-gray-600 hover:text-gray-900">Modifier</button>
            </td>
        </tr>
    `).join('');
}

// Fonction pour mettre à jour le total
function updateTotal(total) {
    const totalElement = document.querySelector('.text-green-600');
    if (totalElement) {
        totalElement.textContent = total.toLocaleString() + ' FCFA';
    }
}

// Charger les ventes au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    loadTodaySales();
});
</script>
@endsection
