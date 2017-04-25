<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\User;
use App\Http\Controllers\Controller;

/**
 * Description of order_data_handler
 *
 * @author Fei
 */
class order_data_handler  extends Controller 
{
  public function insert_data()
  {
    $raw_data = array();
    foreach($_POST['data'] as $record) {
      DB::table('order_data')->insert(['hashed_user_id' => $record['_id'], 'order_number' => $record['order_number'], 'created' => date('Y-m-d H:i:s')]);
    }
  }
}
