<?php

namespace App\Exceptions;

use Exception;


class ExceptionsDataAPI
{
    const MSG_01 = 'Erro ao gravar informação, processo não realizado.';
    const MSG_02 = 'Processo realizado com sucesso.';

    const MESSAGE = 'message';
    const INVALID_DATA = 'invalid_data';

    static function error($cod_http, $data = array()) {

        switch ($cod_http) {
            case '406':
                return response()->json([
                    self::MESSAGE => self::MSG_01,
                    self::INVALID_DATA => $data
                ], 406);
                break;

            default:
                return response()->json([
                    self::MESSAGE => self::MSG_01
                ], 500);
                break;
        }

    }

    static function success($data = array(), $msg ='') {

        return response()->json([
            self::MESSAGE => self::MSG_02,
            'data' => $data
        ], 201);
    }
}