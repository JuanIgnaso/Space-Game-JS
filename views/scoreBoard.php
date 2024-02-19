<?php
use juanignaso\phpmvc\framework\Application;

$this->title = 'ScoreBoard';
?>
<h1 class="text-center">TOP 10 Scores</h1>
<section class="m-auto p-3">
    <ul class="text-white flex justify-center gap-3">
        <li><a href="/scoreBoard">General</a></li>
        <li><a href="/scoreBoard?personal=yes">Personal Best</a></li>
    </ul>
</section>
<table class="text-white table-auto m-auto">
    <caption class="text-xs text-lime-400">TOP 10
        <?php echo isset($global) && !$global ? Application::$app->user->nombre : 'Global'; ?> Scores
    </caption>
    <thead class="text-red-400 text-xl">
        <tr>
            <th>User</th>
            <th>Score</th>
            <th>Game Over</th>
            <th>Finished at</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($topGames) != 0) {
            foreach ($topGames as $game) {
                ?>
                <tr class="text-center">
                    <td class="<?php echo Application::$app->user->nombre == $game['nombre'] ? 'text-yellow-400' : ''; ?>">
                        <?php echo $game['nombre']; ?>
                    </td>
                    <td>
                        <?php echo $game['score']; ?>
                    </td>
                    <td>
                        <?php echo $game['game_finished'] == 1 ? 'No' : 'Yes'; ?>
                    </td>
                    <td>
                        <?php echo $game['finished_at']; ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>