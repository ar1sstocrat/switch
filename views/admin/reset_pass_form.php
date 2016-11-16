<div class="col-md-4 col-md-offset-4">
    <div class="login-panel panel panel-default">                  
        <div class="panel-heading">
            <h3 class="panel-title">Введите новый пароль</h3>
        </div>
        <div class="panel-body">
            <form role="form" action="/admin/auth/change_password" method="post">
                <fieldset>
                    
                    <div class="form-group">
                        <input class="form-control" placeholder="Новый пароль" name="new_pass" type="password" value="">
                        <?=form_error('new_pass');?>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Подвердите пароль" name="new_pass_confirm" type="password" value="">
                        <?=form_error('new_pass_confirm');?>
                    </div>
                        <input class="form-control" name="email" type="hidden" value="<?=$email?>">
                    <div>
                        <!-- Change this to a button or input when using this as a form -->
                        <input type="submit" name="submit" value="Сменить" class="btn btn-lg btn-success btn-block">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>