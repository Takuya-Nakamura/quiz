<?php
if(empty($_POST)) exit;

include './conf.php';

// timezone
date_default_timezone_set('Asia/Tokyo');

// mb_email
mb_language("Japanese");
mb_internal_encoding("UTF-8");

$data =[];
$error_msgs = [];
validates();

if (count($error_msgs) > 0) {
    $res_data = ['errors' => $error_msgs];
    http_response_code(400);
    echo (json_encode($res_data));
    exit;

} else {
    //正常処理
    var_dump("input success"); 
    conv_post_data();
    save_to_csv();
    send_mail_to_user();
    send_mail_to_corporate();
}

###########################
######## Functions ########
###########################


function conv_post_data (){
    global $data, $question1, $question2, $question3,$question4,$question5, $jobs, $notification;
    $data['now'] = date("Y-m-d_H:i:s");
    $data['question1'] =  $question1[$_POST['question1']];
    $data['control_other'] =  $_POST['control_other'];
    $data['question2'] = $question2[$_POST['question2']];
    $data['protect_other'] =  $_POST['protect_other'];
    $data['question3'] = $question3[$_POST['question3']];
    $data['question4'] = $question4[$_POST['question4']];
    $data['question5'] = $question5[$_POST['question5']];

    $data['name'] = $_POST['name'];
    $data['email'] = $_POST['email'];
    $data['jobs'] = $jobs[$_POST['jobs']];
    $data['job_other'] = $_POST['job_other'];
    $data['zip-code'] = $_POST['zip-code'];
    $data['prefecture'] = $_POST['prefecture'];
    $data['city'] = $_POST['city'];
    $data['address'] = $_POST['address'];
    $data['facility'] = $_POST['facility'];
    $data['department'] = $_POST['department'];
    $data['notification'] = $notification[$_POST['notification']];
    

}
######## mail送信関連 ########

function send_mail_to_user()
{
    global $data;
    $res = mb_send_mail(
        $data['email'],
        "メンリッケヘルスケア アンケートにご協力くださいましてありがとうございました",
        create_body_user_mail(),
        "From: no-reply@molnlycke.com\r\n"
    );
}

function create_body_user_mail()
{
    return <<<EOD
お世話になっております。

「第22回 日本褥瘡学会学術集会　オンライン展示　特設サイト」においてアンケートにご協力頂き有難うございました。
    
トートバッグは、ご記載頂いた宛先に送付させて頂きます。
    
9月末頃の発送を予定しております。大変お待たせいたしますが、ご了承頂きますようお願い申し上げます。
    
     
    
メンリッケヘルスケア株式会社 ウンドケア事業部
    
https://www.molnlycke.jp/
    
     
    
     
    
本メールは、「第22回 日本褥瘡学会学術集会　オンライン展示　特設サイト」においてアンケートにご協力いただいた方に自動送信しております。
    
トートバッグ発送のご連絡のためにE-mailを差し上げる場合がございます。
    
そのほか、アンケート内においてセミナーや製品についてのご案内といった情報配信についてご希望いただいた方には、このE-mailアドレス宛にメール送信させていただくことがございます。
    
     
    
リーガル　https://www.molnlycke.com/about-this-site/terms-of-use/

プライバシーポリシー　https://www.molnlycke.com/about-this-site/policies/



Box 13080, Gamlestadvägen 3C, SE-40252 Göteborg, Sweden. Privacy Policy

The Mölnlycke trademark, name and respective logo are registered globally to one or more of the Mölnlycke Health Care Group of Companies. © 2020 Mölnlycke Health Care AB. All rights reserved

EOD;
}

function send_mail_to_corporate()
{
    $res = mb_send_mail(
        // "nakamura0803@gmail.com",
        "info.jp@molnlycke.com",
        "第22回日本褥瘡学会学術集会アンケート回答",
        create_body_corporate_mail(),
        "From: no-reply@molnlycke.com\r\n"
    );
}

function create_body_corporate_mail()
{
    global $data;
    return <<<EOD
以下の内容でアンケート回答がありました。
日付: {$data['now']}
Q1: {$data['question1']}
Q1 その他詳細:{$data['control_other']}
Q2: {$data['question2']}
Q2 その他詳細:{$data['protect_other']}
Q3: {$data['question3']}
Q4: {$data['question4']}
Q5: {$data['question5']}

名前: {$data['name']}
電子メール: {$data['email']}
ご職業:{$data['jobs']}
その他詳細:{$data['job_other']}
郵便番号:{$data['zip-code']}
都道府県:{$data['prefecture']}
市区町村:{$data['city']}
番地:{$data['address']}
ご所属施設名:{$data['facility']}
ご所属(部門名、病棟など):{$data['department']}

通知の同意:{$data['notification']}

以上

EOD;
}


###############################
######## データ保存　　　 ########
###############################
function save_to_csv()  {
    global $data;
    $filename = './csv/list.csv';
    $csv = [];
    foreach ($data as $value){
        $csv[] =$value;
    }

    $fp = fopen($filename, 'a');
    fputcsv($fp, $csv);
    fclose($fp);
}


###############################
######## validation関連 ########
###############################
function validates()
{
    question1Check();
    question2Check();
    question3Check();
    nameCheck();
    emailCheck();
    jobsCheck();
    zipCodeCheck();
    prefectureCheck();
    cityCheck();
    addressCheck();
    facilityCheck();
    notificationCheck();
    policyCheck();
}

function question1Check()
{
    global $error_msgs;
    if (!$_POST['question1']) {
        $error_msgs[] = ["name" => "question1", "message" => "Q1が未入力です。"];
    }
}

function question2Check()
{
    global $error_msgs;
    if (!$_POST['question2']) {
        $error_msgs[] = ["name" => "question2", "message" => "Q2が未入力です。"];
    }
}

function question3Check()
{
    global $error_msgs;
    if (!$_POST['question3']) {
        $error_msgs[] = ["name" => "question3", "message" => "Q3が未入力です。"];
    }
}

function question4Check()
{
    global $error_msgs;
    if (!$_POST['question4']) {
        $error_msgs[] = ["name" => "question4", "message" => "Q4が未入力です。"];
    }
}

function question5Check()
{
    global $error_msgs;
    if (!$_POST['question5']) {
        $error_msgs[] = ["name" => "question5", "message" => "Q5が未入力です。"];
    }
}

function nameCheck()
{
    global $error_msgs;
    if (!$_POST['name']) {
        $error_msgs[] = ["name" => "name", "message" => "名前が未入力です。"];
    }
}

function emailCheck()
{
    global $error_msgs;
    if (!$_POST['email']) {
        $error_msgs[] = ["name" => "email", "message" => "メールアドレスが未入力です。"];
    }
}

function jobsCheck()
{
    global $error_msgs;
    $key = "jobs";
    if (!$_POST[$key]) {
        $error_msgs[] = ["name" => $key, "message" => "職業が未入力です。"];
    }
}

function zipCodeCheck()
{
    global $error_msgs;
    $key = "zip-code";
    if (!$_POST[$key]) {
        $error_msgs[] = ["name" => $key, "message" => "郵便番号が未入力です。"];
    }
}

function prefectureCheck()
{
    global $error_msgs;
    $key = "prefecture";
    if (!$_POST[$key]) {
        $error_msgs[] = ["name" => $key, "message" => "都道府県が未入力です。"];
    }
}

function cityCheck()
{
    global $error_msgs;
    $key = "city";
    if (!$_POST[$key]) {
        $error_msgs[] = ["name" => $key, "message" => "市区町村が未入力です。"];
    }
}

function addressCheck()
{
    global $error_msgs;
    $key = "address";
    if (!$_POST[$key]) {
        $error_msgs[] = ["name" => $key, "message" => "番地が未入力です。"];
    }
}

function facilityCheck()
{
    global $error_msgs;
    $key = "facility";
    if (!$_POST[$key]) {
        $error_msgs[] = ["name" => $key, "message" => "ご所属施設名が未入力です。"];
    }
}


function notificationCheck()
{
    global $error_msgs;
    $key = "notification";
    if (!$_POST[$key]) {
        $error_msgs[] = ["name" => $key, "message" => "通知の承諾が未入力です。"];
    }
}

function policyCheck()
{
    global $error_msgs;
    $key = "policy";
    if (!$_POST[$key]) {
        $error_msgs[] = ["name" => $key, "message" => "プライバシーポリシーが未入力です。"];
    }
}
