<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('fighter') ?>

</head>
<body>
    <header>
        <article id="position">
            <h2>POSITION</h2>
            <ul>
                <li>X = 2</li>
                <li>Y = 3</li>
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
                <li><?= $this->Html->image('sword.png', ['alt' => 'icon strength']) ?> = <?= h($fighter->xp) ?></li>
                <li><?= $this->Html->image('visible-opened-eye-interface-option.png', ['alt' => 'icon sight']) ?> = <?= h($fighter->xp) ?></li>
            </ul>
        </article>
    </header>
    <section>
        <?= $this->Html->image('avatar_'.strtolower(h($fighter->name)).'.png', ['alt' => 'Fighter Avatar','class' => 'avatar']) ?>
        <p id="level"><?= h($fighter->level) ?></p>
        <p><?= h($fighter->name) ?></p>
        <progress id="experience-bar" max="<?= (h($fighter->level)+1)*12 ?>" value="<?= h($fighter->xp) ?>"></progress>
        <p id="exp"><?= h($fighter->xp) ?> / <?= (h($fighter->level)+1)*12 ?></p>
        <?= $this->Html->image('keyboard-left-arrow-button.png', ['alt' => 'Previous','class' => 'arrow']) ?>
        <a id="play" onclick="div_show()">PLAY</a>
        <?= $this->Html->image('keyboard-right-arrow-button.png', ['alt' => 'Next','class' => 'arrow']) ?>
    </section>

</body>
</html>