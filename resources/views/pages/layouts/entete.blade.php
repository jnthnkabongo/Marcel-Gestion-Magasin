<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestion Marcel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar-item:hover {
            transform: translateX(4px);
        }
        .sidebar-item.active {
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.1) 0%, transparent 100%);
            border-left: 3px solid #6366f1;
        }
        .dropdown-menu {
            transform-origin: top right;
            transition: all 0.2s ease;
        }
        .dropdown-menu.hidden {
            opacity: 0;
            transform: scale(0.95);
            pointer-events: none;
        }
        .dropdown-menu.show {
            opacity: 1;
            transform: scale(1);
            pointer-events: auto;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg flex-shrink-0">
            <div class="p-6">
                <!-- Logo -->
                <div class="flex items-center space-x-3 mb-8">
                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-store text-white"></i>
                    </div>
                    <h1 class="text-xl font-bold text-gray-800">Marcel</h1>
                </div>

                <!-- Navigation -->
                <nav class="space-y-2">
                    <a href="#" class="sidebar-item active flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <i class="fas fa-home w-5"></i>
                        <span>Tableau de bord</span>
                    </a>
                    
                    <div class="pt-4 pb-2">
                        <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Gestion</h3>
                    </div>
                    
                    <a href="#" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <i class="fas fa-users w-5"></i>
                        <span>Clients</span>
                    </a>
                    
                    <a href="#" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <i class="fas fa-truck w-5"></i>
                        <span>Fournisseurs</span>
                    </a>

                    <a href="#" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <i class="fas fa-user w-5"></i>
                        <span>Utilisateurs</span>
                    </a>
                    
                    <a href="#" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <i class="fas fa-box w-5"></i>
                        <span>Produits</span>
                    </a>
                    
                    <a href="#" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <i class="fas fa-shopping-cart w-5"></i>
                        <span>Ventes</span>
                    </a>
                    
                    <a href="#" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <i class="fas fa-warehouse w-5"></i>
                        <span>Stock</span>
                    </a>
                    
                    <div class="pt-4 pb-2">
                        <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Système</h3>
                    </div>
                    
                    <a href="#" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <i class="fas fa-cog w-5"></i>
                        <span>Paramètres</span>
                    </a>
                    
                    <a href="#" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <i class="fas fa-history w-5"></i>
                        <span>Historique</span>
                    </a>
                </nav>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            @yield('content')    
        </div>
    </div>

    <!-- Dropdown Menu -->
    <div id="userDropdown" class="dropdown-menu hidden fixed top-16 right-6 w-64 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
        <div class="p-4 border-b border-gray-100">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-gray-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900" id="dropdownUserName">Utilisateur</p>
                    <p class="text-xs text-gray-500">Administrateur</p>
                </div>
            </div>
        </div>
        
        <div class="py-2">
            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                <i class="fas fa-user-circle w-5 mr-3 text-gray-400"></i>
                Mon profil
            </a>
            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                <i class="fas fa-cog w-5 mr-3 text-gray-400"></i>
                Paramètres
            </a>
            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                <i class="fas fa-bell w-5 mr-3 text-gray-400"></i>
                Notifications
                <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1">3</span>
            </a>
        </div>
        
        <div class="py-2 border-t border-gray-100">
            <button onclick="logout()" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                <i class="fas fa-sign-out-alt w-5 mr-3"></i>
                Déconnexion
            </button>
        </div>
    </div>

    <script>

        // Toggle dropdown
        function toggleDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('userDropdown');
            
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                setTimeout(() => dropdown.classList.add('show'), 10);
            } else {
                dropdown.classList.remove('show');
                setTimeout(() => dropdown.classList.add('hidden'), 200);
            }
        }

        // Fermer le dropdown quand on clique ailleurs
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const userMenu = document.querySelector('[onclick="toggleDropdown(event)"]');
            
            if (!dropdown.contains(event.target) && (!userMenu || !userMenu.contains(event.target))) {
                dropdown.classList.remove('show');
                setTimeout(() => dropdown.classList.add('hidden'), 200);
            }
        });

        // Toggle sidebar (mobile)
        function toggleSidebar() {
            const sidebar = document.querySelector('aside');
            sidebar.classList.toggle('hidden');
        }

        // Déconnexion
        function logout() {
            const token = localStorage.getItem('auth_token');
            
            fetch('http://127.0.0.1:8001/api/logout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => response.json())
            .then(data => {
                localStorage.removeItem('auth_token');
                localStorage.removeItem('user');
                window.location.href = '/';
            })
            .catch(error => {
                localStorage.removeItem('auth_token');
                localStorage.removeItem('user');
                window.location.href = '/';
            });
        }

        // Activer le menu item courant
        document.addEventListener('DOMContentLoaded', function() {
            checkAuth();
            
            // Ajouter l'active class au menu item courant
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.sidebar-item');
            
            menuItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    // Retirer la classe active de tous les items
                    menuItems.forEach(i => i.classList.remove('active'));
                    // Ajouter la classe active à l'item cliqué
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>
