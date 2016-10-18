<div class="col-md-4 col-md-offset-4">
    <div class="login-panel panel panel-default">                  
        <div class="panel-heading">
            <h3 class="panel-title">Вход в панель администратора</h3>
        </div>
        <div class="panel-body">
            <form role="form" action="/admin/auth/login" method="post">
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                        <?=form_error('email');?>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Пароль" name="password" type="password" value="">
                        <?=form_error('password');?>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox" value="Remember Me">Запомнить меня
                        </label>
                    </div>
                    <div>
                        <!-- Change this to a button or input when using this as a form -->
                        <input type="submit" name="submit" value="Авторизация" class="btn btn-lg btn-success btn-block">
                        <a href="/admin/auth/restore" class=" btn btn-link">Восстановить пароль</a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>