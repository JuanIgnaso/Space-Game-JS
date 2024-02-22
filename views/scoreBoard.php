<?php
use juanignaso\phpmvc\framework\Application;

$this->title = 'ScoreBoard';
?>
<h1 class="text-center">TOP 10 Scores</h1>
<section class="m-auto p-3">
    <ul class="text-white flex justify-center gap-3">
        <li><a href="/scoreBoard">General</a></li>
        <li>-</li>
        <li><a href="/scoreBoard<?php echo Application::isGuest() ? '' : '?personal=yes'; ?>">Record Personal</a></li>
    </ul>
</section>
<table class="text-white table-auto m-auto">
    <caption class="text-xs text-lime-400">TOP 10
        <?php echo isset($global) && !$global && !Application::isGuest() ? Application::$app->user->nombre : 'Global'; ?>
        Scores
    </caption>
    <thead class="text-red-400 text-base lg:text-xl">
        <tr>
            <th class="p-2">Usuario</th>
            <th class="p-2">Puntuación</th>
            <th class="p-2">Game Over</th>
            <th class="p-2">Terminado</th>
        </tr>
    </thead>
    <tbody class="text-xs lg:text-base">
        <?php
        if (count($topGames) != 0) {
            foreach ($topGames as $game) {
                ?>
                <tr class="text-center">
                    <td
                        class="p-2 <?php echo !Application::isGuest() && Application::$app->user->nombre == $game['nombre'] ? 'text-yellow-400' : ''; ?>">
                        <?php echo $game['nombre']; ?>
                    </td>
                    <td class="p-2">
                        <?php echo $game['score']; ?>
                    </td>
                    <td class="p-2">
                        <?php echo $game['game_finished'] == 1 ? 'No' : 'Yes'; ?>
                    </td>
                    <td class="p-2">
                        <?php echo $game['finished_at']; ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>