<?php

/**
 * Application d'exemple Agence de voyages Silex
 */
date_default_timezone_set('UTC');
// require_once __DIR__.'/vendor/autoload.php';
$vendor_directory = getenv ( 'COMPOSER_VENDOR_DIR' );
if ($vendor_directory === false) {
	$vendor_directory = __DIR__ . '/vendor';
}
require_once $vendor_directory . '/autoload.php';

// Initialisations
$app = require_once 'initapp.php';

require_once 'agvoymodel.php';

// Routage et actions
// circuitlist : Liste tous les circuits
$app->get ( '/circuit0',
		function () use ($app)
		{
			$circuitslist = get_all_circuits ();
			// print_r($circuitslist);
			
			return $app ['twig']->render ( 'circuitslist.html.twig', [
					'circuitslist' => $circuitslist
			] );
}
)->bind ( 'circuitlist' );

// Routage et actions
// circuitlist : Liste tous les circuits
$app->get ( '/front-office/circuit', 
    function () use ($app) 
    {
    	$circuitslist = get_all_circuits ();
    	// print_r($circuitslist);
    	
    	return $app ['twig']->render ( 'front-office/circuitslist-front-office.html.twig', [
    			'circuitslist' => $circuitslist
    	] );
    }
)->bind ( 'circuitlist' );

// circuitlist : Liste tous les circuits
$app->get ( '/back-office/circuit',
		function () use ($app)
		{
			$circuitslist = get_all_circuits ();
			// print_r($circuitslist);
			
			return $app ['twig']->render ( 'back-office/circuitslist-back-office.html.twig', [
					'circuitslist' => $circuitslist
			] );
}
)->bind ( 'circuitlist' );

// circuitshow : affiche les détails d'un circuit
$app->get ( '/circuit/{id}', 
	function ($id) use ($app) 
	{
		$circuit = get_circuit_by_id ( $id );
		// print_r($circuit);
		$programmations = get_programmations_by_circuit_id ( $id );
		//$circuit ['programmations'] = $programmations;

		return $app ['twig']->render ( 'circuitshow.html.twig', [ 
				'id' => $id,
				'circuit' => $circuit 
			] );
	}
)->bind ( 'circuitshow' );

// programmationlist : liste tous les circuits programmés
$app->get ( '/programmation', 
	function () use ($app) 
	{
		$programmationslist = get_all_programmations ();
		// print_r($programmationslist);

		return $app ['twig']->render ( 'programmationslist.html.twig', [ 
				'programmationslist' => $programmationslist 
			] );
	}
)->bind ( 'programmationlist' );

$app->run ();
