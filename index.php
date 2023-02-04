<?php
include_once("config.php");
include_once("err_handler.php");
include_once("db_connect.php");
include_once("functions.php");

include_once("find_token.php");

if(!isset($_GET['type'])) {
    echo ajax_echo(
        "ERROR!", // Заголовок ответа
        "ERROR IN REQUEST.", // Описание ответа
        true, // Наличие ошибка
        "ERROR", // Результат ответа
        null // Дополнительные данные для ответа
    );
    exit();
}

if(preg_match_all("/^(list_ticket)$/ui", $_GET['type'])){
    $query = "SELECT `id`, `from`, `to`, `date_of_flight`, `gate`, `del` FROM `tickets`";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "ERROR IN REQUEST.", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }

    $arr_list = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_list, $row);
    }
    
    echo ajax_echo(
        "LIST OF TICKETS", // Заголовок ответа
        "", // Описание ответа
        false, // Наличие ошибка
        "SUCCESS", // Результат ответа
        $arr_list // Дополнительные данные для ответа
    );

    exit();
}

if(preg_match_all("/^(list_client)$/ui", $_GET['type'])){
    $query = "SELECT * FROM `clients`";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "ERROR IN REQUEST.", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }

    $arr_list = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_list, $row);
    }
    
    echo ajax_echo(
        "LIST OF CLIENTS", // Заголовок ответа
        "", // Описание ответа
        false, // Наличие ошибка
        "SUCCESS", // Результат ответа
        $arr_list // Дополнительные данные для ответа
    );

    exit();
}

if(preg_match_all("/^(list_products)$/ui", $_GET['type'])){
    $query = "SELECT * FROM `products`";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "ERROR IN REQUEST.", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }

    $arr_list = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_list, $row);
    }
    
    echo ajax_echo(
        "LIST OF PRODUCTS", // Заголовок ответа
        "", // Описание ответа
        false, // Наличие ошибка
        "SUCCESS", // Результат ответа
        $arr_list // Дополнительные данные для ответа
    );

    exit();
}

if(preg_match_all("/^(list_gate)$/ui", $_GET['type'])){
    $query = "SELECT * FROM `gates`";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "ERROR IN REQUEST.", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }

    $arr_list = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_list, $row);
    }
    
    echo ajax_echo(
        "LIST OF GATES", // Заголовок ответа
        "", // Описание ответа
        false, // Наличие ошибка
        "SUCCESS", // Результат ответа
        $arr_list // Дополнительные данные для ответа
    );

    exit();
}


if(preg_match_all("/^(list_occup_gates)$/ui", $_GET['type'])){
    $query = "SELECT `gates`.`id`, `gates`.`number` FROM `gates`INNER JOIN `tickets` ON `gates`.`number` = `tickets`.`gate`";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "ERROR IN REQUEST.", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }

    $arr_list = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_list, $row);
    }
    
    echo ajax_echo(
        "LIST OF OCCUPIED GATES", // Заголовок ответа
        "", // Описание ответа
        false, // Наличие ошибка
        "SUCCESS", // Результат ответа
        $arr_list // Дополнительные данные для ответа
    );

    exit();
}


else if(preg_match_all("/^(add_product)$/ui", $_GET['type'])){
    if(!isset($_GET['name'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET NAME IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
    if(!isset($_GET['price'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET PRICE IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
    if(!isset($_GET['description'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET DESC IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
    $query = "INSERT INTO `products`(`name`, `price`, `description`) VALUES ('" . $_GET['name'] . "', '". $_GET['price'] ."', '". $_GET['description'] ."')";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "ERROR IN REQUEST", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }

    echo ajax_echo(
        "SUCCESS", // Заголовок ответа
        "PRODUCT CREATED", // Описание ответа
        false, // Наличие ошибка
        "SUCCESS", // Результат ответа
        null // Дополнительные данные для ответа
    );
    exit();
}

else if(preg_match_all("/^(add_client)$/ui", $_GET['type'])){
    if(!isset($_GET['first_name'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET FIRST_NAME IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
    if(!isset($_GET['second_name'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET SECOND_NAME IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
    if(!isset($_GET['ban'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET BAN IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
    $query = "INSERT INTO `clients`(`first_name`, `second_name`, `ban`) VALUES ('" . $_GET['first_name'] . "', '". $_GET['second_name'] ."', '". $_GET['ban'] ."')";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "ERROR IN REQUEST", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }

    echo ajax_echo(
        "SUCCESS", // Заголовок ответа
        "CLIENT CREATED", // Описание ответа
        false, // Наличие ошибка
        "SUCCESS", // Результат ответа
        null // Дополнительные данные для ответа
    );
    exit();
}

else if(preg_match_all("/^(add_gate)$/ui", $_GET['type'])){
    if(!isset($_GET['number'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET NUBMER IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
    if(!isset($_GET['del'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET DEL IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
    $query = "INSERT INTO `gates`(`number`, `del`) VALUES ('" . $_GET['number'] . "', '". $_GET['del'] ."')";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "ERROR IN REQUEST", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }

    echo ajax_echo(
        "SUCCESS", // Заголовок ответа
        "GATE CREATED", // Описание ответа
        false, // Наличие ошибка
        "SUCCESS", // Результат ответа
        null // Дополнительные данные для ответа
    );
    exit();
}

else if(preg_match_all("/^(upd_product)$/ui", $_GET['type'])){
    if(!isset($_GET['name'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET NAME IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
    if(!isset($_GET['description'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET DESC IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
    if(!isset($_GET['price'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET PRICE IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
        if(!isset($_GET['id'])) {
            echo ajax_echo(
                "ERROR!", // Заголовок ответа
                "GET ID IS NULL", // Описание ответа
                true, // Наличие ошибка
                "ERROR", // Результат ответа
                null // Дополнительные данные для ответа
        );
        exit();
    }
    $query = "UPDATE `products` SET `name` = '". $_GET['name'] ."', `description` = '". $_GET['description'] ."', `price` = '". $_GET['price'] ."' WHERE `id` = '". $_GET['id'] ."'";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "ERROR IN REQUEST", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }

    echo ajax_echo(
        "SUCCESS", // Заголовок ответа
        ".UPDATE IS SUCCESSFUL", // Описание ответа
        false, // Наличие ошибка
        "SUCCESS", // Результат ответа
        null // Дополнительные данные для ответа
    );
    exit();
}

else if(preg_match_all("/^(upd_ticket)$/ui", $_GET['type'])){
    if(!isset($_GET['from'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET FROM IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
    if(!isset($_GET['to'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET TO IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
    if(!isset($_GET['date_of_flight'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET DATE IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
    if(!isset($_GET['gate'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET GATE IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
    if(!isset($_GET['del'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET DEL IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
        if(!isset($_GET['id'])) {
            echo ajax_echo(
                "ERROR!", // Заголовок ответа
                "GET ID IS NULL", // Описание ответа
                true, // Наличие ошибка
                "ERROR", // Результат ответа
                null // Дополнительные данные для ответа
        );
        exit();
    }
    $query = "UPDATE `tickets` SET `from` = '". $_GET['from'] ."', `to` = '". $_GET['to'] ."', `date_of_flight` = '". $_GET['date_of_flight'] ."', `gate` = '". $_GET['gate'] ."', `del` = '". $_GET['del'] ."'  WHERE `id` = '". $_GET['id'] ."'";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "ERROR IN REQUEST", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }

    echo ajax_echo(
        "SUCCESS", // Заголовок ответа
        ".UPDATE IS SUCCESSFUL", // Описание ответа
        false, // Наличие ошибка
        "SUCCESS", // Результат ответа
        null // Дополнительные данные для ответа
    );
    exit();
}

else if(preg_match_all("/^(upd_client)$/ui", $_GET['type'])){
    if(!isset($_GET['first_name'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET FIRST_NAME IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
    if(!isset($_GET['second_name'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET SECOND_NAME IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
    if(!isset($_GET['ban'])) {
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "GET BAN IS NULL", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }
        if(!isset($_GET['id'])) {
            echo ajax_echo(
                "ERROR!", // Заголовок ответа
                "GET ID IS NULL", // Описание ответа
                true, // Наличие ошибка
                "ERROR", // Результат ответа
                null // Дополнительные данные для ответа
        );
        exit();
    }
    $query = "UPDATE `clients` SET `first_name` = '". $_GET['first_name'] ."', `second_name` = '". $_GET['second_name'] ."', `ban` = '". $_GET['ban'] ."' WHERE `id` = '". $_GET['id'] ."'";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "ERROR!", // Заголовок ответа
            "ERROR IN REQUEST", // Описание ответа
            true, // Наличие ошибка
            "ERROR", // Результат ответа
            null // Дополнительные данные для ответа
        );
        exit();
    }

    echo ajax_echo(
        "SUCCESS", // Заголовок ответа
        ".UPDATE IS SUCCESSFUL", // Описание ответа
        false, // Наличие ошибка
        "SUCCESS", // Результат ответа
        null // Дополнительные данные для ответа
    );
    exit();
}

echo ajax_echo(
    "TITLE", // Заголовок ответа
    "TEXT", // Описание ответа
    false, // Наличие ошибка
    "SUCCESS", // Результат ответа
    array( 
        0,1,2,3,4,5,6
    ) // Дополнительные данные для ответа
);
