<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion Marcel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%);
        }
        .input-focus {
            transition: all 0.3s ease;
        }
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <!-- Background animation -->
    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute top-40 left-40 w-80 h-80 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Main container -->
    <div class="relative z-10 w-full max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            
            <!-- Left side - Branding -->
            <div class="text-white text-center lg:text-left space-y-6">
                <div class="inline-flex items-center justify-center lg:justify-start space-x-3">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <i class="fas fa-store text-2xl"></i>
                    </div>
                    <h1 class="text-4xl font-bold">Marcel</h1>
                </div>
                
                <h2 class="text-5xl lg:text-6xl font-extrabold leading-tight">
                    Gestion<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 to-pink-200">
                        Intelligente
                    </span>
                </h2>
                
                <p class="text-xl text-white/80 max-w-md mx-auto lg:mx-0">
                    La solution complète pour gérer votre commerce avec simplicité et efficacité.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-check-circle text-green-300"></i>
                        <span>Gestion des stocks</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-check-circle text-green-300"></i>
                        <span>Ventes simplifiées</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-check-circle text-green-300"></i>
                        <span>Analytics avancés</span>
                    </div>
                </div>
            </div>

            <!-- Right side - Auth forms -->
            <div class="glass-effect rounded-3xl shadow-2xl p-8 space-y-6">
                <!-- Tab navigation -->
                <div class="flex bg-gray-100 rounded-xl p-1">
                    <button onclick="showLogin()" id="loginTab" class="flex-1 py-3 px-4 rounded-lg text-sm font-medium transition-all duration-200 bg-white text-gray-900 shadow-sm">
                        Connexion
                    </button>
                    <button onclick="showRegister()" id="registerTab" class="flex-1 py-3 px-4 rounded-lg text-sm font-medium transition-all duration-200 text-gray-500 hover:text-gray-700">
                        Inscription
                    </button>
                </div>

                <!-- Login Form -->
                <div id="loginForm" class="space-y-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Bon retour</h3>
                        <p class="text-gray-600">Connectez-vous à votre espace</p>
                    </div>

                    <form class="space-y-5" action="{{ route('soumission-login') }}" method="POST">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <div class="relative">
                                <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="email" 
                                    id="email"
                                    name="email"
                                    required
                                    class="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent input-focus"
                                    placeholder="vous@example.com"
                                >
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="password" 
                                    id="password"
                                    name="password"
                                    required
                                    class="w-full pl-12 pr-12 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent input-focus"
                                    placeholder="••••••••"
                                >
                                <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                                <span class="ml-2 text-sm text-gray-600">Se souvenir</span>
                            </label>
                            <a href="#" class="text-sm text-purple-600 hover:text-purple-500">Mot de passe oublié?</a>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-4 rounded-xl font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                            Se connecter
                        </button>
                    </form>
                </div>

                <!-- Register Form -->
                <div id="registerForm" class="space-y-6 hidden">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Créer un compte</h3>
                        <p class="text-gray-600">Rejoignez-nous dès aujourd'hui</p>
                    </div>

                    <form class="space-y-5" action="{{ route('creation-compte') }}" method="POST">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                            <div class="relative">
                                <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="text" 
                                    id="regName"
                                    required
                                    class="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent input-focus"
                                    placeholder="Votre nom"
                                >
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <div class="relative">
                                <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="email" 
                                    id="regEmail"
                                    required
                                    class="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent input-focus"
                                    placeholder="vous@example.com"
                                >
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="password" 
                                    id="regPassword"
                                    required
                                    class="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent input-focus"
                                    placeholder="••••••••"
                                >
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe</label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="password" 
                                    id="regPasswordConfirm"
                                    required
                                    class="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent input-focus"
                                    placeholder="••••••••"
                                >
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rôle</label>
                            <div class="relative">
                                <i class="fas fa-user-tag absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <select 
                                    id="regRole"
                                    required
                                    class="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent input-focus appearance-none"
                                >
                                    <option value="">Sélectionner un rôle</option>
                                    <option value="1">Administrateur</option>
                                    <option value="2">Utilisateur</option>
                                </select>
                            </div>
                        </div>

                        <button 
                            type="submit"
                            class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white py-4 rounded-xl font-semibold hover:from-green-700 hover:to-green-800 transition-all duration-200 transform hover:scale-[1.02] shadow-lg"
                        >
                            S'inscrire
                        </button>
                    </form>
                </div>

                <!-- Alert messages -->
                @if(session('success'))
                    <div class="p-4 rounded-xl flex items-center space-x-3 bg-green-50 text-green-700 border border-green-200">
                        <i class="fas fa-check-circle text-xl text-green-500"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="p-4 rounded-xl flex items-center space-x-3 bg-red-50 text-red-700 border border-red-200">
                        <i class="fas fa-exclamation-circle text-xl text-red-500"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif
                
                <div id="alertMessage" class="hidden p-4 rounded-xl flex items-center space-x-3">
                    <i class="fas fa-info-circle text-xl"></i>
                    <span id="alertText"></span>
                </div>
            </div>
        </div>
    </div>

    <script>

        // Tab switching
        function showLogin() {
            document.getElementById('loginForm').classList.remove('hidden');
            document.getElementById('registerForm').classList.add('hidden');
            document.getElementById('loginTab').classList.add('bg-white', 'text-gray-900', 'shadow-sm');
            document.getElementById('loginTab').classList.remove('text-gray-500');
            document.getElementById('registerTab').classList.remove('bg-white', 'text-gray-900', 'shadow-sm');
            document.getElementById('registerTab').classList.add('text-gray-500');
            hideAlert();
        }

        function showRegister() {
            document.getElementById('registerForm').classList.remove('hidden');
            document.getElementById('loginForm').classList.add('hidden');
            document.getElementById('registerTab').classList.add('bg-white', 'text-gray-900', 'shadow-sm');
            document.getElementById('registerTab').classList.remove('text-gray-500');
            document.getElementById('loginTab').classList.remove('bg-white', 'text-gray-900', 'shadow-sm');
            document.getElementById('loginTab').classList.add('text-gray-500');
            hideAlert();
        }

        // Password toggle
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        // Alert functions
        function showAlert(message, type = 'error') {
            const alertDiv = document.getElementById('alertMessage');
            const alertText = document.getElementById('alertText');
            const alertIcon = alertDiv.querySelector('i');
            
            alertText.textContent = message;
            alertDiv.classList.remove('hidden');
            
            // Reset classes
            alertDiv.className = 'p-4 rounded-xl flex items-center space-x-3';
            
            if (type === 'success') {
                alertDiv.classList.add('bg-green-50', 'text-green-700', 'border', 'border-green-200');
                alertIcon.className = 'fas fa-check-circle text-xl text-green-500';
            } else {
                alertDiv.classList.add('bg-red-50', 'text-red-700', 'border', 'border-red-200');
                alertIcon.className = 'fas fa-exclamation-circle text-xl text-red-500';
            }
        }

        function hideAlert() {
            document.getElementById('alertMessage').classList.add('hidden');
        }

   

        // Add animation styles
        const style = document.createElement('style');
        style.textContent = `
            @keyframes blob {
                0% { transform: translate(0px, 0px) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
                100% { transform: translate(0px, 0px) scale(1); }
            }
            .animate-blob {
                animation: blob 7s infinite;
            }
            .animation-delay-2000 {
                animation-delay: 2s;
            }
            .animation-delay-4000 {
                animation-delay: 4s;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>