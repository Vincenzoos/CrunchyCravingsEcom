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
                'value' => 'cc_logo.png',
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
                'value' => '<a href="mailto:crunchycravings@gmail.com">crunchycravings@gmail.com</a>',
            ],
            [
                'parent' => 'global',
                'label' => 'Copyright Message',
                'description' => 'Copyright information shown at the bottom of the all page.',
                'slug' => 'copyright-message',
                'type' => 'text',
                'value' => '(c) Copyright 2025, Crunchy Cravings.',
            ],

            // Home page - Hero section
            [
                'parent' => 'home',
                'label' => 'Hero Heading',
                'description' => 'The heading shown in the hero section of the home page.',
                'slug' => 'hero-heading',
                'type' => 'text',
                'value' => 'Discover And Explore Premium Lavosh Crackers',
            ],
            [
                'parent' => 'home',
                'label' => 'Hero Text',
                'description' => 'The text shown in the hero section of the home page.',
                'slug' => 'hero-text',
                'type' => 'text',
                'value' => 'CrunchyCravings offers premium Lavosh crackers that pair perfectly with wine and other fine foods. Whether for social gatherings or as a gift, our products are designed to impress.',
            ],
            [
                'parent' => 'home',
                'label' => 'Hero Image',
                'description' => 'The image shown in the hero section of the home page, to the right of the text.',
                'slug' => 'hero-image',
                'type' => 'image',
                'value' => 'crackers.png',
            ],

            // Home page - Product types
            [
                'parent' => 'home',
                'label' => 'Classic Favorites Image',
                'description' => 'The image shown for "Classic favorites" product type in the home page.',
                'slug' => 'classic-image',
                'type' => 'image',
                'value' => 'Classic.jpg',
            ],
            [
                'parent' => 'home',
                'label' => 'Modern Twists Image',
                'description' => 'The image shown for "Modern twists" product type in the home page.',
                'slug' => 'modern-image',
                'type' => 'image',
                'value' => 'Modern.jpg',
            ],
            [
                'parent' => 'home',
                'label' => 'Signature Hampers Image',
                'description' => 'The image shown for "Signature hampers" product type in the home page.',
                'slug' => 'signature-image',
                'type' => 'image',
                'value' => 'Large.jpg',
            ],

            // Home page - Our Mission section
            [
                'parent' => 'home',
                'label' => 'Our Mission Text',
                'description' => 'The text shown in the "Our mission" section of the home page.',
                'slug' => 'mission-text',
                'type' => 'text',
                'value' => '"At CrunchyCravings, our mission is to bring people together through the joy of premium Lavosh crackers. We believe in crafting high-quality, delicious products that elevate every occasion, from casual gatherings to grand celebration"',
            ],
            [
                'parent' => 'home',
                'label' => 'Our Mission Image',
                'description' => 'The image shown in the "Our mission" section of the home page.',
                'slug' => 'mission-image',
                'type' => 'image',
                'value' => 'Mission.png',
            ],
        ];

        $table = $this->table('content_blocks');
        $table->insert($data)->save();
    }
}
