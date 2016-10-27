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
		$this->set('myname', "Myrvete Hatoum");
		//$this->loadModel('Fighters');
		//$figterlist=$this->Fighters->find('all');
		//pr($figterlist->toArray());
		$this->loadModel('Fighters');
		$message = $this->Fighters->test();
		//var_dump($message);
		$this->set('var', $message);
	}

	public function login()
	{
		$messageUser="";
		if($this->request->is('post')){
	
			$data= $this->request->data;
			$this->loadModel('Players');
			$res=$this->Players->find('all')->where(['Players.email' => $data['userName']]);
			$res = $res->first();
			if($res['password'] == $data['password'] AND $res['email'] == $data['userName']){
				$session = $this->request->session();

				$session->write([
  							'Players.id' => $res['id'] ,
  							'Players.email' => $res['email']
  						]);
				$messageUser="Vous êtes bien connecté.";
				return $this->redirect([
					'controller' => 'arenas',
					'action' => 'fighters']);
			}else{
				$messageUser="Votre identifiant et/ou mot de passe est incorrect. Veuillez réessayer.";
			}
		}else{
			
			$messageUser = "Veuillez vous connecter.";
		}
		$this->set('messageUser',$messageUser);
	}

	public function sight()
	{

		$this->set('arenaWidth', 15);
		$this->set('arenaHeight', 10);

		$this->loadModel('Fighters');

		$player_id = $this->request->session()->read('Players.id');
		$fighters = $this->Fighters->find('all')->where(['Fighters.player_id' => $player_id]);
		
		foreach ($fighters as $key => $value) {
					$fighterDisplay[] = $value;		
		}
		$this->set('fighterDisplay', $fighterDisplay);
		$sightDisplay=array();
		foreach ($fighterDisplay as $key => $value) {
			$x = $value['coordinate_x'] ;
			$y = $value['coordinate_y'] ;

			for($i=1;$i<$value['skill_sight']+1;$i++){
				for($k=0;$k<$value['skill_sight']-$i+1;$k++){
					$sightDisplay[$x+$i][$y+$k]=1;
					$sightDisplay[$x+$i][$y-$k]=1;

					$sightDisplay[$x-$i][$y-$k]=1;

					$sightDisplay[$x-$i][$y+$k]=1;
					$sightDisplay[$x][$y+$i]=1;
					$sightDisplay[$x][$y-$i]=1;
				}

			}

		}	
			/*	if($i!=0){
					$sightDisplay[$x][$y+$i]=1;
					$sightDisplay[$x+$i][$y]=1;
					$sightDisplay[$x+$i][$y-$i%($value['skill_sight']) ]=1;
					$sightDisplay[$x+$i][$y+$i%$value['skill_sight'] ]=1;
				}
				*/
		$this->set('fightersSight',$sightDisplay);

	}

	public function diary()
	{
	}

public function fighters()
{
    $this->loadModel('Fighters');
    $player_id = $this->request->session()->read('Players.id');
    $this->set('fighters', $this->Fighters->find('all')->where(['Fighters.player_id' => $player_id]));
}

public function viewFighter($id = null){
    $this->loadModel('Fighters');
    $fighter = $this->Fighters->get($id);
    $this->set(compact('fighter'));
}
}