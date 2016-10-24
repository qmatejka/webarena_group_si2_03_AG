<?php
namespace App\Controller;
use Cake\Controller\Controller;

/**
* Personal Controller
* User personal interface
*
*/
class ArenasController  extends Controller
{
public function index()
{
	$this->set('myname', "Julien Falconnet");
}

public function diary()
{
	
}

public function login()
{
	
}

public function sight()
{
	
}

public function fighters()
{
    $this->loadModel('Fighters');
    $player_id = $this->request->session()->read('Players.id');
    $this->set('fighters', $this->Fighters->find('all')->where(['Fighter.player_id' => $player_id]));
}

public function viewFighter($id = null){
    $this->loadModel('Fighters');
    $fighter = $this->Fighters->get($id);
    $this->set(compact('fighter'));
}
}