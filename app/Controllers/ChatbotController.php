<!-- <?php

namespace App\Controllers;

use App\Models\FacilityModel;

class ChatbotController extends BaseController
{
    /**
     * Method ini menangani request POST dari widget chat.
     * Alurnya: terima pertanyaan user -> ambil data fasilitas terbaru dari
     * database -> gabungkan jadi "system prompt" -> kirim ke Groq API ->
     * kembalikan jawaban AI dalam format JSON ke widget chat.
     */
    public function ask()
    {
//Ambil pertanyaan yang dikirim user dari widget chat (format JSON)
        $input = $this->request->getJSON(true);
        $userMessage = $input['message'] ?? '';

        if (trim($userMessage) === '') {
            return $this->response->setJSON([
                'reply' => 'Pertanyaan tidak boleh kosong.'
            ]);
        }

// Ambil data fasilitas TERBARU dari database (bukan hardcode),
// supaya jawaban chatbot selalu sesuai kondisi asli sistem.
// Ini bagian "Retrieval" dari pola RAG (Retrieval-Augmented Generation).
        $facilityModel = new FacilityModel();
        $facilities = $facilityModel->findAll();

// Susun data fasilitas jadi teks ringkas yang gampang dibaca AI.
// Contoh hasil: "- Putra-04 (Kamar Putra): Rp150.000, status: available"
        $facilityText = '';
        foreach ($facilities as $f) {
            $facilityText .= "- {$f['facility_name']} ({$f['category']}): "
                . "Rp" . number_format($f['price'], 0, ',', '.')
                . ", status: {$f['status']}\n";
        }

// Susun system prompt: instruksi + data asli yang harus dipatuhi AI.
// Ini "pagar" supaya AI tidak mengarang jawaban (halusinasi) dan
// tetap fokus membahas topik asrama saja.
// Ambil nomor kontak pengurus dari .env, biar gampang diganti tanpa edit kode
$contactPhone = getenv('CONTACT_PHONE');

$systemPrompt = "Kamu adalah asisten virtual Sistem Reservasi Asrama Natuna. "
    . "Jawab pertanyaan pengguna HANYA berdasarkan data fasilitas berikut, "
    . "jangan mengarang data di luar ini:\n\n"
    . $facilityText
    . "\nNomor kontak pengurus asrama untuk pertanyaan lebih lanjut: {$contactPhone}\n"
    . "Berikan nomor kontak tersebut HANYA jika: (1) pengguna secara eksplisit meminta "
    . "nomor telepon/kontak/WhatsApp pengurus, atau (2) pertanyaan pengguna tidak dapat "
    . "dijawab dari data fasilitas di atas (misalnya negosiasi khusus, komplain, jadwal "
    . "kunjungan langsung, atau pertanyaan detail lain yang butuh konfirmasi manusia). "
    . "Jangan sebutkan nomor kontak untuk pertanyaan yang sudah terjawab dari data fasilitas. "
    . "Jika pertanyaan di luar topik asrama sama sekali (bukan soal fasilitas maupun kontak), "
    . "katakan dengan sopan bahwa kamu hanya bisa membantu seputar reservasi asrama. "
    . "Jawab singkat, maksimal 3 kalimat, dalam Bahasa Indonesia.";

// Kirim request ke Groq API menggunakan cURL (bawaan PHP, tanpa
// perlu install library tambahan).
        $apiKey = getenv('GROQ_API_KEY');

        $payload = json_encode([
            'model' => 'llama-3.3-70b-versatile',
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user', 'content' => $userMessage],
            ],
        ]);

        $ch = curl_init('https://api.groq.com/openai/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiKey,
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

// Tangani kemungkinan error (API key salah, Groq down, dll)
// supaya widget chat tidak error blank, tapi kasih pesan yang jelas.
        if ($httpCode !== 200) {
            return $this->response->setJSON([
                'reply' => 'Maaf, chatbot sedang tidak bisa diakses. Coba lagi nanti.'
            ]);
        }

// Ambil teks jawaban dari response Groq (formatnya sama seperti
// OpenAI API: choices[0].message.content)
        $data = json_decode($response, true);
        $reply = $data['choices'][0]['message']['content'] ?? 'Maaf, terjadi kesalahan.';

        return $this->response->setJSON(['reply' => $reply]);
    }
} -->