<?php
require_once('workflows.php');

$w = new Workflows();

function status($id, $name, $label) {
	global $w;

	$command = "pgrep $id > /dev/null";
	exec($command, $output, $status);
	$status = ($status) ? "NOT RUNNING" : "RUNNING";
	$w->result( "$id-status", "$command", "$name: $status", "Run `$command`", "icons/$id.png", "no" );
}

$services = json_decode(file_get_contents("services.json"));
$service = $services->$id;

// start
$command = "launchctl load -w ~/Library/LaunchAgents/homebrew-php.josegonzalez.php54.plist?" . $id;
$w->result( "$id-start", $command, "Start {$service->name}", "Will run `$command` for you", "icons/{$service->id}.png" );

// stop
$command = "launchctl unload -w ~/Library/LaunchAgents/homebrew-php.josegonzalez.php54.plist?" . $id;
$w->result( "{$service->id}-stop", $command, "Stop {$service->name}", "Will run `$command` for you", "icons/{$service->id}.png" );

// restart
$command = "launchctl unload -w ~/Library/LaunchAgents/homebrew-php.josegonzalez.php54.plist"
		."; launchctl load -w ~/Library/LaunchAgents/homebrew-php.josegonzalez.php54.plist?" . $id;
$w->result( "{$service->id}-restart", $command, "Restart {$service->name}", "Will run `$command` for you", "icons/{$service->id}.png" );

// status
status($service->id, $service->name, $service->label);

echo $w->toxml();
?>