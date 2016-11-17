<!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Пожалуйста введите данные для создания учетной записи</h4>
                </div>

            </div>
            <div class="row">
                <form action="/auth/registration" method="post" class="col-md-6" enctype="multipart/form-data">
                    <label>Имя<strong style="color: red">*</strong>: </label>
                    <input placeholder="Ваше Имя" name="first_name" type="text" autofocus class="form-control" value="<?=set_value('first_name', '')?>" />
                    <?=form_error('email');?>
                    <label>Фамилия<strong style="color: red">*</strong>: </label>
                    <input placeholder="Ваша Фамилия" name="last_name" type="text" autofocus class="form-control" value="<?=set_value('last_name', '')?>"/>
                    <?=form_error('email');?>
                    <label>Отчество: </label>
                    <input placeholder="Ваше Отчество" name="patronimyc" type="text" autofocus class="form-control" value="<?=set_value('patronimyc', '')?>"/>
                    <?=form_error('email');?>
                    <label>Телефон<strong style="color: red">*</strong>: </label>
                    <input placeholder="Телефон в формате 050-ХХХ-ХХ-ХХ" name="phone" type="tel" autofocus class="form-control" pattern="^\d{3}-\d{3}-\d{2}-\d{2}$" title="Вы неверно ввели номер мобильного телефона, повторите ввод в формате 050-XXX-XX-XX" value="<?=set_value('phone', '')?>"/>
                    <label>Email<strong style="color: red">*</strong>: </label>
                    <input placeholder="E-mail" name="email" type="email" autofocus class="form-control" value="<?=set_value('email', '')?>"/>
                    <?=form_error('email');?>
                    <label>Пароль<strong style="color: red">*</strong>: </label>
                    <input placeholder="Пароль" name="password" type="password" value="" class="form-control" />
                    <?=form_error('password');?>
                    <label>Повторите пароль<strong style="color: red">*</strong>: </label>
                    <input placeholder="Введите пароль еще раз" name="password_confirm" type="password" value="" class="form-control" />
                    <?=form_error('password');?>
                    <label>Выберите Ваш отдел<strong style="color: red">*</strong>:</label>
                    <select name="department" class="form-control">
                        <option></option>
                        <?php
                        foreach($data['department'] as $key => $value)
                        {
                            echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                        }
                        ?>
                    </select>
                    <label>Выберите Вашу должность<strong style="color: red">*</strong>:</label>
                    <select name="post" class="form-control">
                        <option></option>
                        <?php
                        foreach($data['post'] as $key => $value)
                        {
                            echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                        }
                        ?>
                    </select>
                    <label>Выберите изображение:</label>
                    <input type="file" name="img">
                    <hr />
                    <input type="submit" name="submit" value="Авторизация" class="btn btn-info"><br>
                </form>
                <div class="col-md-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            Информация о заполнении формы
                        </div>
                        <div class="panel-body">
                            <p>Поля обозначеные <strong style="color: red">*</strong> обязательны для заполнения</p>
                            <p>Телефон вводится в формате YYY-XXX-XX-XX, где YYY - код оператора например 050, а ХХХ-ХХ-ХХ - номер Вашего телефона</p>
                            <p>После регистрации Ваша учетная запись будет активирована Администратором в течени 1 рабочего дня. В случае возникновения вопросов обращайтесь по Email.</p>
                        </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
                <?=  isset($message)? $info : '';?>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
   

