<?php
require_once __DIR__ . '/src/helperFunctions.php';
require_once  __DIR__ . '/header.php';
$oldValue = $_POST['text'];
?>
<div class="container">
    <form class="m-5" action="text.php" method="post">
        <label for="text">Введите текст</label>
        <textarea class="form-control mt-3" name="text" id="text"><?php
                if (!empty($_GET['preset'])) {
                    $file = "preset".$_GET['preset'].".html";
                    echo file_get_contents(__DIR__.'/'.$file);
                }
                else{
                    echo htmlspecialchars($oldValue);
                }
            ?></textarea>
        <button name="button" type="submit" class="btn btn-primary mt-2">Отправить</button>
    </form>
    <?php
        if(isset($_POST['button'])){
            include __DIR__ .  '/src/text.php'; ?>
                <div>
                    <h2>Задание 2</h2>
                </div>
            <?php if(!empty($images)) {
                foreach ($images as $image) { ?>
                    <div>
                        <img src="<?php echo $image; ?>" alt="image">
                    </div>
                <?php } }?>
                <div>
                    <h2>Задание 7</h2>
                </div>
            <?php if(!empty($replaced)) { ?>
                <div>
                    <?php echo $replaced; ?>
                </div>
            <?php } ?>
            <div>
                <h2>Задание 12</h2>
            </div>
            <?php if(!empty($tableContent)) {
                foreach ($tableContent as $number => $firstElement) {
                    ?>
                    <a class="text-decoration-none" href="#table<?= $number ?>">Таблица <?= $number ?>
                        : <?= $firstElement ?> </a><br>
                    <?php } }?>
            <div>
                <h2>Задание 16</h2>
            </div>
            <?php if(!empty($replacePick)) { ?>
                <div>
                    <?php echo $replacePick; ?>
                </div>
            <?php } ?>
            <div>
                <h2>Все таблицы</h2>
            </div>
            <?php if (!empty($allTables)) {
                foreach ($allTables as $number=>$table) { ?>
                    <table id="table<?= $number?>">
                        <?php foreach ($table as $rowData) { ?>
                            <tr>
                                <?php foreach ($rowData as $cell) { ?>
                                    <td class="pe-3"><?= $cell ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </table>
                <?php } }?>

        <?php } ?>

</div>



    <?php
    require_once  __DIR__ . '/footer.php';
    ?>

