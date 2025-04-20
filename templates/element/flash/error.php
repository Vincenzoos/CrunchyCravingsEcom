<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message error alert alert-danger" onclick="this.classList.add('hidden');"><i class="fa fa-times-circle"></i><?= ' '.$message ?></div>
