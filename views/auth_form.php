<!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Пожалуйста введите данные своей учетной записи</h4>

                </div>

            </div>
            <div class="row">
                <form action="/auth/login" method="post" class="col-md-6">
                    <label>Введите Email: </label>
                    <input placeholder="E-mail" name="email" type="email" autofocus class="form-control" />
                    <?=form_error('email');?>
                    <label>Введите пароль:  </label>
                    <input placeholder="Пароль" name="password" type="password" value="" class="form-control" />
                    <?=form_error('password');?>
                    <label>
                        <input name="remember" type="checkbox" value="Remember Me">Запомнить меня
                    </label>
                    <hr />
                    <input type="submit" name="submit" value="Авторизация" class="btn btn-info"><br>
                    <a href="/auth/restore" class="info"><small>Забыли пароль?</small></a>
                </form>
                <?=  isset($message)? $info : '';?>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
