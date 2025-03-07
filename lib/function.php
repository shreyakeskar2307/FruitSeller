<?php

session_start();
date_default_timezone_set('Asia/Kolkata');//set india time zone

class class_functions
{

    private $con;//connection object

    //connection database
    function __construct()
    {
 
        $this->con = new mysqli("localhost", "root", "", "fruit_seller");
    }



    function  fruit_registered(
        $var_first_name, $var_last_name, $var_mobile_no, $var_account_type, $var_company_name, $var_company_address,$var_profile_image, $var_email, $var_password, $var_con_password)
    {
        // not user input automatically saved value of date and time
        $current_date = date("Y-m-d");
        $current_time = date("H:i:s A");
    
        // parameter pass
        if ($stmt = $this->con->prepare("INSERT INTO `fruit_registered`(`first_name`, `last_name`, `mobile_no`, `account_type`, `company_name`, `company_address`, `profile_image`, `email`, `password`, `con_password`,`current_date`,`current_time`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)")) {
            // save value in table
            $stmt->bind_param(
                "ssssssssssss",
                $var_first_name, $var_last_name, $var_mobile_no, $var_account_type, $var_company_name, $var_company_address, $var_profile_image, $var_email, $var_password, $var_con_password, $current_date, $current_time
            );
            
    
            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    


    function get_user_password($var_email)
    {
        if ($stmt = $this->con->prepare("SELECT password FROM fruit_registered WHERE email = ?")) {
            $stmt->bind_param("s", $var_email);
            $stmt->execute();
            $stmt->bind_result($res_password);
            if ($stmt->fetch()) {
                $stmt->close();
                return $res_password;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            return false;
        }
    }


    // Fetch user report from the database
    function get_user_report()
    {
        // Prepare the SELECT query
        if($stmt = $this->con->prepare("SELECT `id`,`first_name`, `last_name`, `mobile_no`, `account_type`, 
        `company_name`, `company_address`, `email`, `password`, `con_password`  FROM `fruit_registered`")){//connection used and prepare by query

           //bind result
           $stmt->bind_result($res_id, $res_first_name, $res_last_name, $res_mobile_no, $res_account_type,
           $res_company_name, $res_company_address, $res_email, $res_password, $res_con_password);//text=s,int=i
           //bind result to a named show the  result

           if($stmt->execute())
           {
                $data = array();
                $counter = 0; // Initialize a counter
                while($stmt->fetch()) 
                {
                    $data[$counter]['id']                   = $res_id;
                    $data[$counter]['first_name']           = $res_first_name;
                    $data[$counter]['last_name']            = $res_last_name;
                    $data[$counter]['mobile_no']            = $res_mobile_no;
                    $data[$counter]['account_type']         = $res_account_type;
                    $data[$counter]['company_name']         = $res_company_name;
                    $data[$counter]['company_address']      = $res_company_address;
                    $data[$counter]['email']                = $res_email;
                    $data[$counter]['password']             = $res_password;
                    $data[$counter]['con_password']         = $res_con_password;

                    $counter++;
                }
                if(!empty($data))
                {
                    return $data;
                }
                else
                {
                    return false;
                }
            }
            
        }
    }

    function delete_user_record($del_id)
    {
        if($stmt = $this->con->prepare("Delete from `fruit_registered` where `id`=?"))
        {
            $stmt->bind_param("i",$del_id);

            if($stmt->execute())
            {
                return true;

            }
            else{
                return false;
            }
        }
    }

    function update_entery($var_first_name, $var_last_name, $var_mobile_no, $var_account_type, $var_company_name, $var_company_address, $var_email, $var_password, $var_con_password, $res_edit_id)
    {
        // Prepare the SQL statement with the correct number of placeholders
        if ($stmt = $this->con->prepare("UPDATE `fruit_registered` SET `first_name`=?, `last_name`=?, `mobile_no`=?, `account_type`=?, `company_name`=?, `company_address`=?, `email`=?, `password`=?, `con_password`=?  WHERE `id`=?")) 
        {
            // Bind parameters with the correct types (9 parameters in total)
            $stmt->bind_param("sssssssssi",$var_first_name, $var_last_name, $var_mobile_no, $var_account_type, $var_company_name, $var_company_address, $var_email, $var_password, $var_con_password,$res_edit_id);
    
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } 
    }

    function get_user_data_from_id($edit_id)
    {
        // Correct SQL Query (remove non-existing fields like city, current_date, etc.)
        if ($stmt = $this->con->prepare("SELECT `id`, `first_name`, `last_name`, `mobile_no`, `account_type`, `company_name`, `company_address`, `email`, `password`, `con_password` FROM `fruit_registered` WHERE `id` = ?")) {

            $stmt->bind_param("i", $edit_id);
            $stmt->execute();
    
            // Bind correct number of fields
            $stmt->bind_result(
                $res_id, $res_first_name, $res_last_name, $res_mobile_no, $res_account_type,
                $res_company_name, $res_company_address, $res_email, $res_password, $res_con_password
            );
           if($stmt->execute())
           {
                $data = array();

                if($stmt->fetch()) 
                {
                    $data['id']                     = $res_id;
                    $data['first_name']             = $res_first_name;
                    $data['last_name']              = $res_last_name;
                    $data['mobile_no']              = $res_mobile_no;
                    $data['account_type']           = $res_account_type;
                    $data['company_name']           = $res_company_name;
                    $data['company_address']        = $res_company_address;
                    $data['email']                  = $res_email;
                    $data['password']               = $res_password;
                    $data['con_password']           = $res_con_password;


                }
                if(!empty($data))
                {
                    return $data;
                }
                else
                {
                    return false;
                }
            }
            
        }
    }

// contact

    function  contact_details(
        $var_full_name, $var_email, $var_message)
    {
        // not user input automatically saved value of date and time
        $curr_date = date("Y-m-d");
        $curr_time = date("H:i:s A");
    
        // parameter pass
        if ($stmt = $this->con->prepare("INSERT INTO `contact_details`(`full_name`, `email`, `message`,`curr_date`,`curr_time`) VALUES (?,?,?,?,?)")) {
            // save value in table
            $stmt->bind_param(
                "sssss",
                $var_full_name, $var_email, $var_message, $curr_date, $curr_time);
            
    
            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function get_user_contact_report()
    {
        // Prepare the SELECT query
        if($stmt = $this->con->prepare("SELECT `id`,`full_name`,`email`,`message`  FROM `contact_details`")){//connection used and prepare by query

           //bind result
           $stmt->bind_result($res_id, $res_full_name, $res_email, $res_message);//text=s,int=i
           //bind result to a named show the  result

           if($stmt->execute())
           {
                $data = array();
                $counter = 0; // Initialize a counter
                while($stmt->fetch()) 
                {
                    $data[$counter]['id']                   = $res_id;
                    $data[$counter]['full_name']            = $res_full_name;
                    $data[$counter]['email']                = $res_email;
                    $data[$counter]['message']              = $res_message;

                    $counter++;
                }
                if(!empty($data))
                {
                    return $data;
                }
                else
                {
                    return false;
                }
            }
            
        }
    }

    function delete_user_contact_record($del_id)
    {
        if($stmt = $this->con->prepare("Delete from `contact_details` where `id`=?"))
        {
            $stmt->bind_param("i",$del_id);

            if($stmt->execute())
            {
                return true;

            }
            else{
                return false;
            }
        }
    }

       // Get user details by mobile number
   function get_user_details($var_email)
   {
       if($stmt = $this->con->prepare("SELECT first_name,email,mobile_no FROM fruit_registered WHERE email = ?")){
           $stmt->bind_param("s", $var_email);
           $stmt->execute();
        $stmt->bind_result($res_first_name, $res_email,$res_mobile_no);
        if($stmt->execute())
        {
            $data = array();
            while($stmt->fetch()) 
            {
                $data['first_name']           = $res_first_name;
                $data['email']                = $res_email;
                $data['mobile_no']            = $res_mobile_no;
            }
            if(!empty($data))
            {
                return $data;
            }
            else
            {
                return false;
            }
        }
     
 }
}




function  admin_register(
    $var_first_name, $var_last_name, $var_mobile_no, $var_account_type, $var_email,$var_admin_image, $var_password, $var_confirm_password)
{
    // not user input automatically saved value of date and time
    $curr_date = date("Y-m-d");
    $curr_time = date("H:i:s A");

    // parameter pass
    if ($stmt = $this->con->prepare("INSERT INTO `admin_register`(`first_name`, `last_name`, `mobile_no`, `account_type`, `email`,`admin_image`, `password`, `confirm_password`,`curr_date`,`curr_time`) VALUES (?,?,?,?,?,?,?,?,?,?)")) {
        // save value in table
        $stmt->bind_param(
            "ssssssssss",
            $var_first_name, $var_last_name, $var_mobile_no, $var_account_type, $var_email,$var_admin_image, $var_password, $var_confirm_password, $curr_date, $curr_time
        );
        

        // Execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}


function get_user_password_admin($var_first_name)
{
    if ($stmt = $this->con->prepare("SELECT password FROM admin_register WHERE first_name = ?")) {
        $stmt->bind_param("s", $var_first_name);
        $stmt->execute();
        $stmt->bind_result($res_password);
        if ($stmt->fetch()) {
            $stmt->close();
            return $res_password;
        } else {
            $stmt->close();
            return false;
        }
    } else {
        return false;
    }
}

function  addproduct(
    $var_product_id, $var_product_name, $var_description, $var_quantity, $var_available_stock, $var_manufactore, $var_mfg_date, $var_bestbefore, $var_category, $var_original_price, $var_offer_price, $var_product_image)
{
    // not user input automatically saved value of date and time
    $curr_date = date("Y-m-d");
    $curr_time = date("H:i:s A");

    // parameter pass
    if ($stmt = $this->con->prepare("INSERT INTO `addproduct`(`product_id`, `product_name`, `description`, `quantity`, `available_stock`, `manufactore`, `mfg_date`,`bestbefore`,`category`,`original_price`,`offer_price`,`product_image`,`curr_date`,`curr_time`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)")) {
        // save value in table
        $stmt->bind_param(
            "ssssssssssssss",
            $var_product_id, $var_product_name, $var_description, $var_quantity, $var_available_stock, $var_manufactore, $var_mfg_date,$var_bestbefore ,$var_category,$var_original_price, $var_offer_price, $var_product_image, $curr_date, $curr_time
        );
        

        // Execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function get_user_report_product()
{
    // Prepare the SELECT query
    if($stmt = $this->con->prepare("SELECT `id`,`product_id`,`product_name`,`description`,`quantity`,`available_stock`,`manufactore`,`mfg_date`,`bestbefore`,`category`,`original_price`,`offer_price`,`product_image`  FROM `addproduct`")){//connection used and prepare by query

       //bind result
       $stmt->bind_result($res_id,$res_product_id, $res_product_name, $res_description, $res_quantity, $res_available_stock, $res_manufactore, $res_mfg_date,$res_bestbefore ,$res_category,$res_original_price, $res_offer_price, $res_product_image);//text=s,int=i
       //bind result to a named show the  result

       if($stmt->execute())
       {
            $data = array();
            $counter = 0; // Initialize a counter
            while($stmt->fetch()) 
            {
                $data[$counter]['id']                   = $res_id;
                $data[$counter]['product_id']            = $res_product_id;
                $data[$counter]['product_name']                = $res_product_name;
                $data[$counter]['description']              = $res_description;
                $data[$counter]['quantity']            = $res_quantity;
                $data[$counter]['available_stock']                = $res_available_stock;
                $data[$counter]['manufactore']              = $res_manufactore;
                $data[$counter]['mfg_date']            = $res_mfg_date;
                $data[$counter]['bestbefore']                = $res_bestbefore;
                $data[$counter]['category']              = $res_category;
                $data[$counter]['original_price']            = $res_original_price;
                $data[$counter]['offer_price']                = $res_offer_price;
                $data[$counter]['product_image']              = $res_product_image;

                $counter++;
            }
            if(!empty($data))
            {
                return $data;
            }
            else
            {
                return false;
            }
        }
        
    }
}


function  addtocart(
    $var_product_id, $var_product_name, $var_offer_price, $var_original_price, $var_quantity,$var_total,$var_user_id)
{
    $var_total = $var_offer_price * $var_quantity;
    // not user input automatically saved value of date and time
    $curr_date = date("Y-m-d");
    $curr_time = date("H:i:s A");

    // parameter pass
    if ($stmt = $this->con->prepare("INSERT INTO `addtocart`(`product_id`, `product_name`, `offer_price`, `original_price`,`quantity`, `total`,`user_id`,`curr_date`,`curr_time`) VALUES (?,?,?,?,?,?,?,?,?)")) {
        // save value in table
        $stmt->bind_param(
            "sssssssss",
            $var_product_id, $var_product_name, $var_offer_price, $var_original_price,$var_quantity, $var_total,$var_user_id, $curr_date, $curr_time
        );
        

        // Execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

// function get_addtocart_report($var_user_id)
// {
//     // Prepare the SELECT query
//     if($stmt = $this->con->prepare("SELECT `id`,`product_id`,`product_name`,`offer_price`,`original_price`,`quantity`,`total`,`user_id`  FROM `addtocart` WHERE `user_id`=?")){//connection used and prepare by query

//        //bind result()
//        $stmt->bind_result($res_id,$res_product_id, $res_product_name, $res_offer_price,$res_original_price,$res_quantity,$res_total,$res_user_id);//text=s,int=i
//        //bind result to a named show the  result
//        $stmt->bind_param("s", $var_user_id);

//        if($stmt->execute())
//        {
//             $data = array();
//             $counter = 0; // Initialize a counter
//             while($stmt->fetch()) 
//             {
//                 $data[$counter]['id']                   = $res_id;
//                 $data[$counter]['product_id']            = $res_product_id;
//                 $data[$counter]['product_name']                = $res_product_name;
//                 $data[$counter]['offer_price']                = $res_offer_price;
//                 $data[$counter]['original_price']            = $res_original_price;
//                 $data[$counter]['quantity']                = $res_quantity;
//                 $data[$counter]['total']              = $res_total;
//                 $data[$counter]['user_id']              = $res_user_id;

//                 $counter++;
//             }
//             if(!empty($data))
//             {
//                 return $data;
//             }
//             else
//             {
//                 return false;
//             }
//         }
        
//     }
// }

function get_addtocart_report($var_user_id)
{
    // Prepare the SELECT query with a date filter for today
    if($stmt = $this->con->prepare("SELECT `id`,`product_id`,`product_name`,`offer_price`,`original_price`,`quantity`,`total`,`user_id`  
                                   FROM `addtocart` 
                                   WHERE `user_id` = ? AND DATE(`curr_date`) = CURDATE()")) {

       // Bind the result variables
       $stmt->bind_result($res_id, $res_product_id, $res_product_name, $res_offer_price, $res_original_price, $res_quantity, $res_total, $res_user_id);
       
       // Bind the user_id parameter
       $stmt->bind_param("s", $var_user_id);

       if($stmt->execute()) {
            $data = array();
            $counter = 0;
            while($stmt->fetch()) {
                $data[$counter]['id'] = $res_id;
                $data[$counter]['product_id'] = $res_product_id;
                $data[$counter]['product_name'] = $res_product_name;
                $data[$counter]['offer_price'] = $res_offer_price;
                $data[$counter]['original_price'] = $res_original_price;
                $data[$counter]['quantity'] = $res_quantity;
                $data[$counter]['total'] = $res_total;
                $data[$counter]['user_id'] = $res_user_id;
                $counter++;
            }
            return !empty($data) ? $data : false;
        }
    }
}

function get_order_history($var_user_id)
{
    if($stmt = $this->con->prepare("SELECT `id`,`product_id`,`product_name`,`offer_price`,`original_price`,`quantity`,`total`,`user_id` ,`curr_date` 
                                   FROM `addtocart` 
                                   WHERE `user_id` = ? AND DATE(`curr_date`) < CURDATE()")) {

       $stmt->bind_result($res_id, $res_product_id, $res_product_name, $res_offer_price, $res_original_price, $res_quantity, $res_total, $res_user_id,$res_curr_date);
       $stmt->bind_param("s", $var_user_id);

       if($stmt->execute()) {
            $data = array();
            $counter = 0;
            while($stmt->fetch()) {
                $data[$counter]['id'] = $res_id;
                $data[$counter]['product_id'] = $res_product_id;
                $data[$counter]['product_name'] = $res_product_name;
                $data[$counter]['offer_price'] = $res_offer_price;
                $data[$counter]['original_price'] = $res_original_price;
                $data[$counter]['quantity'] = $res_quantity;
                $data[$counter]['total'] = $res_total;
                $data[$counter]['user_id'] = $res_user_id;
                $data[$counter]['curr_date'] = $res_curr_date;

                $counter++;
            }
            return !empty($data) ? $data : false;
        }
    }
}
function get_user_profile($var_email)
{
    // Prepare the SELECT query (include `id`)
    if ($stmt = $this->con->prepare("SELECT `id`, `first_name`, `last_name`, `mobile_no`, `account_type`, 
        `company_name`, `company_address`, `profile_image`, `email`  
        FROM `fruit_registered` WHERE `email`=?")) {

        // Bind email parameter
        $stmt->bind_param("s", $var_email);

        if ($stmt->execute()) {
            // Bind result variables
            $stmt->bind_result($res_id, $res_first_name, $res_last_name, $res_mobile_no, $res_account_type,
                $res_company_name, $res_company_address, $res_profile_image, $res_email);

            $data = array();
            $counter = 0; // Initialize a counter

            while ($stmt->fetch()) {
                $data[$counter]['id']                  = $res_id;
                $data[$counter]['first_name']          = $res_first_name;
                $data[$counter]['last_name']           = $res_last_name;
                $data[$counter]['mobile_no']           = $res_mobile_no;
                $data[$counter]['account_type']        = $res_account_type;
                $data[$counter]['company_name']        = $res_company_name;
                $data[$counter]['company_address']     = $res_company_address;
                $data[$counter]['profile_image']       = $res_profile_image;
                $data[$counter]['email']               = $res_email;

                $counter++;
            }

            // Return data if found, otherwise return false
            return !empty($data) ? $data : false;
        }
    }
    return false; // Return false if query execution fails
}

    //fruit
    
function get_user_report_product_fruit()
{
    // Prepare the SELECT query
    if($stmt = $this->con->prepare("SELECT `id`,`product_id`,`product_name`,`description`,`quantity`,`available_stock`,`manufactore`,`mfg_date`,`bestbefore`,`category`,`original_price`,`offer_price`,`product_image` FROM `addproduct` WHERE `category` = 'Fruit'")){//connection used and prepare by query

       //bind result
       $stmt->bind_result($res_id,$res_product_id, $res_product_name, $res_description, $res_quantity, $res_available_stock, $res_manufactore, $res_mfg_date,$res_bestbefore ,$res_category,$res_original_price, $res_offer_price, $res_product_image);//text=s,int=i
       //bind result to a named show the  result

       if($stmt->execute())
       {
            $data = array();
            $counter = 0; // Initialize a counter
            while($stmt->fetch()) 
            {
                $data[$counter]['id']                   = $res_id;
                $data[$counter]['product_id']            = $res_product_id;
                $data[$counter]['product_name']                = $res_product_name;
                $data[$counter]['description']              = $res_description;
                $data[$counter]['quantity']            = $res_quantity;
                $data[$counter]['available_stock']                = $res_available_stock;
                $data[$counter]['manufactore']              = $res_manufactore;
                $data[$counter]['mfg_date']            = $res_mfg_date;
                $data[$counter]['bestbefore']                = $res_bestbefore;
                $data[$counter]['category']              = $res_category;
                $data[$counter]['original_price']            = $res_original_price;
                $data[$counter]['offer_price']                = $res_offer_price;
                $data[$counter]['product_image']              = $res_product_image;

                $counter++;
            }
            if(!empty($data))
            {
                return $data;
            }
            else
            {
                return false;
            }
        }
        
    }
}


//vegetable
   
function get_user_report_product_vegetable()
{
    // Prepare the SELECT query
    if($stmt = $this->con->prepare("SELECT `id`,`product_id`,`product_name`,`description`,`quantity`,`available_stock`,`manufactore`,`mfg_date`,`bestbefore`,`category`,`original_price`,`offer_price`,`product_image` FROM `addproduct` WHERE `category` = 'Vegetable'")){//connection used and prepare by query

       //bind result
       $stmt->bind_result($res_id,$res_product_id, $res_product_name, $res_description, $res_quantity, $res_available_stock, $res_manufactore, $res_mfg_date,$res_bestbefore ,$res_category,$res_original_price, $res_offer_price, $res_product_image);//text=s,int=i
       //bind result to a named show the  result

       if($stmt->execute())
       {
            $data = array();
            $counter = 0; // Initialize a counter
            while($stmt->fetch()) 
            {
                $data[$counter]['id']                   = $res_id;
                $data[$counter]['product_id']            = $res_product_id;
                $data[$counter]['product_name']                = $res_product_name;
                $data[$counter]['description']              = $res_description;
                $data[$counter]['quantity']            = $res_quantity;
                $data[$counter]['available_stock']                = $res_available_stock;
                $data[$counter]['manufactore']              = $res_manufactore;
                $data[$counter]['mfg_date']            = $res_mfg_date;
                $data[$counter]['bestbefore']                = $res_bestbefore;
                $data[$counter]['category']              = $res_category;
                $data[$counter]['original_price']            = $res_original_price;
                $data[$counter]['offer_price']                = $res_offer_price;
                $data[$counter]['product_image']              = $res_product_image;

                $counter++;
            }
            if(!empty($data))
            {
                return $data;
            }
            else
            {
                return false;
            }
        }
        
    }
}

   //dryfruit
function get_user_report_product_dryfruit()
{
    // Prepare the SELECT query
    if($stmt = $this->con->prepare("SELECT `id`,`product_id`,`product_name`,`description`,`quantity`,`available_stock`,`manufactore`,`mfg_date`,`bestbefore`,`category`,`original_price`,`offer_price`,`product_image` FROM `addproduct` WHERE `category` = 'DryFruit'")){//connection used and prepare by query

       //bind result
       $stmt->bind_result($res_id,$res_product_id, $res_product_name, $res_description, $res_quantity, $res_available_stock, $res_manufactore, $res_mfg_date,$res_bestbefore ,$res_category,$res_original_price, $res_offer_price, $res_product_image);//text=s,int=i
       //bind result to a named show the  result

       if($stmt->execute())
       {
            $data = array();
            $counter = 0; // Initialize a counter
            while($stmt->fetch()) 
            {
                $data[$counter]['id']                   = $res_id;
                $data[$counter]['product_id']            = $res_product_id;
                $data[$counter]['product_name']                = $res_product_name;
                $data[$counter]['description']              = $res_description;
                $data[$counter]['quantity']            = $res_quantity;
                $data[$counter]['available_stock']                = $res_available_stock;
                $data[$counter]['manufactore']              = $res_manufactore;
                $data[$counter]['mfg_date']            = $res_mfg_date;
                $data[$counter]['bestbefore']                = $res_bestbefore;
                $data[$counter]['category']              = $res_category;
                $data[$counter]['original_price']            = $res_original_price;
                $data[$counter]['offer_price']                = $res_offer_price;
                $data[$counter]['product_image']              = $res_product_image;

                $counter++;
            }
            if(!empty($data))
            {
                return $data;
            }
            else
            {
                return false;
            }
        }
        
    }
}

 
//groceries
   
function get_user_report_product_groceries()
{
    // Prepare the SELECT query
    if($stmt = $this->con->prepare("SELECT `id`,`product_id`,`product_name`,`description`,`quantity`,`available_stock`,`manufactore`,`mfg_date`,`bestbefore`,`category`,`original_price`,`offer_price`,`product_image` FROM `addproduct` WHERE `category` = 'Groceries'")){//connection used and prepare by query

       //bind result
       $stmt->bind_result($res_id,$res_product_id, $res_product_name, $res_description, $res_quantity, $res_available_stock, $res_manufactore, $res_mfg_date,$res_bestbefore ,$res_category,$res_original_price, $res_offer_price, $res_product_image);//text=s,int=i
       //bind result to a named show the  result

       if($stmt->execute())
       {
            $data = array();
            $counter = 0; // Initialize a counter
            while($stmt->fetch()) 
            {
                $data[$counter]['id']                   = $res_id;
                $data[$counter]['product_id']            = $res_product_id;
                $data[$counter]['product_name']                = $res_product_name;
                $data[$counter]['description']              = $res_description;
                $data[$counter]['quantity']            = $res_quantity;
                $data[$counter]['available_stock']                = $res_available_stock;
                $data[$counter]['manufactore']              = $res_manufactore;
                $data[$counter]['mfg_date']            = $res_mfg_date;
                $data[$counter]['bestbefore']                = $res_bestbefore;
                $data[$counter]['category']              = $res_category;
                $data[$counter]['original_price']            = $res_original_price;
                $data[$counter]['offer_price']                = $res_offer_price;
                $data[$counter]['product_image']              = $res_product_image;

                $counter++;
            }
            if(!empty($data))
            {
                return $data;
            }
            else
            {
                return false;
            }
        }
        
    }
}
//delete cart record
function delete_cart_record($del_id)
{
    if($stmt = $this->con->prepare("Delete from `addtocart` where `id`=?"))
    {
        $stmt->bind_param("i",$del_id);

        if($stmt->execute())
        {
            return true;

        }
        else{
            return false;
        }
    }
}

// product

function delete_product_record($del_id)
{
    if($stmt = $this->con->prepare("Delete from `addproduct` where `id`=?"))
    {
        $stmt->bind_param("i",$del_id);

        if($stmt->execute())
        {
            return true;

        }
        else{
            return false;
        }
    }
}


function update_product($var_product_id, $var_product_name, $var_description, $var_quantity, $var_available_stock, $var_manufactore, $var_mfg_date, $var_bestbefore, $var_category, $var_original_price, $var_offer_price, $res_edit_id)
{
    // Prepare the SQL statement
    if ($stmt = $this->con->prepare("UPDATE `addproduct` SET `product_id`=?, `product_name`=?, `description`=?, `quantity`=?, `available_stock`=?, `manufactore`=?, `mfg_date`=?, `bestbefore`=?, `category`=?, `original_price`=?, `offer_price`=? WHERE `id`=?")) 
    {
        // Bind parameters with the correct type count
        $stmt->bind_param("sssssssssssi", $var_product_id, $var_product_name, $var_description, $var_quantity, $var_available_stock, $var_manufactore, $var_mfg_date, $var_bestbefore, $var_category, $var_original_price, $var_offer_price, $res_edit_id);

        return $stmt->execute(); // Directly return execution result
    } 

    return false; // Return false if prepare() fails
}

function get_product_data_from_id($edit_id)
{
    if ($stmt = $this->con->prepare("SELECT `id`, `product_id`, `product_name`, `description`, `quantity`, `available_stock`, `manufactore`, `mfg_date`, `bestbefore`, `category`, `original_price`, `offer_price` FROM `addproduct` WHERE `id` = ?")) 
    {
        $stmt->bind_param("i", $edit_id);
        $stmt->execute();
        
        // Bind the correct fields
        $stmt->bind_result($res_id, $res_product_id, $res_product_name, $res_description, $res_quantity, $res_available_stock, $res_manufactore, $res_mfg_date, $res_bestbefore, $res_category, $res_original_price, $res_offer_price);

        $data = array();

        if ($stmt->fetch()) 
        {
            $data['id']              = $res_id;
            $data['product_id']      = $res_product_id;
            $data['product_name']    = $res_product_name;
            $data['description']     = $res_description;
            $data['quantity']        = $res_quantity;
            $data['available_stock'] = $res_available_stock;
            $data['manufactore']     = $res_manufactore;
            $data['mfg_date']        = $res_mfg_date;
            $data['bestbefore']      = $res_bestbefore;
            $data['category']        = $res_category;
            $data['original_price']  = $res_original_price;
            $data['offer_price']     = $res_offer_price;
        }

        return !empty($data) ? $data : false;
    }

    return false; // Return false if prepare() fails
}

//admin login
function get_admin_password($var_email)
{
    if ($stmt = $this->con->prepare("SELECT password FROM admin_register WHERE email = ?")) {
        $stmt->bind_param("s", $var_email);
        $stmt->execute();
        $stmt->bind_result($res_password);
        if ($stmt->fetch()) {
            $stmt->close();
            return $res_password;
        } else {
            $stmt->close();
            return false;
        }
    } else {
        return false;
    }
}

function get_admin_details($var_email)
{
    if($stmt = $this->con->prepare("SELECT first_name,email,mobile_no FROM admin_register WHERE email = ?")){
        $stmt->bind_param("s", $var_email);
        $stmt->execute();
     $stmt->bind_result($res_first_name, $res_email,$res_mobile_no);
     if($stmt->execute())
     {
         $data = array();
         while($stmt->fetch()) 
         {
             $data['first_name']           = $res_first_name;
             $data['email']                = $res_email;
             $data['mobile_no']            = $res_mobile_no;
         }
         if(!empty($data))
         {
             return $data;
         }
         else
         {
             return false;
         }
     }
  
}
}


function get_admin_profile($var_email)
    {
        // Prepare the SELECT query
        if($stmt = $this->con->prepare("SELECT `first_name`, `last_name`, `mobile_no`, `account_type`, 
         `admin_image`, `email`  FROM `admin_register` WHERE `email`=?")){//connection used and prepare by query

           //bind result
           $stmt->bind_param("s", $var_email);

           if ($stmt->execute()) {
           $stmt->bind_result( $res_first_name, $res_last_name, $res_mobile_no, $res_account_type,
           $res_admin_image, $res_email);//text=s,int=i
           //bind result to a named show the  result
          
           {
            $data = array();
            $counter = 0; // Initialize a counter
            while($stmt->fetch()) 
            {
      
                    $data[$counter]['first_name']           = $res_first_name;
                    $data[$counter]['last_name']            = $res_last_name;
                    $data[$counter]['mobile_no']            = $res_mobile_no;
                    $data[$counter]['account_type']         = $res_account_type;
                    $data[$counter]['admin_image']        = $res_admin_image;
                    $data[$counter]['email']                = $res_email;
   
                    $counter++;

                }
                if(!empty($data))
                {
                    return $data;
                }
                else
                {
                    return false;
                }
            }
            
        }
    }
    }


    //client
    function delete_contact_record($del_id)
{
    if($stmt = $this->con->prepare("Delete from `contact_details` where `id`=?"))
    {
        $stmt->bind_param("i",$del_id);

        if($stmt->execute())
        {
            return true;

        }
        else{
            return false;
        }
    }
}
function delete_register_client_record($del_id)
{
    if($stmt = $this->con->prepare("Delete from `fruit_registered` where `id`=?"))
    {
        $stmt->bind_param("i",$del_id);

        if($stmt->execute())
        {
            return true;

        }
        else{
            return false;
        }
    }
}
function delete_admin_record($del_id)
{
    if($stmt = $this->con->prepare("Delete from `admin_register` where `id`=?"))
    {
        $stmt->bind_param("i",$del_id);

        if($stmt->execute())
        {
            return true;

        }
        else{
            return false;
        }
    }
}


function get_register_client_report()
{
    // Prepare the SELECT query
    if($stmt = $this->con->prepare("SELECT `id`,`first_name`,`last_name`,`mobile_no`,`account_type`,`company_name`,`company_address`,`email`,`profile_image`  FROM `fruit_registered`")){//connection used and prepare by query

        //bind result
        $stmt->bind_result($res_id,$res_first_name, $res_last_name, $res_mobile_no, $res_account_type,$res_company_name,$res_company_address, $res_email, $res_profile_image);//text=s,int=i
        //bind result to a named show the  result
 
        if($stmt->execute())
        {
             $data = array();
             $counter = 0; // Initialize a counter
             while($stmt->fetch()) 
             {
                 $data[$counter]['id']                   = $res_id;
                 $data[$counter]['first_name']            = $res_first_name;
                 $data[$counter]['last_name']                = $res_last_name;
                 $data[$counter]['mobile_no']              = $res_mobile_no;
                 $data[$counter]['account_type']            = $res_account_type;
                 $data[$counter]['company_name']             =$res_company_name;
                 $data[$counter]['company_address']             =$res_company_address;
                 $data[$counter]['email']                = $res_email;
                 $data[$counter]['profile_image']              = $res_profile_image;
 
                $counter++;
            }
            if(!empty($data))
            {
                return $data;
            }
            else
            {
                return false;
            }
        }
        
    }
}

function get_admin_client_report()
{
    // Prepare the SELECT query
    if($stmt = $this->con->prepare("SELECT `id`,`first_name`,`last_name`,`mobile_no`,`account_type`,`email`,`admin_image`  FROM `admin_register`")){//connection used and prepare by query

       //bind result
       $stmt->bind_result($res_id,$res_first_name, $res_last_name, $res_mobile_no, $res_account_type, $res_email, $res_admin_image);//text=s,int=i
       //bind result to a named show the  result

       if($stmt->execute())
       {
            $data = array();
            $counter = 0; // Initialize a counter
            while($stmt->fetch()) 
            {
                $data[$counter]['id']                   = $res_id;
                $data[$counter]['first_name']            = $res_first_name;
                $data[$counter]['last_name']                = $res_last_name;
                $data[$counter]['mobile_no']              = $res_mobile_no;
                $data[$counter]['account_type']            = $res_account_type;
                $data[$counter]['email']                = $res_email;
                $data[$counter]['admin_image']              = $res_admin_image;

                $counter++;
            }
            if(!empty($data))
            {
                return $data;
            }
            else
            {
                return false;
            }
        }
        
    }
}


function get_contact_report()
{
    // Prepare the SELECT query
    if($stmt = $this->con->prepare("SELECT `id`,`full_name`,`email`,`message`  FROM `contact_details`")){//connection used and prepare by query

       //bind result
       $stmt->bind_result($res_id,$res_full_name, $res_email, $res_message);//text=s,int=i
       //bind result to a named show the  result

       if($stmt->execute())
       {
            $data = array();
            $counter = 0; // Initialize a counter
            while($stmt->fetch()) 
            {
                $data[$counter]['id']                   = $res_id;
                $data[$counter]['full_name']            = $res_full_name;
                $data[$counter]['email']                = $res_email;
                $data[$counter]['message']              = $res_message;


                $counter++;
            }
            if(!empty($data))
            {
                return $data;
            }
            else
            {
                return false;
            }
        }
        
    }
}

//payment
function  payment_customer(
    $var_customer_id, $var_customer_name, $var_email,$var_grand_total, $var_cardholder, $var_cardnumber, $var_expiry,$var_cvv)
{
    // not user input automatically saved value of date and time
    $curr_date = date("Y-m-d");
    $curr_time = date("H:i:s A");

    // parameter pass
    if ($stmt = $this->con->prepare("INSERT INTO `payment_customer`(`customer_id`, `customer_name`, `email`,`grand_total`, `cardholder`, `cardnumber`, `expiry`, `cvv`, `curr_date`,`curr_time`) VALUES (?,?,?,?,?,?,?,?,?,?)")) {
        // save value in table
        $stmt->bind_param(
            "ssssssssss",
            $var_customer_id, $var_customer_name, $var_email,$var_grand_total, $var_cardholder, $var_cardnumber, $var_expiry,$var_cvv, $curr_date, $curr_time
        );
        

        // Execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function get_payment_report()
{
    // Prepare the SELECT query
    if($stmt = $this->con->prepare("SELECT `id`,`customer_id`, `customer_name`, `email`,`grand_total`, `cardholder`, `cardnumber`, `expiry`, `cvv`  FROM `payment_customer`")){//connection used and prepare by query

       //bind result
       $stmt->bind_result($res_id,$res_customer_id, $res_customer_name, $res_email,$res_grand_total, $res_cardholder, $res_cardnumber, $res_expiry,$res_cvv);//text=s,int=i
       //bind result to a named show the  result

       if($stmt->execute())
       {
            $data = array();
            $counter = 0; // Initialize a counter
            while($stmt->fetch()) 
            {
                $data[$counter]['id']                   = $res_id;
                $data[$counter]['customer_id']            = $res_customer_id;
                $data[$counter]['customer_name']                = $res_customer_name;
                $data[$counter]['email']              = $res_email;
                $data[$counter]['grand_total']              = $res_grand_total;
                $data[$counter]['cardholder']            = $res_cardholder;
                $data[$counter]['cardnumber']                = $res_cardnumber;
                $data[$counter]['expiry']              = $res_expiry;
                $data[$counter]['cvv']            = $res_cvv;

                $counter++;
            }
            if(!empty($data))
            {
                return $data;
            }
            else
            {
                return false;
            }
        }
        
    }
}






}//END