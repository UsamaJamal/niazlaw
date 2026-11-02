<?php
namespace App\Http\Controllers;
use App\Models\Attorney;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
class AttorneyDetailController extends Controller
{
    public function show(Attorney $attorney)
    {
        return view('attorney-detail', compact('attorney') + [
            'attorneyPosts' => $attorney->blogPosts()->where('status', 'published')->where(function ($q) {
                $q->whereNull('published_at')->orWhereDate('published_at', '<=', Carbon::today());
            })->latest()->get(),
        ]);
    }

    public function vcard(Attorney $attorney)
    {
        $escape = static fn ($value) => str_replace(['\\', ';', ',', "\r", "\n"], ['\\\\', '\\;', '\\,', '', '\\n'], (string) $value);
        $card = [
            'BEGIN:VCARD',
            'VERSION:3.0',
            'FN:' . $escape($attorney->name),
            'ORG:Niaz Law P.C.',
            'TITLE:' . $escape($attorney->title),
            'TEL;TYPE=WORK,VOICE:' . $escape($attorney->phone),
            'EMAIL;TYPE=INTERNET,WORK:' . $escape($attorney->email),
            'ADR;TYPE=WORK:;;' . $escape($attorney->location),
            $attorney->linkedin_url ? 'URL;TYPE=LinkedIn:' . $escape($attorney->linkedin_url) : null,
            $attorney->linkedin_url ? 'X-SOCIALPROFILE;TYPE=linkedin:' . $escape($attorney->linkedin_url) : null,
            'URL:' . route('attorneys.detail', $attorney),
            'END:VCARD',
            '',
        ];

        return response(implode("\r\n", array_filter($card, static fn ($line) => $line !== null)), 200, [
            'Content-Type' => 'text/vcard; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $attorney->slug . '.vcf"',
        ]);
    }

    public function pdf(Attorney $attorney)
    {
        $lines = [
            ['NIAZ LAW P.C.', 22],
            ['', 12],
            [$attorney->name, 20],
            [$attorney->title, 13],
            ['', 12],
            ['Phone: ' . $attorney->phone, 12],
            ['Email: ' . $attorney->email, 12],
            ['Location: ' . $attorney->location, 12],
            ['', 12],
            ['Overview', 15],
            [Str::limit($attorney->overview ?: 'Attorney profile information is available at Niaz Law P.C.', 620), 11],
        ];

        $pdf = $this->makeSimplePdf($lines);

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $attorney->slug . '-profile.pdf"',
        ]);
    }

    private function makeSimplePdf(array $lines): string
    {
        $content = "BT\n";
        $y = 760;
        foreach ($lines as [$line, $size]) {
            $wrappedLines = $line === '' ? [''] : explode("\n", wordwrap($line, $size > 15 ? 52 : 82));
            foreach ($wrappedLines as $wrappedLine) {
                $text = $this->pdfEscape($wrappedLine);
                $content .= sprintf("/F1 %d Tf\n1 0 0 1 72 %d Tm\n(%s) Tj\n", $size, $y, $text);
                $y -= $size > 15 ? 34 : 21;
            }
        }
        $content .= "ET\n";

        $objects = [
            '<< /Type /Catalog /Pages 2 0 R >>',
            '<< /Type /Pages /Kids [3 0 R] /Count 1 >>',
            '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Resources << /Font << /F1 5 0 R >> >> /Contents 4 0 R >>',
            '<< /Length ' . strlen($content) . " >>\nstream\n" . $content . 'endstream',
            '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>',
        ];

        $pdf = "%PDF-1.4\n";
        $offsets = [0];
        foreach ($objects as $index => $object) {
            $offsets[] = strlen($pdf);
            $pdf .= ($index + 1) . " 0 obj\n" . $object . "\nendobj\n";
        }
        $xref = strlen($pdf);
        $pdf .= "xref\n0 " . (count($objects) + 1) . "\n0000000000 65535 f \n";
        foreach (array_slice($offsets, 1) as $offset) {
            $pdf .= sprintf("%010d 00000 n \n", $offset);
        }
        $pdf .= "trailer\n<< /Size " . (count($objects) + 1) . " /Root 1 0 R >>\nstartxref\n" . $xref . "\n%%EOF";

        return $pdf;
    }

    private function pdfEscape(string $value): string
    {
        $value = iconv('UTF-8', 'Windows-1252//TRANSLIT//IGNORE', $value) ?: $value;
        return str_replace(['\\', '(', ')', "\r", "\n"], ['\\\\', '\\(', '\\)', '', ' '], $value);
    }
}
