<?php
/*****************************************
* French language file for jAwards
*
* Author: netajour.com
******************************************/

/* *
/	Traduction: netajour.com - janvier 2008
/	**********************************
/
/	HowTo
/	******
/	Si vous modifiez ce fichier, veuillez remplacez les caractères accentués et les apostrophes par leur équivalent unicode (norme iso 8859-1)
/	é= &eacute;        majuscule = &Eacute;
/	è= &egrave;       majuscule = &Egrave;
/	à = &agrave;      majuscule = &Agrave
/	ç = &ccedil;        majuscule = &Ccedil
/	ù= &ugrave;       majuscule = &Ugrave;
/	les apostrophes doivent �tre antislash�es. Ex : l\'information 
/
/	Syntaxe
/	*******
/	FONCTION ( '_CONDITION', 'variable');
/	Condition et variable entre simples cotes séparés par une virgule, mis entre parenthèses après la fonction.
/	Chaque ligne doit se terminer par un point virgule.
/
/        Aide
/	****
/	Si vous obtenez une page blanche ou un message d'erreur du serveur après avoir modifié ce fichier, vérifiez que vous n'avez pas oublié un de ces détails.
*/


// Frontend Language constants:
DEFINE ('_AWARDS_HEADING', 'Les M&eacute;dailles');
DEFINE ('_AWARDS_INFORMATION', 'Informations sur les m&eacute;dailles');
DEFINE ('_AWARDS_AWARD', 'M&eacute;dailles'); 
DEFINE ('_AWARDS_MEDAL', 'M&eacute;daille');
DEFINE ('_AWARDS_DATE', 'Date');
DEFINE ('_AWARDS_REASON', 'Motif');
DEFINE ('_AWARDS_NOAWARD', 'Cet utilisateur n\'a pas encore re&ccedil;u de m&eacute;daille.');
DEFINE ('_AWARDS_NAME', 'Nom');
DEFINE ('_AWARDS_USER', 'Utilisateur');
DEFINE ('_AWARDS_USERS', 'Utilisateurs');
DEFINE ('_AWARDS_AWARDED', 'm&eacute;daill&eacute;');
DEFINE ('_AWARDS_FOLLOWING_USERS_AWARDED', 'Les utilisateurs ayant obtenu cette m&eacute;daille:');
DEFINE ('_AWARDS_NO_USERS', 'Cette m&eacute;daille n\'a jamais &eacute;t&eacute; attribu&eacute;e.');
DEFINE ('_AWARDS_YES','Oui');
DEFINE ('_AWARDS_NO','Non');

// Backend Language constants:
DEFINE ('_AWARDS_ADM_CONFIG','Configuration de jAwards');
DEFINE ('_AWARDS_ADM_CUR_SETTING','Param&egrave;tres');
DEFINE ('_AWARDS_ADM_EXPLANATION','Explications');
DEFINE ('_AWARDS_ADM_CB_INTEGRATION','Int&eacute;grer &agrave Community Builder');
DEFINE ('_AWARDS_ADM_CB_INTEGRATION_EXPLANATION','Lie le nom des m&eacute;daill&eacute;s aux profils de CB');
DEFINE ('_AWARDS_ADM_GROUP','Grouper les m&eacute;dailles');
DEFINE ('_AWARDS_ADM_GROUP_EXPLANATION','Regroupe les m&eacute;dailles identiques et affiche leur quantit&eacute;. Seuls la m&eacute;daille et le motif le plus r&eacute;cent du groupe seront alors affich&eacute;s en frontend.');
DEFINE ('_AWARDS_ADM_SHOWREASON','Afficher le motif');
DEFINE ('_AWARDS_ADM_SHOWREASON_EXPLANATION','Active l\'affichage du motif de la r&eacute;compense dans la liste des m&eacute;dailles. Vous pourrez indiquer ce motif lors de l\'attribution de la m&eacute;daille.');
DEFINE ('_AWARDS_ADM_INTROTEXT','Texte d\'introduction en frontent');
DEFINE ('_AWARDS_ADM_INTROTEXT_EXPLANATION','Un bref r&eacute;sum&eacute; &agrave; afficher en frontend. Laissez vide si vous ne n\'en voulez pas.');
DEFINE ('_AWARDS_ADM_AWARDS_MANAGER','Gestion des m&eacute;daill&eacute;s');
DEFINE ('_AWARDS_ADM_AWARDS_MANAGER_EXPLANATION','Ici vous pouvez g&eacute;rer les m&eacute;daill&eacute;s, les modifier ou supprimer ceux qui existent d&eacute;j&agrave;.');
DEFINE ('_AWARDS_ADM_DISPLAY','Afficher');
DEFINE ('_AWARDS_ADM_FILTER_USER','Trier par utilisateur');
DEFINE ('_AWARDS_ADM_ORDERBY_AWARD','Tri alphab&eacute;tique par nom de m&eacute;daille');
DEFINE ('_AWARDS_ADM_AWARDED_TO','Attribu&eacute;e &agrave;');
DEFINE ('_AWARDS_ADM_ORDERBY_AWARDED_TO','Tri alphab&eacute;tique par nom');
DEFINE ('_AWARDS_ADM_ORDERBY_DATE','Tri par date descendante');
DEFINE ('_AWARDS_ADM_EDIT_AWARD','&Eacute;diter');
DEFINE ('_AWARDS_ADM_ERROR_SELECT_USER','Choisissez l\'utilisateur &agrave; m&eacute;dailler.');
DEFINE ('_AWARDS_ADM_ERROR_SELECT_AWARD','Choisissez la m&eacute;daille &agrave; attribuer.');
DEFINE ('_AWARDS_ADM_EDIT','&Eacute;diter');
DEFINE ('_AWARDS_ADM_NEW','Nouvelle');
DEFINE ('_AWARDS_ADM_DETAILS','D&eacute;tails');
DEFINE ('_AWARDS_ADM_USERID','UserId');
DEFINE ('_AWARDS_ADM_SHOW_USERS','&Eacute;diter');
DEFINE ('_AWARDS_ADM_MASS_AWARD','M&eacute;dailler un groupe:');
DEFINE ('_AWARDS_ADM_SELECT_USERS','S&eacute;lectionnez les r&eacute;cipiendaires');
DEFINE ('_AWARDS_ADM_SELECT_USERS_HINT','(utilisez la touche CTRL pour faire une s&eacute;lection multiple)');
DEFINE ('_AWARDS_ADM_FOR_ALL_USERS','le m&ecirc;me pour tous');
DEFINE ('_AWARDS_ADM_MEDALS_MANAGER','Gestionnaire de M&eacute;dailles');
DEFINE ('_AWARDS_ADM_MEDALS_MANAGER_EXPLANATION','Ici vous pouvez cr&eacute;er de nouvelles m&eacute;dailles et modifier ou supprimer celles qui existent d&eacute;j&agrave;. Vous devez d\'abord cr&eacute;er des images puis les enregistrer dans le r&eacute;pertoire /images/medals/ de votre installation Joomla.');
DEFINE ('_AWARDS_ADM_FILTER_MEDAL','Filtre');
DEFINE ('_AWARDS_ADM_IMAGE','Image');
DEFINE ('_AWARDS_ADM_NAME','Nom');
DEFINE ('_AWARDS_ADM_EDIT_MEDAL','&Eacute;dition des M&eacute;dailles');
DEFINE ('_AWARDS_ADM_ERROR_ENTER_MEDALNAME','Veuillez donner un nom &agrave; la m&eacute;daille.');
DEFINE ('_AWARDS_ADM_ERROR_SELECT_IMAGE','Veuillez s&eacute;lectionner une image.');
DEFINE ('_AWARDS_ADM_EDIT_MEDAL_EXPLANATION','Assurez-vous que l\'image existe est qu\'elle se trouve bien dans le r&eacute;pertoire /images/medals/ de votre installation Joomla, ou t&eacute;l&eacute;chargez-la maintenant &agrave; l\'aide du bouton "Upload" (&agrave; la page pr&eacute;c&eacute;dente)!');
DEFINE ('_AWARDS_ADM_DESCRIPTION','Description');
DEFINE ('_AWARDS_ADM_ERROR_ENTER_FILE','Vous avez oubli&eacute; d\'indiquer le nom du fichier !');
DEFINE ('_AWARDS_ADM_ERROR_WRONG_EXTENSION','Formats autoris&eacute;s: JPEG, GIF ou PNG uniquement');
DEFINE ('_AWARDS_ADM_MEDAL_IMAGE_UPLOAD','T&eacute;l&eacute;charger');
DEFINE ('_AWARDS_ADM_MEDAL_IMAGE','Image de la m&eacute;daille');
DEFINE ('_AWARDS_ADM_FILE','Fichier');
DEFINE ('_AWARDS_ADM_SELECT_MEDAL','Trier par m&eacute;daille'); 
DEFINE ('_AWARDS_ADM_SELECT_USER','Choix de l\'utilisateur');
DEFINE ('_AWARDS_ADM_NUMBERMEDALS','# de m&eacute;dailles en frontend');
DEFINE ('_AWARDS_ADM_NUMBERMEDALS_EXPLANATION','Nombre de m&eacute;dailles &agrave; lister par page en frontend. Un multiple de 5 est recommand&eacute; pour une bonne concordance avec la liste de choix du nombre de page à afficher de Joomla. (5 - 10 - 15 - 25 - 50)');
DEFINE ('_AWARDS_ADM_NUMBERUSERS','# d\'utilisateurs par page');
DEFINE ('_AWARDS_ADM_NUMBERUSERS_EXPLANATION','Nombre d\'utilisateurs &agrave; lister en frontend. Un multiple de 5 est recommand&eacute; pour la bonne concordance avec la liste de choix du nombre de page de Joomla. (5 - 10 - 15 - 25 - 50)');

// new in 0.9:
DEFINE ('_AWARDS_ADM_ORDER','Ordre');
DEFINE ('_AWARDS_ADM_REORDER','Trier');
DEFINE ('_AWARDS_ADM_DEFAULTREASON','Motif d\'attribution par d&eacute;faut');
DEFINE ('_AWARDS_ADM_DATEFORMAT','Format de la date en admin');
DEFINE ('_AWARDS_ADM_DATEFORMAT_EXPLANATION','Formatage de la date en admin. D&eacute;pend aussi de la config Heure Locale de Joomla! ou du serveur.');
DEFINE ('_AWARDS_ADM_DATE_EXPLANATION','Format ISO standard AAAA-MM-JJ. Vous pouvez choisir le format d\'affichage de la date en frontend dans la configuration de jAwards.');
DEFINE ('_AWARDS_ADM_REASON_EXPLANATION','S\'affichera en frontend uniquement si vous l\'avez pr&eacute;cis&eacute; dans la configuration de jAwards. Le motif par d&eacute;faut sera pr&eacute;rempli pour chaque nouvelle m&eacute;daille si vous en avez indiqu&eacute; un');
DEFINE ('_AWARDS_ADM_AVAILABLE_USERS','Utilisateurs disponibles');
DEFINE ('_AWARDS_ADM_SELECTED_USERS','Utilisateurs choisis');
DEFINE ('_AWARDS_ADM_ADD','additionner');
DEFINE ('_AWARDS_ADM_REMOVE','revoquer');
DEFINE ('_AWARDS_ADM_CREDITS','Affiche link');
DEFINE ('_AWARDS_ADM_CREDITS_EXPLANATION','Affiche lien hypertexte en jAwards dans le Frontend');

// new in 1.0
DEFINE ('_AWARDS_ADM_REALNAME','Nom r&eacute;el au lieu de Username');
//DEFINE ('_AWARDS_ADM_REALNAME_EXPLANATION','Should the real name instead of the username be displayed in Frontend and Backend?'); //translation missing
?>
