# Design Patterns en PHP – Projet d’Apprentissage

## 🎯 Objectif du projet

Ce repository a pour but de **rassembler, illustrer et pratiquer** tous les principaux *design patterns* (patrons de conception) en PHP (et Symfony), en suivant une approche pédagogique et structurée.  
L’idée est d’ancrer durablement la compréhension de chaque pattern à travers :
- des explications synthétiques,
- des exemples concrets et testables,
- des retours critiques (pourquoi, quand l’utiliser, limites),
- et des résumés compatibles avec Notion.

---

## 🧩 Pourquoi ce projet ?

- **Renforcer mes connaissances** sur les patterns incontournables (creational, structural, behavioral…).
- **Tester les patterns dans des cas métiers réels** (pas seulement du “théorique”).
- **Me doter d’une bibliothèque de référence** pour réutilisation et partage.
- **Préparer des supports de documentation clairs** (README, Notion, schémas UML…).
- **Être prêt pour des entretiens, revues de code ou formations.**

---

## 🏗️ Structure du projet

Chaque pattern a son propre dossier :  
- `src/Patterns/Creational/...` (Singleton, Factory, AbstractFactory, Builder, Prototype)
- `src/Patterns/Structural/...` (Adapter, Bridge, Composite, etc.)
- `src/Patterns/Behavior/...` (Chain of responsibility, Command, etc.)
- 
Dans chaque dossier :  
- **Un ou plusieurs exemples PHP**,  
- **Des commandes Symfony** pour tester les cas d’usage,  
- **Des README spécifiques** sur Notion,
- **(Optionnel) Un schéma UML** ou visuel pour faciliter la compréhension rapide.

---

## 🚀 Comment utiliser ce repo ?

1. **Cloner le repo** :  
   `git clone https://github.com/<ton-utilisateur>/design-patterns.git`
2. **Installer les dépendances** (si besoin, via Composer/Symfony)
3. **Explorer chaque pattern** :  
   - Lire l’explication dans le dossier,
   - Lancer la commande de test fournie (ex : `php bin/console make:test-singleton`)
   - Analyser le code et la structure.
4. **S’inspirer ou réutiliser** les exemples pour tes propres projets ou pour enseigner.

---

## 🧠 Conseils d’apprentissage

- **Relire les résumés** et tableaux de comparaison pour chaque pattern (présents dans les README ou à intégrer sur Notion).
- **Prendre du recul sur chaque implémentation** :  
  - À quoi sert ce pattern dans la vraie vie ?
  - Quand est-ce que je pourrais/deviens-je l’utiliser naturellement ?
  - Quels sont ses inconvénients ? Y a-t-il plus simple selon le contexte ?
- **Se forcer à coder soi-même l’exemple** avant de regarder la solution.
- **Valider la compréhension en reformulant le pattern à l’oral ou à l’écrit**.

---

## 📝 Inspirations et sources

- [Refactoring Guru](https://refactoring.guru/fr/design-patterns)  
- Documentation officielle Symfony/PHP  
- Cours, articles, et retours d’expérience personnels
ouvrir des issues ou à proposer des améliorations pour enrichir la collection.
