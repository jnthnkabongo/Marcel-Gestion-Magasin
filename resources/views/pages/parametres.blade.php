@extends('pages.layouts.entete')

@section('content')
<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Main content area -->
    <main class="flex-1 overflow-y-auto p-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Paramètres</h1>
                    <p class="text-gray-600">Configurez votre espace de travail</p>
                </div>
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                        <i class="fas fa-undo mr-2"></i>
                        Réinitialiser
                    </button>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Tout sauvegarder
                    </button>
                </div>
            </div>
        </div>

        <!-- Settings Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- Profil utilisateur -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Profil</h3>
                            <p class="text-sm text-gray-500">Informations personnelles</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Photo de profil</label>
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-gray-400 text-2xl"></i>
                            </div>
                            <button class="px-3 py-1 bg-blue-100 text-blue-600 rounded-md text-sm hover:bg-blue-200">
                                Changer
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="Administrateur">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="admin@marcelgestion.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                        <input type="tel" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="+242 000 000 000">
                    </div>
                </div>
            </div>

            <!-- Sécurité -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-shield-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Sécurité</h3>
                            <p class="text-sm text-gray-500">Protection du compte</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm text-gray-600">•••••••••</span>
                            <button onclick="openModal('modalPassword')" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                Modifier
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Authentification 2FA</label>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm text-gray-600">Désactivé</span>
                            <button class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                Activer
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sessions actives</label>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                <div class="flex items-center">
                                    <i class="fas fa-laptop text-gray-400 mr-2"></i>
                                    <div>
                                        <p class="text-sm font-medium">Chrome - Windows</p>
                                        <p class="text-xs text-gray-500">Il y a 2 heures</p>
                                    </div>
                                </div>
                                <button class="text-red-600 hover:text-red-700 text-sm">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                <div class="flex items-center">
                                    <i class="fas fa-mobile text-gray-400 mr-2"></i>
                                    <div>
                                        <p class="text-sm font-medium">Safari - iPhone</p>
                                        <p class="text-xs text-gray-500">Il y a 1 jour</p>
                                    </div>
                                </div>
                                <button class="text-red-600 hover:text-red-700 text-sm">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Entreprise -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-building text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Entreprise</h3>
                            <p class="text-sm text-gray-500">Informations professionnelles</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom de l'entreprise</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" value="Marcel Gestion">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Secteur d'activité</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option>Commerce de détail</option>
                            <option>Services</option>
                            <option>Manufacturier</option>
                            <option>Autre</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" rows="2" placeholder="Adresse complète"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone professionnel</label>
                        <input type="tel" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="+242 000 000 000">
                    </div>
                </div>
            </div>

            <!-- Support -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-headset text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Support</h3>
                            <p class="text-sm text-gray-500">Aide et assistance</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-question-circle text-indigo-600 text-3xl"></i>
                        </div>
                        <h4 class="font-medium text-gray-900 mb-2">Besoin d'aide ?</h4>
                        <p class="text-sm text-gray-600 mb-4">Notre équipe est disponible pour vous assister</p>
                    </div>
                    <div class="space-y-2">
                        <button class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            <i class="fas fa-comments mr-2"></i>
                            Chat en direct
                        </button>
                        <button class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                            <i class="fas fa-envelope mr-2"></i>
                            Envoyer un email
                        </button>
                        <button class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                            <i class="fas fa-book mr-2"></i>
                            Documentation
                        </button>
                    </div>
                </div>
            </div>

            <!-- Marques -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-pink-600 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-trademark text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Marques</h3>
                                <p class="text-sm text-gray-500">Gestion des marques</p>
                            </div>
                        </div>
                        {{-- <button class="px-3 py-1 bg-pink-600 text-white rounded-lg text-sm hover:bg-pink-700">
                            <i class="fas fa-plus mr-1"></i>
                            Ajouter
                        </button> --}}
                    </div>
                </div>
                <div class="p-6">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-sm font-medium text-gray-700 border-b">
                                <th class="pb-3">Marque</th>
                                <th class="pb-3">Produits</th>
                                <th class="pb-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="space-y-2">
                            @forelse ($marques as $marque)
                              <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-mobile-alt text-blue-600 text-sm"></i>
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $marque->nom }}</span>
                                    </div>
                                </td>
                                <td class="py-3 text-sm text-gray-500">{{ $marque->description }} produits</td>
                                <td class="py-3 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <button class="text-blue-600 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-mobile-alt text-blue-600 text-sm"></i>
                                        </div>
                                        <span class="font-medium text-gray-900">Aucune marque trouvée</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                          
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Catégories -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-tags text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Catégories</h3>
                                <p class="text-sm text-gray-500">Gestion des catégories</p>
                            </div>
                        </div>
                        {{-- <button class="px-3 py-1 bg-orange-600 text-white rounded-lg text-sm hover:bg-orange-700">
                            <i class="fas fa-plus mr-1"></i>
                            Ajouter
                        </button> --}}
                    </div>
                </div>
                <div class="p-6">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-sm font-medium text-gray-700 border-b">
                                <th class="pb-3">Catégorie</th>
                                <th class="pb-3">Produits</th>
                                <th class="pb-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $categorie) 
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-laptop text-blue-600 text-sm"></i>
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $categorie->nom }}</span>
                                    </div>
                                </td>
                                <td class="py-3 text-sm text-gray-500">{{ $categorie->description}}</td>
                                <td class="py-3 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <button class="text-blue-600 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-home text-green-600 text-sm"></i>
                                        </div>
                                        <span class="font-medium text-gray-900">Aucune catégorie trouvée</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </main>
</div>

<!-- Modal Mot de passe -->
<div id="modalPassword" class="fixed inset-0 bg-black bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-6 border w-96 shadow-xl rounded-2xl bg-white">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">Changer le mot de passe</h3>
            <button onclick="closeModal('modalPassword')" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe actuel</label>
                <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot de passe</label>
                <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" required>
            </div>
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeModal('modalPassword')" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Annuler
                </button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    <i class="fas fa-lock mr-2"></i>
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.toggle {
    appearance: none;
    width: 44px;
    height: 24px;
    background: #e5e7eb;
    border-radius: 12px;
    position: relative;
    cursor: pointer;
    transition: all 0.3s;
}

.toggle:checked {
    background: #10b981;
}

.toggle::after {
    content: '';
    position: absolute;
    width: 18px;
    height: 18px;
    background: white;
    border-radius: 50%;
    top: 3px;
    left: 3px;
    transition: all 0.3s;
}

.toggle:checked::after {
    left: 23px;
}
</style>

<script>
function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Fermer les modals en cliquant à l'extérieur
document.addEventListener('click', function(event) {
    if (event.target.id === 'modalPassword') {
        closeModal('modalPassword');
    }
});

// Gestion des thèmes
document.querySelectorAll('[class*="border-2"]').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('[class*="border-2"]').forEach(b => {
            b.classList.remove('border-blue-500', 'bg-blue-50');
            b.classList.add('border-gray-300');
        });
        this.classList.remove('border-gray-300');
        this.classList.add('border-blue-500', 'bg-blue-50');
    });
});
</script>
@endsection