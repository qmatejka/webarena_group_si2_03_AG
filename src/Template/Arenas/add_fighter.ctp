<h1>Créer un nouveau champion</h1>
<?php
    echo $this->Form->create($fighter);
    echo $this->form->input('id', array('type'=>'hidden', 'value'=>'default') );
    echo $this->Form->input('name');
    echo $this->form->input('player_id', array('type'=>'hidden', 'value'=>$player_id) );
    echo $this->Form->input('coordinate_x');
    echo $this->Form->input('coordinate_y');
    echo $this->Form->input('level');
    echo $this->Form->input('xp');
    echo $this->Form->input('skill_sight');
    echo $this->Form->input('skill_strength');
    echo $this->Form->input('skill_health');
    echo $this->Form->input('current_health');
    echo $this->Form->button(__("Créer le champion"));
    echo $this->Form->end();

