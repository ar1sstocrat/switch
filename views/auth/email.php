<!DOCTYPE html>
<html>
    <body>
        <div style="position: relative; min-height: 1px; padding-right: 15px; padding-left: 15px;">
            <div style="margin-bottom: 20px; background-color: #fff; border: 1px solid transparent;border-radius: 4px;-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05); box-shadow: 0 1px 1px rgba(0, 0, 0, .05);border-color: #bce8f1; ">
                <div style=" color: #31708f;background-color: #d9edf7;border-color: #bce8f1;">
                    <?=sprintf(lang('email_forgot_password_heading'), $identity);?>
                </div>
                <div style="border-top-color: #bce8f1;">
                    <p><?=lang('email_forgot_password_hbody')?></p>
                    <p><?=sprintf(lang('email_forgot_password_subheading'), anchor($path.$forgotten_password_code, lang('email_forgot_password_link')));?></p>
                    <p><?=lang('email_forgot_password_fbody')?></p>
                </div>
                <div style=" padding: 10px 15px; background-color: #f5f5f5; border-top: 1px solid #ddd; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px;">
                            <?=lang('email_forgot_password_footer');?>
                </div>
            </div>
        </div>
    </body>
</html>