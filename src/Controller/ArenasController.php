<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
* Personal Controller
* User personal interface
*
*/
class ArenasController  extends AppController
{
public function index()
	{
		$this->set('myname', "Myrvete Hatoum");

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
    $session = $this->request->session();
    $player_id = $session->read('Players.id');
    
    $query = $this->Fighters->find('all')->where(['Fighters.player_id' => $player_id]);
    $this->set('fighters', $query);
    
    
    //if(isset($session->read('user.fighters.ids'))){
        $array = array();
        foreach($query as $row){
            $array[] = $row->id;
        }
        $session->write([
                            'user.fighters.ids' => $array
                        ]);
    //}
    
}

public function viewFighter($id = null){
    $this->loadModel('Fighters');
    $fighter = $this->Fighters->get($id);
    $this->set(compact('fighter'));
    
    $fighters_ids = $this->request->session()->read('user.fighters.ids');
    for ($i = 0; $i < count($fighters_ids); $i++) {
        if($fighters_ids[$i] == $id){
            if($i == 0){
                $this->set('previous', $fighters_ids[count($fighters_ids)-1]);
                $this->set('next', $fighters_ids[$i+1]);
            }else if($i == count($fighters_ids)-1){
                $this->set('previous', $fighters_ids[$i-1]);
                $this->set('next', $fighters_ids[0]);
            }else{
                $this->set('previous', $fighters_ids[$i-1]);
                $this->set('next', $fighters_ids[$i+1]);
            }
            break;
        }
    }   
}

public function levelupFighter($id = null){ 
    $fightersTable = TableRegistry::get('Fighters');
    $fighter = $fightersTable->get($id);
    $totalAmountOfExp=($fighter->level + 1)*12;
    $currentAmountOfExp=$fighter->xp;
        
    if($currentAmountOfExp>=$totalAmountOfExp){
        $fighter->level++;
        $fighter->current_health++;
        $fighter->skill_health++;
        $fighter->xp = $currentAmountOfExp - $totalAmountOfExp;
        if($fighter->level % 3 == 0){
            $fighter->skill_strength++;
        }
        if($fighter->level % 5 == 0){
            $fighter->skill_sight++;
        }
        
        if ($fightersTable->save($fighter)) {
            $this->Flash->success(__('Votre champion devient plus fort!'));
            return $this->redirect(['action' => 'viewFighter', $id]);
        }
    }
    $this->Flash->error(__('Impossible de mettre à jour votre champion.'));   
    $this->set('fighter', $fighter);
    return $this->redirect(['action' => 'viewFighter', $id]);
}

public function addFighter()
{
    $this->loadModel('Fighters');
    
    $this->set('player_id', $this->request->session()->read('Players.id'));
    
    $fighter = $this->Fighters->newEntity();
    if ($this->request->is('post')) {
        $fighter = $this->Fighters->patchEntity($fighter, $this->request->data);
        if ($this->Fighters->save($fighter)) {
            $this->Flash->success(__('Votre champion a été créé.'));
            return $this->redirect(['action' => 'fighters']);
        }
        $this->Flash->error(__('Impossible de créer votre champion.'));
    }
    $this->set('fighter', $fighter);
}
}