@extends('pages.layouts.entete')

@section('content')
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Main content area -->
        <main class="flex-1 overflow-y-auto p-6">
            <!-- Header section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Gestion des utilisateurs</h1>
                        <p class="text-gray-600">Consultez et gérez tous les utilisateurs du système</p>
                    </div>
                    <button onclick="openModal('modalNouveauUtilisateur')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Nouvel utilisateur
                    </button>
                </div>
            </div>

            <!-- Stats cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-users text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Total utilisateurs</p>
                            <p class="text-2xl font-bold text-gray-800">{{ count($users) }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user-shield text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Administrateurs</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $administrateurs }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-purple-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Utilisateurs actifs</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $users->where('status', 'active')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users table -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-800">Liste des utilisateurs</h3>
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
                                    <input type="checkbox" class="rounded border-gray-300">
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Utilisateur
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rôle
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date de création
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dernière connexion
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="rounded border-gray-300" value="{{ $user->id }}">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                                <i class="fas fa-user text-gray-600 text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                <div class="text-xs text-gray-500">ID: {{ $user->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $user->role->nom === 'admin' ? 'bg-red-100 text-red-800' : 
                                               ($user->role->nom === 'Manager' ? 'bg-blue-100 text-blue-800' : 
                                               'bg-gray-100 text-gray-800') }}">
                                            {{ $user->role->nom }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $user->last_login ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $user->last_login ? 'Actif' : 'Inactif' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->last_login ? $user->last_login->format('d/m/Y H:i') : 'Jamais' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-1"> 
                                             <a class="px-3 py-1 bg-blue-500 text-white rounded-md text-sm hover:bg-blue-600 transition-colors duration-200" href="#">
                                                <i class="fas fa-eye mr-1"></i>
                                                Voir
                                            </a>
                                            <a class="px-3 py-1 bg-orange-500 text-white rounded-md text-sm hover:bg-orange-600 transition-colors duration-200" href="#">
                                                <i class="fas fa-edit mr-1"></i>
                                                Modifier
                                            </a>
                                            <form action="{{ route('utilisateurs.suppression', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-md text-sm hover:bg-red-600 transition-colors duration-200" onclick="event.preventDefault(); confirmSuppression({{ $user->id }}, '{{ $user->name }}')">Supprimer</button>
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
                                       
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                        <i class="fas fa-users text-4xl mb-3 text-gray-300"></i>
                                        <p>Aucun utilisateur trouvé</p>
                                        <p class="text-sm">Commencez par ajouter un nouvel utilisateur</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                {{-- @if ($users->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $users->links() }}
                    </div>
                @endif --}}
            </div>
        </main>
        <div class="mb-10"></div>
    </div>

    <!-- Modal Nouveau Utilisateur-->
    <div id="modalNouveauUtilisateur" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-10 mx-auto p-6 border w-[800px] shadow-lg rounded-md bg-white max-h-[150vh] overflow-y-auto">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Nouveau Utilisateur</h3>
                    <button onclick="closeModal('modalNouveauUtilisateur')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form class="space-y-4" method="POST" action="{{ route('utilisateurs.ajout')}}">
                    @csrf
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet utilisateur</label>
                            <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Entrez le nom" required>
                        </div>
                         <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">E-mail utilisateur</label>
                            <input type="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Entrez l'e-mail" required>
                        </div>
                         <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                            <input type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Entrez le mot de passe" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rôle</label>
                            <select name="role_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="">Sélectionner le rôle</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    
                   
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeModal('modalNouveauUtilisateur')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
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

       <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }

        // Fermer les modals en cliquant à l'extérieur
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('bg-opacity-50')) {
                const modals = ['modalNouveauUtilisateur']; // Uniquement les modals qui existent
                modals.forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (modal && !modal.classList.contains('hidden')) { // Vérifier si modal existe
                        closeModal(modalId);
                    }
                });
            }
        });

        // Fonction de confirmation avec SweetAlert2
        function confirmSuppression(userId, userName) {
            Swal.fire({
                title: 'Confirmation de suppression',
                text: `Êtes-vous sûr de vouloir supprimer l'utilisateur "${userName}" ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Soumettre le formulaire de suppression
                    const form = document.querySelector(`form[action*="${userId}"]`);
                    if (form) {
                        form.submit();
                    }
                }
            });
        }
    </script>
@endsection