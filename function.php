<?php 

require("Admin/sql.connect.php");

function get_cars($type)
{

    global $mysqli;
    switch ($type) 
    {
        case "avalible":
            $sql="SELECT id,name,photo_url,type,price from cars WHERE avalible = 1";
            break;
        case "unvalible":
            $sql="SELECT c.id, c.name,c.type,c.price,c.photo_url,r.to_date FROM cars AS c
            INNER JOIN reservations AS r ON r.car_id=c.id
            WHERE c.avalible = 0";
            break;
        case "list":
            $sql="SELECT id,name FROM cars
            WHERE avalible = 1 ";
            break;

    }

       $result=$mysqli->query($sql);
       $rows = $result->fetch_all(MYSQLI_ASSOC);
       return $rows;
}

function generate_dashboard()
{

    global $mysqli;
    $sql= "SELECT cars.name,clients.surname,reservations.cost, reservations.to_date FROM reservations INNER JOIN cars ON reservations.car_id = cars.id 
    INNER JOIN clients ON reservations.client_id=clients.id;";
    $result=$mysqli->query($sql);
    $rows=$result->fetch_all(MYSQLI_ASSOC);
    return $rows;
}

function reserve($name, $surname, $phone_number, $car_id,$term, $days, $hours)
{
    global $mysqli;
    $from_date=$term;


    $to_date=date('Y-m-d H:i', strtotime($from_date.'+'.$days.'days +'.$hours.' hours'));

    $sql = "SELECT name, price, avalible FROM cars WHERE id=$car_id";
    $result=$mysqli->query($sql);
    $row = $result->fetch_row();
    $price = $row[1];
    $car_name= $row[0];
    $avalible = $row[2];
    if($avalible==1)
    {  
        $cost = $price*($days*24+ $hours);
        $sql2= "INSERT INTO clients(`name`,`surname`,`phone_number`) VALUES(?,?,?)";
        if($statement = $mysqli->prepare($sql2))
            {
                if($statement->bind_param('sss',$name,$surname,$phone_number))
                {
                    $statement->execute();
                    $client_id=$mysqli->insert_id;
                    $mysqli->query("INSERT INTO payments(`car_id`) VALUES ($car_id)");
                    $payment_id=$mysqli->insert_id;
                        // --------------------------------------------------
                    make_pay($name,$surname,$phone_number,$cost,$price,$car_name, $payment_id);
                    $sql3= "INSERT INTO reservations (`client_id`,`car_id`,`from_date`,`to_date`,`cost`) VALUES (?,?,?,?,?)";
                    if($statement_2=$mysqli->prepare($sql3))
                        {
                                if($statement_2->bind_param('iissi',$client_id,$car_id,$from_date,$to_date,$cost))
                            {
                                $statement_2->execute();
                            }
                        }
                }
            } else 
                {
                    die("Niepoprawne zapytanie");
                }
    } else
            {
                die("Samochód zajęty!");
            }
}
function make_pay
($name, $surname, $phone_number,$cost,$price,$car_name,$payment_id)
{
    global $mysqli;
    require_once 'lib/openpayu.php';
    require_once 'config.php';

    $order['continueUrl'] = 'http://localhost/rental/success.php'; //customer will be redirected to this page after successfull payment
    $order['notifyUrl'] = 'http://localhost/rental/order/OrderNotify.php';
    $order['customerIp'] = $_SERVER['REMOTE_ADDR'];
    $order['merchantPosId'] = OpenPayU_Configuration::getMerchantPosId();
    $order['description'] = 'Car_Rent';
    $order['currencyCode'] = 'PLN';
    $order['totalAmount'] = $cost*100;
    $order['extOrderId'] = $payment_id; //must be unique!
    
    $order['products'][0]['name'] = $car_name;
    $order['products'][0]['unitPrice'] = $price;
    $order['products'][0]['quantity'] = 1;
    
    //optional section buyer
    $order['buyer']['phone'] = $phone_number;
    $order['buyer']['firstName'] = $name;
    $order['buyer']['lastName'] = $surname;
    
    $response = OpenPayU_Order::create($order);
    $order_id = $response->getResponse()->orderId;
    $mysqli->query("UPDATE payments SET order_id = '".$order_id."' WHERE id = $payment_id");
    $mysqli->query("UPDATE cars SET avalible = 0 WHERE id=(SELECT car_id from payments WHERE id=$payment_id)");
    header('Location:'.$response->getResponse()->redirectUri); //You must redirect your client to PayU payment summary page.
}
?>