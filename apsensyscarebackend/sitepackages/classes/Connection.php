<?php
class Connection {
    //Initialization of the variables
	protected 	$link;
    private 	$server=HOST_NAME;
	private 	$username=USER_NAME;
	private 	$password=PASSWORD;
	private 	$db=DB_NAME;
    var 		$strErrorMessage;
    //Constructor define
	public function __construct()
    {
        $this->connect();
    }//End constructor
    //Method  for connectivity
    private function connect(){
        $this->link = mysqli_connect($this->server, $this->username, $this->password, $this->db, '3306');
		if($this->link){
			if(!mysqli_select_db($this->link,$this->db)){
				echo $this->strErrorMessage = ERR_NO_DATABASE ." ".mysqli_error($this->link);
				return false;
			}
		} else {
			echo $this->strErrorMessage = ERR_CONNECT_SERVER." ".mysqli_connect_error($this->link);
			return false;
		}
		return true;
    }//End method
	public function getLink()
	{
    	return $this->link;
	}
    //Method to close the database connection
    public function __sleep(){
        mysqli_close($this->link);
    }//End sleep method
    //Wakeup method
    public function __wakeup(){
        $this->connect();
    }//End wakeup method
}//End class

?> 