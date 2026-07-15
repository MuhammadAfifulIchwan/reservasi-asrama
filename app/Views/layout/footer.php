</div>

    <footer class="bg-light text-center mt-5 p-3">
        <small>&copy; 2026 Sistem Reservasi Asrama Natuna</small>
    </footer>

    <!-- Bootstrap JS (tetap sama) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- File Javascript Dashboard (tetap sama, tidak diubah) -->
    <script src="/js/admin-dashboard.js"></script>

    <!-- ============================================= -->
    <!-- WIDGET CHATBOT AI - mengambang di semua halaman -->
    <!-- ID dan nama fungsi JS TIDAK diubah, supaya       -->
    <!-- ChatbotController.php tetap terhubung normal     -->
    <!-- ============================================= -->
    <!-- <div id="chatToggleBtn" style="position:fixed; bottom:20px; right:20px; z-index:1000;">
        <button class="btn btn-primary rounded-circle shadow"
                style="width:60px;height:60px; font-size:22px;"
                onclick="toggleChat()">
            <i class="bi bi-chat-dots-fill"></i>
        </button>
    </div> -->

    <div id="chatBox" style="display:none; position:fixed; bottom:90px; right:20px; width:320px; height:420px; z-index:1000; border-radius:16px; overflow:hidden;" class="card shadow">
        <div class="card-header text-white" style="background: linear-gradient(90deg, var(--brand-primary), var(--brand-primary-dark));">
            <i class="bi bi-robot me-2"></i>Tanya Asrama Bot
        </div>
        <div id="chatMessages" class="card-body" style="overflow-y:auto; overflow-x:hidden; height:300px; font-size:14px;"></div>
        <div class="card-footer p-2 bg-white">
            <div class="input-group">
                <input type="text" id="chatInput" class="form-control" placeholder="Tulis pertanyaan..." style="border-radius:8px 0 0 8px;">
                <button class="btn btn-primary" onclick="sendChat()" style="border-radius:0 8px 8px 0;">
                    <i class="bi bi-send-fill"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
    // Buka/tutup jendela chat saat ikon diklik (fungsi & ID sama persis seperti sebelumnya)
    function toggleChat() {
        const box = document.getElementById('chatBox');
        box.style.display = (box.style.display === 'none') ? 'block' : 'none';
    }

    // Kirim pertanyaan user ke ChatbotController::ask() lewat fetch(),
    // lalu tampilkan jawaban AI di jendela chat. (logika tidak diubah,
    // hanya bubble chat dipercantik dengan rounded corner lebih besar)
    async function sendChat() {
        const input = document.getElementById('chatInput');
        const messages = document.getElementById('chatMessages');
        const question = input.value.trim();
        if (question === '') return;

        messages.innerHTML += `
            <div class="d-flex justify-content-end mb-2">
                <div class="text-white p-2" style="max-width:80%; word-wrap:break-word; background:var(--brand-primary); border-radius:14px 14px 2px 14px;">
                    ${question}
                </div>
            </div>`;
        input.value = '';
        messages.scrollTop = messages.scrollHeight;

        const res = await fetch('<?= base_url('chatbot/ask') ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ message: question })
        });
        const data = await res.json();

        messages.innerHTML += `
            <div class="d-flex justify-content-start mb-2">
                <div class="bg-light border p-2" style="max-width:80%; word-wrap:break-word; border-radius:14px 14px 14px 2px;">
                    ${data.reply}
                </div>
            </div>`;
        messages.scrollTop = messages.scrollHeight;
    }
    </script>

</body>
</html>