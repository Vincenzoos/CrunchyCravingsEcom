<?php
/**
 * Contact Enquiry Text email template
 *
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 * @var string $email business's email address
 */
?>
New Contact Enquiry Received!
--------------------------------------------------

Hello <?= h($email) ?>,

You have received a new enquiry via the CrunchyCravings website.

Enquiry Details:
--------------------------------------------------
Name: <?= h($contact->first_name) ?> <?= h($contact->last_name) ?>

Email: <?= h($contact->email) ?>

Phone: <?= h($contact->phone_number) ?>


Message:
<?= h($contact->message) ?>

--------------------------------------------------

Please log in to the admin panel to view and manage this enquiry.

Best regards,
CrunchyCravings

--------------------------------------------------
This email was sent to <?= h($email) ?>.
If you believe you received this in error, please disregard this message.

Copyright © <?= date("Y") ?> CrunchyCravings
```
This template matches the structure and tone of your order confirmation, but is tailored for contact enquiries.
