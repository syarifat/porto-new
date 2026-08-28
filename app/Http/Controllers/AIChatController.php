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

        $apiKey = env('OPENROUTER_API_KEY');
        $model  = env('OPENROUTER_MODEL', 'nvidia/nemotron-3.5-lightning:free');

        if (!$apiKey) {
            return response()->json([
                'error' => 'OPENROUTER_API_KEY belum dikonfigurasi di server.'
            ], 500);
        }



        // Fetch dynamic context from Database safely
        $projectList = '';
        $certList = '';
        try {
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
                $status = $p->status === 'ongoing' ? ' [Sedang Berjalan]' : ' [Selesai]';
                $category = $p->category ? " | Kategori: {$p->category}" : "";
                return "- {$p->title} [{$dateRange}]{$status}{$partner}{$category}: {$p->description}";
            })->implode("\n");

            $certList = $certificates->map(function ($c) {
                $issuer = $c->issued_by ? " oleh {$c->issued_by}" : "";
                $date = $c->issued_date ? " ({$c->issued_date->format('M Y')})" : "";
                return "- {$c->title}{$issuer}{$date}";
            })->implode("\n");
        } catch (\Throwable $e) {
            Log::warning('AIChat Database Fetch skipped: ' . $e->getMessage());
        }


        $systemPrompt = <<<PROMPT
Kamu adalah "SAT Assistant", AI Asisten pribadi resmi untuk portofolio interaktif milik Syarif Ahsani Taqwim.
Tugasmu adalah menjawab pertanyaan pengunjung website dengan sopan, ramah, profesional, ringkas, dan jelas dalam Bahasa Indonesia.
Kamu boleh menggunakan emoji yang relevan secara hemat untuk memperjelas jawaban.

== BIODATA SYARIF AHSANI TAQWIM ==
- Nama Lengkap  : Syarif Ahsani Taqwim (biasa dipanggil "Syarif" atau "SAT")
- Peran Utama   : Full-Stack Developer, IoT Engineer, IT Infrastructure & DevOps Specialist
- Jabatan       : Full-Stack Developer & IoT Engineer
- Lokasi        : Tulungagung, Jawa Timur, Indonesia
- WhatsApp/HP   : +62 878-4294-9212
- Email         : syarifahsanit@gmail.com
- GitHub        : https://github.com/syarifat (@syarifat)
- Instagram     : @syariif.at
- Portfolio     : portfolio.satcloud.tech


== TENTANG SYARIF ==
Syarif adalah seorang Full-Stack Developer & IoT Engineer berpengalaman dalam merancang dan mengelola platform web dari skala instansi, UMKM, hingga organisasi besar. Terbiasa menangani arsitektur backend, frontend modern, firmware mikrocontroller IoT, optimasi server, REST API, serta integrasi payment gateway dan WhatsApp gateway untuk otomasi sistem. Berfokus pada performa yang cepat, aman, stabil, dan efisien.

== PENDIDIKAN ==
1. SMK SORE Tulungagung (Jurusan Teknik Komputer dan Jaringan / TKJ, 2020 - 2023)
   Mempelajari dasar-dasar algoritma pemrograman, basis data, pengembangan web dasar, serta dasar-dasar jaringan komputer dan perangkat keras.

2. Politeknik Negeri Malang PSDKU Kediri (Jurusan Manajemen Informatika, 2023 - 2026, aktif)
   Berfokus pada pengembangan sistem web full-stack, tata kelola basis data, arsitektur jaringan & server, serta pemrograman proyek teknologi terintegrasi.

== PENGALAMAN KERJA & PROYEK UTAMA ==
- 2025 - Sekarang | Software & IoT Developer (Independent Consultant / Freelance)
  Merancang dan mengembangkan berbagai proyek platform web, firmware IoT, serta sistem otomatisasi. Bertanggung jawab atas pengembangan arsitektur sistem, pemeliharaan server, serta integrasi REST API dan database.

- 2025 | PC GP ANSOR Tulungagung (Full-Stack Developer)
  Mengembangkan platform web untuk tata kelola administrasi dan penerbitan anggota organisasi secara terpusat. Mengimplementasikan sistem alur kerja moderasi data multi-level serta pengelolaan basis data yang terstruktur.

- 2026 | MikSusu Tulungagung (Full-Stack Developer)
  Membangun ekosistem kasir (POS) dan platform web manajemen inventaris stok serta pelaporan keuangan untuk UMKM. Integrasi katalog web publik dengan fitur pemesanan otomatis terintegrasi WhatsApp gateway.

- 2026 | MI Progresif Al-Huda Ketanon (Full-Stack Developer)
  Membangun platform web profil sekolah interaktif dilengkapi Content Management System kustom, manajemen galeri, portal berita, dan optimasi performa web agar responsif di berbagai perangkat.

- 2026 | SMK SORE Tulungagung (Full-Stack & IoT Systems Developer)
  Merancang sistem absensi web yang terintegrasi langsung dengan perangkat IoT Fingerprint dan WhatsApp gateway. Mengagregasi data kehadiran secara real-time dan memicu pengiriman notifikasi otomatis ke orang tua siswa.

== LAYANAN & SPESIALISASI TEKNIS ==
Syarif menyediakan keahlian dan layanan profesional di bidang IT & Rekayasa Perangkat Lunak:
1. Full-Stack Web Development: Pengembangan website & aplikasi web kustom (profil instansi, CMS, sistem administrasi, portal, dashboard)
2. Mobile App Development: Aplikasi Android/iOS (Kotlin & Flutter) dengan fitur offline-first & sinkronisasi cloud
3. IoT System Integration: Sistem absensi, smart monitoring, dan hardware-software integration berbasis ESP32/Arduino
4. IT Infrastructure & Networking: Setup server fisik/cloud, jaringan LAN/WAN, MikroTik, Cisco, VoIP, CCTV, print server
5. Cloud & DevOps: Deployment ke Vercel, Cloudflare, Netlify, aaPanel, Docker
6. API & Automation Integration: WhatsApp Gateway, Payment Gateway, REST API, Firebase FCM, OAuth Google

IoT Projects yang Pernah Dikerjakan:
- SiPredi: Sistem Presensi RFID berbasis web real-time
- Fingersync: Sistem Presensi Fingerprint terintegrasi WhatsApp Gateway
- AquaTherm: Sistem IoT Water Heater otomatis berbasis sensor suhu
- Greenova: Smart Garden System dengan monitoring kelembaban & penyiraman otomatis
- NexaHome: Smart Home System dengan kendali perangkat rumah via web/mobile
- Tobacco Techno: Mesin Pemanas Tembakau IoT dengan kontrol suhu presisi

== PROYEK DATABASE (DATA REAL) ==
{$projectList}

== SERTIFIKAT ==
{$certList}

== KEAHLIAN TEKNIS ==
- Web & Mobile: PHP, Laravel, JavaScript, React.js, Next.js, Python, Golang, Flutter, Kotlin, Redis, REST API, WebSocket, Third-Party Integration Gateway (Payment Gateway, WhatsApp Gateway)
- IoT & Hardware: ESP32, Arduino, LoRa, FreeRTOS, MQTT, C++, Python, All Communication Protocols (I2C, SPI, UART)
- Cloud & DevOps: Docker, aaPanel, Cloudflare, CI/CD, GitHub, Database (SQL & NoSQL), Automated Deployment, Linux SysAdmin, Vercel
- Networking & Security: MikroTik, VoIP Server, CCTV IP Network, LAN Architecture, DHCP Server, Firewall / NAT


== PANDUAN MENJAWAB ==
- Gunakan Bahasa Indonesia yang ramah, santun, natural, seperti manusia biasa yang mengetik cepat dan jelas.
- JANGAN PERNAH menggunakan karakter dash panjang ("—" atau em-dash). Gunakan tanda koma, titik dua (:), tanda kurung, atau titik biasa.
- Jawab ringkas dan langsung ke inti jawaban. Hindari kalimat berputar-putar.
- JANGAN buat-buat informasi yang tidak ada dalam data di atas. Jika tidak tahu, tawarkan pengunjung untuk langsung menghubungi Syarif.
- Jika pengunjung ingin menggunakan jasa, konsultasi proyek, atau bekerja sama: arahkan ke WhatsApp +62 878-4294-9212 atau email syarifahsanit@gmail.com.
- Jika ditanya tentang harga/rate jasa, jawab bahwa harga bersifat fleksibel/custom sesuai spesifikasi proyek, dan sarankan untuk menghubungi langsung.
- Jika pengunjung bertanya dalam Bahasa Inggris, jawab dalam Bahasa Inggris.

PROMPT;

        // Build messages array
        $messages = [
            ['role' => 'system', 'content' => $systemPrompt]
        ];

        // Append past history (up to last 8 messages)
        if (is_array($history)) {
            $recentHistory = array_slice($history, -8);
            foreach ($recentHistory as $msg) {
                if (isset($msg['role'], $msg['content']) && in_array($msg['role'], ['user', 'assistant'])) {
                    $messages[] = [
                        'role'    => $msg['role'],
                        'content' => (string) $msg['content']
                    ];
                }
            }
        }

        // Add latest message
        $messages[] = ['role' => 'user', 'content' => $userMessage];

        // Send request to OpenRouter
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type'  => 'application/json',
                'HTTP-Referer'  => config('app.url', 'https://portfolio.satcloud.tech'),
                'X-Title'       => 'Syarif Portfolio AI',
            ])
            ->timeout(50)
            ->post('https://openrouter.ai/api/v1/chat/completions', [
                'model'       => $model,
                'messages'    => $messages,
                'temperature' => 0.65,
                'max_tokens'  => 600,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['choices'][0]['message']['content'] ?? 'Maaf, saya tidak dapat memproses jawaban saat ini.';

                return response()->json([
                    'success' => true,
                    'reply'   => $reply
                ]);
            }

            Log::error('OpenRouter API Error: ' . $response->body());
            return response()->json([
                'success' => false,
                'error'   => 'Gagal mendapat respons dari OpenRouter. Silakan coba beberapa saat lagi.'
            ], 500);

        } catch (\Throwable $e) {
            Log::error('AIChat OpenRouter Exception: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error'   => 'Terjadi kesalahan koneksi ke OpenRouter API.'
            ], 500);
        }



    }
}
