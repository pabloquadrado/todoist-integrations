<?php

function d()
{
    $params = func_get_args();

    $backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT);

    $caller = array_shift($backtrace);

    echo '<code>File: ' . $caller['file'] . ' / Line: ' . $caller['line'] . '</code>';

    foreach($params as &$param) {
        echo '<pre>';

        if (is_object($param) || is_array($param)) {
            print_r($param);
        } else if (empty($param) || is_resource($param)) {
            var_dump($param);
        } else {
            echo (string) $param;
        }

        echo '</pre>';
    }
}

function dd()
{
    $params = func_get_args();

    call_user_func_array('d', $params);

    die;
}
