<? if(isset($msg_sucesso) && $msg_sucesso != ''): ?>
<div class="alert alert-success"><?=$msg_sucesso?></div>
<? endif; ?>

<? if(isset($msg_erro) && $msg_erro != ''): ?>
<div class="alert alert-error"><?=$msg_erro?></div>
<? endif; ?>