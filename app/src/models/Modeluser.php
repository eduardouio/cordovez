<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Trabaja con los datos del usuario
 * @package    CordovezApp
 * @author    Eduardo Villota <eduardouio7@gmail.com>
 * @copyright    Copyright (c) 2014,  Agencias y Representaciones Cordovez S.A.
 * @license    Todos los derechos reservados Agencias y Representaciones Cordovez S.A.
 * @link    https://gitlab.com/eduardo/APPImportaciones
 * @since    Version 1.0.0
 * @filesource
 */
class Modeluser extends CI_Model {
    private $table = 'usuario';

    /**
     * Retorna la informacion de un usuario, si no existe retorna false
     * @param int $idUser
     * @return array | boolean
     */
    public function get($idUser) 
    {
        $user = $this->modelbase->get_table([
            'table' => $this->table,
            'where' => [
                'id_user' => $idUser,
            ],
        ]);
        if((gettype($user) == 'array') && (count($user) > 0)){
            return $user[0];
        }
        return false;
    }
}