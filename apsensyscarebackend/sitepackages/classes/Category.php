<?php

/******************************************************************************************* 
* Category Class, Start 
*******************************************************************************************/
class Category{
	
	/***************************************************************************************
	* Function to loginCustomer, start
	***************************************************************************************/
	
	function loginCustomer($objArray)
	{
		extract($objArray);
		$objQuery = new Query();
		if(($objQuery->fetchNumRow("`otp`","`mobile`='".$phone."' AND `read_otp`='no' AND `code`='".$otp."' AND `sysDate`='".date('D,d-M-Y')."'"))==1)
		{
			if($objQuery->updateRow("`otp`","`read_otp`='yes',`read_time`='".date('D,d-M-Y h:i:sA')."'","`mobile`='".$phone."' AND `read_otp`='no' AND `code`='".$otp."' AND `sysDate`='".date('D,d-M-Y')."'"))
			{
				if((($objQuery->fetchNumRow("`customer`","`mobile`='".$phone."' AND `del`='no'"))<1))
				{
					$objQuery->insertData("`customer`","`mobile`='".$phone."',`sysTime`='".date('D,d-M-Y h:i:sA')."',`sysDate`='".date('D,d-M-Y')."'");
				}
				$getUserData=mysqli_fetch_assoc($objQuery->fetchResult("`customer`","`mobile`='".$phone."' AND `del`='no'"));
				setcookie("APCCUSTOMER",$getUserData['id'], time() + 30*86400 ,'/');
				return true;
			}
			else return false;
		}
		else return false;
	}
	/***************************************************************************************
	* Function to loginCustomer, start
	***************************************************************************************/	
}
/******************************************************************************************* 
* Category Class, End
*******************************************************************************************/
?>