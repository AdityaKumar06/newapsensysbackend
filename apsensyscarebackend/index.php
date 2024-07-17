<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:*');
header("Access-Control-Allow-Headers: Content-Type");
// echo "test";exit;
error_reporting(E_ALL);

include('./sitepackages/includes/include.php');

$REQUEST_URI = $_SERVER['REQUEST_URI'];
$uri = str_replace('/apsensyscarebackend', '', $REQUEST_URI);
//  echo '<br/>';
//  echo $uri;
//  die;
if ($uri === '/site_user') {
    include('./sitepackages/inbuilt/pages/SignUp.php');
    die;
}elseif ($uri === '/currentuser') {
    include('./sitepackages/inbuilt/pages/Currentuser.php');
    die;
} elseif ($uri === '/admin/getuser') {
    include('./sitepackages/inbuilt/pages/allUsers.php');
    die;
} else if ($uri === '/login_user') {
    include('./sitepackages/inbuilt/pages/Login.php');
    die;
} else if ($uri === '/admin-login') {

    include('./sitepackages/inbuilt/pages/AdminLogin.php');
    die;
} else if ($uri === '/fatch_baner') {
    include('./sitepackages/inbuilt/pages/Baner.php');
    die;
} else if ($uri === '/fatch_category') {
    include('./sitepackages/inbuilt/pages/Category.php');
    die;
} else if ($uri === '/products') {
    include('./sitepackages/inbuilt/pages/Products.php');
    die;
} else if ($uri === '/productdetails') {
    include('./sitepackages/inbuilt/pages/ProductData.php');
    die;
} else if ($uri === '/productdetailsbyid') {
    include('./sitepackages/inbuilt/pages/ProductDetails.php');
    die;
} else if ($uri === '/updateproducts') {
    include('./sitepackages/inbuilt/pages/Updateproducts.php');
    die;
} else if ($uri === '/size') {
    include('./sitepackages/inbuilt/pages/Size.php');
    die;
} else if ($uri === '/magnifying') {
    include('./sitepackages/inbuilt/pages/MagnifyingImages.php');
    die;
} else if ($uri === '/usercart') {
    include('./sitepackages/inbuilt/pages/Cart.php');
    die;
} else if ($uri === '/getAddress') {
    include('./sitepackages/inbuilt/pages/GetAddress.php');
    die;
} else if ($uri === '/addAddress') {
    include('./sitepackages/inbuilt/pages/AddAddress.php');
    die;
} else if ($uri === '/fetchUsersdata') {
    include('./sitepackages/inbuilt/pages/UserDetails.php');
    die;
} else if ($uri === '/addContact') {
    include('./sitepackages/inbuilt/pages/AddContact.php');
    die;
} else if ($uri === '/updateCategory') {
    include('./sitepackages/inbuilt/pages/UpdateCategory.php');
    die;
} else if ($uri === '/createSigneture') {
    include('./sitepackages/inbuilt/razorpay/signeture.php');
    die;
} else if ($uri === '/login_push_user') {
    include('./sitepackages/inbuilt/pages/pushUser.php');
    die;
} else if ($uri === '/addwishlist') {
    include('./sitepackages/inbuilt/pages/AddwishList.php');
    die;
} else if ($uri === '/getuserwishlist') {
    include('./sitepackages/inbuilt/pages/Getuserwishlist.php');
    die;
} else if ($uri === '/featuredbrand') {
    include('./sitepackages/inbuilt/pages/Getdbrand.php');
    die;
} else if ($uri === '/cartdetails') {
    include('./sitepackages/inbuilt/pages/GetCart.php');
    die;
} else if ($uri === '/sendemail') {
    include('./sitepackages/inbuilt/pages/Sendemail.php');
    die;
} else if ($uri === '/createOrder') {
    include('./sitepackages/inbuilt/phonepay/pay.php');
    die;
} else if ($uri === '/payment/status') {
    include('./sitepackages/inbuilt/phonepay/status.php');
    die;
} else if ($uri === '/unsubscribe') {
    include('./sitepackages/inbuilt/pages/DoUnsubscribe.php');
    die;
} else if ($uri === '/currentorder') {
    include('./sitepackages/inbuilt/pages/currentOrder.php');
    die;
} else if ($uri === '/categoryproducts') {
    include('./sitepackages/inbuilt/pages/productBycategory.php');
    die;
} else if ($uri === '/i-upload') {
    include('./sitepackages/inbuilt/pages/imageUpload.php');
    die;
} else if ($uri === '/categorydetailsbyid') {
    include('./sitepackages/inbuilt/pages/CategoryDetails.php');
    die;
} else if ($uri === '/addcategory') {
    include('./sitepackages/inbuilt/pages/AddCategory.php');
    die;
} else if ($uri === '/productsizes') {
    include('./sitepackages/inbuilt/pages/GetproductSizes.php');
    die;
} else if ($uri === '/addproductvarities') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/Addvaritiesproduct.php');
    die;
} else if ($uri === '/addproduct') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/Addproduct.php');
    die;
} else if ($uri === '/deleteproductvarity') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/Deletedatatable.php');
    die;
} else if ($uri === '/resetPassword') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/Passwordreset.php');
    die;
} else if ($uri === '/orderhistory') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/OrderHistory.php');
    die;
} else if ($uri === '/userresetPassword') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/ResetPassword.php');
    die;
}else if ($uri === '/updatepassword') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/UpdatePassword.php');
    die;
}else if ($uri === '/getorderdetails') {//Avidev
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/Ordercommands.php');
    die;
}else if ($uri === '/orderhistorydetails') {//Avidev 5-31-2024
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/OrderhistoryDetails.php');
    die;
}else if ($uri === '/userupdatepassword') {//Avidev Jha for user reset passowrd- step-2 6 JUNE 2024
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/UserupdatePassword.php');
    die;
}else if ($uri === '/profiledetails') {//Avidev 7-10-2024
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/ProfileDetails.php');
    die;
}else if ($uri === '/userAddress') {//Avidev 7-10-2024
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/YourAddress.php');
    die;
}

// dashboard.....

else if ($uri === '/pendingorder') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/PendingOrder.php');
    die;
} else if ($uri === '/orderDetails') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/OrderDetails.php');
    die;
} else if ($uri === '/commands') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/Ordercommands.php');
    die;
} else if ($uri === '/statusupdate') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/UpdateOrderStatus.php');
    die;
} else if ($uri === '/Addsize') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/Addsize.php');
    die;
} else if ($uri === '/deleteorder') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/deleteorder.php');
    die;
} else if ($uri === '/customer') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/Customer.php');
    die;
} else if ($uri === '/revenuehistory') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/RevenueHistory.php');
    die;
} else if ($uri === '/customeredit') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/CustomerEdit.php');
    die;
} else if ($uri === '/updatepaswword') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/UpdatePassword.php');
    die;
} else if ($uri === '/imagemagnified') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/Image_magnified.php');
    die;
} else if ($uri === '/deleteuser') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/DeleteUser.php');
    // die;
} else if ($uri === '/addbanners') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/Addbanners.php');
    // die;
} else if ($uri === '/productdelete') {
    // echo($uri);die;
    include('./sitepackages/inbuilt/pages/Deleteproduct.php');
    // die;
} else {
    echo "bed request";
}
