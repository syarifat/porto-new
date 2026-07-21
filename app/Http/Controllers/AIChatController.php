<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'history' => 'nullable|array',
        ]);

        $userMessage = trim($request->input('message'));
        $history = $request->input('history', []);

        $apiKey = env('GROQ_API_KEY');

        if (!$apiKey) {
            return response()->json([
                'error' => 'API Key Groq belum dikonfigurasi di server.'
            ], 500);
        }

        // Fetch dynamic context from Database
        $projects = Project::orderBy('start_date', 'desc')->get();
        $certificates = Certificate::orderBy('issued_date', 'desc')->get();

        $projectList = $projects->map(function ($p) {
            $dateRange = $p->start_date ? $p->start_date->format('M Y') : '';
            if ($p->end_date) {
                $dateRange .= ' s/d ' . $p->end_date->format('M Y');
            } else {
                $dateRange .= ' s/d Sekarang';
            }
            $partner = $p->partner_name ? " (Mitra: {$p->partner_name})" : "";
            return "- {$p->title} [{$dateRange}]{$partner}: {$p->description}";
        })->implode("\n");

        $certList = $certificates->map(function ($c) {
            $issuer = $c->issued_by ? " oleh {$c->issued_by}" : "";
            return "- {$c->title}{$issuer}";
        })->implode("\n");

        $systemPrompt = <<<PROMPT
Kamu adalah "SAT Assistant", AI Asisten pribadi resmi untuk portofolio interaktif Syarif Ahsani Taqwim.
Tugasmu adalah menjawab pertanyaan pengunjung website portofolio dengan sopan, ramah, profesional, ringkas, dan jelas dalam Bahasa Indonesia.

BIODATA SYARIF AHSANI TAQWIM:
- Nama Lengkap: Syarif Ahsani Taqwim (biasa dipanggil Syarif)
- Peran: Full-Stack Developer, IoT Engineer, dan IT Infrastructure & DevOps Specialist
- Jabatan: Founder SAT Project
- Lokasi: Tulungagung, Jawa Timur
- Kontak WhatsApp / HP: +62 878-4294-9212
- Email: syarifahsanit@gmail.com
- Instagram: @syariif.at

AREA KEAHLIAN / KOMPETENSI:
1. Software & Mobile Development: PHP (Laravel), JavaScript, HTML/CSS, Mobile Development (Android/iOS), MySQL, Cloudflare D1/R2.
2. Internet of Things (IoT): Perancangan hardware cerdas ESP32, ESP8266, Arduino. Integrasi sensor (RFID, Ultrasonik, GPS NEO-6M, Load Cell HX711) ke dashboard web real-time.
3. Infrastructure & DevOps: SysAdmin Linux, Docker, Vercel, Cloudflare, Home Server & STB Modding (Armbian, STB HG680P, B860H).
4. Enterprise Networking: Cisco, MikroTik, DHCP/DNS/Firewall, VoIP, CCTV Integration.

DAFTAR PROYEK TERLAKSANA:
{$projectList}

DAFTAR SERTIFIKAT:
{$certList}

PANDUAN MENJAWAB:
- Jawablah menggunakan bahasa Indonesia yang ramah, sopan, dan jelas.
- Jawab secara ringkas dan langsung pada poinnya (hindari paragraf yang terlalu panjang).
- Jangan membuat informasi palsu di luar data di atas. Jika ditanya sesuatu yang tidak diketahui, tawarkan untuk menghubungi Syarif langsung via WhatsApp (+62 878-4294-9212) atau Email.
- Jika pengguna ingin berkonsultasi atau menyewa jasa, berikan kontak WhatsApp atau Email Syarif.
PROMPT;

        // Build messages array
        $messages = [
            ['role' => 'system', 'content' => $systemPrompt]
        ];

        // Append past history (up to last 6 messages)
        if (is_array($history)) {
            $recentHistory = array_slice($history, -6);
            foreach ($recentHistory as $msg) {
                if (isset($msg['role'], $msg['content']) && in_array($msg['role'], ['user', 'assistant'])) {
                    $messages[] = [
                        'role' => $msg['role'],
                        'content' => (string) $msg['content']
                    ];
                }
            }
        }

        // Add latest message
        $messages[] = ['role' => 'user', 'content' => $userMessage];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type'  => 'application/json',
            ])->timeout(20)->post('https://api.groq.com/openai/v1/chat/completions', [
                'model'       => 'llama-3.3-70b-versatile',
                'messages'    => $messages,
                'temperature' => 0.6,
                'max_tokens'  => 500,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['choices'][0]['message']['content'] ?? 'Maaf, saya tidak dapat memproses jawaban saat ini.';

                return response()->json([
                    'success' => true,
                    'reply'   => $reply
                ]);
            }

            Log::error('Groq API Error: ' . $response->body());
            return response()->json([
                'success' => false,
                'error'   => 'Gagal mendapat respons dari AI. Silakan coba beberapa saat lagi.'
            ], 500);

        } catch (\Exception $e) {
            Log::error('AIChat Exception: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error'   => 'Terjadi kesalahan koneksi ke layanan AI.'
            ], 500);
        }
    }
}
