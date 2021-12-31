# BackLog 

Ici vous pourrez trouver le backlog sous forme de user story.

je l'ai est classé en deux catégorie :
- [Utilisateur](#Utilisateur)
- [Administrateur](#Administrateur)

Les User Storys seront noté sur une échelle de 0 à 10 pour leurs valeur/importance, 10 tres important, 0 pas important

Les User Storys auront aussi une valeur de compléxité sur 10

---

### Utilisateur

| User Story | Valeur / importance | Critère | Compléxité |
| :----:     | :----: | :----:  | :----:  |
| L'utilisateur doit pouvoir s'enregistrer | 10 | email, nom, prenom, mot de passe | 2 |
| L'utilisateur doit pouvoir se connecter avec son email et son mot de passe | 10 | email, mot de passe | 2 |
| En tant qu'utilisateur je veux que mon mot de passe soit hashé | 10 | mot de passe, BCrypt | 2 |
| L'utilisateur doit pouvoir voir les articles proposés par le site même s'il n'est pas connecté | 10 | aucun | 1 |
| L'utilisateur doit pouvoir voir les tarifs de chaque articles sur la page de l'article | 9 | aucun | 1 |
| L'utilisateur doit pouvoir voir tous les articles d'un même type (theatre / concert / exposition / humour) sur une page | 9 | aucun | 1 |
| L'utilisateur connecté doit pouvoir réserver depuis la page d'un article | 10 | être connecté | 3 |
| L'utilisateur doit pouvoir voir ces réservations | 9 | être connecté | 3 |
| L'utilisateur doit voir des messages d'erreur en cas de problème | 4 | aucun | 1 |
| L'utilisateur doit voir une page d'erreur si la page demandé n'existe pas | 4 | aucun | 1 |
| L'utilisateur doit pouvoir se déconnecter | 9 | être connecté | 1 |

---

### Administrateur

| User Story | Valeur / importance | Critère | Compléxité |
| :----:     | :----: | :----:  | :----:  |
| L'administrateur doit pouvoir se connecter | 10 | email, mot de passe | 2 |
| L'administrateur doit pouvoir se déconnecter | 10 | être connecté | 2 |
| L'administrateur doit pouvoir voir le liens pour la page dashboard | 10 | être administrateur | 2 |
| L'administrateur doit pouvoir voir un compte rendu de son site sur la page dashboard (total utilisateurs, total reservations, total argent) | 7 | être administrateur | 5 |
| L'administrateur doit pouvoir voir les dernières réservations sur la page dashboard | 8 | être administrateur | 4 |
| L'administrateur doit pouvoir voir un graphique sur le nombres de réservations par jour sur les 10 derniers jours | 3 | être administrateur | 10 |
| L'administrateur doit pouvoir supprimer une réservation | 8 | être administrateur | 3 |
| L'administrateur doit pouvoir voir les utilisateurs | 9 | être administrateur | 2 |
| L'administrateur doit pouvoir voir ces articles | 9 | être administrateur | 2 |
| L'administrateur doit pouvoir supprimer un utilisateurs | 8 | être administrateur | 3 |
| L'administrateur doit pouvoir modidfier un article | 9 | être administrateur | 6 |
| L'administrateur doit pouvoir créer un article | 10 | être administrateur | 7 |
| L'administrateur doit pouvoir créer des tarifs pour un article | 8 | être administrateur | 9 |
| L'administrateur doit pouvoir modiffier des tarifs pour un article | 4 | être administrateur | 7 |
| L'administrateur doit pouvoir supprimer des tarifs pour un article | 8 | être administrateur | 6 |
| L'administrateur doit pouvoir supprimer un article | 8 | être administrateur | 3 |
| L'administrateur ne doit pas pouvoir supprimer un article s'il y a des réservations dessus | 10 | être administrateur | 7 |
| L'administrateur ne doit pas pouvoir supprimer un utilisateur s'il a des réservations en cours | 10 | être administrateur | 7 |
| L'administrateur doit pouvoir voir les meilleurs ventes sur son site depuis la page statistiques | 4 | être administrateur | 6 |
| En tant qu'administrateur je ne veux pas que les utilisateurs puissent voir la partie dashboard | 10 | être administrateur | 3 |
| En tant qu'administrateur je veux pouvoir voir les messages en cas d'erreur ou de succès | 10 | être administrateur | 6 |