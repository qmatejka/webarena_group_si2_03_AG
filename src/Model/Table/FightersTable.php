<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class FightersTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
    
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('name')
            ->requirePresence('name')
            ->notEmpty('coordinate_x')
            ->requirePresence('coordinate_x')
            ->notEmpty('coordinate_y')
            ->requirePresence('coordinate_y')
            ->notEmpty('level')
            ->requirePresence('level')
            ->notEmpty('xp')
            ->requirePresence('xp')
            ->notEmpty('skill_sight')
            ->requirePresence('skill_sight')
            ->notEmpty('skill_strength')
            ->requirePresence('skill_strength')
            ->notEmpty('skill_health')
            ->requirePresence('skill_health')
            ->notEmpty('current_health')
            ->requirePresence('current_health');
        
        return $validator;
    }
}