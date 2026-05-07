<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('heroes')->insert([
            ['tag' => 'Award Winning Photography', 'title' => 'Where Love|Becomes Art', 'subtitle' => 'Timeless moments · Genuine emotion · Eternal memories', 'bg' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=1800&q=80', 'btn1' => 'Discover More', 'btn2' => 'Book Session'],
            ['tag' => 'Luxury Wedding Photography', 'title' => 'Every Frame|Tells a Story', 'subtitle' => 'Capturing the in-between · The laughs · The tears', 'bg' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=1800&q=80', 'btn1' => 'View Gallery', 'btn2' => 'Book Session'],
            ['tag' => 'Your Day · Your Story', 'title' => 'Begin Your|Forever Here', 'subtitle' => 'Photography & Cinematography for discerning couples', 'bg' => 'https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=1800&q=80', 'btn1' => 'See Packages', 'btn2' => 'Book Session'],
        ]);

        DB::table('projects')->insert([
            ['couple' => 'Sofia & Marcus', 'location' => 'Amalfi Coast, Italy', 'season' => 'Summer 2024', 'img' => 'https://images.unsplash.com/photo-1550005809-91ad75fb315f?w=900&q=80', 'size' => 'lg'],
            ['couple' => 'Amara & James', 'location' => 'Santorini, Greece', 'season' => 'Spring 2024', 'img' => 'https://images.unsplash.com/photo-1591604466107-ec97de577aff?w=900&q=80', 'size' => 'sm'],
            ['couple' => 'Chloe & Rafael', 'location' => 'Tuscany, Italy', 'season' => 'Autumn 2023', 'img' => 'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=900&q=80', 'size' => 'sm'],
        ]);

        DB::table('galleries')->insert([
            ['img' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=900&q=80', 'alt' => 'Gallery 1', 'title' => 'Sacred Vows', 'category' => 'ceremony', 'tag' => 'Ceremony', 'order' => 1],
            ['img' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=600&q=80', 'alt' => 'Gallery 2', 'title' => 'Golden Hour Kiss', 'category' => 'portrait', 'tag' => 'Portraits', 'order' => 2],
            ['img' => 'https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=600&q=80', 'alt' => 'Gallery 3', 'title' => 'Bridal Radiance', 'category' => 'bridal', 'tag' => 'Bridal', 'order' => 3],
            ['img' => 'https://images.unsplash.com/photo-1460978812857-470ed1c77af0?w=900&q=80', 'alt' => 'Gallery 4', 'title' => 'First Dance', 'category' => 'reception', 'tag' => 'Reception', 'order' => 4],
            ['img' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=600&q=80', 'alt' => 'Gallery 5', 'title' => 'Floral Elegance', 'category' => 'details', 'tag' => 'Details', 'order' => 5],
            ['img' => 'https://images.unsplash.com/photo-1537633552985-df8429e8048b?w=900&q=80', 'alt' => 'Gallery 6', 'title' => 'Forever Begins', 'category' => 'portrait', 'tag' => 'Portraits', 'order' => 6],
            ['img' => 'https://images.unsplash.com/photo-1550005809-91ad75fb315f?w=900&q=80', 'alt' => 'Gallery 7', 'title' => 'Walking the Aisle', 'category' => 'ceremony', 'tag' => 'Ceremony', 'order' => 7],
            ['img' => 'https://images.unsplash.com/photo-1591604466107-ec97de577aff?w=900&q=80', 'alt' => 'Gallery 8', 'title' => 'Candid Joy', 'category' => 'reception', 'tag' => 'Reception', 'order' => 8],
            ['img' => 'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=900&q=80', 'alt' => 'Gallery 9', 'title' => 'Veil of Dreams', 'category' => 'bridal', 'tag' => 'Bridal', 'order' => 9],
            ['img' => 'https://images.unsplash.com/photo-1561486462-89834a03cb72?w=900&q=80', 'alt' => 'Gallery 10', 'title' => 'Ring Ceremony', 'category' => 'details', 'tag' => 'Details', 'order' => 10],
            ['img' => 'https://images.unsplash.com/photo-1543736959-29af8bb44c91?w=900&q=80', 'alt' => 'Gallery 11', 'title' => 'Intimate Moment', 'category' => 'portrait', 'tag' => 'Portraits', 'order' => 11],
            ['img' => 'https://images.unsplash.com/photo-1550005809-91ad75fb315f?w=600&q=80', 'alt' => 'Gallery 12', 'title' => 'Altar Kiss', 'category' => 'ceremony', 'tag' => 'Ceremony', 'order' => 12],
        ]);

        DB::table('packages')->insert([
            ['name' => 'Essence', 'price' => 1800, 'featured' => false, 'badge' => '', 'features' => "6 Hours Coverage\n1 Photographer\n300+ Edited Photos\nOnline Gallery\nUSB Delivery\n-Engagement Session\n-Wedding Film"],
            ['name' => 'Lumière', 'price' => 3200, 'featured' => true, 'badge' => 'Most Popular', 'features' => "Full Day (10 hrs)\n2 Photographers\n600+ Edited Photos\nPrivate Gallery\nFine Art Album\nEngagement Session\n-Wedding Film"],
            ['name' => 'Forever', 'price' => 5500, 'featured' => false, 'badge' => '', 'features' => "Full Day + Rehearsal\n2 Photographers + Videographer\nUnlimited Edited Photos\nPrivate Gallery\nLuxury Heirloom Album\nEngagement Session\nCinematic Wedding Film"],
        ]);

        DB::table('testimonials')->insert([
            ['couple' => 'Sofia & Marcus', 'location' => 'Amalfi Coast 2024', 'rating' => 5, 'quote' => 'They captured moments we didn\'t even know were happening. Every photo made us cry happy tears. Worth every penny and more.'],
            ['couple' => 'Amara & James', 'location' => 'Santorini 2024', 'rating' => 5, 'quote' => 'From first consultation to delivery, the experience was flawless. The photos look like scenes from a movie. We are in love with every frame.'],
            ['couple' => 'Chloe & Rafael', 'location' => 'Tuscany 2023', 'rating' => 5, 'quote' => 'The most talented photographers we\'ve encountered. They made us feel at ease and the results are absolutely breathtaking.'],
        ]);

        DB::table('inquiries')->insert([
            ['name' => 'Elena', 'partner' => 'David', 'email' => 'elena@example.com', 'phone' => '+1 555-0101', 'date' => '2025-06-15', 'package' => 'Lumière – $3,200', 'venue' => 'Central Park', 'message' => 'We are so excited!', 'status' => 'pending'],
        ]);

        DB::table('contacts')->insert([
            ['name' => 'John Doe', 'email' => 'john@test.com', 'subject' => 'Availability', 'message' => 'Are you available for Dec 2025?', 'status' => 'pending'],
        ]);

        // Default Site Settings
        DB::table('settings')->insert([
            ['key' => 'siteName', 'value' => 'Chitraloy - চিত্রালয়'],
            ['key' => 'siteEmail', 'value' => 'hello@chittraloy.com'],
            ['key' => 'ctaTag', 'value' => 'Let\'s Begin'],
            ['key' => 'ctaTitle', 'value' => 'Your Story Deserves to be Remembered'],
            ['key' => 'ctaSub', 'value' => 'Limited dates available for 2025. Secure yours today.'],
            ['key' => 'socialIg', 'value' => ''],
            ['key' => 'socialPi', 'value' => ''],
            ['key' => 'socialFb', 'value' => ''],
            ['key' => 'socialYt', 'value' => ''],
            ['key' => 'footerTagline', 'value' => 'Luxury wedding photography for couples who believe their story is worth telling beautifully.'],
            ['key' => 'footerLocations', 'value' => 'New York · Paris · Amalfi · Worldwide'],
            ['key' => 'footerCopy', 'value' => '© 2025 Chitraloy - চিত্রালয় Photography. All rights reserved.'],
            // About Section Data
            ['key' => 'aboutTag', 'value' => 'Our Story'],
            ['key' => 'aboutYears', 'value' => '12'],
            ['key' => 'aboutTitle', 'value' => 'We Don\'t Just Take Photos,<br>We <em>Craft</em> Moments'],
            ['key' => 'aboutDesc1', 'value' => 'At Chitraloy - চিত্রালয়, we believe every wedding is a unique universe of emotion. We immerse ourselves in your story — the stolen glances, the happy tears, the quiet moments between — and transform them into photographs you\'ll treasure for generations.'],
            ['key' => 'aboutDesc2', 'value' => 'Based in New York, we travel worldwide for couples who deserve nothing less than extraordinary.'],
            ['key' => 'aboutStat1Val', 'value' => '850+'],
            ['key' => 'aboutStat1Lbl', 'value' => 'Weddings Captured'],
            ['key' => 'aboutStat2Val', 'value' => '42+'],
            ['key' => 'aboutStat2Lbl', 'value' => 'Countries Visited'],
            ['key' => 'aboutStat3Val', 'value' => '98%'],
            ['key' => 'aboutStat3Lbl', 'value' => 'Happy Couples'],
            ['key' => 'aboutImg1', 'value' => 'https://images.unsplash.com/photo-1537633552985-df8429e8048b?w=900&q=80'],
            ['key' => 'aboutImg2', 'value' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=400&q=80'],
            // Video Section Data
            ['key' => 'videoCover', 'value' => 'https://images.unsplash.com/photo-1561486462-89834a03cb72?w=1800&q=80'],
            ['key' => 'videoUrl', 'value' => 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1'],
            ['key' => 'videoTitle', 'value' => 'Feel the Story'],
            ['key' => 'videoSub', 'value' => 'Watch our cinematic wedding films'],
        ]);
    }
}
