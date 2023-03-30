 <?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* INCLUDE */

set_include_path('/src');

require_once("vendor/autoload.php");

/* INCLUDE */

ob_start();

if (!isset($_REQUEST)) {
return;
}

$input_data = json_decode(file_get_contents('php://input'), true);

switch($input_data["type"]) {
    case 'confirmation':
        return echo \bot\Constants::CONFIRMATION;
    break;
    case 'message_new':
        $user = new \bot\lib\command\CommandSender($input_data["object"]["message"]["from_id"], $input_data["object"]["message"]["peer_id"]);
        $command = new \bot\lib\command\Command($input_data["object"]["message"]["text"], $input_data["object"]["message"]["attachments"]);
        $reader = new \bot\lib\command\CommandReader();
        $reader->read($user, $command);
    break;
}

header('HTTP/1.1 200 OK');
echo \bot\Constants::STATUS_OK;

?>