<?php

namespace App\Exceptions;

use Exception;


class ExceptionsDataAPI
{
    const MSG_01 = 'Erro ao gravar informação, processo não realizado.';
    const MSG_02 = 'Processo realizado com sucesso.';
    const MSG_04 = 'Usuário ou senha inválidos.';
    const MSG_05 = 'Cadastro realizado com sucesso.';

    const MSG_06 = 'Token expirado.';
    const MSG_07 = 'Token inválido.';
    const MSG_08 = 'Token na blacklisted';
    const MSG_09 = 'Token não fornecido';

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
            case '401':
                return response()->json([
                    self::MESSAGE => self::MSG_04
                ], 401);
                break;
            default:
                return response()->json([
                    self::MESSAGE => self::MSG_01
                ], 500);
                break;
        }

    }

    static function success($cod_http = 200, $data = array()) {
        switch($cod_http) {
            case '201':

                return response()->json([
                    self::MESSAGE => self::MSG_05,
                    'data' => $data
                ], 201);
                break;
            case '200':

                return response()->json([
                    self::MESSAGE => self::MSG_02,
                    'data' => $data
                ], 200);
                break;
        }
    }

    static function errorToken($error) {
        switch ($error) {
        case 'TOKEN_EXPIRED':

            return response()->json([
                self::MESSAGE => self::MSG_06,
            ], 406);
            break;
        case 'TOKEN_INVALID':

            return response()->json([
                self::MESSAGE => self::MSG_07,
            ], 406);
            break;
        case 'TOKEN_BLACKLISTED':

            return response()->json([
                self::MESSAGE => self::MSG_08,
            ], 406);
            break;
        case 'TOKEN_NOT_PROVIDED':

            return response()->json([
                self::MESSAGE => self::MSG_09,
            ], 406);
            break;
        }
    }
}