<?php
/*
Plugin Name: Quotations Manager
Plugin URI: http://wordpress.org/plugins/quotations-manager/
Description: Un plugin per WordPress per gestire la creazione e modifica di servizi, comprese l'aggiunta di eventuali opzioni extra.
Author: ailequal
Version: 0.0.1
Author URI: https://github.com/ailequal
*/


/*
 * Il codice e' attualmente scritto in maniera procedurale, ma sara' successivamente rivisto in OOP
 * Il plugin utilizza in tutti i file e funzioni il prefisso "quoma"
 */


/*
 * require_once
 */

// Creazione delle pagine
require_once( __DIR__ . '/quoma-pages.php' );

// Gestione redirect
require_once( __DIR__ . '/quoma-redirects.php' );

// Creazione CPT
require_once( __DIR__ . '/quoma-cpt.php' );
