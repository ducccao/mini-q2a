<button id="send">
    send mail


</button>
<?php


function adminNotifyQuestionByMail()
{

    $to = "caovanducs@gmail.com";
    $subject = "Hi Duc";
    $txt = "Content mail";
    $headers = "From: mini-q2a-udpt04";


    $send = mail($to, $subject, $txt, $headers);
    echo $send;
    echo 2;
    if (!$send) {
        return -1;
    }
    return 1;
}
$ret = adminNotifyQuestionByMail();
echo $ret;
?>