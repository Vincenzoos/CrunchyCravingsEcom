<?php
/**
 * Reset Password HTML email template
 *
 * @var \App\View\AppView $this
 * @var string $first_name email recipient's first name
 * @var string $last_name email recipient's last name
 * @var string $email email recipient's email address
 * @var string $nonce nonce used to reset the password
 */
?>
<div class="content">
    <!-- START CENTERED WHITE CONTAINER -->
    <table role="presentation" class="main">
        <!-- START MAIN CONTENT AREA -->
        <tr>
            <td class="wrapper">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <h3>Reset your account password</h3>
<!--                            <p>Hi --><?php //= h($first_name) ?><!--, </p>-->
                            <p>Hi <?= h($email) ?>,</p>
                            <p>Thank you for your request to reset the password of your account on <b>CrunchyCravings</b>. </p>
                            <p></p>
                            <p>To reset your account password, use the button below to access the reset password page: </p>
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                <tbody>
                                <tr>
                                    <td align="left">
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                            <tr>
                                                <td><a href="<?= $this->Url->build(['controller' => 'Auth', 'action' => 'resetPassword', $nonce], ['fullBase' => true]) ?>" target="_blank">Reset account password</a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <p>or use the following link: <br>
                                <?= $this->Html->link($this->Url->build(['controller' => 'Auth', 'action' => 'resetPassword', $nonce], ['fullBase' => true])) ?></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- END MAIN CONTENT AREA -->
    </table>
    <!-- END CENTERED WHITE CONTAINER -->
    <!-- START FOOTER -->
    <div class="footer" style="margin-top: 10px; text-align: center; font-size: 12px; color: #999;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
            <tr>
                <td class="content-block" style="color: darkred; padding: 10px;">
                    <!--                    This email is addressed to --><?php //= h($first_name) ?><!-- --><?php //= h($last_name) ?><!-- &lt;--><?php //= h($email) ?><!--&gt;<br>-->
                    This email is addressed to <?= h($email) ?><br>
                    Please ignore this email if you did not place an order.<br><br>
                    Copyright &copy; <?= date("Y"); ?> CrunchyCravings
                </td>
            </tr>
        </table>
    </div>
    <!-- END FOOTER -->
</div>
