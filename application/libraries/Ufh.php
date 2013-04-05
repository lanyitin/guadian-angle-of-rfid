<?php
class UHF {
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
		$cmdString = null;
		if (is_int($para_antid)) {
			$cmdString = sprintf("RDID -seq MOC -ant %d -tmo 200\n", $para_antid);
		} else {
			$cmdString = sprintf("RDID -seq MOC -ant %s -tmo 200\n", $para_antid);
		}

		socket_write($this->socket, $cmdString, strlen($cmdString)) or die("Unable to send data");
		echo socket_read($this->socket, 2048);
	}

	public function writeId($para_newid, $para_antid)
	{
		$cmdString = null;
		if (is_int($para_antid)) {
			$cmdString = sprintf("WTID %s -seq SOC -ant %d -tmo 200\n", $para_newid, $para_antid);
		} else {
			$cmdString = sprintf("WTID %s -seq SOC -ant %s -tmo 200\n", $para_newid, $para_antid);
		}
		socket_write($this->socket, $cmdString, strlen($cmdString)) or die("Unable to send data");

		echo socket_read($this->socket, 2048);
	}
}


#  以上程式碼為Class的宣告   理論上來講應該是不會變動的
#if (!isset($_GET["action"])) {
#	echo "try to give a GET param 'action', there are only two value for this param 'read' or 'write'<br/>\n";
#	echo "the default id write into card is 'abcdedg'\n";
#} else if ($_GET["action"] == "read") {
#	$uhf = new UHF("192.168.1.200", 7090);
#	$uhf->readIdFromAntena(1);
#} else if ($_GET["action"] == "write") {
#	$uhf = new UHF("192.168.1.200", 7090);
#	$uhf->writeId("0000000000ABCDEF12345679 ", 1);
#}
?>
