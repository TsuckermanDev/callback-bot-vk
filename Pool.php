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

$input_data = json_decode(file_get_contents('php://input'));
$input_data_array = json_decode(file_get_contents('php://input'), true);

switch($input_data->type) {
    case 'confirmation':
        echo \bot\Constants::CONFIRMATION;
    break;
    case 'message_new':
	header('HTTP/1.1 200 OK');
        echo \bot\Constants::STATUS_OK;
        $user = new \bot\command\CommandSender($input_data->object->message->from_id, $input_data->object->message->peer_id);
        $command = new \bot\command\Command($input_data->object->message->text, $input_data_array["object"]["message"]["attachments"]);
        $reader = new \bot\command\CommandReader();
        $reader->read($user, $command);
        break;
    default:
        header('HTTP/1.1 200 OK');
        echo \bot\Constants::STATUS_OK;
    break;

}
?>