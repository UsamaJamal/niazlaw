<?php

namespace Database\Seeders;

use App\Models\Capability;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdditionalCapabilitySeeder extends Seeder
{
    public function run(): void
    {
        $capabilities = [
            [
                'title' => 'Commercial Transactions & Contract Negotiation',
                'description' => 'Strategic counsel for commercial agreements, negotiations, and transactions that protect business objectives and support durable relationships.',
                'image' => 'images/capability-commercial-transactions-contract-negotiation.png',
                'overview_heading' => 'Commercial Agreements Built for Business',
                'overview_paragraph_one' => 'We advise businesses through the full lifecycle of commercial transactions, from planning and negotiation through drafting, execution, and ongoing contract management. Our advice is practical, commercially focused, and tailored to the objectives, leverage, and risk profile of each transaction.',
                'overview_paragraph_two' => 'Whether the matter involves a strategic partnership, supply arrangement, technology agreement, services contract, or a complex cross-border transaction, we help clients reach clear terms that allocate risk appropriately and support long-term value.',
                'experience' => "Contract Strategy — Assessing commercial objectives, leverage, and key legal risks before negotiations begin.\nDrafting & Negotiation — Preparing and negotiating tailored agreements that reflect the agreed commercial deal.\nStrategic Transactions — Advising on joint ventures, distribution arrangements, supply agreements, and other business-critical relationships.\nContract Governance — Creating practical approval, renewal, and compliance processes for contract portfolios.",
                'representative_matters' => "Advised a growth-stage company on the negotiation of a multi-year enterprise services agreement.\nDrafted and negotiated supply and distribution arrangements for an expanding consumer business.\nSupported a technology company in structuring a strategic commercial partnership.\nReviewed and streamlined a client's recurring customer and vendor contract templates.",
            ],
            [
                'title' => 'Contractual Disputes & Risk Management',
                'description' => 'Clear, commercial advice for preventing, managing, and resolving contract disputes while protecting business relationships and operations.',
                'image' => 'images/capability-contractual-disputes-risk-management.png',
                'overview_heading' => 'Practical Contract Risk Management',
                'overview_paragraph_one' => 'Contract disputes can disrupt operations, strain important relationships, and create substantial cost. We help clients identify issues early, evaluate available remedies, and choose a proportionate path forward—whether that involves negotiation, formal dispute resolution, or a carefully managed commercial exit.',
                'overview_paragraph_two' => 'Our work also focuses on prevention. We assess contract language, performance obligations, notices, and governance processes to reduce the likelihood of disputes and give decision-makers a clearer understanding of their options when issues arise.',
                'experience' => "Risk Assessment — Identifying contractual exposure, evidentiary issues, and practical options at an early stage.\nDispute Strategy — Developing proportionate negotiation, mediation, arbitration, or litigation strategies.\nNotice & Remedy Management — Preparing contractual notices and managing cure, termination, and escalation processes.\nPreventive Reviews — Improving templates and contract controls to reduce recurring risk.",
                'representative_matters' => "Advised a commercial client on its options following repeated supplier performance failures.\nNegotiated a resolution to a disputed services agreement while preserving the commercial relationship.\nReviewed termination and notice rights for a client exiting a long-term vendor arrangement.\nDeveloped a contract-risk review process for a business with a high-volume agreement portfolio.",
            ],
            [
                'title' => 'Outside General Counsel Services',
                'description' => 'Ongoing, business-minded legal support for companies that need a trusted legal partner without a full-time in-house team.',
                'image' => 'images/capability-outside-general-counsel-services.png',
                'overview_heading' => 'Your Flexible Legal Partner',
                'overview_paragraph_one' => 'Our outside general counsel service gives leadership teams reliable access to practical legal advice across their day-to-day commercial and operational needs. We act as an extension of the business, learning its priorities, risk tolerance, and decision-making processes so advice is timely and useful.',
                'overview_paragraph_two' => 'From contracts and corporate governance to employment, vendor matters, and strategic initiatives, we coordinate legal work efficiently and bring in specialist support when a matter requires it. The result is flexible coverage that grows with the business.',
                'experience' => "Day-to-Day Counsel — Responsive advice on commercial, corporate, and operational legal questions.\nContract Oversight — Reviewing key agreements and supporting negotiation with customers, vendors, and partners.\nGovernance Support — Assisting with board matters, entity maintenance, policies, and internal approvals.\nStrategic Planning — Providing legal input on growth initiatives, new products, and changing business risks.",
                'representative_matters' => "Served as trusted ongoing counsel to a founder-led company managing a growing contract portfolio.\nAdvised leadership on governance and commercial issues during a period of rapid expansion.\nSupported a client with vendor, customer, and employment-related legal questions on an ongoing basis.\nCreated a legal-priorities roadmap for a business transitioning from outsourced to more structured legal support.",
            ],
        ];

        foreach ($capabilities as $item) {
            Capability::updateOrCreate(
                ['title' => $item['title']],
                [
                    'slug' => Str::slug($item['title']),
                    'description' => $item['description'],
                    'page_title' => $item['title'],
                    'page_description' => $item['description'],
                    'image' => $item['image'],
                    'hero_image' => $item['image'],
                    'overview_heading' => $item['overview_heading'],
                    'overview_paragraph_one' => $item['overview_paragraph_one'],
                    'overview_paragraph_two' => $item['overview_paragraph_two'],
                    'experience' => $item['experience'],
                    'representative_matters' => $item['representative_matters'],
                ]
            );
        }
    }
}
