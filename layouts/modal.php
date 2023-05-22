<?php
// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects
extract($displayData);
?>
<form>
	<input class="uk-input required" name="product" placeholder="Товар" type="text" value="<?php echo $product->name; ?>" />
	<input class="uk-input required" name="name" placeholder="Имя" type="text" />
	<input class="uk-input required" name="email" placeholder="Email" type="text" />
	<input class="uk-input required" name="quaestion" placeholder="Вопрос" type="textarea" />
	<button class="btn uk-button rf-button-send">Задать вопрос</button>
</form>