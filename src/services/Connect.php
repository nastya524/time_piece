<?php
namespace services;
class Connect
{
    public static function Connect()
    {
        $timePiece = mysqli_connect(
            '127.0.0.1:3306',
            'root',
            '',
            'timePiece'
        );
        if (!$timePiece)
        {
            die('нет соединения с бд');
        }
        else
        {
            return $timePiece;
        }
    }
}
