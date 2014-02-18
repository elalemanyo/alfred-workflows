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
$command = "sudo launchctl load /Library/LaunchAgents/homebrew.mxcl.nginx.plist?" . $id;
$w->result( "$id-start", $command, "Start {$service->name}", "Will run `$command` for you", "icons/{$service->id}.png" );

// stop
$command = "sudo launchctl unload /Library/LaunchAgents/homebrew.mxcl.nginx.plist?" . $id;
$w->result( "{$service->id}-stop", $command, "Stop {$service->name}", "Will run `$command` for you", "icons/{$service->id}.png" );

// restart
$command = "sudo launchctl unload /Library/LaunchAgents/homebrew.mxcl.nginx.plist"
		."; sudo launchctl load /Library/LaunchAgents/homebrew.mxcl.nginx.plist?" . $id;
$w->result( "{$service->id}-restart", $command, "Restart {$service->name}", "Will run `$command` for you", "icons/{$service->id}.png" );

// status
status($service->id, $service->name, $service->label);

echo $w->toxml();
?>