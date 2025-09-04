<?php
// Cek tahap form
$step = isset($_POST['step']) ? $_POST['step'] : 1;

// STEP 1: Input baris & kolom
if ($step == 1) {
?>
    <form method="post">
        <label>Inputkan Jumlah Baris:</label>
        <input type="number" name="rows" required> Contoh: 1 <br><br>

        <label>Inputkan Jumlah Kolom:</label>
        <input type="number" name="cols" required> Contoh: 3 <br><br>

        <input type="hidden" name="step" value="2">
        <button type="submit">SUBMIT</button>
    </form>
<?php
}

// STEP 2: Generate form input berdasarkan baris x kolom
elseif ($step == 2) {
    $rows = $_POST['rows'];
    $cols = $_POST['cols'];
    ?>
    <form method="post">
        <?php
        for ($i = 1; $i <= $rows; $i++) {
            for ($j = 1; $j <= $cols; $j++) {
                echo "$i.$j <input type='text' name='data[$i][$j]'> ";
            }
            echo "<br><br>";
        }
        ?>
        <input type="hidden" name="step" value="3">
        <input type="hidden" name="rows" value="<?= $rows ?>">
        <input type="hidden" name="cols" value="<?= $cols ?>">
        <button type="submit">SUBMIT</button>
    </form>
<?php
}

// STEP 3: Tampilkan hasil input user sesuai format "i.j : value"
elseif ($step == 3) {
    $rows = $_POST['rows'];
    $cols = $_POST['cols'];
    $data = $_POST['data'];

    echo "<h3>Hasil Input:</h3>";
    echo "<pre>"; // agar format rapi
    for ($i = 1; $i <= $rows; $i++) {
        for ($j = 1; $j <= $cols; $j++) {
            $value = isset($data[$i][$j]) ? htmlspecialchars($data[$i][$j]) : '';
            echo "$i.$j : $value\n";
        }
    }
    echo "</pre>";
    echo"<form method='post'>

        <input type='hidden' name='step' value='1'>
        <button type='submit'>Back To Step 1</button>
    </form>";
}
?>
