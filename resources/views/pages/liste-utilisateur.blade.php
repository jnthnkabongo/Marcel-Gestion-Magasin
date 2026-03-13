@extends('pages.layouts.entete')

@section('content')
<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Top navigation -->
    <header class="bg-white shadow-sm border-b">
        <div class="flex items-center justify-between px-6 py-4">
            <div class="flex items-center space-x-4">
                <button onclick="toggleSidebar()" class="text-gray-500 hover:text-gray-700 lg:hidden">
                    <i class="fas fa-bars"></i>
                </button>
                <h2 class="text-2xl font-semibold text-gray-800">Utilisateurs</h2>
            </div>
            
            <div class="flex items-center space-x-4">
                <!-- Notifications -->
                <button class="relative text-gray-500 hover:text-gray-700">
                    <i class="fas fa-bell"></i>
                    <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
                
                <!-- Search -->
                <div class="hidden md:flex items-center bg-gray-100 rounded-lg px-3 py-2">
                    <i class="fas fa-search text-gray-400 mr-2"></i>
                    <input type="text" placeholder="Rechercher un utilisateur..." class="bg-transparent outline-none text-sm w-48" id="searchInput">
                </div>
                
                <!-- User menu -->
                <div class="relative">
                    <button onclick="toggleDropdown(event)" class="flex items-center space-x-3 hover:bg-gray-100 rounded-lg px-3 py-2 transition-colors">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-medium text-gray-700" id="topUserName">Utilisateur</p>
                            <p class="text-xs text-gray-500">En ligne</p>
                        </div>
                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-gray-600 text-sm"></i>
                        </div>
                        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main content area -->
    <main class="flex-1 overflow-y-auto p-6">
        <!-- Header section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Gestion des utilisateurs</h1>
                    <p class="text-gray-600">Consultez et gérez tous les utilisateurs du système</p>
                </div>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center">
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
                        <p class="text-2xl font-bold text-gray-800" id="totalUsers">0</p>
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
                        <p class="text-2xl font-bold text-gray-800" id="adminCount">0</p>
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
                        <p class="text-2xl font-bold text-gray-800" id="activeCount">0</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <div class="flex flex-wrap items-center gap-4">
                <div class="flex items-center space-x-2">
                    <label class="text-sm font-medium text-gray-700">Rôle:</label>
                    <select class="border border-gray-300 rounded-lg px-3 py-1 text-sm" id="roleFilter">
                        <option value="">Tous les rôles</option>
                        <option value="admin">Administrateur</option>
                        <option value="user">Utilisateur</option>
                        <option value="manager">Manager</option>
                    </select>
                </div>
                
                <div class="flex items-center space-x-2">
                    <label class="text-sm font-medium text-gray-700">Statut:</label>
                    <select class="border border-gray-300 rounded-lg px-3 py-1 text-sm" id="statusFilter">
                        <option value="">Tous les statuts</option>
                        <option value="active">Actif</option>
                        <option value="inactive">Inactif</option>
                    </select>
                </div>
                
                <div class="flex items-center space-x-2">
                    <label class="text-sm font-medium text-gray-700">Par page:</label>
                    <select class="border border-gray-300 rounded-lg px-3 py-1 text-sm" id="perPageFilter">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                
                <button onclick="resetFilters()" class="text-sm text-gray-600 hover:text-gray-800">
                    <i class="fas fa-redo mr-1"></i>
                    Réinitialiser
                </button>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="sortTable('name')">
                                Utilisateur <i class="fas fa-sort text-gray-400 ml-1"></i>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="sortTable('email')">
                                Email <i class="fas fa-sort text-gray-400 ml-1"></i>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rôle
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="sortTable('created_at')">
                                Date de création <i class="fas fa-sort text-gray-400 ml-1"></i>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Dernière connexion
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="usersTableBody">
                        <!-- Les utilisateurs seront chargés ici -->
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-users text-4xl mb-3 text-gray-300"></i>
                                <p>Chargement des utilisateurs...</p>
                                <p class="text-sm">Veuillez patienter</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Affichage de <span class="font-medium">1</span> à <span class="font-medium">10</span> sur <span class="font-medium">0</span> résultats
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

<script>
// Données d'exemple (remplacer par appel API)
let users = [];
let filteredUsers = [];
let currentSort = { field: null, direction: 'asc' };

// Charger les utilisateurs
function loadUsers() {
    const token = localStorage.getItem('auth_token');
    
    // Simulation de données pour l'exemple
    users = [
        {
            id: 1,
            name: 'Jean Dupont',
            email: 'jean.dupont@example.com',
            role: { nom: 'Administrateur' },
            status: 'active',
            created_at: '2024-01-15',
            last_login: '2024-03-13 10:30'
        },
        {
            id: 2,
            name: 'Marie Martin',
            email: 'marie.martin@example.com',
            role: { nom: 'Manager' },
            status: 'active',
            created_at: '2024-02-20',
            last_login: '2024-03-13 09:15'
        },
        {
            id: 3,
            name: 'Pierre Bernard',
            email: 'pierre.bernard@example.com',
            role: { nom: 'Utilisateur' },
            status: 'inactive',
            created_at: '2024-03-01',
            last_login: '2024-03-10 14:20'
        },
        {
            id: 4,
            name: 'Sophie Petit',
            email: 'sophie.petit@example.com',
            role: { nom: 'Utilisateur' },
            status: 'active',
            created_at: '2024-03-05',
            last_login: '2024-03-13 11:45'
        },
        {
            id: 5,
            name: 'Lucas Robert',
            email: 'lucas.robert@example.com',
            role: { nom: 'Manager' },
            status: 'active',
            created_at: '2024-02-10',
            last_login: '2024-03-12 16:30'
        }
    ];
    
    // En production, faire un appel API:
    /*
    fetch('http://127.0.0.1:8001/api/users', {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        users = data.users;
        applyFilters();
        updateStats();
    })
    .catch(error => {
        console.error('Erreur lors du chargement des utilisateurs:', error);
    });
    */
    
    applyFilters();
    updateStats();
}

// Mettre à jour les statistiques
function updateStats() {
    const totalUsers = users.length;
    const adminCount = users.filter(u => u.role.nom === 'Administrateur').length;
    const activeCount = users.filter(u => u.status === 'active').length;
    
    document.getElementById('totalUsers').textContent = totalUsers;
    document.getElementById('adminCount').textContent = adminCount;
    document.getElementById('activeCount').textContent = activeCount;
}

// Appliquer les filtres
function applyFilters() {
    const roleFilter = document.getElementById('roleFilter').value;
    const statusFilter = document.getElementById('statusFilter').value;
    const searchFilter = document.getElementById('searchInput').value.toLowerCase();
    
    filteredUsers = users.filter(user => {
        const matchRole = !roleFilter || user.role.nom.toLowerCase().includes(roleFilter.toLowerCase());
        const matchStatus = !statusFilter || user.status === statusFilter;
        const matchSearch = !searchFilter || 
            user.name.toLowerCase().includes(searchFilter) ||
            user.email.toLowerCase().includes(searchFilter);
        
        return matchRole && matchStatus && matchSearch;
    });
    
    displayUsers();
}

// Afficher les utilisateurs dans le tableau
function displayUsers() {
    const tbody = document.getElementById('usersTableBody');
    
    if (filteredUsers.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                    <i class="fas fa-users text-4xl mb-3 text-gray-300"></i>
                    <p>Aucun utilisateur trouvé</p>
                    <p class="text-sm">Essayez de modifier vos filtres</p>
                </td>
            </tr>
        `;
        return;
    }
    
    tbody.innerHTML = filteredUsers.map(user => `
        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
                <input type="checkbox" class="rounded border-gray-300" value="${user.id}">
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-user text-gray-600 text-sm"></i>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-900">${user.name}</div>
                        <div class="text-xs text-gray-500">ID: ${user.id}</div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                ${user.email}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${
                    user.role.nom === 'Administrateur' ? 'bg-red-100 text-red-800' :
                    user.role.nom === 'Manager' ? 'bg-blue-100 text-blue-800' :
                    'bg-gray-100 text-gray-800'
                }">
                    ${user.role.nom}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${
                    user.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'
                }">
                    ${user.status === 'active' ? 'Actif' : 'Inactif'}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                ${new Date(user.created_at).toLocaleDateString('fr-FR')}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                ${user.last_login ? new Date(user.last_login).toLocaleString('fr-FR', {
                    day: '2-digit',
                    month: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit'
                }) : 'Jamais'}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button class="text-indigo-600 hover:text-indigo-900 mr-3">Voir</button>
                <button class="text-gray-600 hover:text-gray-900 mr-3">Modifier</button>
                <button class="text-red-600 hover:text-red-900" onclick="deleteUser(${user.id})">Supprimer</button>
            </td>
        </tr>
    `).join('');
    
    updatePagination();
}

// Trier le tableau
function sortTable(field) {
    if (currentSort.field === field) {
        currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
    } else {
        currentSort.field = field;
        currentSort.direction = 'asc';
    }
    
    filteredUsers.sort((a, b) => {
        let aVal = a[field];
        let bVal = b[field];
        
        if (field === 'created_at') {
            aVal = new Date(aVal);
            bVal = new Date(bVal);
        }
        
        if (aVal < bVal) return currentSort.direction === 'asc' ? -1 : 1;
        if (aVal > bVal) return currentSort.direction === 'asc' ? 1 : -1;
        return 0;
    });
    
    displayUsers();
}

// Réinitialiser les filtres
function resetFilters() {
    document.getElementById('roleFilter').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('searchInput').value = '';
    document.getElementById('perPageFilter').value = '10';
    
    applyFilters();
}

// Supprimer un utilisateur
function deleteUser(userId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
        const token = localStorage.getItem('auth_token');
        
        // En production, faire un appel API:
        /*
        fetch(`http://127.0.0.1:8001/api/users/${userId}`, {
            method: 'DELETE',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                users = users.filter(u => u.id !== userId);
                applyFilters();
                updateStats();
            }
        })
        .catch(error => {
            console.error('Erreur lors de la suppression:', error);
        });
        */
        
        // Simulation pour l'exemple
        users = users.filter(u => u.id !== userId);
        applyFilters();
        updateStats();
    }
}

// Mettre à jour la pagination
function updatePagination() {
    const perPage = parseInt(document.getElementById('perPageFilter').value);
    const total = filteredUsers.length;
    const start = Math.min(1, total);
    const end = Math.min(perPage, total);
    
    document.querySelector('.text-gray-700').innerHTML = `
        Affichage de <span class="font-medium">${start}</span> à <span class="font-medium">${end}</span> sur <span class="font-medium">${total}</span> résultats
    `;
}

// Écouteurs d'événements
document.addEventListener('DOMContentLoaded', function() {
    loadUsers();
    
    // Écouteurs pour les filtres
    document.getElementById('roleFilter').addEventListener('change', applyFilters);
    document.getElementById('statusFilter').addEventListener('change', applyFilters);
    document.getElementById('searchInput').addEventListener('input', applyFilters);
    document.getElementById('perPageFilter').addEventListener('change', applyFilters);
});
</script>
@endsection