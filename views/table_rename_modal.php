<div class="rename_modal_window modal_<?= $check ? ($key - 1) : $key ?>">
    <div class="exitModal exitModal_<?= $check ? ($key - 1) : $key  ?>"><button>X</button></div>
    <form method="post">
        <input type="hidden" name="from" value="<?= $path . "/" . $files[$check ? ($key + 1) : ($key + 2)] ?>">
        <input type="hidden" name="to_path" value="<?= $path . "/"?>">
        <input type="text" name="to" value="<?= $files[$check ? ($key + 1) : ($key + 2)] ?>">
        <input type="submit" value="Rename">
    </form>
</div>