<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Seeder;

/**
 * Naik Kelas — full financial-literacy curriculum (Bahasa Indonesia).
 *
 * Audience: lulusan SMA/SMK, pekerja restoran di Kediri, usia ~20-40 tahun.
 * Level baca SD kelas 3-5. Kalimat pendek, satu ide per kalimat.
 * Setiap pelajaran: hook -> satu ide -> contoh dengan angka rupiah nyata -> satu aksi yang bisa dicek.
 *
 * Idempotent: pakai updateOrCreate, jadi db:seed boleh diulang tanpa duplikat.
 */
class CurriculumSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->modules() as $m) {
            $module = Module::updateOrCreate(
                ['slug' => $m['slug']],
                [
                    'order' => $m['order'],
                    'title' => $m['title'],
                    'summary' => $m['summary'],
                    'art_object_key' => $m['art_object_key'],
                ]
            );

            foreach ($m['lessons'] as $i => $lesson) {
                Lesson::updateOrCreate(
                    ['module_id' => $module->id, 'order' => $i + 1],
                    [
                        'title' => $lesson['title'],
                        'body' => $lesson['body'],
                        'action_text' => $lesson['action_text'],
                    ]
                );
            }
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function modules(): array
    {
        return [

            // ===================================================================
            // MODULE 1 — m01-waktu — Mindset: waktu & umur muda
            // ===================================================================
            [
                'order' => 1,
                'slug' => 'm01-waktu',
                'art_object_key' => 'm01-waktu',
                'title' => 'Modul 1 — Modal Terbesarmu Bukan Uang',
                'summary' => 'Umur muda dan badan sehat itu modal paling besar yang kamu punya. Uang cuma alat untuk hidup yang kamu mau.',
                'lessons' => [
                    [
                        'title' => 'Yang Paling Berharga Adalah Waktumu',
                        'body' => <<<'HTML'
<p>Kamu mungkin merasa belum punya apa-apa. Belum punya tabungan besar. Belum punya rumah. Belum punya usaha.</p>
<p>Tapi kamu salah. Kamu punya satu hal yang orang kaya pun mau beli mahal-mahal: <strong>umur muda</strong>.</p>
<p>Umur muda itu seperti lahan kosong yang masih luas. Kalau kamu tanam pohon sekarang, umur 40 tahun pohonnya sudah besar dan berbuah. Tapi kalau kamu baru tanam umur 38, kamu keburu tua sebelum pohonnya berbuah.</p>
<p>Setiap tahun yang lewat tanpa kamu menanam, lahanmu makin sempit. Itu sebabnya hari ini penting. Bukan besok. Hari ini.</p>
<p>Kabar baiknya: kamu masih punya banyak lahan kosong. Banyak orang yang lebih tua iri sama kamu.</p>
HTML,
                        'action_text' => 'Hitung dan tulis di kertas: umurmu sekarang berapa, dan berapa tahun lagi sampai umur 40.',
                    ],
                    [
                        'title' => 'Uang Itu Alat, Bukan Tujuan',
                        'body' => <<<'HTML'
<p>Banyak orang bilang mereka mau "kaya". Tapi kalau ditanya kaya buat apa, mereka bingung.</p>
<p>Uang itu seperti pisau di dapur. Pisau bukan tujuan. Pisau cuma alat untuk memotong. Yang penting masakan yang kamu buat.</p>
<p>Uang juga begitu. Uang cuma alat. Yang penting hidup seperti apa yang kamu mau. Mungkin kamu mau bisa berhenti kerja capek di umur 40. Mungkin kamu mau bisa bantu orang tua tanpa pusing. Mungkin kamu mau anakmu sekolah tinggi.</p>
<p>Kalau kamu tahu hidup yang kamu mau, kamu jadi tahu untuk apa nabung. Orang yang nabung tanpa tujuan biasanya cepat menyerah. Orang yang punya tujuan jelas akan bertahan.</p>
HTML,
                        'action_text' => 'Tulis satu kalimat: "Aku mau bebas dari kerja yang melelahkan di umur ___." Tempel di dinding kamarmu.',
                    ],
                    [
                        'title' => 'Tubuhmu yang Sehat Itu Mesin Uang',
                        'body' => <<<'HTML'
<p>Kamu bisa masak. Kamu bisa kerja keras seharian di dapur yang panas. Itu bukan hal kecil.</p>
<p>Keahlian dan badan sehatmu itu mesin yang mencetak uang tiap bulan. Selama mesin ini jalan, ada gaji masuk.</p>
<p>Tapi mesin ini tidak selamanya kuat. Suatu hari badan capek. Lutut sakit. Mata mulai rabun. Mesin melambat.</p>
<p>Itu sebabnya kamu harus pakai mesin yang masih kuat sekarang untuk <strong>membangun mesin kedua</strong>. Mesin kedua adalah aset yang mencetak uang walau badanmu istirahat. Nanti kita pelajari pelan-pelan.</p>
<p>Intinya: selagi badan masih kuat, jangan cuma dipakai untuk hidup hari ini. Pakai juga untuk membangun masa depan.</p>
HTML,
                        'action_text' => 'Sebutkan satu keahlian kerjamu yang paling kamu kuasai, lalu tulis di catatan HP.',
                    ],
                ],
            ],

            // ===================================================================
            // MODULE 2 — m02-catatan — Know your money
            // ===================================================================
            [
                'order' => 2,
                'slug' => 'm02-catatan',
                'art_object_key' => 'm02-catatan',
                'title' => 'Modul 2 — Kenali Uangmu Sendiri',
                'summary' => 'Kamu tidak bisa mengatur uang yang tidak kamu hitung. Catat uang masuk dan uang keluar.',
                'lessons' => [
                    [
                        'title' => 'Uang yang Tidak Dicatat Pasti Bocor',
                        'body' => <<<'HTML'
<p>Di dapur, kamu selalu hitung stok. Berapa kilo ayam. Berapa liter minyak. Berapa karung beras. Kalau tidak dihitung, stok bocor dan kamu rugi tanpa sadar.</p>
<p>Uang di dompetmu sama persis. Kalau tidak dicatat, uang itu bocor ke mana-mana. Akhir bulan kamu bingung: "Lho, gajiku ke mana?"</p>
<p>Coba pikir. Gaji Rp2.500.000 masuk. Lima belas hari kemudian sudah tinggal Rp300.000. Kamu tidak ingat dipakai apa saja. Itu tanda uangmu bocor.</p>
<p>Mencatat itu bukan ribet. Mencatat itu seperti menyalakan lampu di kamar gelap. Tiba-tiba kamu bisa lihat ke mana uangmu pergi.</p>
HTML,
                        'action_text' => 'Buka catatan di HP-mu sekarang, lalu tulis semua uang yang kamu pegang hari ini.',
                    ],
                    [
                        'title' => 'Cara Catat yang Gampang: Masuk dan Keluar',
                        'body' => <<<'HTML'
<p>Mencatat uang tidak perlu rumus. Cuma dua kolom. <strong>Uang masuk</strong> dan <strong>uang keluar</strong>.</p>
<p>Uang masuk: gaji, uang tip, uang lembur, uang dari jualan kecil. Uang keluar: makan, rokok, kopi, pulsa, bensin, kirim ke orang tua.</p>
<p>Contoh satu hari:</p>
<ul>
<li>Masuk: tip Rp30.000</li>
<li>Keluar: kopi Rp8.000, rokok Rp25.000, makan siang Rp15.000, bensin Rp20.000</li>
</ul>
<p>Hari itu kamu dapat Rp30.000 tapi keluar Rp68.000. Berarti hari itu kamu tekor Rp38.000. Kalau tidak dicatat, kamu tidak akan pernah tahu.</p>
<p>Catat setiap kali keluar uang. Cukup satu detik. Lama-lama jadi kebiasaan.</p>
HTML,
                        'action_text' => 'Catat SEMUA uang masuk dan keluar kamu selama 3 hari ke depan, termasuk kopi dan rokok.',
                    ],
                    [
                        'title' => 'Lihat Angka yang Bikin Kaget',
                        'body' => <<<'HTML'
<p>Setelah kamu mencatat beberapa hari, sekarang waktunya melihat. Inilah bagian yang paling membuka mata.</p>
<p>Jumlahkan satu jenis pengeluaran kecil yang kamu lakukan tiap hari. Misalnya rokok.</p>
<p>Rokok Rp25.000 sehari kelihatan kecil. Tapi coba kali 30 hari. Itu Rp750.000 sebulan. Kali 12 bulan, itu <strong>Rp9.000.000 setahun</strong>. Uang segitu cukup buat beli 7 ekor kambing muda.</p>
<p>Ini bukan untuk membuatmu merasa bersalah. Ini untuk membuatmu sadar. Uang kecil yang diulang-ulang jadi uang besar.</p>
<p>Begitu kamu lihat angkanya, kamu jadi punya pilihan. Mau terus, atau mau pelan-pelan dialihkan ke hal yang lebih penting.</p>
HTML,
                        'action_text' => 'Pilih satu pengeluaran harianmu, kalikan dengan 30, lalu tulis berapa totalnya sebulan.',
                    ],
                ],
            ],

            // ===================================================================
            // MODULE 3 — m03-celengan — Pay yourself first
            // ===================================================================
            [
                'order' => 3,
                'slug' => 'm03-celengan',
                'art_object_key' => 'm03-celengan',
                'title' => 'Modul 3 — Bayar Diri Sendiri Dulu',
                'summary' => 'Sisihkan tabungan begitu uang masuk, sebelum dipakai apa pun. Pisahkan uangnya supaya aman.',
                'lessons' => [
                    [
                        'title' => 'Petani Pintar Pisahkan Benih Dulu',
                        'body' => <<<'HTML'
<p>Bayangkan seorang petani panen padi. Kalau dia pintar, dia pisahkan dulu sebagian gabah untuk benih. Baru sisanya dimakan.</p>
<p>Petani yang bodoh makan semua hasil panennya. Musim tanam berikutnya dia tidak punya benih. Dia tetap miskin selamanya.</p>
<p>Uangmu sama. Begitu gaji masuk, <strong>sisihkan dulu untuk dirimu sendiri</strong>. Baru sisanya dipakai untuk hidup. Ini namanya "bayar diri sendiri dulu".</p>
<p>Kebanyakan orang melakukan sebaliknya. Mereka bayar semua orang dulu: bayar makan, bayar rokok, bayar utang, bayar jajan. Kalau ada sisa, baru ditabung. Masalahnya, hampir tidak pernah ada sisa.</p>
<p>Balik urutannya. Tabung dulu. Pakai belakangan.</p>
HTML,
                        'action_text' => 'Tentukan satu angka tetap yang akan kamu sisihkan tiap gajian, lalu tulis angkanya.',
                    ],
                    [
                        'title' => 'Mulai dari 10 Persen',
                        'body' => <<<'HTML'
<p>Berapa yang harus disisihkan? Aturan paling tua dan paling terbukti: <strong>10 persen</strong> dari setiap uang yang kamu dapat.</p>
<p>Sepuluh persen itu kecil. Dari Rp10.000, cuma Rp1.000. Dari gaji Rp2.500.000, cuma Rp250.000. Sisanya Rp2.250.000 masih kamu pakai.</p>
<p>"Tapi Rp250.000 itu berasa," katamu. Memang. Tapi coba ingat: ribuan orang hidup dengan gaji yang lebih kecil dari sisamu itu. Kamu pasti bisa.</p>
<p>Kalau 10 persen terasa terlalu berat di awal, mulai dari 5 persen. Yang penting kamu mulai. Nanti pelan-pelan naikkan.</p>
<p>Uang 10 persen ini bukan untuk dipakai. Ini benihmu. Ini yang nanti tumbuh jadi mesin keduamu.</p>
HTML,
                        'action_text' => 'Hitung 10 persen dari gaji terakhirmu, lalu tulis angka itu sebagai target tabungan bulananmu.',
                    ],
                    [
                        'title' => 'Pisahkan Uangnya, Jangan Dicampur',
                        'body' => <<<'HTML'
<p>Ini rahasia penting. Uang tabungan harus <strong>dipisah</strong> dari uang sehari-hari. Kalau dicampur di satu dompet, pasti kepakai.</p>
<p>Uang yang kelihatan itu godaan. Kalau ada di depan mata, tangan gampang mengambilnya. Jadi sembunyikan dari diri sendiri.</p>
<p>Cara paling gampang zaman sekarang: buka satu aplikasi investasi yang terdaftar OJK, lalu mulai Reksadana Pasar Uang. Apa itu? Uangmu dikumpulkan bareng banyak orang dan diatur ahli, ditaruh di tempat aman. Mulainya cuma <strong>Rp10.000</strong>.</p>
<p>Begitu gajian, langsung pindahkan jatah 10 persen ke situ. Sebelum belanja apa pun. Anggap uang itu sudah hilang dari dompet harianmu.</p>
<p>Kalau belum mau aplikasi, pisahkan saja uangnya di amplop atau celengan yang susah dibuka. Yang penting terpisah.</p>
HTML,
                        'action_text' => 'Pisahkan uang tabunganmu ke tempat terpisah (amplop, celengan, atau aplikasi) minggu ini.',
                    ],
                ],
            ],

            // ===================================================================
            // MODULE 4 — m04-timbangan — Needs vs wants + family pressure
            // ===================================================================
            [
                'order' => 4,
                'slug' => 'm04-timbangan',
                'art_object_key' => 'm04-timbangan',
                'title' => 'Modul 4 — Kebutuhan, Keinginan, dan Keluarga',
                'summary' => 'Bedakan yang kamu butuh dari yang kamu mau. Jaga gaya hidup. Bantu keluarga tanpa menghancurkan diri sendiri.',
                'lessons' => [
                    [
                        'title' => 'Beda Kebutuhan dan Keinginan',
                        'body' => <<<'HTML'
<p>Ada dua macam pengeluaran. <strong>Kebutuhan</strong> dan <strong>keinginan</strong>. Banyak orang gagal menabung karena tidak bisa membedakan keduanya.</p>
<p>Kebutuhan itu yang kamu perlu untuk hidup dan kerja. Contoh: makan, sewa kamar, seragam kerja, bensin ke tempat kerja, pulsa untuk dihubungi bos.</p>
<p>Keinginan itu enak punya tapi tidak wajib. Contoh: kopi kekinian tiap hari, rokok merek mahal, HP baru padahal yang lama masih bagus, baju baru tiap bulan.</p>
<p>Bukan berarti keinginan itu haram. Sesekali boleh. Tapi kamu harus tahu mana yang mana. Kalau semua keinginan kamu turuti, tabunganmu nol selamanya.</p>
<p>Tes gampangnya: "Kalau ini tidak kubeli, apakah aku tetap bisa kerja besok?" Kalau jawabannya ya, itu keinginan.</p>
HTML,
                        'action_text' => 'Lihat catatan pengeluaranmu, lalu tandai mana yang kebutuhan dan mana yang keinginan.',
                    ],
                    [
                        'title' => 'Awas Ember Bocor: Gaya Hidup Naik Diam-Diam',
                        'body' => <<<'HTML'
<p>Ada jebakan pelan yang menjerat hampir semua orang. Namanya gaya hidup naik diam-diam.</p>
<p>Begini ceritanya. Gajimu naik. Senang. Lalu tanpa sadar, kamu mulai upgrade. Kopi biasa jadi kopi mahal. Rokok murah jadi rokok mahal. Makan warung jadi makan kafe.</p>
<p>Hasilnya? Gaji naik, tapi tabungan tetap nol. Bahkan kadang makin tekor. Uangnya naik, tapi gaya hidup naik lebih cepat.</p>
<p>Ini seperti ember bocor yang lubangnya kamu besarkan sendiri. Mau diisi air sebanyak apa pun, tetap habis.</p>
<p>Aturannya simpel: kalau gaji naik, naikkan dulu tabunganmu, bukan gaya hidupmu. Hidup secukupnya. Biarkan jarak antara penghasilan dan pengeluaran makin lebar. Jarak itulah yang jadi kekayaanmu.</p>
HTML,
                        'action_text' => 'Pilih satu keinginan terbesarmu minggu ini, lalu alihkan uangnya ke tabungan.',
                    ],
                    [
                        'title' => 'Bantu Keluarga Tanpa Tenggelam Sendiri',
                        'body' => <<<'HTML'
<p>Ini bagian yang berat. Banyak dari kita punya keluarga yang minta bantuan uang. Orang tua, adik, saudara. Menolak rasanya tidak enak. Tapi memberi terus-menerus bisa menghancurkan masa depanmu sendiri.</p>
<p>Ingat ini: <strong>kamu tidak bisa menolong orang tenggelam kalau kamu sendiri belum bisa berenang.</strong> Kalau kamu ikut tenggelam, tidak ada yang selamat.</p>
<p>Caranya bukan menolak total. Caranya pakai batas. Tetapkan satu angka tetap tiap bulan untuk "pos keluarga". Misalnya Rp200.000. Itu batasnya. Keluarga dapat tangan yang stabil, bukan seluruh tubuhmu.</p>
<p>Kalau diminta lebih, jujur saja dengan tenang: "Maaf, sekarang aku belum bisa lebih. Uangku sedang aku kunci untuk masa depan kita." Bicara soal komitmenmu, bukan menyalahkan mereka.</p>
<p>Dengan amankan dirimu dulu, kamu justru jadi orang yang bisa diandalkan keluarga jangka panjang. Bukan yang ikut karam.</p>
HTML,
                        'action_text' => 'Tetapkan satu angka tetap "pos keluarga" per bulan, lalu tulis angkanya sebagai batas.',
                    ],
                ],
            ],

            // ===================================================================
            // MODULE 5 — m05-payung — Emergency buffer
            // ===================================================================
            [
                'order' => 5,
                'slug' => 'm05-payung',
                'art_object_key' => 'm05-payung',
                'title' => 'Modul 5 — Dana Darurat: Payungmu Saat Hujan',
                'summary' => 'Siapkan dana darurat sebelum mulai investasi. Ini perlindungan supaya satu masalah kecil tidak jadi utang.',
                'lessons' => [
                    [
                        'title' => 'Kenapa Kamu Butuh Tabung Gas Cadangan',
                        'body' => <<<'HTML'
<p>Di dapur yang baik, selalu ada tabung gas cadangan. Kamu tidak berharap gas habis pas lagi rame order. Tapi kalau habis, satu tabung cadangan menyelamatkan harimu.</p>
<p>Hidup juga butuh cadangan. Namanya <strong>dana darurat</strong>. Ini uang khusus untuk kejadian tak terduga.</p>
<p>Hidup penuh kejutan. Ban motor bocor. HP rusak. Anak sakit mendadak. Tiba-tiba dipecat. Semua butuh uang cepat.</p>
<p>Orang yang tidak punya dana darurat, begitu kena masalah kecil, langsung lari ke pinjol atau rentenir. Lalu terjerat utang bunga tinggi bertahun-tahun. Satu masalah kecil berubah jadi bencana besar.</p>
<p>Dana darurat memutus rantai itu. Ada masalah, ambil dari cadangan, selesai. Tidak perlu ngutang.</p>
HTML,
                        'action_text' => 'Tulis 3 kejadian darurat yang pernah memaksamu cari uang mendadak.',
                    ],
                    [
                        'title' => 'Dana Darurat Itu Tameng, Bukan Investasi',
                        'body' => <<<'HTML'
<p>Penting dipahami: dana darurat <strong>bukan</strong> untuk cari untung. Dana darurat itu tameng. Tugasnya cuma satu: selalu ada saat dibutuhkan.</p>
<p>Karena itu, dana darurat harus <strong>aman dan gampang diambil</strong>. Jangan ditaruh di kambing. Kambing tidak bisa dijual dalam satu jam saat anak demam. Jangan ditaruh di emas batangan yang harganya bisa lagi turun saat kamu butuh jual.</p>
<p>Taruh dana darurat di tempat yang stabil dan cepat cair. Contoh: Reksadana Pasar Uang yang bisa dicairkan dalam beberapa hari, atau rekening tabungan terpisah.</p>
<p>Jangan tergoda menaruh dana darurat di tempat berisiko demi untung lebih. Untungnya kecil, tapi risikonya besar: pas butuh, uangnya malah lagi turun. Untuk dana darurat, aman lebih penting daripada untung.</p>
HTML,
                        'action_text' => 'Tentukan satu tempat aman untuk dana daruratmu (rekening terpisah atau Reksadana Pasar Uang).',
                    ],
                    [
                        'title' => 'Mulai dari Rp1 Juta, Lalu Bangun Pelan',
                        'body' => <<<'HTML'
<p>Berapa besar dana darurat? Jangan langsung mikir angka besar sampai kamu menyerah duluan. Mulai kecil.</p>
<p><strong>Target pertama: Rp1.000.000.</strong> Cukup untuk menambal kejadian kecil seperti ban bocor atau HP rusak. Kumpulkan ini dulu sebelum mikir investasi apa pun.</p>
<p>Setoran pertama boleh berapa pun. Bahkan Rp50.000 sudah jadi awal. Yang penting mulai. Lalu tambah tiap gajian sampai kena Rp1 juta.</p>
<p>Setelah Rp1 juta tercapai, naikkan targetnya. Target berikutnya: <strong>biaya hidup 3 sampai 6 bulan</strong>. Kalau biaya hidupmu Rp2 juta sebulan, target akhirnya Rp6 juta sampai Rp12 juta.</p>
<p>Kedengarannya banyak. Tapi dikumpulkan pelan-pelan, pasti sampai. Baru setelah dana darurat aman, kamu boleh mulai menanam uang ke aset yang tumbuh.</p>
HTML,
                        'action_text' => 'Setor uang pertama (berapa pun, misal Rp50.000) ke tempat dana daruratmu minggu ini.',
                    ],
                ],
            ],

            // ===================================================================
            // MODULE 6 — m06-ungkit — Good vs bad debt (leverage)
            // ===================================================================
            [
                'order' => 6,
                'slug' => 'm06-ungkit',
                'art_object_key' => 'm06-ungkit',
                'title' => 'Modul 6 — Utang yang Memberi Makan vs Utang yang Memakanmu',
                'summary' => 'Ada utang baik dan utang buruk. Utang baik membeli aset yang menghasilkan. Utang buruk membeli barang yang nilainya turun.',
                'lessons' => [
                    [
                        'title' => 'Dua Macam Utang',
                        'body' => <<<'HTML'
<p>Banyak orang takut pada semua utang. Padahal ada utang yang baik. Kuncinya tahu bedanya.</p>
<p><strong>Utang baik</strong> adalah utang untuk membeli sesuatu yang menghasilkan uang. Barang itu bekerja untukmu dan membayar utangnya sendiri.</p>
<p><strong>Utang buruk</strong> adalah utang untuk membeli barang yang nilainya turun dan tidak menghasilkan apa-apa. Tiap bulan kamu yang membayar, dan barangnya makin tidak berharga.</p>
<p>Contoh gampang. Utang untuk beli indukan kambing = utang baik. Kambing beranak, anaknya dijual, utangnya terbayar dari hasil itu. Kambing memberi makan kamu.</p>
<p>Utang untuk beli HP mahal biar gaya = utang buruk. HP tidak menghasilkan apa-apa. Tiap bulan kamu bayar cicilan, dan harga HP-nya makin jatuh. HP itu memakan kamu.</p>
HTML,
                        'action_text' => 'Tulis satu contoh utang baik dan satu contoh utang buruk dari hidupmu sendiri.',
                    ],
                    [
                        'title' => 'Tes Sederhana: Ini Memberi Makan atau Memakanmu?',
                        'body' => <<<'HTML'
<p>Sebelum berutang, tanya satu hal: <strong>"Barang ini akan memberi makan aku, atau memakan aku?"</strong></p>
<p>Kalau barangnya menghasilkan uang atau menaikkan penghasilanmu, itu memberi makan. Boleh dipikirkan. Contoh: gerobak untuk jualan, alat masak untuk usaha sampingan, indukan kambing.</p>
<p>Kalau barangnya cuma untuk gaya atau senang sesaat, dan harganya turun terus, itu memakan kamu. Hindari ngutang untuknya. Contoh: motor baru biar keren, HP terbaru, liburan pakai pinjol.</p>
<p>Yang paling bahaya adalah pinjol untuk hal konsumtif. Bunganya mencekik. Kamu berutang Rp1 juta, beberapa bulan jadi Rp2 juta. Itu rentenir model baru.</p>
<p>Aturan emasnya: <strong>berutang hanya untuk hal yang bisa beranak.</strong> Jangan pernah berutang untuk gaya hidup.</p>
HTML,
                        'action_text' => 'Sebelum belanja besar berikutnya, tanyakan "memberi makan atau memakan?" dan tulis jawabannya.',
                    ],
                    [
                        'title' => 'Bereskan Utang Buruk yang Ada Sekarang',
                        'body' => <<<'HTML'
<p>Kalau kamu sudah punya utang buruk, jangan panik. Tapi jangan diam juga. Mulai bereskan sekarang.</p>
<p>Langkah pertama: tulis semua utangmu. Berapa jumlahnya, dan berapa bunganya. Lihat semuanya di satu tempat. Ini sering bikin kaget, tapi harus dihadapi.</p>
<p>Langkah kedua: tandai utang dengan bunga paling tinggi. Biasanya pinjol atau kartu kredit. Itu yang paling cepat memakanmu.</p>
<p>Langkah ketiga: bayar utang bunga tertinggi itu duluan, secepat mungkin. Yang lain bayar minimal dulu. Setelah yang paling mahal lunas, pindah ke berikutnya.</p>
<p>Langkah keempat dan paling penting: <strong>janji tidak menambah utang konsumtif baru.</strong> Percuma menambal ember kalau kamu terus melubanginya.</p>
HTML,
                        'action_text' => 'Buat daftar semua utangmu, tandai yang bunganya paling tinggi untuk dilunasi duluan.',
                    ],
                ],
            ],

            // ===================================================================
            // MODULE 7 — m07-kambing — The goat principle (compounding)
            // ===================================================================
            [
                'order' => 7,
                'slug' => 'm07-kambing',
                'art_object_key' => 'm07-kambing',
                'title' => 'Modul 7 — Prinsip Kambing: Buat Uangmu Beranak',
                'summary' => 'Rahasia orang yang naik kelas: jangan makan bibitnya. Biarkan uangmu beranak, lalu putar lagi anaknya.',
                'lessons' => [
                    [
                        'title' => 'Dua Kambing Bisa Jadi Sekampung',
                        'body' => <<<'HTML'
<p>Ini pelajaran paling penting di seluruh kelas ini. Pelan-pelan, resapi.</p>
<p>Bayangkan kamu punya 2 ekor kambing betina. Kamu rawat. Beberapa bulan kemudian, mereka beranak. Sekarang kamu punya 4.</p>
<p>Nah, di sinilah ujiannya. Kamu lapar. Kamu tergoda menjual atau memakan anak kambingnya. Orang yang miskin selamanya akan melakukan itu. Tiap kali butuh, dia makan anaknya.</p>
<p>Tapi orang yang naik kelas sabar. Dia biarkan anak kambing tumbuh. Anaknya beranak lagi. Jadi 8. Lalu 16. Lalu 20.</p>
<p>Lima tahun kemudian, dia bukan lagi punya 2 kambing. Dia punya <strong>sekampung kambing</strong>. Senilai puluhan juta. Padahal modal awalnya cuma 2 ekor.</p>
<p>Itulah rahasianya. Bukan beli banyak di awal. Tapi sabar membiarkan yang sedikit berkembang biak.</p>
HTML,
                        'action_text' => 'Gambar atau tulis di kertas: 2 kambing jadi 4, jadi 8, jadi 16. Tempel di tempat yang kamu lihat tiap hari.',
                    ],
                    [
                        'title' => 'Jangan Pernah Makan Bibitnya',
                        'body' => <<<'HTML'
<p>Petani menyebutnya "jangan makan bibit". Maksudnya begini.</p>
<p>Setiap uang punya dua nasib. Bisa <strong>ditanam</strong> supaya jadi lebih banyak, atau <strong>dimakan</strong> sekali lalu hilang.</p>
<p>Uang yang kamu tanam dan tumbuh, itu bibitmu. Bibit ini tidak boleh dimakan. Yang boleh kamu nikmati cuma "anaknya", yaitu hasil atau untungnya. Itu pun lebih baik diputar lagi dulu di awal.</p>
<p>Contoh nyata. Kamu taruh Rp5 juta di reksadana. Setahun jadi Rp5,3 juta. Yang Rp300 ribu itu anaknya. Modal Rp5 juta itu bibit. Jangan sentuh bibitnya. Kalau bisa, putar lagi yang Rp300 ribu supaya tahun depan beranak lebih banyak.</p>
<p>Orang yang terus makan bibitnya tidak akan pernah kaya, walau penghasilannya besar. Orang yang menjaga bibitnya, walau kecil, pelan-pelan jadi makin kuat.</p>
HTML,
                        'action_text' => 'Tentukan satu "kambing induk" pertamamu (tabungan atau investasi) yang berjanji TIDAK akan kamu sentuh.',
                    ],
                    [
                        'title' => 'Sabar Itu Kekuatan, Bukan Kelemahan',
                        'body' => <<<'HTML'
<p>Prinsip kambing butuh satu hal yang langka: <strong>kesabaran</strong>.</p>
<p>Di tahun pertama dan kedua, hasilnya kelihatan kecil. 2 kambing jadi 4. Rasanya lambat. Banyak orang menyerah di sini. Mereka bilang "tidak ada untungnya", lalu menjual semua.</p>
<p>Tapi keajaibannya datang belakangan. Dari 4 ke 8 itu cepat. Dari 8 ke 16 lebih cepat lagi. Makin lama makin kencang. Ini namanya bunga berbunga: hasil yang menghasilkan hasil lagi.</p>
<p>Hal yang sama berlaku untuk uang. Rp300.000 ditabung tiap bulan selama 15 tahun, dengan untung kecil yang diputar terus, bisa jadi <strong>sekitar Rp87 juta</strong>. Padahal yang kamu setor cuma sekitar Rp54 juta. Selisih Rp33 juta itu kerja bunga berbunga, bukan kerjamu.</p>
<p>Kuncinya satu: mulai muda, dan jangan berhenti. Waktu adalah teman terbaik kambingmu.</p>
HTML,
                        'action_text' => 'Tulis aturan untuk dirimu: "Untung dari tabunganku akan kuputar lagi, bukan kupakai." Simpan aturan itu.',
                    ],
                ],
            ],

            // ===================================================================
            // MODULE 8 — m08-tumbuh — Ways to grow capital
            // ===================================================================
            [
                'order' => 8,
                'slug' => 'm08-tumbuh',
                'art_object_key' => 'm08-tumbuh',
                'title' => 'Modul 8 — Kendaraan untuk Menumbuhkan Uang',
                'summary' => 'Kenali tempat menumbuhkan uang: emas, reksadana, ternak, warung, kos. Mulai dari yang kecil dan aman, naik bertahap.',
                'lessons' => [
                    [
                        'title' => 'Naik Kelas Itu Bertahap, Jangan Loncat',
                        'body' => <<<'HTML'
<p>Ada banyak cara menumbuhkan uang. Tapi jangan langsung loncat ke yang besar. Naik kelas itu bertahap, seperti sekolah. Tidak ada anak yang loncat dari kelas 1 ke kelas 6.</p>
<p>Urutannya dari yang paling aman dan murah, naik ke yang lebih besar:</p>
<ul>
<li><strong>Kelas 1 — Emas dan Reksadana Pasar Uang.</strong> Mulai Rp10.000. Paling aman buat pemula.</li>
<li><strong>Kelas 2 — Ternak kambing.</strong> Modal sekitar Rp2,4 juta untuk 2 ekor. Beranak sendiri.</li>
<li><strong>Kelas 3 — Warung.</strong> Modal Rp5 juta sampai Rp15 juta. Menghasilkan, tapi kerja keras.</li>
<li><strong>Kelas 4 — Kos-kosan.</strong> Modal puluhan juta. Penghasilan rutin tiap bulan.</li>
</ul>
<p>Jangan tergoda loncat ke kos-kosan sebelum kuat di kelas bawah. Tiap kelas mengajari kamu, dan modal kelas atas datang dari hasil kelas bawah.</p>
HTML,
                        'action_text' => 'Tulis kamu sekarang ada di "kelas" berapa, dan kelas berikutnya yang mau kamu tuju.',
                    ],
                    [
                        'title' => 'Emas dan Reksadana: Pintu Masuk Termurah',
                        'body' => <<<'HTML'
<p>Dua kendaraan pertama paling cocok untuk pemula karena murah, aman, dan gampang.</p>
<p><strong>Emas.</strong> Emas itu barang nyata yang nilainya tahan terhadap inflasi. Uang Rp100.000 di laci tahun depan nilainya turun. Emas cenderung ikut naik. Sepuluh tahun terakhir, emas naik sekitar 4 kali lipat. Kamu bisa mulai nabung emas di Pegadaian dari <strong>Rp10.000</strong>. Aturan penting: beli emas batangan bersertifikat, bukan perhiasan. Perhiasan kena potongan ongkos.</p>
<p><strong>Reksadana Pasar Uang.</strong> Uangmu dikumpulkan bareng banyak orang, diatur ahli berizin OJK, ditaruh di tempat aman seperti deposito. Mulai dari <strong>Rp10.000</strong>. Untungnya sekitar 4 sampai 6 persen setahun. Lebih tinggi dari tabungan biasa yang cuma 0,5 sampai 1,5 persen. Bisa dicairkan kapan saja.</p>
<p>Keduanya cocok jadi tempat pertama menyimpan benihmu. Tidak perlu pintar analisa. Cukup setor rutin tiap gajian.</p>
HTML,
                        'action_text' => 'Buka satu akun pemula minggu ini: Tabungan Emas Pegadaian ATAU Reksadana Pasar Uang (terdaftar OJK).',
                    ],
                    [
                        'title' => 'Kambing, Warung, Kos: Aset yang Lebih Besar',
                        'body' => <<<'HTML'
<p>Setelah kuat di emas dan reksadana, kamu bisa naik ke aset yang lebih besar. Ini butuh modal dan kerja lebih, tapi hasilnya juga lebih besar.</p>
<p><strong>Ternak kambing.</strong> Modal sekitar Rp2,4 juta untuk 2 betina muda. Kalau kamu rajin cari rumput sendiri, biaya pakan cuma sekitar Rp40.000 per ekor sebulan. Dalam 5 tahun, 2 kambing bisa jadi sekitar 20 ekor, senilai <strong>Rp30 sampai Rp40 juta</strong>. Risikonya: bisa kena penyakit, jadi kandang harus bersih.</p>
<p><strong>Warung.</strong> Modal Rp5 sampai Rp15 juta. Warung yang ramai bisa untung bersih sekitar Rp7 juta sebulan. Tapi ini kerja keras 12 jam sehari. Anggap warung itu beli pekerjaan dengan untung lebih, bukan penghasilan santai.</p>
<p><strong>Kos-kosan.</strong> Ini tujuan jangka panjang, bukan langkah pertama. Bangun 4 kamar di tanah sendiri bisa menghasilkan sekitar <strong>Rp2,7 juta sebulan</strong> tanpa kamu kerja tiap hari. Tapi modalnya besar, ratusan juta. Dibangun dari hasil aset-aset kecil yang kamu kumpulkan dulu.</p>
HTML,
                        'action_text' => 'Pilih satu aset besar yang paling cocok dengan keadaanmu, lalu cari tahu satu angka: berapa modal awalnya.',
                    ],
                ],
            ],

            // ===================================================================
            // MODULE 9 — m09-warung — Worker -> owner
            // ===================================================================
            [
                'order' => 9,
                'slug' => 'm09-warung',
                'art_object_key' => 'm09-warung',
                'title' => 'Modul 9 — Dari Karyawan Jadi Pemilik',
                'summary' => 'Selama hanya digaji, berhenti kerja berarti berhenti penghasilan. Naik kelas berarti punya aset yang menghasilkan walau kamu istirahat.',
                'lessons' => [
                    [
                        'title' => 'Menimba Air vs Menggali Sumur',
                        'body' => <<<'HTML'
<p>Bayangkan dua orang yang sama-sama butuh air tiap hari untuk dapur.</p>
<p>Orang pertama menimba air dari sungai tiap hari. Selama dia menimba, dapur ada air. Tapi begitu dia berhenti, capek atau sakit, dapur langsung kering. Tidak menimba berarti tidak ada air.</p>
<p>Orang kedua kerja keras sekali untuk menggali sumur. Capek di awal. Tapi setelah sumurnya jadi, air mengalir terus. Walau dia istirahat, air tetap ada.</p>
<p>Karyawan yang digaji itu seperti penimba air. Berhenti kerja, berhenti uang masuk. Pemilik aset itu seperti penggali sumur. Asetnya terus memberi walau dia tidak hadir.</p>
<p>Keduanya sama-sama kerja keras. Bedanya, yang satu membangun sesuatu yang bertahan. <strong>Naik kelas berarti pelan-pelan menggali sumurmu sendiri</strong>, sambil tetap menimba untuk hidup hari ini.</p>
HTML,
                        'action_text' => 'Tulis: penghasilanmu sekarang dari "menimba" (gaji) atau dari "sumur" (aset)? Jujur saja.',
                    ],
                    [
                        'title' => 'Pakai Keahlianmu Sebagai Jembatan',
                        'body' => <<<'HTML'
<p>Kabar baiknya, kamu tidak mulai dari nol. Kamu sudah punya keahlian yang berharga: kamu bisa masak.</p>
<p>Keahlian ini bisa jadi jembatan dari karyawan ke pemilik. Kamu tidak perlu langsung buka restoran besar. Mulai kecil.</p>
<p>Contoh. Kamu punya satu menu andalan yang selalu dipuji. Coba jual sendiri di luar jam kerja. Lewat gerobak kecil, atau pesanan online dari rumah, atau titip di warung tetangga.</p>
<p>Modalnya kecil. Warung sederhana bisa mulai dari Rp5 juta. Bahkan jualan dari rumah bisa lebih murah. Risikonya kecil karena kamu masih punya gaji.</p>
<p>Mulai sambil tetap kerja. Uang dari usaha kecil ini jangan dipakai. Putar lagi, atau tanam ke aset lain. Pelan-pelan usahamu tumbuh, sampai suatu hari penghasilannya menyamai gajimu.</p>
HTML,
                        'action_text' => 'Tulis satu ide usaha kecil dari keahlianmu yang bisa kamu mulai sambil tetap bekerja.',
                    ],
                    [
                        'title' => 'Punya Usaha Sendiri atau Modal Bareng',
                        'body' => <<<'HTML'
<p>Untuk jadi pemilik aset, ada beberapa jalan. Tidak ada yang wajib. Pilih yang paling cocok dengan keadaanmu.</p>
<p><strong>Jalan pertama: bangun sendiri dari kecil.</strong> Mulai warung sendiri, atau ternak kambing sistem bagi hasil (kamu kasih modal, orang lain yang rawat, untung dibagi). Kamu pegang penuh, tapi semua risiko kamu tanggung sendiri.</p>
<p><strong>Jalan kedua: ikut taruh modal bareng.</strong> Kamu bisa menaruh modal di usaha yang sudah jalan dan sudah punya sistem, misalnya restoran yang sudah ramai. Untungnya dibagi sesuai modal. Risikonya lebih kecil karena usahanya sudah terbukti, tapi kamu tidak pegang kendali penuh.</p>
<p>Ini cuma <strong>salah satu pilihan</strong>, bukan keharusan. Tidak ada yang menekanmu. Yang penting: pelan-pelan ubah uang hasil kerjamu jadi aset yang menghasilkan, lewat jalan mana pun yang kamu nyaman.</p>
<p>Pilih satu jalan dulu. Pelajari. Mulai kecil. Jangan menunggu sempurna.</p>
HTML,
                        'action_text' => 'Pilih satu jalan jadi pemilik (bangun sendiri atau modal bareng), lalu tulis langkah pertama yang realistis untukmu.',
                    ],
                ],
            ],

            // ===================================================================
            // MODULE 10 — m10-target — The 40 Plan
            // ===================================================================
            [
                'order' => 10,
                'slug' => 'm10-target',
                'art_object_key' => 'm10-target',
                'title' => 'Modul 10 — Peta 40: Rencana Menuju Bebas',
                'summary' => 'Gabungkan semua pelajaran jadi satu rencana bertahun. Angkamu, jangka waktumu, langkah-langkahmu.',
                'lessons' => [
                    [
                        'title' => 'Apa Artinya "Bebas Finansial"',
                        'body' => <<<'HTML'
<p>Kita sudah jalan jauh. Sekarang kita rangkai semuanya jadi satu peta.</p>
<p>Tujuan kita namanya <strong>bebas finansial</strong>. Artinya sederhana: hasil dari aset-asetmu cukup untuk menutupi biaya hidup bulananmu. Tanpa kamu harus kerja capek tiap hari.</p>
<p>Contoh. Biaya hidupmu Rp3 juta sebulan. Kalau kambingmu, kosmu, dan reksadanamu menghasilkan Rp3 juta sebulan, kamu bebas. Uang yang bekerja untukmu, bukan kamu yang bekerja untuk uang.</p>
<p>Bebas bukan berarti berhenti kerja total. Bebas berarti kamu kerja karena mau, bukan karena terpaksa. Itu bedanya besar.</p>
<p>Target kita: capai ini sekitar umur 40. Kedengarannya jauh, tapi itu justru kabar baik. Kamu punya banyak waktu, asal mulai sekarang.</p>
HTML,
                        'action_text' => 'Hitung dan tulis: berapa biaya hidupmu sebulan? Itu angka yang harus ditutup asetmu nanti.',
                    ],
                    [
                        'title' => 'Enam Tangga Menuju Umur 40',
                        'body' => <<<'HTML'
<p>Semua yang kita pelajari sebenarnya satu urutan tangga. Naik satu per satu. Jangan loncat.</p>
<ul>
<li><strong>Tangga 1.</strong> Catat uang masuk dan keluar. Sisihkan 10 persen tiap gajian untuk dirimu dulu.</li>
<li><strong>Tangga 2.</strong> Kumpulkan dana darurat. Mulai Rp1 juta, lalu bangun ke biaya hidup 3 sampai 6 bulan.</li>
<li><strong>Tangga 3.</strong> Lunasi utang buruk, mulai dari bunga tertinggi. Berhenti menambah utang konsumtif.</li>
<li><strong>Tangga 4.</strong> Tumbuhkan modal di tangga risiko: emas, reksadana, lalu kambing.</li>
<li><strong>Tangga 5.</strong> Putar terus hasilnya. Jangan makan bibitnya.</li>
<li><strong>Tangga 6.</strong> Ubah jadi aset penghasil besar: warung atau kos, yang memberi uang tiap bulan.</li>
</ul>
<p>Tiap tahun kamu naik satu atau dua anak tangga. Umur 40, kamu sampai di atas. Kamu "lulus".</p>
HTML,
                        'action_text' => 'Tulis di tangga mana kamu sekarang, lalu tentukan satu tangga berikutnya yang akan kamu naiki bulan ini.',
                    ],
                    [
                        'title' => 'Isi Peta 40-mu Sekarang',
                        'body' => <<<'HTML'
<p>Sekarang waktunya membuat petamu sendiri. Ini bukan teori. Ini rencana nyata untuk hidupmu.</p>
<p>Ambil satu lembar kertas. Tulis tiga hal ini:</p>
<ul>
<li><strong>Umurku sekarang:</strong> ___ tahun.</li>
<li><strong>Umur target bebas:</strong> ___ tahun. (Berapa tahun lagi dari sekarang?)</li>
<li><strong>Tiga langkah pertamaku:</strong> (1) buka rekening atau aplikasi untuk sisihkan 10 persen, (2) target dana darurat pertama Rp1 juta, (3) instrumen pertama yang akan kubuka (emas atau reksadana).</li>
</ul>
<p>Setelah ditulis, foto petamu. Simpan di HP. Lihat lagi tiap awal bulan. Tanya: "Bulan ini aku maju atau diam?"</p>
<p>Ingat satu kalimat penutup ini: <strong>tidak ada satu pun dari ini yang cepat. Semuanya mesin yang lambat tapi pasti.</strong> Miliki sebanyak mungkin mesin kecil, beri makan tiap gajian, jangan makan bibitnya. Umur 40, mesin-mesin itu yang membayar hidupmu. Bukan punggungmu yang sakit di dapur.</p>
HTML,
                        'action_text' => 'Isi satu lembar "Peta 40": umur sekarang, umur target bebas, dan 3 langkah pertamamu. Foto dan simpan.',
                    ],
                ],
            ],

        ];
    }
}
