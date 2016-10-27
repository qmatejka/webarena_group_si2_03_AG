<?= $this->Html->css('fighter') ?>

<header>
    <article id="position">
        <h2>POSITION</h2>
        <ul>
            <li>X = <?= h($fighter->coordinate_x) ?></li>
            <li>Y = <?= h($fighter->coordinate_y) ?></li>
        </ul>
    </article>

    <article id="skills">
        <h2>SKILLS</h2>
        <ul>
            <li>
                <?= $this->Html->image('favorite-heart-button.png', ['alt' => 'icon health']) ?> 
                <progress id="health-bar" max="<?= h($fighter->skill_health) ?>" value="<?= h($fighter->current_health) ?>"></progress>
                <p id="health"><?= h($fighter->current_health) ?> / <?= h($fighter->skill_health) ?></p>
            </li>
            <li><?= $this->Html->image('sword.png', ['alt' => 'icon strength']) ?> = <?= h($fighter->skill_strength) ?></li>
            <li><?= $this->Html->image('visible-opened-eye-interface-option.png', ['alt' => 'icon sight']) ?> = <?= h($fighter->skill_sight) ?></li>
        </ul>
    </article>
</header>
<section>
    <?php
        if(file_exists(WWW_ROOT . 'img' . DS . 'avatar_'.strtolower(h($fighter->name)).'.png')){
            $avatar='avatar_'.strtolower(h($fighter->name)).'.png';
        }else{
            $avatar='helmet.png';
        }
        echo $this->Html->image($avatar, ['alt' => 'Fighter Avatar','class' => 'avatar'])        
    ?>
    <p id="level"><?= h($fighter->level) ?></p>
    <p><?= h($fighter->name) ?></p>
    <?php 
        if(h($fighter->xp)<= (h($fighter->level)+1)*12){
            $activ = "disabled";
        }else{
            $activ = "";
        }
        echo $this->Html->link(
                                'LEVEL UP',
                                array('controller' => 'arenas', 'action' => 'levelupFighter', h($fighter->id)),
                                ['class' => $activ.' button'],
                                array(),
                                "Are you sure you want to levelup your fighter?"
                            );
    ?>
    <progress id="experience-bar" max="<?= (h($fighter->level)+1)*12 ?>" value="<?= h($fighter->xp) ?>"></progress>
    <p id="exp"><?= h($fighter->xp) ?> / <?= (h($fighter->level)+1)*12 ?></p>
    <?= $this->Html->image('keyboard-left-arrow-button.png', [
        'alt' => 'Previous',
        'class' => 'arrow',
        'url' => ['controller' => 'arenas', 'action' => 'viewFighter', $previous]
        ]) ?>
    <a id="play">PLAY</a>
    <?= $this->Html->image('keyboard-right-arrow-button.png', [
        'alt' => 'Next',
        'class' => 'arrow',
        'url' => ['controller' => 'arenas', 'action' => 'viewFighter', $next]
        ]) ?>
</section>