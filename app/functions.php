<?php

function normal_text($data)
{
    if (gettype($data) !== "array") {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
    return '';
}

function normal_text_back($text)
{
    if (gettype($text) !== "array") {
        return trim(htmlspecialchars_decode(trim($text), ENT_QUOTES), ' ');
    }
    return '';
}

function normal_date($date, $format = 'M d, Y h:i A')
{
    $d = date_create($date);
    return date_format($d, $format);
}

function current_date($format = 'Y-m-d H:i:s')
{
    return date($format);
}

function normal_to_db_date($date, $format = 'Y-m-d H:i:s')
{
    $d = date_create($date);
    if ($d === false) { return false; }
    return date_format($d, $format);
}

function go ($URL)
{
    header("location: $URL");
    die();
}

function move ($PATH)
{
    header("location: ".URL."/$PATH");
    die();
}

function message_move ($message_type, $message_content, $PATH)
{
    $_SESSION['message'] = ['type' => $message_type, 'data' => $message_content];
    move($PATH);
}

function end_response ($status_code, $message, $header_json = false)
{
    if ($header_json) {
        header('Content-Type: application/json; charset=utf-8');
    }
    http_response_code($status_code);
    echo json_encode(['status_code' => $status_code, 'message' => $message]);
    die();
}

function href ($PATH, $ADD_PHP = true)
{
    return URL."/$PATH" . ($ADD_PHP ? '.php' : '');
}

function css_link ($file, $tag = false)
{
    $link = URL.'/'.$file.'.css';
    if ($tag) {
        return '<link rel="stylesheet" href="'.$link.'">';
    }
    return $link;
}

function js_link ($file, $tag = false)
{
    $link = URL.'/'.$file.'.js';
    if ($tag) {
        return '<script src="'.$link.'"></script>';
    }
    return $link;
}

function _d ($v)
{
    echo '<pre>' . var_export($v, true) . '</pre>';
}

function __d ($v)
{
    echo '<pre>' . var_export($v, true) . '</pre>';
    die();
}

function job_status_to_badge ($status) {
    if ($status === 'PINK') { return '<div class="badge badge-light-pink">waiting for diagnostics</div>'; }
    if ($status === 'ORANGE') { return '<div class="badge badge-light-warning">waiting for parts</div>'; }
    if ($status === 'RED') { return '<div class="badge badge-light-red">cannot be repaired</div>'; }
    if ($status === 'GREEN') { return '<div class="badge badge-light-success">repaired</div>'; }
    return '';
}

function job_status_to_text ($status) {
    if ($status === 'PINK') { return 'waiting for diagnostics'; }
    if ($status === 'ORANGE') { return 'waiting for parts'; }
    if ($status === 'RED') { return 'cannot be repaired'; }
    if ($status === 'GREEN') { return 'repaired'; }
    return '';
}
