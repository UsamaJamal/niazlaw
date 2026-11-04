<?php

namespace Database\Seeders;

use App\Models\CareerOpening;
use App\Models\CareerSetting;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    public function run()
    {
        CareerSetting::updateOrCreate(['id' => 1], [
            'attorney_overview' => 'At Niaz Law P.C., attorneys work on meaningful legal matters with direct client contact, practical responsibility and the support of an experienced, collaborative team. We value sound judgment, curiosity and a commitment to delivering clear, commercially minded counsel.',
            'attorney_advancement' => 'We invest in the professional growth of our attorneys through mentorship, hands-on experience and opportunities to take ownership of complex work. You will build relationships, deepen your expertise and shape a practice that reflects your strengths and ambitions.',
            'staff_overview' => 'Our professional staff makes an essential difference in every client experience. We are looking for organised, service-minded people who enjoy working closely with colleagues, solving problems and helping a high-performing legal team succeed.',
            'staff_advancement' => 'Niaz Law P.C. offers a supportive environment for professional growth. Team members are trusted with meaningful work, encouraged to develop new skills and recognised for the contribution they make to our clients and the firm.',
            'application_email' => config('services.contact_inquiries.recipient'),
        ]);

        $openings = [
            ['track' => 'attorneys', 'title' => 'Associate Attorney', 'location' => 'Franklin Park, IL · Full-time'],
            ['track' => 'attorneys', 'title' => 'Of Counsel', 'location' => 'Illinois · Flexible arrangement'],
            ['track' => 'professional-staff', 'title' => 'Legal Assistant', 'location' => 'Franklin Park, IL · Full-time'],
            ['track' => 'professional-staff', 'title' => 'Client Services Coordinator', 'location' => 'Lisle, IL · Full-time'],
        ];

        foreach ($openings as $opening) {
            CareerOpening::updateOrCreate(
                ['track' => $opening['track'], 'title' => $opening['title']],
                $opening + ['active' => true]
            );
        }
    }
}
