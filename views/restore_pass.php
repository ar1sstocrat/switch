<!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Введите адрес електронной почты</h4>
                </div>
            </div>
            
            <div class="row">
                <form action="/auth/restore" method="post" class="col-md-6">
                    <label>Введите Email: </label>
                    <input placeholder="E-mail" name="email" type="email" autofocus class="form-control" />
                    <?=form_error('email');?>
                    <hr />
                    <input type="submit" name="submit" value="Восстановить" class="btn btn-info">
                </form>
                <?=  isset($message) ? $info : '';?>
            </div>
        </div>
    </div>
<!-- CONTENT-WRAPPER SECTION END-->
