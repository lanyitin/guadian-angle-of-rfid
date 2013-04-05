<?php
class Ufh2 {
	private $socket; //socket object
	function __construct($para_host, $para_port)
	{
		if (!is_string($para_host)) {
			die("Invalidate type for first argument. it should be a string");
		}
		if (!is_int($para_port)) {
			die("Invalidate type for second argument. it should be a integer");
		}

		$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket\n");
		socket_set_option($this->socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 1, 'usec' => 1)); 
		socket_connect($this->socket, $para_host, $para_port) or die("Could not conntect to $para_host:$para_port");
	}

	function __destruct()
	{

		socket_close($this->socket);
	}

	public function readIdFromAntena($para_antid)
	{
		$cmdString = "GET /scanner.php?action=read HTTP/1.1\r\n";
		$cmdString .= "Host: www.example.com\r\n";
		$cmdString .= "Connection: Close\r\n\r\n";
		socket_write($this->socket, $cmdString, strlen($cmdString)) or die("Unable to send data");
		$response = socket_read($this->socket, 2048);
		list($header, $body) = explode("\r\n\r\n", $response, 2);
		$body = explode(" ", $body, 3);
		echo $body[2];
	}

	public function writeId($para_newid, $para_antid)
	{
		$cmdString = "GET /scanner.php?action=write&id=$para_newid HTTP/1.1\r\n";
		$cmdString .= "Host: www.example.com\r\n";
		$cmdString .= "Connection: Close\r\n\r\n";
		socket_write($this->socket, $cmdString, strlen($cmdString)) or die("Unable to send data");
		$response = socket_read($this->socket, 2048);
		list($header, $body) = explode("\r\n\r\n", $response, 2);
		echo $body;
	}
}
?>
