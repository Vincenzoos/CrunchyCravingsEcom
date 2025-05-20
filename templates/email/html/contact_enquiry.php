<?php
/**
 * Contact Enquiry HTML email template
 *
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 * @var string $email business's email address
 */
?>
<div class="content">
    <table role="presentation" class="main" style="width:100%; border-collapse: collapse;">
        <tr>
            <td class="wrapper" style="padding: 20px;">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                    <tr>
                        <td>
                            <h3>New Contact Enquiry Received!</h3>
                            <p>Hello <?= h($email) ?>,</p>
                            <p>
                                You have received a new enquiry via the <b>CrunchyCravings</b> website.<br><br>
                                <strong>Enquiry Details:</strong>
                            </p>
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="width:100%; border: 1px solid #ddd;">
                                <tr>
                                    <td style="border: 1px solid #ddd; padding: 8px;"><strong>Name</strong></td>
                                    <td style="border: 1px solid #ddd; padding: 8px;"><?= h($contact->first_name) ?> <?= h($contact->last_name) ?></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #ddd; padding: 8px;"><strong>Email</strong></td>
                                    <td style="border: 1px solid #ddd; padding: 8px;"><?= h($contact->email) ?></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #ddd; padding: 8px;"><strong>Phone</strong></td>
                                    <td style="border: 1px solid #ddd; padding: 8px;"><?= h($contact->phone_number) ?></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #ddd; padding: 8px; vertical-align: top;"><strong>Message</strong></td>
                                    <td style="border: 1px solid #ddd; padding: 8px; white-space: pre-line;"><?= h($contact->message) ?></td>
                                </tr>
                            </table>
                            <p>
                                Please log in to the admin panel to view and manage this enquiry.
                            </p>
                            <p>
                                Best regards,<br>
                                CrunchyCravings
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div class="footer" style="margin-top: 10px; text-align: center; font-size: 12px; color: #999;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
            <tr>
                <td class="content-block" style="color:darkred; padding: 10px;">
                    This email was sent to <?= h($email) ?>.<br>
                    If you believe you received this in error, please disregard this message.<br><br>
                    Copyright &copy; <?= date("Y") ?> CrunchyCravings
                </td>
            </tr>
        </table>
    </div>
</div>
