<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
	<div class="login-panel panel panel-default">
            <div class="panel-heading">Вход в панель администратора</div>
                <div class="panel-body">
                    <form role="form" action="/admin/auth/login" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
                                <?=form_error('email');?>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                <?=form_error('password');?>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Запомнить меня
                                </label>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Авторизация">
                            <a href="/admin/auth/restore" class=" btn btn-link">Восстановить пароль</a>
			</fieldset>
                    </form>
		</div>
	</div>
    </div><!-- /.col-->
    <?=!empty($message)?$auth_error:NULL;?>
</div><!-- /.row -->
