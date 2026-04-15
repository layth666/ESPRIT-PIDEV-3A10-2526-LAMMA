# Rapport Technique : Architecture et Fonctionnalités Avancées - Projet LAMMA

Ce document présente une vue d'ensemble technique des bibliothèques (bundles), des APIs et des logiques métier avancées implémentées dans l'application LAMMA.

---

## 1. Les Bundles Symfony (Bibliothèques Externes)

Nous avons intégré plusieurs bundles pour répondre à des besoins spécifiques de gestion et de présentation :

### A. Génération de PDF Personnalisés (`dompdf/dompdf`)
- **Utilité** : Utilisé pour générer des badges de participation et des factures abonnements.
- **Localisation** : `src/Service/BadgeService.php`.
- **Valeur Ajoutée** : Permet la transformation dynamique de templates Twig en documents PDF professionnels téléchargeables.

### B. Sécurité & Identification (`endroid/qr-code` & `picqer/barcode-generator`)
- **Utilité** : Génération de QR Codes et de codes-barres 128.
- **Localisation** : `src/Service/BadgeService.php`.
- **Valeur Ajoutée** : Sécurisation des badges de participation pour un scan rapide lors des événements Scout.

### C. Statistiques Avancées (Google Charts via `loader.js`)
- **Utilité** : Visualisation de données métier (Revenus, Popularité, Inscriptions).
- **Localisation** : `templates/admin/dashboard.html.twig`.
- **Valeur Ajoutée** : Transformation des données brutes en graphiques interactifs (Camembert, Aires, Barres) pour une prise de décision rapide par l'administrateur.

### D. Expérience Utilisateur (`php-flasher`)
- **Utilité** : Notifications toast élégantes.
- **Localisation** : Globalement (utilisé via `$this->addFlash()` dans les contrôleurs).
- **Valeur Ajoutée** : Amélioration de l'interactivité lors des succès/échecs d'opérations (ajout au panier, modification de profil).

---

## 2. Intégrations d'APIs Externes

L'application LAMMA se connecte à plusieurs services tiers pour enrichir ses fonctionnalités :

### A. Intelligence Artificielle (`OpenAI API / GPT-4o`)
- **Fonction** : Assistant virtuel "Scout IA".
- **Localisation** : `src/Service/ScoutChatbotService.php`.
- **Usage** : Analyse les préférences des scouts pour suggérer des menus personnalisés et répondre aux questions sur les événements.

### B. Flux Social Médias (`TikWM API - TikTok`)
- **Fonction** : Recherche et affichage de vidéos culinaires ou événementielles en temps réel.
- **Localisation** : `src/Controller/TikTokController.php`.
- **Usage** : Permet de trouver les dernières tendances virales liées aux restaurants partenaires.

### C. Météo en Temps Réel (`Open-Meteo API`)
- **Fonction** : Affichage des conditions climatiques pour les lieux d'événements.
- **Localisation** : `templates/admin/dashboard.html.twig`.
- **Usage** : Aide les organisateurs à anticiper les conditions météorologiques pour les activités en extérieur.

### D. Paiements Sécurisés (`Stripe API`)
- **Fonction** : Gestion des abonnements et paiements.
- **Usage** : Automatisation des transactions pour les plans Premium et Pass Evénement.

---

## 3. Logique Métier Avancée (Complexité Backend)

Au-delà des bundles et APIs, le projet implémente des algorithmes spécifiques au domaine "LAMMA" :

### A. Système de Calcul Nutritionnel Automatique
- **Fichier** : `src/Controller/RepasDetailleController.php` (méthode `calculateNutrition`).
- **Logique** : L'application récupère la liste des ingrédients d'un plat, croise les données avec le dépôt `IngredientRepository`, et calcule automatiquement le total calorique et protéique du repas final.

### B. Moteur de Recommandation & Panier Intelligent
- **Fichier** : `src/Service/CartService.php`.
- **Logique** : Gestion de la persistance en session, application de réductions dynamiques et vérification de la disponibilité des stocks/places en temps réel.

### C. Analyse de Menus via IA (OCR + Vision)
- **Fichier** : `src/Service/GeminiMenuAnalyzer.php`.
- **Logique** : Utilisation de modèles de vision pour extraire le texte et les prix à partir d'une photo de menu physique pour les intégrer automatiquement en base de données.

### D. Système de Favoris Unifié
- **Fichier** : `src/Controller/FavoriController.php`.
- **Logique** : Système AJAX permettant de toggler (ajouter/retirer) des favoris sans rechargement de page, avec une gestion asynchrone pour une UX fluide.

---

## Conclusion

L'application **LAMMA** exploite la puissance du framework Symfony en combinant des services backend robustes (calculs, gestion d'états) avec des intégrations modernes (IA, APIs sociales, PDF dynamiques). Cette architecture modulaire garantit à la fois la performance et une scalabilité élevée.
