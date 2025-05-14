<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class ContentBlocksSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'parent' => 'global',
                'label' => 'Website Title',
                'description' => 'Shown on the home page, as well as any tabs in the users browser.',
                'slug' => 'website-title',
                'type' => 'text',
                'value' => 'Crunchy Cravings',
            ],
            [
                'parent' => 'global',
                'label' => 'Logo',
                'description' => 'Shown in the top entre of the every pages.',
                'slug' => 'logo',
                'type' => 'image',
            ],
            [
                'parent' => 'global',
                'label' => 'Business Address',
                'description' => 'Business headquarters address shown at footer of all pages.',
                'slug' => 'business-address',
                'type' => 'text',
                'value' => '121 King Street, Melbourne Victoria 3000 Australia',
            ],
            [
                'parent' => 'global',
                'label' => 'Business Phone Number',
                'description' => 'Business phone number shown at footer of all pages.',
                'slug' => 'business-phone',
                'type' => 'text',
                'value' => '+61 3 8376 6284',
            ],
            [
                'parent' => 'global',
                'label' => 'Email Link',
                'description' => 'The business email address.',
                'slug' => 'email-link',
                'type' => 'html',
                'value' => '<a href="mailto:crunchycravings@gmail.com">Crunchy Cravings</a>.',
            ],
            [
                'parent' => 'global',
                'label' => 'Copyright Message',
                'description' => 'Copyright information shown at the bottom of the all page.',
                'slug' => 'copyright-message',
                'type' => 'text',
                'value' => '(c) Copyright 2025, Crunchy Cravings.',
            ],
        ];

        $table = $this->table('content_blocks');
        $table->insert($data)->save();
    }
}
