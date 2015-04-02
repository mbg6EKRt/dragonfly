<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/../'));

	require_once(WM_ROOTPATH.'common/class_log.php');
	require_once(WM_ROOTPATH.'common/inc_constants.php');

/*
  Class pop3.class.inc
  Author: Jointy <bestmischmaker@web.de>
  create: 07. May 2003
  last cahnge: 25. July 2006

  Version: 1.16 (final)

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

  ChangeLog:

  // 08 May 2003
  - Version 0.52 (beta) public coming out !!!
  - add logging

  // 09 May 2003
  - Version 0.61 out !!!
  - add get_top() function (public)

  -------------------------
  ! POP3 Class get Public !
  -------------------------

  // 10 May 2003
  - add reset() function (public)
  - add _checkstate($string) function (private)
  - add _stats() function (private)
  - add uidl($msg_number) function (public)

  // 11 May 2003
  - add save2mysql function (public) (beta)
  - fixed some errors !!!

  // 14 May 2003
  - fixed a heavy bug with APOP Server (private func _parse_banner($server_text))
  (so sometimes the APOP Authorization goes failed, although the password was correct !!)

  // 15 May 2003
  - changed error handling in get_office_status(), get_top(), get_mail()
  - add APOP Autodetection !!! more in Readme.txt

  -----------------------------------
  POP3 Class get Version 1.00 (final)
  -----------------------------------

  // 16 May 2003
  - finished save2mysql() function ( public )

  // 17 May 2003
  - remove some bugs ( save2mysql() )
  ///////////////////////////////////
  finished pop3.class.inc  Version: 1.10
  ///////////////////////////////////

  // 20 May 2003
  - fixed a bug in get_top()

  // 12. July 2003
  - fix a bug in get_top()

  // 26. July 2003
  // fixed an error with noob ! Thanks to "Martin Eisenfuehrer.de" <martin@eisenfuehrer.de>" !
  !!! it doesn't named "noob", it is named "noop" !!!

  so now the func named "noop()" and it will send the right command "NOOP"

  // version 1.14 (final) out

  // 22. M&auml;rz 2004
  - fix a bug while checking sock_timeout
  - fix a bug in _cleanup() while check $this->socket if resource , now it use is_resource function
  - fix a bug in _cleanup() and _getnextstring() with $this->socket_status
    ( php always reported a notice: undefined property (thats fixed) dont do an unset() on a class vars :) )

  // 24. M&auml;rz 2004 version 1.15 (-fix update-)


  // 25 July 2006 version 1.16 (-fix update-)
  - Qmail does send a point (.) instead an (+OK) by getting an email by the get_mail() function.
    By the 3 parameter $qmailer you can say that we communicate with an qmail server
    
    BEST THANKS TO Daniel Sepeur that he post this cool bug fix on phpclasses.org

  
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
*/
class CPOP3 {
    // Socket Vars
    var $socket = FALSE;
    var $socket_status = FALSE;
    var $socket_timeout = "90,500";

    var $error = "No Errors";
    var $state = "DISCONNECTED";
    var $apop_banner = "";
    var $apop_detect;

    var $log;
    var $log_file;
    var $log_fp;

    var $file_fp;
    
	/**
	 * @access private
	 * @var CLog
	 */
	var $_log;

    // Constructor
    function CPOP3($apop_detect = FALSE)
    {
        $this->apop_detect = $apop_detect;
		$this->_log =& CLog::CreateInstance();
    }
    /*
      Function _cleanup()
      Access: Private
    */
    function _cleanup()
    {
        $this->state = "DISCONNECTED";

        if (is_array($this->socket_status)) $this->socket_status = FALSE;

        if (is_resource($this->socket))
        {
            socket_set_blocking( $this->socket, false);
            @fclose($this->socket);
            $this->socket = FALSE;
        }

    }

    /*
      Function _logging($string)
      Access: Private
    */
    function _logging($string)
    {
        return TRUE;
    }


    /*
      Function connect($server, $port, $timeout, $sock_timeout)
      Access: Public

      // Vars:
      - $server ( Server IP or DNS )
      - $port ( Server port default is "110" )
      - $timeout ( Connection timeout for connect to server )
      - $sock_timeout ( Socket timeout for all actions   (10 sec 500 msec) = (10,500))


      If all right you get true, when not you get false and on $this->error = msg !!!
    */
    function connect($server, $port = '110', $timeout = '10' , $sock_timeout = '10,500')
    {
        if($this->socket)
        {
            $this->error = "POP3 connect() - Error: Connection also avalible !!!";
            setGlobalError($this->error);
            return FALSE;
        }

        if(!trim($server))
        {
            $this->error = "POP3 connect() - Error: Please give a server address.";
            setGlobalError($this->error);
            return FALSE;
        }

        if($port < "1" && $port > "65535" || !trim($port))
        {
            $this->error = "POP3 connect() - Error: Port not set or out of range (1 - 65535)";
            setGlobalError($this->error);
            return FALSE;
        }

        if($timeout < 0 && $timeout > 25 || !trim($timeout))
        {
            $this->error = "POP3 connect() - Error: Connection Timeout not set or out of range (0 - 25)";
            setGlobalError($this->error);
            return FALSE;
        }
        $sock_timeout = explode(",",$sock_timeout);
        if( !trim($sock_timeout[0]) || ($sock_timeout[0] < 0 && $sock_timeout[0] > 25) ) // || !preg_match("^[0-9]",sock_timeout[1]) )
        {
            $this->error = "POP3 connect() - Error: Socket Timeout not set or out of range (0 - 25)";
            setGlobalError($this->error);
            return FALSE;
        }
        /*
        if(!ereg("([0-9]{2}),([0-9]{3})",$sock_timeout))
        {
            $this->error = "POP3 connect() - Error: Socket Timeout in invalid Format (Right Format xx,xxx \"10,500\")";
            return FALSE;
        }
        */
        // Check State
        if(!$this->_checkstate("connect")) return FALSE;

        $this->socket = @fsockopen($server, $port, $errno, $errstr, $timeout);
        if(!$this->socket)
        {
            $this->error = "POP3 connect() - Error: Can't connect to Server. Error: ".$errno." -- ".$errstr;
            setGlobalError($this->error);
            return FALSE;
        }

        // Set Socket Timeout
        // It is valid for all other functions !!
        socket_set_timeout($this->socket,$sock_timeout[0],$sock_timeout[1]);
        socket_set_blocking($this->socket,true);

        $response = $this->_getnextstring();

        if(substr($response,0,1) != "+")
        {
            $this->_cleanup();
            $this->error = "POP3 connect() - Error: ".$response;
            setGlobalError($this->error);
            return FALSE;
        }

        // Get the server banner for APOP
        $this->apop_banner = $this->_parse_banner($response);

        $this->state = "AUTHORIZATION";

        return TRUE;

    }

    /*
      Function _login($user, $pass)
      Access: Public
    */
    function login($user, $pass, $apop = "0"){
        if(!$this->socket){
            $this->error = "POP3 login() - Error: No connection avalible.";
            setGlobalError($this->error);
            $this->_cleanup();
            return FALSE;
        }

        if( $this->_checkstate("login") ){

        if($this->apop_detect){
            if($this->apop_banner != ""){
                $apop = "1";
            }
        }

        if($apop == "0"){

            $response = "";
            $cmd = "USER $user";
            if(!$this->_putline($cmd)) return FALSE;

            $response = $this->_getnextstring();

            if (substr($response,0,1) == "-" )
            {
            	setGlobalError($response);
                $this->error = "POP3 login() - Error: ".$response;
                $this->_cleanup();
                return FALSE;
            }

            $response = "";
            $cmd = "PASS $pass";
            if(!$this->_putline($cmd)) return FALSE;
            $response = $this->_getnextstring();
            if (substr($response,0,1) == "-" )
            {
            	setGlobalError($response);
                $this->error = "POP3 login() - Error: ".$response;
                $this->_cleanup();
                return FALSE;
            }
            $this->state = "TRANSACTION";
            return TRUE;

        }elseif($apop == "1"){
            // APOP Section

            // Check is Server Banner for APOP Command given !!!
            if(empty($this->apop_banner)){
                $this->error = "POP3 login() (APOP) - Error: No Server Banner -- aborted and close connection";
                setGlobalError($this->error);
                $this->_cleanup();
                return FALSE;
            }
            echo $this->apop_banner;

            $response = '';

            // Send APOP Command !!!

            $cmd = "APOP ". $user ." ". md5($this->apop_banner.$pass);

            if(!$this->_putline($cmd)) return FALSE;
            $response = $this->_getnextstring();

            // Check the response !!!
            if(substr($response,0,1) != "+" ){
                $this->error = "POP3 login() (APOP) - Error: ".$response;
                setGlobalError($this->error);
                $this->_cleanup();
                return FALSE;
            }
            $this->state = "TRANSACTION";
            return TRUE;

        }else{
            $this->error = "POP3 login() - Error: Please set apop var !!! (1 [true] or 0 [false]).";
            setGlobalError($this->error);
            $this->_cleanup();
            return FALSE;
        }

        }

        return FALSE;
    }
    /*
      Func get_top($msg_number,$lines)
      Access: Public
    */
    function get_top( $msg_number , $lines = "0" )
    {
        if(!$this->socket)
        {
            $this->error = "POP3 get_top() - Error: No connection avalible.";
            setGlobalError($this->error);
            return FALSE;
        }

        if(!$this->_checkstate("get_top")) return FALSE;

        $response = "";
        $cmd = "TOP " . $msg_number ." ". $lines;
        if(!$this->_putline($cmd)) return FALSE;

        $response = $this->_getnextstring();

        if(substr($response,0,3) != "+OK")
        {
            $this->error = "POP3 get_top() - Error: ".$response;
            setGlobalError($this->error);
            return FALSE;
        }
        // Get Header
        // $i = "0";
        // $response = "<HEADER> \r\n";
        $output = '';
        
        $response = $this->_getnextstring();
        
        while(!eregi("^\.\r\n",$response))
        {
            //if(substr($response,0,4) == "\r\n") break;
           	$output .= $response;

            //$output[$i] = $response;
            //$i++;
            $response = $this->_getnextstring();
        }
        if( $lines == "0" )
        {
            //$response = $this->_getnextstring();
        }
        // $output[$i++] = "</HEADER> \r\n";
        // Get $lines
        if( $lines != "0" )
        {
            //$response = "<MESSAGE> \r\n";
            for($g = 0;$g < $lines; $g++){
                if(eregi("^\.\r\n",$response)) break;
                //$output[$i] = $response;
                //$i++;
	           	$output .= $response;
                $response = $this->_getnextstring();
            }
            //$output[$i] = "</MESSAGE> \r\n";
        }

        return $output;
    }


    /*
      Function get_mail
      Access: Public
    */
    function get_mail( $msg_number, $qmailer = FALSE )
    {
        if(!$this->socket)
        {
            $this->error = "POP3 get_mail() - Error: No connection avalible.";
			setGlobalError($this->error);
            return FALSE;
        }

        if(!$this->_checkstate("get_mail")) return FALSE;

        $response = "";
        $cmd = "RETR $msg_number";
        if(!$this->_putline($cmd)) return FALSE;

        $response = $this->_getnextstring();

        if ($qmailer == TRUE)
	{
		if(substr($response,0,1) != '.') 
		{
			$this->error = "POP3 get_mail() - Error: ".$response;
			setGlobalError($this->error);
			return FALSE;
		}
	}
	else 
	{
		if(substr($response,0,3) != "+OK") 
		{
			$this->error = "POP3 get_mail() - Error: ".$response;
			setGlobalError($this->error);
			return FALSE;
		}
	}
	
        // Get MAIL !!!
        /*$i = "0";
        $response = "<HEADER> \r\n";
        while(!eregi("^\.\r\n",$response))
        {
            if(substr($response,0,4) == "\r\n") break;
            $output[$i] = $response;
            $i++;
            $response = $this->_getnextstring();
        }
        $output[$i++] = "</HEADER> \r\n";

        $response = "<MESSAGE> \r\n";*/

        $output = '';
        $response = $this->_getnextstring();

        while(!ereg("^\.\r\n",$response))
        {
        	$output .= $response;
            //$output[$i] = $response;
            //$i++;
            $response = $this->_getnextstring();
        	if ($response === false)
            {
            	$output = '';
            	break;
            }
        }
        //$output[$i] = "</MESSAGE> \r\n";

        return $output;
    }


    /*
       Function _check_state()
       Access: Private

    */

    function _checkstate($string)
    {
        // Check for delete_mail func
        if($string == "delete_mail" || $string == "get_office_status" || $string == "get_mail" || $string == "get_top" || $string == "noop" || $string == "reset" || $string == "uidl" || $string == "stats")
        {
            $state = "TRANSACTION";
            if($this->state != $state){
                $this->error = "POP3 $string() - Error: state must be in \"$state\" mode !!! Your state: \"$this->state\" !!!";
                setGlobalError($this->error);
                return FALSE;
            }
            return TRUE;
        }

        // Check for connect func
        if($string == "connect")
        {
            $state = "DISCONNECTED";
            $state_1 = "UPDATE";
            if($this->state == $state or $this->state == $state_1){
                return TRUE;
            }
            $this->error= "POP3 $string() - Error: state must be in \"$state\" or \"$state_1\" mode !!! Your state: \"$this->state\" !!!";
            setGlobalError($this->error);
            return FALSE;

        }

        // Check for login func
        if($string == "login")
        {
            $state = "AUTHORIZATION";
            if($this->state != $state){
                $this->error = "POP3 $string() - Error: state must be in \"$state\" mode !!! Your state: \"$this->state\" !!!";
                setGlobalError($this->error);
                return FALSE;
            }
            return TRUE;
        }
        $this->error = "POP3 _checkstate() - Error: Not allowed string given !!!";
        setGlobalError($this->error);
        return FALSE;
    }

    /*
    * Function delete_mail($msg_number)
    * Access: Public
    */
    function delete_mail($msg_number = "0")
    {
         if(!$this->socket){
            $this->error = "POP3 delete_mail() - Error: No connection avalible.";
            setGlobalError($this->error);
            return FALSE;
        }
        if(!$this->_checkstate("delete_mail")) return FALSE;

        if($msg_number == "0"){
            $this->error = "POP3 delete_mail() - Error: Please give a valid Messagenumber (Number can't be \"0\").";
            setGlobalError($this->error);
            return FALSE;
        }
        // Delete Mail
        $response = "";
        $cmd = "DELE $msg_number";
        if(!$this->_putline($cmd)) return FALSE;
        $response = $this->_getnextstring();
        if(substr($response,0,1) != "+"){
           $this->error = "POP3 delete_mail() - Error: ".$response;
           setGlobalError($this->error);
           return FALSE;
        }

        return TRUE;
    }


    /*
      Function get_office_status
      Access: Public

      Output an array

      Array
     (
        [count_mails] => 3
        [octets] => 2496
        [1] => Array
              (
                  [size] => 832
                  [uid] => 617999468
              )

        [2] => Array
              (
                  [size] => 882
                  [uid] => 617999616
              )

        [3] => Array
              (
                  [size] => 1726
                  [uid] => 617999782
              )

        [error] => No Errors
     )

    */

    function get_office_status(){

        if(!$this->socket){
            $this->error = "POP3 get_office_status() - Error: No connection avalible.";
            setGlobalError($this->error);
            $this->_cleanup();
            return FALSE;
        }

        if(!$this->_checkstate("get_office_status")){
            $this->_cleanup();
            return FALSE;
        }

        // Put the "STAT" Command !!!
        $response = "";
        $cmd = "STAT";
        if(!$this->_logging($cmd)) return FALSE;
        if(!$this->_putline($cmd)) return FALSE;

        $response = $this->_getnextstring();

        if(!$this->_logging($response)) return FALSE;

        if(substr($response,0,3) != "+OK"){
            $this->error = "POP3 get_office_status() - Error: ".$response;
            setGlobalError($this->error);
            if(!$this->_logging($this->error)) return FALSE;
            $this->_cleanup();
            return FALSE;
        }
        // Remove "\r\n" !!!
        $response = trim($response);

        ////////////////////////////////////////////////////////////////////////
        // Some Server send the STAT string is finished by "." (+OK 3 52422.)
        // - "Yahoo Server"
        $lastdigit = substr($response,-1);
        if(!ereg("(0-9)",$lastdigit)){
            $response = substr($response,0,strlen($response)-1);
        }
        unset($lastdigit);
        ////////////////////////////////////////////////////////////////////////

        $array = explode(" ",$response);
        $output["count_mails"] = $array[1];
        $output["octets"] = $array[2];

        unset($array);
        $response = "";

        if($output["count_mails"] != "0"){

            // List Command
            $cmd = "LIST";
            if(!$this->_logging($cmd)) return FALSE;
            if(!$this->_putline($cmd)) return FALSE;
            $response ="";
            $response = $this->_getnextstring();

            if(!$this->_logging($response)) return FALSE;

            if(substr($response,0,3) != "+OK"){
                $this->error = "POP3 get_office_status() - Error: ".$response;
                $this->_cleanup();
                return FALSE;
            }
            // Get Message Number and Size !!!
            $response = "";
            for($i=0;$i<$output["count_mails"];$i++){
                $nr=$i+1;
                $response = trim($this->_getnextstring());
                if(!$this->_logging($response)) return FALSE;
                $array = explode(" ",$response);
                $output[$nr]["size"] = $array[1];
                $response = "";
                unset($array);
                unset($nr);
            }
            // $response = $this->_getnextstring();
            // echo "<b>".$response."</b>";

            // Check is server send "."
            if(trim($this->_getnextstring()) != "."){
                $this->error = "POP3 get_office_status() - Error: Server does not send "." at the end !!!";
                $this->_cleanup();
                return FALSE;
            }
            if(!$this->_logging(".")) return FALSE;

            // UIDL Command
            $cmd = "UIDL";
            if(!$this->_logging($cmd)) return FALSE;
            if(!$this->_putline($cmd)) return FALSE;
            $response = "";
            $response = $this->_getnextstring();
            if(!$this->_logging($response)) return FALSE;
            if(substr($response,0,3) != "+OK"){
                $this->error = "POP3 get_office_status() - Error: ".$response;
                setGlobalError($this->error);
                $this->_cleanup();
                return FALSE;
            }
            // Get UID's
            $response = "";
            for($i=0;$i<$output["count_mails"];$i++){
                $nr=$i+1;
                $response = trim($this->_getnextstring());
                if(!$this->_logging($response)) return FALSE;
                $array = explode(" ", $response);
                $output[$nr]["uid"] = $array[1];
                $response = "";
                unset($array);
                unset($nr);
            }

            // Check is server send "."
            if(trim($this->_getnextstring()) != "."){
                $this->error = "POP3 get_office_status() - Error: Server does not send "." at the end !!!";
                setGlobalError($this->error);
                $this->_cleanup();
                return FALSE;
            }
            if(!$this->_logging(".")) return FALSE;
        }

        return $output;

    }

    /*

      Access: Public
    */

    function noop(){
        if(!$this->socket){
            $this->error = "POP3 noop() - Error: No connection avalible.";
            setGlobalError($this->error);
            if(!$this->_logging($this->error)) return FALSE;
            return FALSE;
        }
        if(!$this->_checkstate("noop")) return FALSE;

        $cmd = "NOOP";

        if(!$this->_logging($cmd)) return FALSE;
        if(!$this->_putline($cmd)) return FALSE;

        $response = "";
        $response = $this->_getnextstring();
        if(!$this->_logging($response)) return FALSE;
        if(substr($response,0,1) != "+"){
            $this->error = "POP3 noop() - Error: ".$response;
            setGlobalError($this->error);
            return FALSE;
        }

        return TRUE;
    }

    /*
      Function reset()
      Access: Public
    */
    function reset(){
        if(!$this->socket){
            $this->error = "POP3 reset() - Error: No connection avalible.";
            setGlobalError($this->error);
            if(!$this->_logging($this->error)) return FALSE;

            return FALSE;
        }

        if(!$this->_checkstate("reset")) return FALSE;

        $cmd = "RSET";

        if(!$this->_logging($cmd)) return FALSE;
        if(!$this->_putline($cmd)) return FALSE;
        $response = "";
        $response = $this->_getnextstring();
        if(!$this->_logging($response)) return FALSE;
        if(substr($response,0,1) != "+"){
            $this->error = "POP3 reset() - Error: ".$response;
            setGlobalError($this->error);
            return FALSE;
        }
        return TRUE;
    }
    /*
      Function stats
      Access: Private
      Get only count of mails and size of maildrop !!!
    */

    function _stats(){
        if(!$this->socket){
            $this->error = "POP3 _stats() - Error: No connection avalible.";
            setGlobalError($this->error);
            return FALSE;
        }

        if(!$this->_checkstate("stats")) return FALSE;
        $cmd = "STAT";
        if(!$this->_putline($cmd)) return FALSE;

        $response = $this->_getnextstring();
        if(substr($response,0,1) != "+"){
            $this->error = "POP3 _stats() - Error: ".$response;
            setGlobalError($this->error);
            return FALSE;
        }
        $response = trim($response);
        
        ////////////////////////////////////////////////////////////////////////
        // Some Server send the STAT string is finished by "." (+OK 3 52422.)
        // - "Yahoo Server"
        $lastdigit = substr($response,-1);
        if(!ereg("(0-9)",$lastdigit)){
            $response = substr($response,0,strlen($response)-1);
        }
        unset($lastdigit);
        ////////////////////////////////////////////////////////////////////////

        $array = explode(' ',$response);

        $output["count_mails"] = $array[1];
        $output["octets"] = $array[2];

        return $output;
    }

    /*
      Function uidl($msg_number = "0")
      Access: Public
    */
    function uidl($msg_number = "0"){
        if(!$this->socket){
            $this->error = "POP3 uidl() - Error: No connection avalible.";
            setGlobalError($this->error);
            return FALSE;
        }

        if(!$this->_checkstate("uidl")) return FALSE;

        if($msg_number == '0'){
            $cmd = 'UIDL';

            // Get count of mails
            $mails = $this->_stats();
            if(!$mails) return FALSE;

            if(!$this->_logging($cmd)) return FALSE;
            if(!$this->_putline($cmd)) return FALSE;

            $response = '';
            $response = $this->_getnextstring();
            if(!$this->_logging($response)) return FALSE;
            if(substr($response,0,1) != "+"){
               $this->error = "POP3 uidl() - Error: ".$response;
               setGlobalError($this->error);
               return FALSE;
            }
            $response = "";
            $output = array();
            for($i = 1; $i <= $mails["count_mails"];$i++){
                $response = $this->_getnextstring();
                if(!$this->_logging($response)) return FALSE;
                $response = trim($response);
                $array = explode(" ",$response);
                $output[$i] = $array[1];
            }
            $this->_getnextstring();
            return $output;
        }else{
            $cmd = "UIDL $msg_number";

            if(!$this->_logging($cmd)) return FALSE;
            if(!$this->_putline($cmd)) return FALSE;

            $response = "";
            $response = $this->_getnextstring();
            if(!$this->_logging($response)) return FALSE;
            if(substr($response,0,1) != "+"){
               $this->error = "POP3 uidl() - Error: ".$response;
               setGlobalError($this->error);
               return FALSE;
            }

            $response = trim($response);

            $array = explode(' ',$response);

            $output[$array[1]] = $array[2];


            return $output;
        }

    }

    /*
      Function list($msg_number = "0")
      Access: Public
    */
    function msglist($msg_number = "0") {
        if(!$this->socket){
            $this->error = "POP3 uidl() - Error: No connection avalible.";
            setGlobalError($this->error);
            return FALSE;
        }

        if(!$this->_checkstate("uidl")) return FALSE;



        if($msg_number == "0"){
            $cmd = "LIST";

            // Get count of mails
            $mails = $this->_stats();
            if(!$mails) return FALSE;

            if(!$this->_logging($cmd)) return FALSE;
            if(!$this->_putline($cmd)) return FALSE;

            $response = "";
            $response = $this->_getnextstring();
            if(!$this->_logging($response)) return FALSE;
            if(substr($response,0,1) != "+"){
               $this->error = "POP3 uidl() - Error: ".$response;
               setGlobalError($this->error);
               return FALSE;
            }
            $response = "";
            $output = array();
            for($i = 1; $i <= $mails["count_mails"];$i++){
                $response = $this->_getnextstring();
                if(!$this->_logging($response)) return FALSE;
                $response = trim($response);
                $array = explode(" ",$response);
                $output[$i] = $array[1];
            }
            $this->_getnextstring();
            return $output;
        }else{
            $cmd = "LIST $msg_number";

            if(!$this->_logging($cmd)) return FALSE;
            if(!$this->_putline($cmd)) return FALSE;

            $response = "";
            $response = $this->_getnextstring();
            if(!$this->_logging($response)) return FALSE;
            if(substr($response,0,1) != "+"){
               $this->error = "POP3 uidl() - Error: ".$response;
               setGlobalError($this->error);
               return FALSE;
            }

            $response = trim($response);

            $array = explode(' ', $response);

            $output[$array[1]] = $array[2];


            return $output;
        }

    }
    
    
    /*
      Function close()
      Access: Public

      Close POP3 Connection
    */

    function close(){

        $response = "";
        $cmd = "QUIT";
        if(!$this->_logging($cmd)) return FALSE;
        if(!$this->_putline($cmd)) return FALSE;

        if($this->state == "AUTHORIZATION"){
            $this->state = "DISCONNECTED";
        }elseif($this->state == "TRANSACTION"){
            $this->state = "UPDATE";
        }

        $response = $this->_getnextstring();

        if(!$this->_logging($response)) return FALSE;
        if(substr($response,0,1) != "+"){
            $this->error = "POP3 close() - Error: ".$response;
            setGlobalError($this->error);
            return FALSE;
        }
        $this->socket = FALSE;

        $this->_cleanup();

        return TRUE;
    }

    /*
      Function _getnextstring()
      Access: Private
    */

    function _getnextstring( $buffer_size = 512 )
    {
        $buffer = '';
        $buffer = @fgets( $this->socket , $buffer_size);
       	$this->_log->WriteLine('POP3 << : '.trim($buffer));
       	
        if ($buffer && strlen($buffer) > 1 && substr($buffer, 0, 2) == '..')
        {
        	$buffer = substr($buffer, 1);
        }
		
        $this->socket_status = @socket_get_status($this->socket);
        
		if( $this->socket_status["timed_out"] )
        {
            $this->_cleanup();
            $this->error = "Socket timeout reached during POP3 connection.";
            setGlobalError($this->error);
        }
        $this->socket_status = FALSE;

        return $buffer;
    }

    /*
      Function _putline()
      Access: Private
    */
    function _putline($string)
    {
		$this->_log->WriteLine('POP3 >> : '.$string);

        $line = $string."\r\n";
        
        if(!fwrite($this->socket , $line , strlen($line)))
        {
            $this->error = "POP3 _putline() - Error while send \" $string \". -- Connection closed.";
            setGlobalError($this->error);
            $this->_cleanup();
            return FALSE;
        }
        return TRUE;
    }

    /*
      Function _parse_banner( $server_text )
      Access: Private
    */
    function _parse_banner ( &$server_text )
    {
	$outside = true;
	$banner = "";
	$length = strlen($server_text);
	for($count = 0; $count < $length; $count++)
	{
		$digit = substr($server_text,$count,1);
		if($digit != "")
		{
			if( (!$outside) and ($digit != '<') and ($digit != '>') )
			{
				$banner .= $digit;
				continue;
			}
			if ($digit == '<')
			{
				$outside = false;
			}
			elseif ($digit == '>')
			{
				$outside = true;
			}
		}
	}
	$banner = trim($banner);
        if(strlen($banner) != 0 )
        {
            return "<". $banner .">";
        }
        return;
	}

}
