@extends('pages.layouts.entete')

@section('content')
<div class="flex-1 flex flex-col overflow-hidden">
    <main class="flex-1 overflow-y-auto p-6">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Rapport de Ventes</h1>
            <p class="text-gray-600">Analyse des bénéfices par produit et vue d'ensemble</p>
        </div>

       

        <!-- Cartes de bénéfices généraux -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Bénéfice total -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Bénéfice Total</h3>
                    <i class="fas fa-chart-line text-2xl opacity-80"></i>
                </div>
                <div class="text-3xl font-bold">{{ number_format($beneficeTotal, 0, ',', ' ') }} $</div>
                <div class="text-sm opacity-90 mt-2">
                    Cumul des bénéfices
                </div>
            </div>

            <!-- Nombre de ventes -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Total Ventes</h3>
                    <i class="fas fa-shopping-cart text-2xl opacity-80"></i>
                </div>
                <div class="text-3xl font-bold">{{ $totalVentes }}</div>
                <div class="text-sm opacity-90 mt-2">
                    Transactions effectuées
                </div>
            </div>

            <!-- Bénéfice moyen -->
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Bénéfice Moyen</h3>
                    <i class="fas fa-calculator text-2xl opacity-80"></i>
                </div>
                <div class="text-3xl font-bold">{{ number_format($beneficeMoyen, 0, ',', ' ') }} $</div>
                <div class="text-sm opacity-90 mt-2">
                    Par vente
                </div>
            </div>

            <!-- Produit le plus rentable -->
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Meilleur Produit</h3>
                    <i class="fas fa-trophy text-2xl opacity-80"></i>
                </div>
                <div class="text-xl font-bold">{{ $meilleurProduit['nom'] ?? 'N/A' }}</div>
                <div class="text-sm opacity-90 mt-2">
                    {{ number_format($meilleurProduit['benefice'] ?? 0, 0, ',', ' ') }} $
                </div>
            </div>
        </div>

         <!-- Filtres -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <form method="GET" action="" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date début</label>
                    <input type="date" name="date_debut" value="" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date fin</label>
                    <input type="date" name="date_fin" value="" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Produit</label>
                    <select name="produit_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Tous les produits</option>
                        
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                        <i class="fas fa-filter mr-2"></i>
                        Filtrer
                    </button>
                </div>
            </form>
        </div>

        <!-- Tableau des bénéfices par produit -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Détail des Bénéfices par Produit</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N°</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Vente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Numéro Série</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix Unitaire</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Ventes</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Coût Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bénéfice</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marge</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($produitRapports as $index => $Rapport)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $Rapport['nom'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $Rapport['date_vente'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $Rapport['numero_serie'] }}</td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($Rapport['cout_total'], 0, ',', ' ') }} $</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($Rapport['total_ventes'], 0, ',', ' ') }} $</td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($Rapport['prix_unitaire'], 0, ',', ' ') }} $</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="{{ $Rapport['benefice'] > 0 ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                                        {{ number_format($Rapport['benefice'], 0, ',', ' ') }} $
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="{{ $Rapport['marge'] > 50 ? 'text-green-600' : ($Rapport['marge'] > 20 ? 'text-yellow-600' : 'text-red-600') }}">
                                        {{ number_format($Rapport['marge'], 1) }}%
                                    </span>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-chart-bar text-4xl mb-3 text-gray-300"></i>
                                <p class="text-lg">Aucune donnée trouvée pour cette période</p>
                                <p class="text-sm">Essayez de modifier les filtres ou la période</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection