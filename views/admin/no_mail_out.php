<div class="col-md-4 col-md-offset-4">
    <div class="login-panel panel panel-default">                  
        <div class="panel-heading">
            <h3 class="panel-title">Для восстановления пароля введите Email</h3>
        </div>
        <div class="panel-body">
            <form role="form" action="/admin/auth/restore" method="post">
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="E-mail" name="email" id="email" type="email" autofocus>
                        <?=form_error('email');?>
                    </div>
                    <div>
                        <!-- Change this to a button or input when using this as a form -->
                        <input type="submit" name="submit" value="Восстановить" class="btn btn-lg btn-success btn-block">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>