<!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Введите новый пароль</h4>
                </div>
            </div>
            
            <div class="row">
                <form action="/auth/change_password" method="post" class="col-md-6">
                    <label>Введите новый пароль: </label>
                    <input placeholder="Новый пароль" name="new_pass" type="password" autofocus class="form-control" />
                    <?=form_error('new_pass');?>
                    <label>Введите новый пароль повторно: </label>
                    <input placeholder="Подтвердите пароль" name="new_pass_confirm" type="password" autofocus class="form-control" />
                    <?=form_error('new_pass_confirm');?>
                    <hr />
                    <input type="submit" name="submit" value="Изменить пароль" class="btn btn-info">
                    <input name="email" type="hidden" value="<?=$email?>" />
                </form>
                <?=  isset($message) ? $info : '';?>
            </div>
        </div>
    </div>
<!-- CONTENT-WRAPPER SECTION END-->
