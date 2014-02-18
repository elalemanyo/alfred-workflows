<?php
require_once('workflows.php');

$w = new Workflows();

function status($id, $name, $label) {
	global $w;
	if (!$id) { return; }

	$command = "pgrep $id > /dev/null";
	exec($command, $output, $status);
	$status = ($status) ? "NOT RUNNING" : "RUNNING";
	$w->result( "$id-status", "$command", "$name: $status", "Run `$command`", "icons/$id.png", "no" );

}

$services = json_decode(file_get_contents("services.json"));
foreach($services as $service) {
	status($service->id, $service->name, $service->label);
}

echo $w->toxml();
?>