<?php
// Script de test pour la fonction login
require_once 'vendor/autoload.php';

use Illuminate\Http\Request;
use App\Http\Requests\Credentials;

// Test 1: Validation correcte
echo "Test 1: Validation avec email/password valides\n";
$request = new Request();
$request->merge([
    'email' => 'test@example.com',
    'password' => 'password123'
]);

$credentialsRequest = new Credentials();
$credentialsRequest->merge($request->all());

if ($credentialsRequest->passes()) {
    echo "✅ Validation réussie\n";
    echo "Email: " . $request->email . "\n";
    echo "Password: [masqué]\n";
} else {
    echo "❌ Validation échouée\n";
    foreach ($credentialsRequest->errors()->all() as $error) {
        echo "- " . $error . "\n";
    }
}

echo "\n";

// Test 2: Validation incorrecte
echo "Test 2: Validation avec email invalide\n";
$request2 = new Request();
$request2->merge([
    'email' => 'email-invalide',
    'password' => '123'
]);

$credentialsRequest2 = new Credentials();
$credentialsRequest2->merge($request2->all());

if ($credentialsRequest2->passes()) {
    echo "✅ Validation réussie (anormal)\n";
} else {
    echo "✅ Validation échouée (normal)\n";
    foreach ($credentialsRequest2->errors()->all() as $error) {
        echo "- " . $error . "\n";
    }
}

echo "\nTest terminé !\n";
?>
