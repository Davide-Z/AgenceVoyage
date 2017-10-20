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

//index : présentation de l'agence
$app->get ( '/',
    function () use ($app)
    {

        return $app ['twig']->render ( 'front-office/home.html.twig');
}
)->bind ( 'home' );




$app->get ( '/circuit',
		function () use ($app)
		{
			$circuitslist = get_all_circuits ();
			// print_r($circuitslist);
			
			return $app ['twig']->render ( 'front-office/circuitslist.html.twig', [
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

		return $app ['twig']->render ( 'front-office/circuitshow.html.twig', [ 
				'id' => $id,
				'circuit' => $circuit 
			] );
	}
)->bind ( 'circuitshow' );

// steps : affiche les détails d'un circuit
$app->get ( '/circuit/{id}/steps',
		function ($id) use ($app)
		{
			$circuit = get_circuit_by_id ( $id );
			// print_r($circuit);
			$programmations = get_programmations_by_circuit_id ( $id );
			//$circuit ['programmations'] = $programmations;
			
			return $app ['twig']->render ( 'front-office/steps.html.twig', [
					'id' => $id,
					'circuit' => $circuit
			] );
}
)->bind ( 'steps' );

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

// backoffice

$app->get ( '/back-office/circuit',
		function () use ($app)
		{
			$circuitslist = get_all_circuits ();
			// print_r($circuitslist);
			
			return $app ['twig']->render ( 'back-office/circuitslist.html.twig', [
					'circuitslist' => $circuitslist
			] );
}
)->bind ( 'circuitlistadmin' );

// circuitshow : affiche les détails d'un circuit
$app->get ( '/back-office/circuit/{id}',
		function ($id) use ($app)
		{
			$circuit = get_circuit_by_id ( $id );
			// print_r($circuit);
			$programmations = get_programmations_by_circuit_id ( $id );
			//$circuit ['programmations'] = $programmations;
			
			return $app ['twig']->render ( 'back-office/circuitshow.html.twig', [
					'id' => $id,
					'circuit' => $circuit
			] );
}
)->bind ( 'circuitshowadmin' );

// steps : affiche les détails d'un circuit
$app->get ( '/back-office/circuit/{id}/steps',
		function ($id) use ($app)
		{
			$circuit = get_circuit_by_id ( $id );
			// print_r($circuit);
			$programmations = get_programmations_by_circuit_id ( $id );
			//$circuit ['programmations'] = $programmations;
			
			return $app ['twig']->render ( 'back-office/steps.html.twig', [
					'id' => $id,
					'circuit' => $circuit
			] );
}
)->bind ( 'stepsadmin' );

// programmationlist : liste tous les circuits programmés
$app->get ( '/back-office/programmation',
		function () use ($app)
		{
			$programmationslist = get_all_programmations ();
			// print_r($programmationslist);
			
			return $app ['twig']->render ( 'programmationslist.html.twig', [
					'programmationslist' => $programmationslist
			] );
}
)->bind ( 'programmationlistadmin' );

$app->run ();
