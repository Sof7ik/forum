<?
require_once dirname(__DIR__) . '/php/connection.php';

$select5Themes=$pdo->query(
    "SELECT
        `themes`.`id` AS 'theme-id',
        `themes`.`name` AS 'theme-name'
    FROM
        ".dbname.".`themes`,
        ".dbname.".`theme-status`
    WHERE
        `themes`.`status` = `theme-status`.`id` AND
        `themes`.`status` = 2
    ORDER BY `themes`.`watches` DESC LIMIT 5");
?>

<div class="left">
    <p>Самые читаемые темы на форуме</p>

    <aside>
        <ul>
            <?
                while ($theme = $select5Themes->fetch())
                {
                    ?>
                    <li>
                        <a class="aside-item" href='/pages/theme.php?id=<?=$theme["theme-id"]?>' > <?=$theme['theme-name']?></a>
                    </li> 
                    <?
                }
            ?>
        </ul>
    </aside>

    <div class="map map-aside">
        <span>Мы на карте</span>

        <div class="map-wrapper">
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A9018cc0733649d69a1bf1682ac01ffc489ee5cc36ddc61a3e796fca44fc17862&amp;width=240&amp;height=240&amp;lang=ru_RU&amp;scroll=true"></script>
        </div>

        
    </div>
</div>

