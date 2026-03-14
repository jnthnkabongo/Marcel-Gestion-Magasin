@extends('pages.layouts.entete')

@section('content')
<div class="flex h-screen bg-gray-50">

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-6">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Historiques</h1>
                        <p class="text-gray-600 text-sm">Suivi de toutes les activités système</p>
                    </div>
                    <div class="flex items-center space-x-4">
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
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-clock text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Aujourd'hui</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $historiquesAujourdhui ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-plus-circle text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Créations</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalCreations ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-edit text-yellow-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Modifications</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalModifications ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-trash text-red-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Suppressions</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalSuppressions ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Historiques Table -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900">Liste des activités</h2>
                        <div class="flex items-center space-x-4">
                            <input type="text" placeholder="Rechercher..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Toutes les actions</option>
                                <option value="creation">Création</option>
                                <option value="modification">Modification</option>
                                <option value="suppression">Suppression</option>
                            </select>
                            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Tous les utilisateurs</option>
                                @if(isset($users))
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date & Heure
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Utilisateur
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    IP Address
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse (isset($historiques) ? $historiques : [] as $historique)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div>
                                            <div class="font-medium">{{ $historique->created_at->format('d/m/Y') }}</div>
                                            <div class="text-gray-500">{{ $historique->created_at->format('H:i:s') }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                                <i class="fas fa-user text-gray-600 text-xs"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $historique->user->name ?? 'Inconnu' }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    {{ $historique->user->email ?? 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @switch($historique->action)
                                            @case('creation')
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    <i class="fas fa-plus mr-1"></i> Création
                                                </span>
                                                @break
                                            @case('modification')
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    <i class="fas fa-edit mr-1"></i> Modification
                                                </span>
                                                @break
                                            @case('suppression')
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    <i class="fas fa-trash mr-1"></i> Suppression
                                                </span>
                                                @break
                                            @default
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    {{ $historique->action }}
                                                </span>
                                        @endswitch
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="max-w-xs truncate">
                                            {{ $historique->description ?? 'Aucune description' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $historique->ip_address ?? 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                        <i class="fas fa-history text-4xl mb-3 text-gray-300"></i>
                                        <p>Aucun historique trouvé</p>
                                        <p class="text-sm">Les activités apparaîtront ici dès qu'elles seront enregistrées</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if(isset($historiques) && $historiques->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $historiques->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>

{{-- <style>
    .table-fixed {
        table-layout: fixed;
        width: 100%;
    }
    .col-date { width: 120px; }
    .col-user { width: 200px; }
    .col-action { width: 120px; }
    .col-description { width: 300px; }
    .col-ip { width: 120px; }
    
    .text-ellipsis {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style> --}}
@endsection