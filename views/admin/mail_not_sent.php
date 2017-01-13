<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
	<div class="login-panel panel panel-default">
            <div class="panel-heading">Введите Ваш Email</div>
                <div class="panel-body">
                    <form role="form" action="/admin/auth/restore" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
                                <?=form_error('email');?>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Восстановить">
			</fieldset>
                    </form>
		</div>
	</div>
    </div><!-- /.col-->
    <?=!empty($message)?$mail_sent:NULL;?>
</div><!-- /.row -->