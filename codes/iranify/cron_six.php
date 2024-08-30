<?php
require_once 'config.php';
require_once 'apipanel.php';
require_once 'botapi.php';
#-------------[  Notification to the user ]-------------#
$list_service = mysqli_query($connect, "SELECT * FROM invoice");
while ($row = mysqli_fetch_assoc($list_service)) {
    $date = date('Y-m-d H:i:s');
    $marzban_list_get = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM marzban_panel WHERE name_panel = '{$row['Service_location']}'"));
    $get_username_Check = getuser($row['username'], $marzban_list_get['name_panel']);


    try {
        if (!isset($get_username_Check['status'])) continue;

        $liveValue = floor((@$get_username_Check['data_limit'] - @$get_username_Check['used_traffic']) / 1073741824);
        mysqli_query($connect, "update invoice set live_volume={$liveValue} where id_invoice='{$row['id_invoice']}'");
        $date = date('Y-m-d H:i:s');
        mysqli_query($connect, "update invoice set live_volume_updated_at='{$date}' where id_invoice='{$row['id_invoice']}'");

        if (@$get_username_Check['used_traffic'] && $liveValue >= 3) {
            mysqli_query($connect, "update invoice set 3_gig_notified_at=NULL where id_invoice='{$row['id_invoice']}'");
        }

        if (@$get_username_Check['used_traffic'] && $liveValue >= 1) {
            mysqli_query($connect, "update invoice set 1_gig_notified_at=NULL where id_invoice='{$row['id_invoice']}'");
        }

    } catch (\Exception) {

    }


    if (isset($get_username_Check['status'])) {
        $timeservice = $get_username_Check['expire'] - time();
        $day = floor($timeservice / 86400) + 1;
        $output = $get_username_Check['data_limit'] - $get_username_Check['used_traffic'];
        $RemainingVolume = formatBytes($output);

        $date = date('Y-m-d H:i:s');
        if (is_null($row['1_gig_notified_at']) &&   $output <= 1073741824 && $output > 0 && isset($get_username_Check['data_limit']) && $get_username_Check['status'] == "active") {
            $text = "
⭕️ کاربر گرامی از حجم سرویس تان کمتر از 1 گیگ مانده است.
برای جلوگیری از قطع سرویس از طریق منوی تمدید سرویس آنرا تمدید کنید.

نام کاربری : <code>{$row['username']}</code>
نام سرویس : {$row['name_product']}
";
            sendmessage($row['id_user'], $text, null, 'HTML');
            mysqli_query($connect, "update invoice set 1_gig_notified_at='{$date}' where id_invoice='{$row['id_invoice']}'");
            if (is_null($row['3_gig_notified_at'])) {
                mysqli_query($connect, "update invoice set 3_gig_notified_at='{$date}' where id_invoice='{$row['id_invoice']}'");
            }
        } elseif (is_null($row['3_gig_notified_at']) && $output <= 3221225472 && $output > 0 && isset($get_username_Check['data_limit']) && $get_username_Check['status'] == "active") {
            $text = "
⭕️ کاربر گرامی از حجم سرویس تان کمتر از 3 گیگ مانده است.
برای جلوگیری از قطع سرویس از طریق منوی تمدید سرویس آنرا تمدید کنید.

نام کاربری : <code>{$row['username']}</code>
نام سرویس : {$row['name_product']}
";
            sendmessage($row['id_user'], $text, null, 'HTML');
            mysqli_query($connect, "update invoice set 3_gig_notified_at='{$date}' where id_invoice='{$row['id_invoice']}'");
        } elseif ($output <= 5368709120 && $output > 0 && isset($get_username_Check['data_limit']) && $get_username_Check['status'] == "active") {
            $text = "
⭕️ کاربر گرامی از حجم سرویس تان کمتر از 5 گیگ مانده است.
برای جلوگیری از قطع سرویس از طریق منوی تمدید سرویس آنرا تمدید کنید.مانده است

نام کاربری : <code>{$row['username']}</code>
نام سرویس : {$row['name_product']}
";
            sendmessage($row['id_user'], $text, null, 'HTML');
        }


    }
}
#-------------[  Notification to the user ]-------------#

