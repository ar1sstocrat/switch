<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bootsrtap Free Admin Template - SIMINTA | Admin Dashboad Template</title>
        <!-- Core CSS - Include with every page -->
        <link href="https://github.com/ar1sstocrat/switch/tree/master/public_html/assets/admin/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
        <link href="https://github.com/ar1sstocrat/switch/tree/master/public_html/assets/admin/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="https://github.com/ar1sstocrat/switch/tree/master/public_html/assets/admin/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
        <link href="https://github.com/ar1sstocrat/switch/tree/master/public_html/assets/admin/css/style.css" rel="stylesheet" />
        <link href="https://github.com/ar1sstocrat/switch/tree/master/public_html/assets/admin/css/main-style.css" rel="stylesheet" />
    </head>
    <body>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <?=sprintf(lang('email_forgot_password_heading'), $identity);?>
                        </div>
                        <div class="panel-body">
                            <p><?=sprintf(lang('email_forgot_password_subheading'), anchor('/admin/auth/reset_password/'.$forgotten_password_code, lang('email_forgot_password_link')));?></p>
                        </div>
                        <div class="panel-footer">
                            <?=lang('email_forgot_password_footer');?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>