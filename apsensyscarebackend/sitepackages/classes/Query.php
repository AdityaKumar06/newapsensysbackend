<?php

/******************************************************************************************* 
 * Query Class, Start 
 *******************************************************************************************/
class Query
{

	function getMysqliLink()
	{
		$obj = new Connection;
		return $obj->getLink();
	}

	/***************************************************************************************
	 * function for Curl URL with DATA, End
	 ***************************************************************************************/
	function curlData($url, $data)
	{
		$objURL = curl_init($url);
		curl_setopt($objURL, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($objURL, CURLOPT_POST, 1);
		curl_setopt($objURL, CURLOPT_POSTFIELDS, $data);
		$retval = trim(curl_exec($objURL));
		curl_close($objURL);
		return $retval;
	}
	/***************************************************************************************
	 * function for Curl URL with DATA, Start
	 ***************************************************************************************/
	/***************************************************************************************
	 * function for Curl URL with DATA No SSL, End
	 ***************************************************************************************/
	function curlDataNoSSL($url, $data)
	{
		$objURL = curl_init($url);
		curl_setopt($objURL, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($objURL, CURLOPT_POST, 1);
		curl_setopt($objURL, CURLOPT_POSTFIELDS, $data);
		curl_setopt($objURL, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($objURL, CURLOPT_SSL_VERIFYPEER, false);
		$retval = trim(curl_exec($objURL));
		curl_close($objURL);
		return $retval;
	}
	/***************************************************************************************
	 * function for Curl URL with DATA No SSL, Start
	 ***************************************************************************************/

	/***************************************************************************************
	 * Calculate Sum Of Rows For A Column and return value, Start
	 ***************************************************************************************/
	function fetchSingleArrayValue($select, $tbl, $con)
	{
		$sql = "SELECT " . $select . " FROM " . $tbl . " WHERE " . $con;
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		$resultDetails = mysqli_fetch_row($result);
		return $resultDetails[0];
	}
	/***************************************************************************************
	 *Calculate Sum Of Rows For A Column and return value, End 
	 ***************************************************************************************/
	/***************************************************************************************
	 * Method to genrate Code, Start
	 ***************************************************************************************/
	function getRandomHashCode()
	{
		return md5(uniqid(rand(), true));
	}
	/***************************************************************************************
	 * Method to genrate Code, Start
	 ***************************************************************************************/
	/***************************************************************************************
	 * Method to genrate User ID, Start
	 ***************************************************************************************/
	function generateUserID()
	{
		$userID = 'ASC' . rand(1000, 9999) . '' . chr(rand(65, 90)) . '' . chr(rand(65, 90));
		return $userID;
	}
	/***************************************************************************************
	 * Method to genrate User ID, Start
	 ***************************************************************************************/
	/***************************************************************************************
	 * Method to insert data, Start
	 ***************************************************************************************/
	function insertData($tbl, $val)
	{
		$sql = "INSERT INTO " . $tbl . " SET " . $val;
		$res = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		if ($res) {
			return true;
		} else {
			return false;
		}
	}
	/***************************************************************************************
	 * Method to insert data, End 
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method to fetch all results, Start
	 ***************************************************************************************/
	function fetchResults($tbl)
	{
		$sql = "SELECT * FROM " . $tbl;
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method to fetch all results, End
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method to fetch rows on a condition, Start
	 ***************************************************************************************/
	function fetchResult($tbl, $con)
	{
		$sql = "SELECT * FROM " . $tbl . " WHERE " . $con;
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method to fetch rows on a condition, End
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method to fetch rows on a condition, Start
	 ***************************************************************************************/
	function fetchResultsLimit($tbl, $con, $limit)
	{
		$sql = "SELECT * FROM " . $tbl . " WHERE " . $con . " LIMIT " . $limit;
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method to fetch rows on a condition, End
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method to fetch number of rows, Start
	 ***************************************************************************************/
	function fetchNumRows($tbl)
	{
		$sql = "SELECT * FROM " . $tbl;
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		$rows = mysqli_num_rows($result);
		return $rows;
	}
	/***************************************************************************************
	 * Method to fetch number of rows, End 
	 ***************************************************************************************/

	/***************************************************************************************
	 * Calculate Sum Of Rows For A Column, Start
	 ***************************************************************************************/
	function fetchSelectRows($select, $tbl, $con)
	{
		$sql = "SELECT " . $select . " FROM " . $tbl . " WHERE " . $con;
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 *Calculate Sum Of Rows For A Column, End 
	 ***************************************************************************************/
 

	/***************************************************************************************
	 * Method to fetch number of rows on a condition, Start
	 ***************************************************************************************/
	function fetchNumRow($tbl, $con)
	{
		$sql = "SELECT * FROM " . $tbl . " WHERE " . $con;
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		$rows = mysqli_num_rows($result);
		return $rows;
	}
	/***************************************************************************************
	 * Method to fetch number of rows on a condition, End
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method to fetch result order by ascending, Start
	 ***************************************************************************************/
	function fetchResultOrderBy($tbl, $con, $orderby)
	{
		$sql = "SELECT * FROM " . $tbl . " WHERE " . $con . " ORDER BY " . $orderby . " ASC";
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method to fetch result order by ascending, End
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method to fetch result order by ascending, Start
	 ***************************************************************************************/
	function fetchResultsOrderBy($tbl, $orderby)
	{
		$sql = "SELECT * FROM " . $tbl . " ORDER BY " . $orderby . " ASC";
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method to fetch result order by ascending, End
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method to fetch result group by, Start
	 ***************************************************************************************/
	function fetchResultsGroupBy($tbl, $groupby)
	{
		$sql = "SELECT * FROM " . $tbl . " GROUP BY " . $groupby;
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method to fetch result group by, End
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method for where condition and group by., Start
	 ***************************************************************************************/
	function fetchResultGroupBy($tbl, $con, $groupby)
	{
		$sql = "SELECT * FROM " . $tbl . " WHERE " . $con . " GROUP BY " . $groupby;
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method for where condition and group by., End
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method for group by and order by, Start
	 ***************************************************************************************/
	function fetchResultGroupByOrderBy($tbl, $groupby, $orderby)
	{
		$sql = "SELECT * FROM " . $tbl . " GROUP BY " . $groupby . " ORDER BY " . $orderby;
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method for group by and order by, End
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method to delete rows, Start
	 ***************************************************************************************/
	function deleteRows($tbl)
	{
		$sql = "DELETE FROM " . $tbl;
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return true;
	}
	/***************************************************************************************
	 * Method to delete rows, End
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method to delete row on a condition, Start
	 ***************************************************************************************/
	function deleteRow($tbl, $con)
	{
		$sql = "DELETE FROM " . $tbl . " WHERE " . $con;
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return true;
	}
	/***************************************************************************************
	 * Method to delete row on a condition, End
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method to delete rows using in operator, Start
	 ***************************************************************************************/
	function deleteRowArray($tbl, $con, $arr)
	{
		$sql = "DELETE FROM " . $tbl . " WHERE " . $con . " IN (" . $arr . ")";
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return true;
	}
	/***************************************************************************************
	 * Method to delete rows using in operator, End
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method to update rows using in operator, Start
	 ***************************************************************************************/
	function updateRowArray($tbl, $val, $con, $arr)
	{
		$sql = "UPDATE " . $tbl . " SET " . $val . " WHERE " . $con . " IN (" . $arr . ")";
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return true;
	}
	/***************************************************************************************
	 * Method to update rows using in operator, End
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method to fetch rows using in operator, Start
	 ***************************************************************************************/
	function fetchRowArray($tbl, $con, $arr)
	{
		$sql = "SELECT * FROM " . $tbl . " WHERE " . $con . " IN (" . $arr . ")";
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return true;
	}
	/***************************************************************************************
	 * Method to fetch rows using in operator, End
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method to fetch values, Start
	 ***************************************************************************************/
	function fetchValues($fields, $tbl, $con)
	{
		$sql = "SELECT " . $fields . " FROM " . $tbl . " WHERE " . $con;
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method to fetch values, End
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method to update table, Start
	 ***************************************************************************************/
	function updateRow($tbl, $val, $con)
	{
		$sql = "UPDATE " . $tbl . " SET " . $val . " WHERE " . $con;
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method to update table, End
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method to fetch record from query, Start
	 ***************************************************************************************/
	function queryRecord($sql)
	{
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method to fetch record from query, End
	 ***************************************************************************************/

	/***************************************************************************************
	 * Method for date difference, Start
	 ***************************************************************************************/
	function dateDiff($dformat, $endDate, $beginDate)
	{
		$date_parts1 = explode($dformat, $beginDate);
		$date_parts2 = explode($dformat, $endDate);
		$start_date = gregoriantojd($date_parts1[1], $date_parts1[0], $date_parts1[2]);
		$end_date = gregoriantojd($date_parts2[1], $date_parts2[0], $date_parts2[2]);
		return $end_date - $start_date;
	}
	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
	/***************************************************************************************
	 * Method for date difference, Start
	 ***************************************************************************************/
	function CustomerEditDetails($userId) //Profile display
    {
        $sql = "SELECT  * FROM site_user JOIN `address` ON `site_user`.`phone_number` = `address`.`contact`  WHERE `site_user`.`userId`='$userId' ";
        $result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
        return $result;
    }
	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
	/***************************************************************************************
	 * Method for date difference, Start
	 ***************************************************************************************/ 
	function Youraddress($userId) //Profile display
    {
        // $sql = "SELECT  * FROM site_user JOIN `address` ON `site_user`.`phone_number` = `address`.`contact`  WHERE `site_user`.`userId`='$userId' ";
		$sql="SELECT address.*, user_address.user_id, user_address.address_id, user_address.is_default, user_address.created_at FROM address JOIN user_address ON address.id = user_address.address_id WHERE `user_address`.`user_id`='$userId'";
        $result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
        return $result; 
    }
	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
	/***************************************************************************************
	 * Method for date difference, Start
	 ***************************************************************************************/
	function joinProductandOrder($productid, $orderid)
	{
		$sql = "SELECT CONCAT(product.brand_name, product.name) as product_name, order_line.order_id, order_line.ordered_price, order_line.ordered_bag_size, order_line.quantity FROM product JOIN order_line ON product.id = $productid WHERE `order_line`.`order_id`='$orderid'";
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
	/***************************************************************************************
	 * Method for date difference, Start
	 ***************************************************************************************/
	function productIdwithSize($id)
	{
		$sql = "SELECT * FROM product_size JOIN product_entry ON product_size.id = product_entry.size_id WHERE product_entry.product_id = '$id'";

		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
	/***************************************************************************************
	 * Method for date difference, Start
	 ***************************************************************************************/
	function getpendingOrder()
	{
		$sql = "SELECT shop_order.*, site_user.f_name FROM shop_order JOIN site_user ON shop_order.user_id = site_user.userId WHERE shop_order.order_status = 'pending' ORDER BY `shop_order`.`created_at` ASC";

		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
	/***************************************************************************************
	 * Method for date difference, Start
	 ***************************************************************************************/
	function orderDetails($id)
	{
		$sql = "SELECT order_line.*,product.product_image,product.name,product.brand_name FROM product JOIN order_line ON order_line.product_id = product.id WHERE order_line.order_id = '$id'";

		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}

	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
	/***************************************************************************************
	 * Method for date difference, Start
	 ***************************************************************************************/
	function fullorderDetails($order_status)
	{
		$sql = "select shop_order.*,address.*,site_user.f_name from shop_order JOIN site_user on site_user.userId=shop_order.user_id JOIN address ON address.id= shop_order.address_id WHERE shop_order.order_status='$order_status'";

		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}

	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
		/***************************************************************************************
	* Method for date difference, Start
	***************************************************************************************/
	function getOrderHistory($userid){
		$sql="select shop_order.user_id, shop_order.order_id, shop_order.order_total, order_line.quantity,order_line.ordered_price, shop_order.order_status, shop_order.order_date, product.id, product.brand_name, product.short_name, product.product_image, product.default_size FROM shop_order JOIN order_line ON shop_order.order_id = order_line.order_id JOIN product ON order_line.product_id = product.id WHERE shop_order.user_id='$userid'";
		
		$result=mysqli_query($this->getMysqliLink(),$sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	// Avidev
	function getOrderdetailhistory($userid){
		$sql="select shop_order.user_id, shop_order.order_id, shop_order.order_total, order_line.quantity,order_line.ordered_price, shop_order.order_status, shop_order.order_date, product.id, product.brand_name, product.short_name, product.product_image, product.default_size FROM shop_order JOIN order_line ON shop_order.order_id = order_line.order_id JOIN product ON order_line.product_id = product.id WHERE shop_order.user_id='$userid'";
		
		$result=mysqli_query($this->getMysqliLink(),$sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	
	/***************************************************************************************
	* Method for date difference, End
	***************************************************************************************/
	function CustomerResult()
	{
		$sql = "SELECT site_user.id,site_user.userId,site_user.f_name,`updated_at`AS last_seen, SUM(shop_order.order_total) AS order_total,SUM(shop_order.total_quantity) AS total_quantity FROM site_user LEFT JOIN shop_order ON site_user.userId = shop_order.user_id GROUP BY site_user.userId";
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
	function RevenueHistory()
	{
		$sql = "WITH RECURSIVE DateSeries AS ( SELECT CURDATE() - INTERVAL 29 DAY AS date UNION SELECT date + INTERVAL 1 DAY FROM DateSeries WHERE date < CURDATE() ) SELECT ds.date AS order_date, COALESCE(SUM(so.order_total), 0) AS total_amount_sold FROM DateSeries ds LEFT JOIN shop_order so ON DATE(so.created_at) = ds.date GROUP BY ds.date ORDER BY ds.date";
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
	function CustomerEdit()
	{
		$sql = "SELECT `type`,`f_name`,`l_name`,`email_address`,`phone_number`,`password` FROM `site_user`";
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
	function productdata()
	{
		$sql = "SELECT product.id, product_entry.size_id,product.default_price FROM product JOIN product_entry ORDER BY product.id DESC LIMIT 1";
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
	function getdefaultProducts()
	{
		$sql = "SELECT product.*, product_entry.price,product_entry.mrp, product_size.size_value,ROUND(((product_entry.mrp - product_entry.price) / product_entry.mrp) * 100,0) AS discount FROM product JOIN ( SELECT product_id, MIN(price) AS min_price FROM product_entry GROUP BY product_id ) AS min_prices ON product.id = min_prices.product_id JOIN product_entry ON product.id = product_entry.product_id AND min_prices.min_price = product_entry.price JOIN product_size ON product_entry.size_id = product_size.id";
		$result = mysqli_query($this->getMysqliLink(), $sql) or die(mysqli_error($this->getMysqliLink()));
		return $result;
	}
	/***************************************************************************************
	 * Method for date difference, End
	 ***************************************************************************************/
}
/******************************************************************************************* 
* Query Class, End 
*******************************************************************************************/
