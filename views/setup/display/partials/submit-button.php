<?php
$form = flexform_get_block_form($block);
$submit_btn_text_color = $form['submit_btn_text_color'] ? $form['submit_btn_text_color'] : '#fff';
$submit_btn_bg_color = $form['submit_btn_bg_color'] ? $form['submit_btn_bg_color'] : '#0a0a0a';
$label =  $block['button_text'] ? $block['button_text'] : _flexform_lang('next');
$icon = '<i class="fa-solid fa-arrow-right-long"></i>';
if($is_submit){
    $label = $form['submit_btn_name'] ? $form['submit_btn_name'] : _flexform_lang('submit');
    $icon =  '<i class="fa-regular fa-circle-check"></i>';
}
?>
<div class="flexform-sumbit-button-wrapper">
    <input type="hidden" name="current" value="<?php echo flexformPerfectSerialize($block['id']) ?>">
    <?php if ($is_submit) : ?>
        <input type="hidden" name="is_submit" value="1">
    <?php endif; ?>
    <button data-current="<?php echo flexformPerfectSerialize($block['id']) ?>"
            style="background: <?php echo $submit_btn_bg_color; ?>;color: <?php echo $submit_btn_text_color; ?>;"
            class="btn btn-lg ff-submit-button flexform-next-button-preview tw-mt-4"><span><?php echo $label;  ?></span> &nbsp;
    <?php echo $icon; ?>
    </button>
</div>