		<div class="padding-15">

			<div class="login-box">

                <div id="divInfo" name="divInfo" class="alert <?=$alert_style; ?>" style="<?=$form_style;?>">
					<?=$message; ?>
				</div>

			</div>

		</div>

<?php
    Assets::js([
        template_url('plugins/jquery/jquery-2.1.4.min.js', 'smarty'),
        template_url('js/app.js', 'smarty'),
        template_url($js_script, 'smarty'),
    ]);

    echo isset($js) ? $js : ''; // Place to pass data / plugable hook zone

?>