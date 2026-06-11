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
 * 10 modul (spine tetap), ~8-9 pelajaran per modul. Pelajaran disusun berurutan
 * supaya satu ide nyambung ke ide berikutnya. Penekanan dengan <strong> akan tampil
 * sebagai stabilo kuning di reader.
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
                    [
                        'title' => 'Cerita Dua Teman: Mulai Muda Menang Jauh',
                        'body' => <<<'HTML'
<p>Ada dua teman, sama-sama kerja di restoran. Namanya kita sebut Budi dan Andi.</p>
<p>Budi mulai nyisihkan Rp200.000 tiap bulan sejak umur 22. Dia berhenti nabung di umur 32. Cuma 10 tahun, lalu uangnya dibiarkan tumbuh saja.</p>
<p>Andi santai dulu. Dia baru mulai nabung Rp200.000 tiap bulan di umur 32, dan terus sampai umur 50. Jadi Andi nabung 18 tahun, jauh lebih lama dari Budi.</p>
<p>Tebak siapa yang uangnya lebih banyak di umur 50? <strong>Budi</strong>. Padahal Budi nabung lebih sedikit dan lebih singkat. Kok bisa?</p>
<p>Karena uang Budi punya waktu lebih lama untuk beranak. Bukan jumlah setoran yang menang, tapi seberapa awal kamu mulai. Itu sebabnya hari ini lebih berharga dari uangmu nanti.</p>
HTML,
                        'action_text' => 'Tulis: kalau kamu mulai nyisihkan Rp100.000 tiap bulan mulai sekarang, kamu mulai di umur berapa?',
                    ],
                    [
                        'title' => 'Bukan Soal Gaji Besar, Tapi Kebiasaan',
                        'body' => <<<'HTML'
<p>Banyak orang berpikir, "Aku tidak bisa kaya karena gajiku kecil." Itu setengah benar, tapi setengahnya salah.</p>
<p>Ada orang gaji Rp10 juta sebulan, tapi tiap akhir bulan uangnya habis. Mobil dicicil, HP dicicil, gaya hidup tinggi. Dia kelihatan kaya, padahal kosong.</p>
<p>Ada juga orang gaji Rp3 juta yang pelan-pelan punya kambing, punya tanah kecil, punya tabungan. Dia tidak kelihatan kaya, tapi dia <strong>sedang naik kelas</strong>.</p>
<p>Bedanya bukan di besar gaji. Bedanya di kebiasaan. Yang satu menghabiskan, yang satu menyisihkan.</p>
<p>Kabar baiknya: kebiasaan bisa dilatih siapa saja, termasuk kamu. Gaji kecil bukan halangan. Kebiasaan buruk baru halangan.</p>
HTML,
                        'action_text' => 'Tulis satu kebiasaan uang burukmu yang mau kamu ubah mulai bulan ini.',
                    ],
                    [
                        'title' => 'Musuh Terbesarmu: "Nanti Saja"',
                        'body' => <<<'HTML'
<p>Musuh paling berbahaya dalam soal uang bukan gaji kecil. Bukan juga harga yang naik. Musuhnya adalah dua kata: <strong>"nanti saja"</strong>.</p>
<p>"Nanti saja kalau gaji naik." "Nanti saja kalau utang lunas." "Nanti saja kalau anak sudah besar." Nanti yang itu hampir tidak pernah datang.</p>
<p>Kenapa? Karena saat gaji naik, kebutuhan ikut naik. Saat utang lunas, muncul utang baru. Selalu ada alasan untuk menunda.</p>
<p>Orang yang naik kelas punya satu sikap: mulai dari yang ada sekarang. Walau cuma Rp10.000. Walau belum sempurna.</p>
<p>Menunda nabung sama saja membiarkan lahanmu kosong satu musim lagi. Lebih baik tanam sedikit hari ini daripada janji tanam banyak yang tak pernah jadi.</p>
HTML,
                        'action_text' => 'Sisihkan uang berapa pun hari ini, walau cuma Rp10.000, lalu pisahkan dari dompet harianmu.',
                    ],
                    [
                        'title' => 'Kamu Tidak Perlu Pintar, Kamu Perlu Konsisten',
                        'body' => <<<'HTML'
<p>Banyak orang takut belajar soal uang. Mereka pikir butuh pintar hitung, butuh sekolah tinggi, butuh paham istilah ribet.</p>
<p>Itu salah. Naik kelas tidak butuh otak encer. Yang dibutuhkan cuma satu: <strong>konsisten</strong>. Lakukan hal kecil yang benar, berulang-ulang, dalam waktu lama.</p>
<p>Bayangkan menetes air ke ember. Satu tetes tidak terasa. Tapi kalau menetes tiap hari bertahun-tahun, embernya penuh juga.</p>
<p>Nabung Rp10.000 sehari kelihatan tidak ada artinya. Tapi diulang tiap hari selama 10 tahun, itu jadi puluhan juta. Bukan karena kamu pintar, tapi karena kamu rajin.</p>
<p>Jadi jangan minder. Kamu tidak perlu jadi orang paling pintar. Kamu cukup jadi orang yang paling tidak gampang menyerah.</p>
HTML,
                        'action_text' => 'Pilih satu hal kecil soal uang yang sanggup kamu lakukan tiap hari tanpa berat, lalu tulis.',
                    ],
                    [
                        'title' => 'Lingkungan Bisa Menarikmu Turun',
                        'body' => <<<'HTML'
<p>Ada pepatah: kamu jadi mirip lima orang yang paling sering kamu temani.</p>
<p>Kalau teman-teman dekatmu suka pamer barang baru, suka ngajak nongkrong mahal, suka ngutang buat gaya, pelan-pelan kamu ikut. Bukan karena kamu lemah, tapi karena manusia ikut lingkungannya.</p>
<p>Sebaliknya, kalau kamu dekat dengan orang yang hemat, yang punya usaha kecil, yang suka belajar, kamu ikut naik juga.</p>
<p>Kamu tidak perlu memutus teman lama. Tapi <strong>jaga dirimu dari tekanan ikut-ikutan</strong>. Tidak semua ajakan harus dituruti. Tidak semua gaya teman harus ditiru.</p>
<p>Cari juga satu atau dua orang yang arahnya sama denganmu. Saling dukung untuk naik kelas, bukan saling ajak boros.</p>
HTML,
                        'action_text' => 'Tulis nama satu orang yang bisa kamu ajak sama-sama belajar mengatur uang.',
                    ],
                    [
                        'title' => 'Tulis Alasanmu yang Paling Kuat',
                        'body' => <<<'HTML'
<p>Perjalanan naik kelas itu panjang. Akan ada hari kamu malas. Akan ada hari kamu tergoda berhenti. Di hari-hari itu, yang menahanmu bukan ilmu, tapi <strong>alasanmu</strong>.</p>
<p>Alasan yang kuat itu yang menyentuh hati. Bukan "biar kaya". Tapi yang lebih dalam.</p>
<p>Mungkin: "Aku tidak mau orang tuaku susah di hari tua." Mungkin: "Aku tidak mau anakku merasakan miskin seperti aku dulu." Mungkin: "Aku mau berhenti kerja capek sebelum badanku rusak."</p>
<p>Alasan seperti itu yang membuatmu bangun lagi saat jatuh. Yang membuatmu bilang "tidak" pada godaan.</p>
<p>Tulis alasanmu sekarang, mumpung semangat. Simpan di tempat yang sering kamu lihat. Itu jangkar yang menahanmu saat ombak datang.</p>
HTML,
                        'action_text' => 'Tulis satu alasan terkuatmu kenapa kamu mau naik kelas, lalu simpan sebagai pengingat di HP.',
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
                        'title' => 'Hitung Penghasilan Aslimu',
                        'body' => <<<'HTML'
<p>Kalau ditanya, "Penghasilanmu berapa sebulan?", kebanyakan orang cuma sebut gaji pokok. Padahal itu sering bukan angka sebenarnya.</p>
<p>Penghasilan aslimu adalah <strong>semua uang yang masuk</strong>, dari mana pun. Gaji pokok, uang lembur, uang tip, bonus, uang dari jualan kecil, kiriman, apa pun.</p>
<p>Contoh. Gaji pokok Rp2.500.000. Tambah tip rata-rata Rp400.000. Tambah lembur Rp300.000. Tambah jualan pulsa Rp150.000. Total aslinya Rp3.350.000, bukan Rp2.500.000.</p>
<p>Kenapa ini penting? Karena kalau kamu cuma lihat gaji pokok, kamu merasa lebih miskin dari kenyataan, lalu pasrah. Padahal ada uang tip dan sampingan yang sering habis tanpa jejak.</p>
<p>Tahu angka aslimu bikin kamu sadar: ada lebih banyak yang bisa disisihkan daripada yang kamu kira.</p>
HTML,
                        'action_text' => 'Jumlahkan semua sumber uang masukmu bulan lalu, lalu tulis total penghasilan aslimu.',
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
                    [
                        'title' => 'Cari Lubang Bocor Terbesarmu',
                        'body' => <<<'HTML'
<p>Setelah mencatat seminggu, coba kelompokkan pengeluaranmu. Jangan lihat satu-satu, tapi per jenis.</p>
<p>Kumpulkan jadi beberapa kelompok: makan dan minum, rokok, transportasi, pulsa dan internet, jajan dan nongkrong, kirim keluarga.</p>
<p>Jumlahkan masing-masing kelompok. Lalu lihat: <strong>kelompok mana yang paling besar?</strong> Itu lubang bocor terbesarmu.</p>
<p>Sering kali yang bocor bukan kebutuhan pokok, tapi hal kecil yang sering: kopi, rokok, nongkrong, jajan online. Karena kecil, kita pikir tidak masalah. Padahal kalau dijumlah, itu yang menghabiskan.</p>
<p>Memperbaiki satu lubang terbesar lebih ampuh daripada pelit di sepuluh hal kecil. Tambal yang paling besar dulu.</p>
HTML,
                        'action_text' => 'Kelompokkan pengeluaran mingguanmu, lalu tulis kelompok mana yang paling besar.',
                    ],
                    [
                        'title' => 'Selisih: Angka Paling Penting dalam Hidupmu',
                        'body' => <<<'HTML'
<p>Dari semua angka soal uang, ada satu yang paling menentukan nasibmu. Bukan gaji. Bukan pengeluaran. Tapi <strong>selisih</strong> antara keduanya.</p>
<p>Selisih itu: uang masuk dikurangi uang keluar. Sisa inilah yang bisa kamu tabung dan tanam. Inilah benih masa depanmu.</p>
<p>Contoh. Penghasilan Rp3.350.000. Pengeluaran Rp3.300.000. Selisihnya cuma Rp50.000. Artinya, kerja sebulan penuh, yang jadi milikmu cuma Rp50.000.</p>
<p>Orang kaya tidak fokus menaikkan gaji saja. Mereka fokus melebarkan selisih. Caranya dua: naikkan penghasilan, atau turunkan pengeluaran. Paling kuat kalau dua-duanya.</p>
<p>Makin lebar selisihmu, makin cepat kamu naik kelas. Sempit selisih, lambat. Nol selisih, jalan di tempat selamanya.</p>
HTML,
                        'action_text' => 'Hitung selisihmu bulan lalu: penghasilan dikurangi pengeluaran. Tulis angkanya, walau kecil atau minus.',
                    ],
                    [
                        'title' => 'Pakai HP-mu: Aplikasi atau Buku Catatan',
                        'body' => <<<'HTML'
<p>Mencatat tidak harus repot. Alatnya sudah ada di tanganmu: HP.</p>
<p>Cara paling gampang: pakai aplikasi catatan biasa yang sudah ada di HP. Tiap keluar uang, tulis satu baris. Tanggal, untuk apa, berapa. Selesai.</p>
<p>Kalau mau lebih rapi, ada aplikasi pencatat keuangan gratis. Tinggal pilih masuk atau keluar, ketik angka, dia jumlahkan sendiri.</p>
<p>Tidak suka HP? Pakai buku tulis kecil di saku. Yang penting <strong>satu tempat saja</strong>, jangan tercecer. Catatan yang tercecer sama saja tidak mencatat.</p>
<p>Pilih satu cara yang paling kamu nyaman, lalu pakai itu terus. Alat termahal kalah dengan alat sederhana yang benar-benar kamu pakai tiap hari.</p>
HTML,
                        'action_text' => 'Pilih satu alat catatan (aplikasi catatan, aplikasi keuangan, atau buku kecil), lalu mulai pakai hari ini.',
                    ],
                    [
                        'title' => 'Cek Mingguan: Lima Menit Tiap Minggu',
                        'body' => <<<'HTML'
<p>Mencatat saja tidak cukup. Catatan yang tidak pernah dilihat sama seperti foto yang tidak pernah dibuka. Kamu harus <strong>meninjau</strong>.</p>
<p>Caranya gampang. Sekali seminggu, pilih satu waktu tenang. Misalnya Minggu malam. Buka catatanmu lima menit.</p>
<p>Tanya tiga hal: Minggu ini aku masuk berapa? Keluar berapa? Selisihnya berapa?</p>
<p>Lalu satu pertanyaan jujur: "Ada pengeluaran yang aku sesali?" Kalau ada, minggu depan hati-hati di situ.</p>
<p>Cek rutin ini bikin uangmu tidak pernah lepas dari pandangan. Lima menit seminggu jauh lebih ampuh daripada panik sekali sebulan saat dompet sudah kosong.</p>
HTML,
                        'action_text' => 'Tentukan satu hari dan jam tetap tiap minggu untuk cek catatan uangmu, lalu pasang pengingat di HP.',
                    ],
                    [
                        'title' => 'Jujur pada Diri Sendiri',
                        'body' => <<<'HTML'
<p>Ada satu hal yang bisa merusak semua catatan: tidak jujur pada diri sendiri.</p>
<p>Banyak orang diam-diam tidak mencatat pengeluaran yang memalukan. Rokok tidak ditulis. Nongkrong tidak ditulis. Beli rokok teman tidak ditulis. Akhirnya catatannya bohong, dan dia membohongi dirinya sendiri.</p>
<p>Ingat: catatan ini cuma kamu yang lihat. Tidak ada yang menghakimi. Kalau kamu sembunyikan angka dari dirimu sendiri, kamu rugi sendiri.</p>
<p>Catat semua, apa adanya. Yang memalukan justru paling penting dicatat, karena di situlah sering bocornya.</p>
<p>Kejujuran kecil ini adalah pondasi. <strong>Kamu tidak bisa memperbaiki yang kamu sembunyikan.</strong> Berani lihat angka yang sebenarnya adalah langkah pertama orang yang naik kelas.</p>
HTML,
                        'action_text' => 'Tambahkan ke catatanmu satu pengeluaran yang biasanya kamu malas catat, mulai hari ini.',
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
                    [
                        'title' => 'Bikin Otomatis Supaya Tidak Lupa',
                        'body' => <<<'HTML'
<p>Manusia gampang lupa dan gampang tergoda. Kalau menyisihkan uang harus mengandalkan niat tiap bulan, suatu saat pasti bolong.</p>
<p>Solusinya: bikin <strong>otomatis</strong>. Atur supaya uang pindah sendiri ke tabungan, tanpa kamu harus mikir.</p>
<p>Banyak aplikasi punya fitur "setoran rutin" atau "auto debit". Kamu atur sekali: tiap tanggal gajian, sekian rupiah pindah otomatis ke reksadana atau tabungan emas.</p>
<p>Kalau belum pakai aplikasi, buat aturan keras untuk dirimu: begitu uang gaji di tangan, hari itu juga langsung pisahkan jatah tabungan. Jangan tunggu besok.</p>
<p>Kunci sukses menyisihkan uang adalah membuatnya terjadi tanpa perjuangan tiap kali. Atur sekali, jalan terus. Uang yang sudah pindah duluan tidak akan tergoda kamu pakai.</p>
HTML,
                        'action_text' => 'Atur setoran otomatis di aplikasimu, atau buat aturan "pisahkan di hari gajian juga", lalu tulis tanggalnya.',
                    ],
                    [
                        'title' => 'Naikkan Pelan-Pelan Tiap Gaji Naik',
                        'body' => <<<'HTML'
<p>Hari ini kamu mungkin sanggup menyisihkan 10 persen. Itu bagus. Tapi jangan berhenti di situ selamanya.</p>
<p>Setiap kali penghasilanmu naik, jangan langsung naikkan gaya hidup. Naikkan dulu jatah tabunganmu. Ini trik diam-diam yang membuat orang kaya makin kaya.</p>
<p>Contoh. Gajimu naik Rp300.000. Kebanyakan orang langsung pakai semua untuk hidup lebih enak. Kamu, pakai setengahnya untuk hidup, setengahnya lagi tambahkan ke tabungan.</p>
<p>Dengan cara ini, kamu tetap merasa lebih lega tiap gaji naik, tapi tabunganmu juga ikut bertambah. Tidak ada yang dikorbankan habis.</p>
<p>Naik dari 10 persen ke 15 persen, lalu 20 persen, pelan-pelan. <strong>Setiap kenaikan gaji adalah kesempatan menabung lebih, bukan alasan boros lebih.</strong></p>
HTML,
                        'action_text' => 'Tulis janji untuk dirimu: "Setiap gajiku naik, separuh kenaikannya masuk tabungan."',
                    ],
                    [
                        'title' => 'Kalau Penghasilanmu Tidak Tetap',
                        'body' => <<<'HTML'
<p>Tidak semua orang punya gaji tetap. Banyak yang penghasilannya naik turun: tergantung tip, tergantung order, tergantung musim ramai.</p>
<p>Kalau begitu, cara menyisihkannya sedikit beda. Jangan tentukan angka tetap yang kaku. Tentukan <strong>persen</strong>, bukan jumlah.</p>
<p>Aturannya: tiap kali ada uang masuk, berapa pun, langsung sisihkan 10 persennya. Hari ramai dapat Rp200.000, sisihkan Rp20.000. Hari sepi dapat Rp50.000, sisihkan Rp5.000.</p>
<p>Dengan cara persen, kamu otomatis nabung banyak saat rezeki banyak, dan nabung sedikit saat sedang seret. Adil dan tetap jalan.</p>
<p>Saat dapat rezeki besar mendadak, seperti bonus atau THR, godaan paling kuat. Justru di situ paling penting: sisihkan dulu bagiannya sebelum hilang.</p>
HTML,
                        'action_text' => 'Buat aturan persen untuk dirimu, lalu praktikkan: sisihkan 10 persen dari uang masuk berikutnya, berapa pun jumlahnya.',
                    ],
                    [
                        'title' => 'Bayar Dirimu Sebelum Bayar Siapa Pun',
                        'body' => <<<'HTML'
<p>Coba bayangkan urutan uangmu tiap gajian. Siapa yang kamu bayar duluan?</p>
<p>Kebanyakan orang membayar dunia luar dulu. Bayar utang, bayar warung, bayar pulsa, bayar jajan, bayar orang lain. Dirinya sendiri dibayar paling akhir, dari sisa yang biasanya nol.</p>
<p>Padahal kamu yang kerja paling keras. Kenapa kamu yang dapat bagian paling akhir dan paling sedikit?</p>
<p>Balik. <strong>Bayar dirimu sendiri lebih dulu.</strong> Begitu uang masuk, ambil dulu jatah tabunganmu, anggap itu tagihan paling penting. Tagihan untuk masa depanmu.</p>
<p>Dirimu di umur 40 sedang menunggu kiriman dari dirimu yang sekarang. Jangan biarkan dia menunggu sisa yang tak pernah ada. Kirim dulu, baru urus yang lain.</p>
HTML,
                        'action_text' => 'Di gajian berikutnya, pindahkan jatah tabungan SEBELUM membayar apa pun yang lain, lalu catat bahwa kamu berhasil.',
                    ],
                    [
                        'title' => 'Rayakan Setoran, Bukan Belanja',
                        'body' => <<<'HTML'
<p>Banyak orang merasa senang saat belanja. Beli barang baru, ada rasa puas sebentar. Lalu uangnya hilang dan barangnya jadi biasa.</p>
<p>Coba latih perasaan baru: <strong>merasa senang saat menabung</strong>. Saat angka tabunganmu naik, itu kemenangan. Rayakan dalam hati.</p>
<p>Bayangkan kambingmu bertambah satu. Bayangkan pohonmu bertambah tinggi. Tiap setoran adalah satu langkah lebih dekat ke bebas.</p>
<p>Lihat angka tabunganmu naik tiap bulan. Rasakan bangganya. Itu rasa yang lebih awet daripada senang sesaat membeli barang.</p>
<p>Orang yang bisa menikmati proses menabung tidak akan menyerah. Karena buat dia, menabung bukan siksaan, tapi kemenangan kecil tiap bulan.</p>
HTML,
                        'action_text' => 'Setelah setoran berikutnya, lihat total tabunganmu dan tulis satu kalimat bangga untuk dirimu sendiri.',
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
                        'title' => 'Tes 24 Jam Sebelum Beli',
                        'body' => <<<'HTML'
<p>Banyak uang habis bukan karena kebutuhan, tapi karena <strong>tergoda saat itu juga</strong>. Lihat barang bagus, langsung beli. Lihat diskon, langsung checkout. Besoknya menyesal.</p>
<p>Ada senjata sederhana melawan ini: tes 24 jam. Aturannya gampang. Untuk barang yang bukan kebutuhan mendesak, tunggu satu hari sebelum membeli.</p>
<p>Lihat barang yang kamu mau. Catat. Lalu pulang. Besok, tanya lagi: "Aku masih benar-benar mau ini, atau cuma tergoda kemarin?"</p>
<p>Sering kali, setelah sehari, keinginannya hilang sendiri. Kamu baru saja menyelamatkan uangmu tanpa merasa tersiksa.</p>
<p>Untuk barang besar, perpanjang jadi seminggu. Makin mahal barangnya, makin lama waktu tunggunya. Godaan kuat di awal, tapi cepat memudar kalau diberi waktu.</p>
HTML,
                        'action_text' => 'Praktikkan tes 24 jam pada satu keinginan berikutnya, lalu tulis apakah kamu jadi beli atau tidak.',
                    ],
                    [
                        'title' => 'Gengsi Itu Mahal',
                        'body' => <<<'HTML'
<p>Banyak uang habis bukan untuk diri sendiri, tapi untuk dilihat orang lain. Itu namanya gengsi. Dan gengsi itu mahal sekali.</p>
<p>HP baru biar tidak malu. Rokok merek mahal biar dianggap mapan. Traktir teman biar dianggap royal. Motor dimodifikasi biar keren. Semua demi pandangan orang.</p>
<p>Padahal, orang yang kamu pamerkan itu tidak ikut menanggung saat akhir bulan kamu kesusahan. Mereka cuma melihat sebentar, lalu lupa.</p>
<p>Orang yang benar-benar naik kelas justru sering kelihatan biasa saja. Bajunya sederhana, HP-nya cukup. Tapi diam-diam dia punya kambing, punya tabungan, punya tanah.</p>
<p><strong>Kaya beneran itu di rekening, bukan di penampilan.</strong> Lebih baik terlihat biasa tapi tenang, daripada terlihat wah tapi dikejar cicilan.</p>
HTML,
                        'action_text' => 'Tulis satu pengeluaran gengsi yang selama ini kamu lakukan, lalu putuskan untuk berhenti atau menguranginya.',
                    ],
                    [
                        'title' => 'Diskon Sering Jadi Jebakan',
                        'body' => <<<'HTML'
<p>"Mumpung diskon!" Kalimat ini sudah menghabiskan uang banyak orang. Diskon kelihatan seperti menghemat. Padahal sering jadi jebakan.</p>
<p>Pikir baik-baik. Kalau kamu beli barang yang tidak kamu butuhkan karena diskon 50 persen, kamu tidak menghemat 50 persen. Kamu <strong>menghabiskan 50 persen</strong> untuk barang yang tadinya tidak kamu perlu.</p>
<p>Toko dan aplikasi pintar. Mereka pasang diskon, gratis ongkir, beli satu gratis satu, supaya tanganmu gatal belanja. Itu memang dirancang untuk membuatmu lapar mata.</p>
<p>Diskon baru benar-benar hemat kalau dua syarat terpenuhi: barangnya memang sudah kamu butuhkan, dan kamu memang sudah berencana membelinya.</p>
<p>Kalau cuma kepincut karena murah, tahan. Murah yang tidak kamu butuh tetap saja membuang uang.</p>
HTML,
                        'action_text' => 'Lain kali lihat diskon, tanya: "Apakah aku akan beli ini kalau tidak ada diskon?" Tulis jawabannya sebelum membeli.',
                    ],
                    [
                        'title' => 'Bedakan Murah dan Hemat',
                        'body' => <<<'HTML'
<p>Banyak orang mengira hemat berarti selalu beli yang paling murah. Itu tidak selalu benar. Kadang yang murah justru bikin boros.</p>
<p>Contoh. Kamu beli sepatu kerja murah Rp50.000. Tiga bulan rusak. Setahun kamu beli empat kali, total Rp200.000. Kalau dari awal beli yang Rp150.000 dan tahan dua tahun, kamu lebih hemat.</p>
<p>Itu bedanya murah dan hemat. <strong>Murah itu soal harga sekarang. Hemat itu soal biaya jangka panjang.</strong></p>
<p>Untuk barang yang dipakai terus dan harus awet, sepatu kerja, alat masak, ban motor, kadang lebih bijak beli yang sedikit lebih mahal tapi tahan lama.</p>
<p>Tapi untuk barang sekali pakai atau yang fungsinya sama saja, ambil yang murah. Pintar memilih kapan murah dan kapan kualitas, itu seni berhemat sebenarnya.</p>
HTML,
                        'action_text' => 'Pikirkan satu barang yang sering kamu beli ulang karena cepat rusak, lalu pertimbangkan beli yang lebih awet.',
                    ],
                    [
                        'title' => 'Anggaran Sederhana: Bagi Uangmu Tiga Kantong',
                        'body' => <<<'HTML'
<p>Mengatur uang jadi gampang kalau dibagi dalam kantong. Ada cara sederhana yang dipakai banyak orang: bagi tiga.</p>
<p>Begitu uang masuk, bagi jadi tiga kantong:</p>
<ul>
<li><strong>Kantong kebutuhan</strong>, sekitar separuh uangmu. Untuk makan, sewa, transport, hal wajib.</li>
<li><strong>Kantong keinginan</strong>, sekitar tiga dari sepuluh bagian. Untuk senang-senang secukupnya: jajan, nongkrong, hiburan.</li>
<li><strong>Kantong masa depan</strong>, sisanya. Untuk tabungan, dana darurat, dan aset yang tumbuh.</li>
</ul>
<p>Angka ini tidak kaku. Kalau bisa, perkecil keinginan, perbesar masa depan. Tapi yang penting: kantong masa depan jangan pernah nol.</p>
<p>Dengan membagi sejak awal, kamu tidak akan kaget di tengah bulan. Tiap kantong tahu tugasnya. Kamu boleh menikmati hidup, asal tetap mengisi kantong masa depan.</p>
HTML,
                        'action_text' => 'Bagi penghasilanmu bulan ini ke tiga kantong, lalu tulis angka rupiah untuk masing-masing.',
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
                    [
                        'title' => 'Ngomong "Tidak" dengan Tenang',
                        'body' => <<<'HTML'
<p>Banyak uang bocor karena kita tidak enak menolak. Diajak nongkrong, ikut. Diminta traktir, kasih. Diajak patungan ini-itu, iya saja. Padahal hati berat.</p>
<p>Belajar bilang "tidak" dengan tenang adalah keahlian uang yang penting. Bukan jadi pelit, tapi jadi punya batas.</p>
<p>Kamu tidak perlu marah atau berbohong. Cukup jujur dan ramah. Beberapa kalimat yang bisa kamu pakai:</p>
<ul>
<li>"Aku ikut kumpul, tapi aku sudah makan dari rumah, ya."</li>
<li>"Maaf, bulan ini aku lagi ketat. Lain kali."</li>
<li>"Aku lagi nabung buat sesuatu yang penting. Doain ya."</li>
</ul>
<p>Orang yang benar-benar menghargaimu tidak akan tersinggung. Yang tersinggung karena kamu tidak boros, itu bukan teman yang menjaga masa depanmu. <strong>Batasmu adalah hakmu.</strong></p>
HTML,
                        'action_text' => 'Hafalkan satu kalimat menolak yang nyaman buatmu, lalu pakai saat ada ajakan yang tidak perlu.',
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
                    [
                        'title' => 'Berapa Besar Dana Daruratmu?',
                        'body' => <<<'HTML'
<p>Target akhir dana darurat itu beda-beda tiap orang. Tergantung satu hal: seberapa pasti penghasilanmu, dan berapa banyak yang bergantung padamu.</p>
<p>Aturannya pakai <strong>biaya hidup bulanan</strong>, bukan gaji. Hitung dulu: sebulan kamu butuh berapa untuk bertahan hidup tanpa pemasukan? Misal Rp2 juta.</p>
<p>Kalau kamu masih lajang dan gajimu cukup pasti, target 3 bulan biaya hidup sudah lumayan aman. Berarti Rp6 juta.</p>
<p>Kalau kamu sudah punya tanggungan, anak atau orang tua, atau penghasilanmu naik turun, targetnya lebih besar: 6 bulan biaya hidup. Berarti Rp12 juta.</p>
<p>Makin banyak orang yang bergantung padamu, makin tebal payung yang kamu perlu. Hitung angkamu sendiri, jangan pakai angka orang lain.</p>
HTML,
                        'action_text' => 'Hitung biaya hidupmu sebulan, kalikan 3 sampai 6, lalu tulis target dana daruratmu.',
                    ],
                    [
                        'title' => 'Apa yang Boleh dan Tidak Boleh Diambil',
                        'body' => <<<'HTML'
<p>Dana darurat cuma berguna kalau kamu disiplin soal kapan boleh dipakai. Kalau diambil untuk apa saja, namanya bukan dana darurat lagi, tapi dompet kedua.</p>
<p>Dana darurat <strong>boleh</strong> dipakai untuk hal yang mendesak, tak terduga, dan penting. Contoh: berobat mendadak, motor rusak yang dipakai kerja, kehilangan pekerjaan, atap bocor parah.</p>
<p>Dana darurat <strong>tidak boleh</strong> dipakai untuk hal yang sebenarnya keinginan. Contoh: diskon HP, ganti motor karena bosan, liburan, kondangan besar, ikut arisan.</p>
<p>Tes sederhananya tiga pertanyaan: Apakah ini mendesak? Apakah ini tak terduga? Apakah kalau dibiarkan akan jadi masalah besar? Kalau tiga-tiganya ya, baru ambil.</p>
<p>Diskon bukan darurat. Keinginan bukan darurat. Jaga ketat pintu ini, karena payung yang bocor tidak melindungimu saat hujan deras.</p>
HTML,
                        'action_text' => 'Tulis aturan pribadimu: tiga jenis kejadian yang boleh memakai dana darurat. Tempel di dekat catatanmu.',
                    ],
                    [
                        'title' => 'Isi Lagi Setelah Terpakai',
                        'body' => <<<'HTML'
<p>Suatu hari dana daruratmu akan terpakai. Itu bukan kegagalan, justru itu tugasnya. Payung memang untuk dipakai saat hujan.</p>
<p>Tapi ada satu langkah yang sering dilupakan: <strong>mengisinya lagi</strong>. Setelah badai lewat, payungmu harus disiapkan untuk badai berikutnya.</p>
<p>Contoh. Dana daruratmu Rp6 juta. Motor rusak, terpakai Rp2 juta. Sekarang tinggal Rp4 juta. Tugasmu berikutnya: kembalikan ke Rp6 juta pelan-pelan.</p>
<p>Caranya sama seperti mengumpulkannya dulu. Sisihkan tiap gajian sampai penuh lagi. Anggap mengisi ulang ini prioritas, sebelum menambah investasi lain.</p>
<p>Hidup tidak cuma kasih satu masalah seumur hidup. Selalu ada kejutan berikutnya. Yang punya payung selalu siap adalah yang tidak pernah lari ke pinjol.</p>
HTML,
                        'action_text' => 'Buat janji: kalau dana daruratmu terpakai, mengisinya kembali jadi prioritas utama setoran berikutnya.',
                    ],
                    [
                        'title' => 'Jangan Campur dengan Tabungan Tujuan',
                        'body' => <<<'HTML'
<p>Banyak orang menabung untuk macam-macam tujuan. Tabungan nikah. Tabungan beli motor. Tabungan modal usaha. Itu bagus. Tapi awas satu hal.</p>
<p>Tabungan tujuan <strong>jangan dicampur</strong> dengan dana darurat. Kalau dicampur, saat darurat datang, kamu makan tabungan nikahmu. Atau saat mau beli motor, dana daruratmu habis.</p>
<p>Pisahkan dalam kantong-kantong berbeda. Satu kantong khusus dana darurat, tidak diutak-atik kecuali benar-benar darurat. Kantong lain untuk tiap tujuan.</p>
<p>Zaman sekarang gampang. Banyak aplikasi tabungan dan reksadana memungkinkan kamu buat beberapa "dompet" atau "tujuan" terpisah dalam satu akun.</p>
<p>Dengan dipisah, kamu tahu persis: ini untuk apa, sudah berapa. Tidak saling makan. Tiap kantong punya tugasnya sendiri, dan tidak ada yang jebol diam-diam.</p>
HTML,
                        'action_text' => 'Pisahkan dana daruratmu dari tabungan tujuan lain, lalu beri nama tiap kantong dengan jelas.',
                    ],
                    [
                        'title' => 'Lapis Kedua: Lindungi dari Musibah Besar',
                        'body' => <<<'HTML'
<p>Dana darurat bagus untuk masalah kecil dan menengah. Tapi ada musibah yang terlalu besar untuk ditambal tabungan, terutama sakit berat atau kecelakaan.</p>
<p>Biaya rumah sakit bisa puluhan juta dalam beberapa hari. Itu bisa menghabiskan dana darurat dan semua asetmu sekaligus. Untuk ini, kamu butuh lapis kedua: <strong>perlindungan kesehatan</strong>.</p>
<p>Yang paling dasar dan murah: BPJS Kesehatan. Iurannya kecil tiap bulan, tapi menanggung biaya berobat dan rawat inap yang besar. Pastikan kamu dan keluargamu terdaftar dan iurannya aktif.</p>
<p>Ini bukan pengeluaran sia-sia. Ini seperti payung untuk badai besar yang jarang datang, tapi kalau datang bisa menghanyutkan semua.</p>
<p>Satu kali sakit besar tanpa perlindungan bisa menghapus kerja kerasmu bertahun-tahun. Iuran kecil tiap bulan jauh lebih murah daripada kehilangan semua.</p>
HTML,
                        'action_text' => 'Cek status BPJS Kesehatanmu dan keluargamu. Kalau belum aktif, urus pendaftarannya bulan ini.',
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
                        'title' => 'Bahaya Pinjol dan Rentenir',
                        'body' => <<<'HTML'
<p>Ada satu jenis utang yang harus kamu hindari sebisa mungkin: pinjol nakal dan rentenir. Mereka kelihatan menolong, padahal menjerat.</p>
<p>Mereka memang gampang. Pinjam cepat, cair dalam menit, tidak banyak tanya. Tapi di balik itu, bunganya mencekik. Pinjol nakal bisa mengenakan bunga yang membuat utangmu berlipat dalam hitungan bulan.</p>
<p>Contoh nyata. Pinjam Rp1.000.000. Beberapa bulan kemudian harus bayar Rp2.500.000 atau lebih. Telat sedikit, denda menumpuk. Lalu mereka teror, hubungi semua kontakmu, mempermalukanmu.</p>
<p>Banyak orang baik hancur hidupnya bukan karena miskin, tapi karena terjerat pinjol. Satu pinjaman kecil menyeret ke pinjaman berikutnya untuk menutup yang lama.</p>
<p>Aturannya keras: <strong>jangan pernah pakai pinjol untuk konsumtif.</strong> Untuk darurat pun, dana daruratmu jauh lebih aman. Inilah kenapa kita siapkan payung lebih dulu.</p>
HTML,
                        'action_text' => 'Kalau ada aplikasi pinjol di HP-mu yang dipakai untuk konsumtif, niatkan lunasi dan hapus. Tulis rencananya.',
                    ],
                    [
                        'title' => 'Paylater dan Kartu Kredit: Pisau Bermata Dua',
                        'body' => <<<'HTML'
<p>Paylater dan kartu kredit ada di mana-mana sekarang. "Beli sekarang, bayar nanti." Kedengarannya enak. Tapi ini pisau bermata dua.</p>
<p>Masalahnya, paylater membuat kamu merasa <strong>seperti punya uang yang sebenarnya belum kamu punya</strong>. Jadi gampang belanja melebihi kemampuan. Lalu tagihan datang, dan bunganya menggigit kalau telat.</p>
<p>Banyak orang terjebak: pakai paylater untuk hal kecil, lupa, menumpuk, lalu kaget saat total tagihan keluar. Bunga dan denda bikin barang yang tadinya murah jadi mahal.</p>
<p>Bukan berarti haram mutlak. Buat orang yang sangat disiplin, kartu kredit bisa dibayar penuh tiap bulan tanpa bunga. Tapi kalau kamu belum yakin bisa disiplin, lebih aman jauhi dulu.</p>
<p>Aturan amannya: kalau kamu tidak punya uangnya sekarang untuk membeli tunai, kamu belum mampu membelinya. Titik. Jangan beli pakai uang masa depan untuk gaya hari ini.</p>
HTML,
                        'action_text' => 'Cek semua paylater dan cicilan aktifmu, jumlahkan total tagihannya, lalu tulis angkanya.',
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
                    [
                        'title' => 'Dua Cara Lunasi Utang: Bola Salju vs Bunga Tertinggi',
                        'body' => <<<'HTML'
<p>Kalau utangmu lebih dari satu, ada dua cara terkenal untuk melunasinya. Pilih yang paling cocok dengan dirimu.</p>
<p><strong>Cara bunga tertinggi.</strong> Bayar dulu utang yang bunganya paling besar, sambil yang lain bayar minimal. Ini cara paling hemat uang, karena bunga besar yang paling cepat memakanmu. Secara hitungan, ini yang paling cerdas.</p>
<p><strong>Cara bola salju.</strong> Bayar dulu utang yang jumlahnya paling kecil sampai lunas, apa pun bunganya. Lalu pindah ke yang berikutnya. Tiap utang yang lunas memberi semangat. Ini cara paling kuat untuk menjaga semangat.</p>
<p>Mana yang lebih baik? Kalau kamu butuh hemat maksimal, pilih bunga tertinggi. Kalau kamu butuh rasa menang supaya tidak menyerah, pilih bola salju.</p>
<p>Yang terburuk adalah tidak pakai cara apa pun, cuma bayar asal-asalan. Pilih satu cara, lalu ikuti sampai semua utang buruk habis.</p>
HTML,
                        'action_text' => 'Pilih satu cara melunasi utang (bunga tertinggi atau bola salju), lalu tulis utang mana yang kamu serang pertama.',
                    ],
                    [
                        'title' => 'Jangan Gali Lubang Tutup Lubang',
                        'body' => <<<'HTML'
<p>Ada jebakan paling berbahaya saat terlilit utang: berutang baru untuk membayar utang lama. Orang menyebutnya gali lubang tutup lubang.</p>
<p>Awalnya terasa melegakan. Utang A jatuh tempo, kamu pinjam dari B untuk bayar A. Masalah hari ini selesai. Tapi sebenarnya kamu cuma memindahkan masalah, dan sering menambah bunga baru di atasnya.</p>
<p>Lama-lama lubangnya makin dalam dan makin banyak. B jatuh tempo, pinjam C. C jatuh tempo, pinjam D. Sampai tidak ada lagi yang mau meminjami. Lalu hancur.</p>
<p>Jalan keluar yang benar bukan menambah lubang, tapi <strong>mengurangi pengeluaran dan menambah pemasukan</strong>, lalu bayar utang dari selisihnya. Pelan, tapi benar-benar mengecil.</p>
<p>Kalau sudah sangat terjepit, lebih baik bicara jujur dengan yang memberi utang untuk minta keringanan, daripada lari ke pinjaman baru. Berhenti menggali adalah langkah pertama keluar dari lubang.</p>
HTML,
                        'action_text' => 'Janji pada dirimu: tidak akan berutang baru untuk bayar utang lama. Tulis janji ini dan simpan.',
                    ],
                    [
                        'title' => 'Kapan Utang Benar-Benar Masuk Akal',
                        'body' => <<<'HTML'
<p>Setelah semua peringatan ini, apakah utang selalu jahat? Tidak. Utang baik ada, dan kadang justru mempercepat kamu naik kelas. Tapi syaratnya ketat.</p>
<p>Utang masuk akal kalau memenuhi beberapa syarat sekaligus:</p>
<ul>
<li>Untuk <strong>aset yang menghasilkan</strong>, bukan barang konsumtif. Contoh: alat usaha, indukan ternak, gerobak jualan.</li>
<li>Hasil dari aset itu <strong>lebih besar dari cicilan dan bunganya</strong>. Aset membayar utangnya sendiri, masih sisa untukmu.</li>
<li>Bunganya wajar, bukan pinjol mencekik.</li>
<li>Cicilannya masih sanggup kamu bayar walau usaha sedang sepi.</li>
</ul>
<p>Kalau satu syarat saja tidak terpenuhi, tunda dulu. Lebih baik kumpulkan modal sendiri pelan-pelan daripada berutang sembarangan.</p>
<p>Utang itu seperti api: bisa memasak, bisa membakar. Dipakai dengan aturan ketat, dia alat. Dipakai sembarangan, dia bencana.</p>
HTML,
                        'action_text' => 'Pikirkan satu rencana utang yang pernah terlintas, lalu uji dengan empat syarat di atas. Tulis lolos atau tidak.',
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
                    [
                        'title' => 'Keajaiban Waktu: Tiap Tahun Berharga',
                        'body' => <<<'HTML'
<p>Bunga berbunga punya satu sahabat sejati: waktu. Makin lama uangmu beranak, makin gila hasilnya di akhir. Dan bedanya tidak kecil.</p>
<p>Bayangkan dua orang menabung jumlah sama tiap bulan, dengan untung sama. Bedanya cuma kapan mulai.</p>
<p>Yang mulai umur 25 dan berhenti menyetor umur 40, lalu dibiarkan sampai 50, hasilnya bisa jauh lebih besar daripada yang baru mulai umur 35. Padahal yang mulai 35 menyetor lebih lama.</p>
<p>Kok bisa? Karena tahun-tahun paling awal itu yang anaknya punya waktu paling panjang untuk beranak lagi. <strong>Satu tahun di awal lebih berharga daripada satu tahun di akhir.</strong></p>
<p>Inilah kenapa "nanti saja" itu mahal. Tiap tahun kamu menunda, kamu membuang tahun yang paling berharga. Mulai sekarang, walau kecil, kalahkan mulai besar tapi terlambat.</p>
HTML,
                        'action_text' => 'Hitung: kalau kamu mulai sekarang sampai umur 40, itu berapa tahun uangmu punya waktu untuk beranak? Tulis angkanya.',
                    ],
                    [
                        'title' => 'Setor Kecil Tapi Rutin Mengalahkan Setor Besar Sekali',
                        'body' => <<<'HTML'
<p>Banyak orang menunggu punya uang banyak dulu baru mulai investasi. "Nanti kalau sudah ada Rp10 juta baru mulai." Itu cara berpikir yang membuat orang tidak pernah mulai.</p>
<p>Kebenarannya: <strong>setoran kecil yang rutin biasanya menang</strong> melawan setoran besar sekali yang menunggu lama.</p>
<p>Contoh. Si A menabung Rp200.000 tiap bulan, mulai sekarang. Si B menunggu sampai punya Rp10 juta sekaligus, yang butuh bertahun-tahun mengumpulkan dulu. Saat B baru mulai, uang A sudah beranak bertahun-tahun.</p>
<p>Menyetor rutin juga melatih kebiasaan. Tiap bulan kamu menanam, jadi otot disiplinmu makin kuat. Yang menunggu uang besar sering kehilangan momen dan tidak pernah benar-benar mulai.</p>
<p>Jangan tunggu jumlah besar. Mulai dari yang kamu sanggup hari ini, walau Rp50.000 sebulan. Yang penting rutin dan tidak berhenti. Konsistensi mengalahkan jumlah.</p>
HTML,
                        'action_text' => 'Tentukan satu angka kecil yang pasti sanggup kamu setor tiap bulan tanpa bolong, lalu mulai bulan ini.',
                    ],
                    [
                        'title' => 'Musuh Kambing: Menjual Saat Panik',
                        'body' => <<<'HTML'
<p>Ada satu kesalahan yang menghancurkan hasil bunga berbunga: menjual saat panik.</p>
<p>Begini biasanya. Harga emas atau reksadana turun sebentar. Berita ramai bilang ekonomi jelek. Hatimu takut. Lalu kamu jual semua karena ngeri rugi lebih banyak.</p>
<p>Padahal turun naik itu hal biasa untuk aset yang tumbuh. Seperti cuaca: ada hujan, ada panas. Petani yang panik mencabut tanamannya tiap kali mendung tidak akan pernah panen.</p>
<p>Yang menjual saat panik mengubah penurunan sementara jadi kerugian beneran. Padahal kalau ditahan, biasanya harga naik lagi setelah badai lewat.</p>
<p><strong>Aset yang tumbuh diukur dalam tahun, bukan hari.</strong> Selama uang itu memang untuk jangka panjang dan bukan dana darurat, biarkan saja saat turun. Jangan biarkan rasa takut sesaat menjual masa depanmu.</p>
HTML,
                        'action_text' => 'Tulis janji: "Aku tidak akan menjual asetku hanya karena harganya turun sementara." Simpan untuk pengingat.',
                    ],
                    [
                        'title' => 'Inflasi: Pencuri Diam-Diam',
                        'body' => <<<'HTML'
<p>Ada pencuri yang masuk ke rumahmu tiap tahun tanpa ketahuan. Tidak membawa linggis, tidak membongkar pintu. Namanya <strong>inflasi</strong>.</p>
<p>Inflasi artinya harga barang naik pelan-pelan tiap tahun. Yang dulu Rp10.000 dapat banyak, sekarang dapat sedikit. Uang yang sama, nilainya menyusut.</p>
<p>Contoh. Uang Rp1 juta kamu simpan di laci. Sepuluh tahun lagi jumlahnya tetap Rp1 juta, tapi yang bisa dibeli mungkin tinggal separuh. Diam-diam dicuri inflasi.</p>
<p>Itu sebabnya menyimpan uang di laci atau di tabungan bunga sangat kecil sebenarnya bikin rugi pelan-pelan. Uangmu kalah lari dari kenaikan harga.</p>
<p>Lawannya: taruh uang di aset yang ikut naik nilainya, seperti emas, reksadana, atau kambing. Aset yang tumbuh lebih cepat dari inflasi membuat uangmu tetap menang, bukan dimakan diam-diam.</p>
HTML,
                        'action_text' => 'Tulis satu barang yang harganya kamu ingat naik dalam 5 tahun terakhir, sebagai bukti inflasi itu nyata.',
                    ],
                    [
                        'title' => 'Putar Anaknya, Jangan Dimakan',
                        'body' => <<<'HTML'
<p>Kita kembali ke inti prinsip kambing, karena ini yang paling sering gagal dijalankan. Saat asetmu mulai memberi hasil, godaan terbesar muncul: memakan hasilnya.</p>
<p>Reksadanamu memberi untung. Kambingmu beranak. Warungmu mulai laba. Hatimu bilang, "Sekarang aku boleh menikmati ini." Sebagian boleh. Tapi jangan semua.</p>
<p>Orang yang naik kelas <strong>memutar kembali hasilnya</strong>. Untung reksadana dibelikan unit baru. Anak kambing dipelihara jadi induk baru. Laba warung dipakai menambah dagangan.</p>
<p>Dengan memutar hasil, bukan cuma modalmu yang bekerja, tapi anak-anaknya ikut bekerja. Inilah yang membuat pertumbuhan makin lama makin cepat, seperti bola salju yang menggelinding.</p>
<p>Bayangkan dua petani. Yang satu memakan tiap anak kambing. Yang satu memutar terus. Sepuluh tahun lagi, yang satu masih punya dua kambing, yang satu punya kandang penuh. Putar dulu, nikmati nanti.</p>
HTML,
                        'action_text' => 'Tentukan satu hasil dari asetmu yang akan kamu putar kembali, bukan kamu pakai, lalu tulis komitmennya.',
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
                        'title' => 'Hubungan Untung dan Risiko',
                        'body' => <<<'HTML'
<p>Sebelum memilih tempat menaruh uang, pahami satu hukum yang tidak pernah bohong: <strong>makin besar janji untung, makin besar risikonya.</strong></p>
<p>Tidak ada untung besar tanpa risiko. Kalau ada yang menjanjikan untung besar tanpa risiko, hampir pasti itu penipuan. Ingat baik-baik kalimat ini.</p>
<p>Tabungan dan reksadana pasar uang: untung kecil, tapi sangat aman. Cocok untuk dana darurat dan pemula.</p>
<p>Emas: untung sedang, risiko sedang, nilainya bisa naik turun tapi cenderung naik jangka panjang.</p>
<p>Usaha sendiri seperti warung: untung bisa besar, tapi risiko juga besar, bisa rugi kalau sepi. Karena itu kita naik bertahap: kuat dulu di yang aman, baru berani ambil yang risikonya lebih besar dengan uang yang kamu sanggup kehilangan.</p>
HTML,
                        'action_text' => 'Tulis ulang kalimat ini untuk dirimu: "Untung besar tanpa risiko = penipuan." Ingat-ingat selalu.',
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
                        'title' => 'Awas Investasi Bodong',
                        'body' => <<<'HTML'
<p>Ini pelajaran yang bisa menyelamatkan uangmu bertahun-tahun. Di luar sana banyak <strong>investasi bodong</strong>, alias penipuan berkedok investasi.</p>
<p>Ciri-cirinya hampir selalu sama. Mereka menjanjikan untung besar dan cepat. "Untung 10 persen sebulan, pasti, tanpa risiko." "Modal Rp1 juta jadi Rp3 juta dalam dua bulan." Itu mustahil dan itu jebakan.</p>
<p>Cara kerjanya: uang dari anggota baru dipakai membayar anggota lama, supaya kelihatan benar-benar untung. Selama masih banyak yang masuk, aman. Begitu setoran baru seret, bandar kabur, dan semua uang hilang.</p>
<p>Tanda bahaya lain: kamu disuruh mengajak orang lain untuk dapat bonus. Untungnya dari merekrut, bukan dari usaha nyata. Itu skema piramida.</p>
<p>Aturan keras: <strong>kalau untungnya terlalu indah untuk jadi nyata, itu memang tidak nyata.</strong> Uang yang lambat tapi pasti jauh lebih baik daripada cepat tapi hilang. Lebih baik ketinggalan "peluang" daripada kehilangan tabungan.</p>
HTML,
                        'action_text' => 'Tulis tiga ciri investasi bodong, lalu simpan supaya kamu ingat saat ada tawaran mencurigakan.',
                    ],
                    [
                        'title' => 'Cek Izin OJK Sebelum Taruh Uang',
                        'body' => <<<'HTML'
<p>Bagaimana cara membedakan tempat investasi yang aman dari yang penipu? Ada satu pegangan sederhana: <strong>izin resmi</strong>.</p>
<p>Di Indonesia, lembaga keuangan yang sah harus terdaftar dan diawasi OJK, yaitu Otoritas Jasa Keuangan. Untuk yang sesuai syariah, ada juga pengawasan tambahan. Lembaga resmi tidak akan kabur membawa uangmu, karena diawasi negara.</p>
<p>Sebelum menaruh uang di aplikasi atau perusahaan mana pun, cek dulu: apakah mereka terdaftar di OJK? Kamu bisa tanya, bisa cari di daftar resmi OJK, atau telepon layanan OJK.</p>
<p>Aplikasi reksadana dan tabungan emas yang besar dan terkenal umumnya sudah berizin. Tapi tetap biasakan mengecek, jangan asal percaya iklan.</p>
<p>Aturannya gampang: <strong>tidak ada izin OJK, tidak masuk uang.</strong> Lebih baik repot mengecek sebentar daripada menyesal kehilangan tabungan seumur hidup.</p>
HTML,
                        'action_text' => 'Sebelum pakai aplikasi investasi apa pun, cek apakah ia terdaftar OJK, lalu tulis hasilnya.',
                    ],
                    [
                        'title' => 'Jangan Taruh Semua Telur di Satu Keranjang',
                        'body' => <<<'HTML'
<p>Ada pepatah tua yang sangat berguna soal uang: <strong>jangan taruh semua telur di satu keranjang.</strong></p>
<p>Maksudnya, jangan taruh seluruh uangmu di satu tempat saja. Kalau keranjang itu jatuh, semua telur pecah. Tapi kalau telur dibagi ke beberapa keranjang, satu jatuh pun yang lain selamat.</p>
<p>Contoh. Jangan taruh semua uang di satu usaha. Kalau usaha itu bangkrut, habis semua. Lebih aman: sebagian di emas, sebagian di reksadana, sebagian di kambing, sebagian di usaha.</p>
<p>Kalau satu turun, yang lain bisa menahan. Emas turun, mungkin warung lagi ramai. Warung sepi, emas dan reksadana masih aman. Risikonya jadi terbagi, tidak menumpuk di satu titik.</p>
<p>Tapi jangan juga terlalu banyak macam sampai bingung mengurus. Untuk pemula, cukup dua atau tiga keranjang dulu. Yang penting tidak menumpuk semua di satu tempat.</p>
HTML,
                        'action_text' => 'Tulis rencana sederhana: kalau punya uang lebih, kamu mau bagi ke berapa "keranjang" dan apa saja.',
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
                    [
                        'title' => 'Bagi Hasil: Modal Bertemu Tenaga',
                        'body' => <<<'HTML'
<p>Kadang kamu punya modal tapi tidak punya waktu atau keahlian. Atau sebaliknya, punya tenaga tapi tidak punya modal. Di sinilah <strong>bagi hasil</strong> berguna.</p>
<p>Bagi hasil itu sederhana: satu pihak kasih modal, satu pihak kasih tenaga dan keahlian. Hasilnya dibagi sesuai kesepakatan. Ini cara yang sudah lama dipakai di desa, dan sesuai juga dengan prinsip syariah.</p>
<p>Contoh paling umum: ternak bagi hasil. Kamu beli kambing, tetanggamu yang merawat. Saat kambing beranak atau dijual, untungnya dibagi, misalnya setengah-setengah. Kamu dapat aset yang tumbuh tanpa harus mengurus tiap hari.</p>
<p>Yang penting dalam bagi hasil: <strong>perjanjian jelas sejak awal.</strong> Siapa menanggung apa kalau rugi, bagaimana pembagian kalau untung, kapan dibagi. Lebih baik ditulis, walau dengan orang dekat.</p>
<p>Bagi hasil membuat kamu bisa punya aset produktif walau sibuk kerja. Tapi pilih partner yang jujur dan rajin, karena keberhasilanmu ada di tangannya juga.</p>
HTML,
                        'action_text' => 'Pikirkan satu orang jujur dan rajin di sekitarmu yang mungkin bisa diajak bagi hasil, lalu tulis namanya.',
                    ],
                    [
                        'title' => 'Reksadana Saham untuk Jangka Panjang',
                        'body' => <<<'HTML'
<p>Setelah kamu nyaman dengan emas dan reksadana pasar uang, ada satu kendaraan lagi yang cocok untuk tujuan jauh: <strong>reksadana saham</strong>.</p>
<p>Bedanya dengan pasar uang: reksadana saham menaruh uangmu di perusahaan-perusahaan besar yang tumbuh. Untungnya bisa lebih besar dalam jangka panjang, tapi naik turunnya juga lebih kasar.</p>
<p>Karena naik turunnya kasar, ini cuma cocok untuk uang yang <strong>tidak kamu butuhkan dalam waktu dekat</strong>. Minimal 5 sampai 10 tahun. Untuk tujuan jauh seperti dana pensiun atau sekolah anak yang masih kecil.</p>
<p>Jangan taruh dana darurat atau uang yang sebentar lagi dipakai di sini. Kalau pas butuh harganya lagi turun, kamu rugi. Ingat pelajaran "jangan jual saat panik".</p>
<p>Cara amannya: setor rutin sedikit-sedikit tiap bulan, lalu lupakan dalam waktu lama. Biarkan waktu dan bunga berbunga bekerja. Tetap pastikan terdaftar OJK sebelum mulai.</p>
HTML,
                        'action_text' => 'Tulis satu tujuan jangka panjang (lebih dari 5 tahun) yang cocok kamu isi pakai reksadana saham nanti.',
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
                        'title' => 'Penghasilan Aktif dan Penghasilan Pasif',
                        'body' => <<<'HTML'
<p>Ada dua jenis penghasilan, dan tahu bedanya akan mengubah cara kamu memandang uang selamanya.</p>
<p><strong>Penghasilan aktif</strong> adalah uang yang datang karena kamu bekerja. Gaji, upah, bayaran. Begitu kamu berhenti bekerja, uangnya berhenti. Tubuhmu adalah mesinnya.</p>
<p><strong>Penghasilan pasif</strong> adalah uang yang datang dari aset yang kamu miliki, walau kamu tidak bekerja hari itu. Sewa kos, hasil ternak, untung reksadana, bagian dari usaha.</p>
<p>Hampir semua orang mulai hidup hanya dari penghasilan aktif. Itu wajar. Tapi yang naik kelas pelan-pelan membangun penghasilan pasif di sampingnya.</p>
<p>Tujuan akhirnya jelas: bikin penghasilan pasifmu cukup besar sampai bisa menutupi biaya hidup. Saat itu terjadi, kamu bebas. <strong>Kerja jadi pilihan, bukan keharusan.</strong> Tiap aset yang kamu kumpulkan adalah satu bata menuju ke sana.</p>
HTML,
                        'action_text' => 'Tulis berapa penghasilan pasifmu sekarang (boleh nol), lalu tulis satu sumber pasif pertama yang mau kamu bangun.',
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
                        'title' => 'Mulai Usaha Sampingan Tanpa Berhenti Kerja',
                        'body' => <<<'HTML'
<p>Banyak orang punya impian usaha tapi takut memulai. Mereka pikir harus berhenti kerja dulu, mempertaruhkan semua. Itu cara yang berisiko dan tidak perlu.</p>
<p>Cara yang lebih aman: <strong>mulai usaha sampingan sambil tetap bekerja.</strong> Gajimu jadi jaring pengaman. Kalau usaha sampingan belum jalan, kamu masih bisa makan.</p>
<p>Pakai waktu luangmu. Hari libur, jam sebelum atau sesudah kerja. Jual sesuatu yang kamu bisa: makanan, jasa, titipan, apa pun yang ada pasarnya di sekitarmu.</p>
<p>Awalnya capek, karena kamu kerja dua kali. Tapi ini sementara. Tujuannya membuktikan usahamu bisa jalan dan menghasilkan, sebelum kamu berani lebih besar.</p>
<p>Aturannya: jangan berhenti dari kerja utama sampai usaha sampinganmu benar-benar menghasilkan stabil, idealnya sampai mendekati gajimu. Lompat saat sudah ada cabang untuk dipijak, bukan ke jurang kosong.</p>
HTML,
                        'action_text' => 'Tentukan satu hari atau jam dalam seminggu yang akan kamu pakai untuk merintis usaha sampingan, lalu tulis.',
                    ],
                    [
                        'title' => 'Uji Idemu dengan Modal Kecil Dulu',
                        'body' => <<<'HTML'
<p>Saat punya ide usaha, godaan terbesar adalah langsung besar. Sewa tempat bagus, beli alat lengkap, stok banyak. Itu berbahaya, karena kalau idemu ternyata kurang laku, modalmu hangus.</p>
<p>Cara orang pintar: <strong>uji dulu dengan modal sekecil mungkin.</strong> Buktikan ada yang mau beli, sebelum keluar uang besar.</p>
<p>Contoh. Mau jualan ayam geprek? Jangan langsung sewa ruko. Coba dulu masak sedikit, jual ke teman kerja dan tetangga, terima pesanan dari rumah. Lihat: laku tidak? Disukai tidak? Untung tidak?</p>
<p>Kalau laku dan disukai, baru tambah pelan-pelan. Kalau ternyata sepi, kamu cuma rugi sedikit dan dapat pelajaran. Jauh lebih murah daripada bangkrut dari awal.</p>
<p>Anggap modal kecil di awal itu seperti mencicipi sebelum membeli sepiring penuh. Tes dulu, perbesar yang terbukti jalan. Jangan pertaruhkan semua pada tebakan.</p>
HTML,
                        'action_text' => 'Ambil idemu, lalu tulis cara mengujinya dengan modal sekecil mungkin minggu ini.',
                    ],
                    [
                        'title' => 'Belajar dari Tempat Kamu Kerja Sekarang',
                        'body' => <<<'HTML'
<p>Kamu sedang duduk di atas sekolah bisnis gratis, dan mungkin tidak sadar. Tempat kamu kerja sekarang adalah guru terbaikmu.</p>
<p>Tiap hari kamu melihat bagaimana sebuah usaha berjalan. Bagaimana belanja bahan, bagaimana mengatur stok, bagaimana melayani pembeli, kenapa ramai di jam tertentu, menu mana yang paling laku.</p>
<p>Kebanyakan karyawan datang, kerja, pulang, tanpa memperhatikan. Tapi kamu yang mau naik kelas, <strong>perhatikan dan pelajari diam-diam.</strong> Ini ilmu mahal yang kamu dapat sambil digaji.</p>
<p>Amati: berapa kira-kira modal sepiring, berapa harga jualnya, berapa untungnya. Bagaimana bos menangani pelanggan rewel. Bagaimana mengatur karyawan. Catat pelajaran yang berguna.</p>
<p>Suatu hari saat kamu buka usaha sendiri, ilmu ini yang membuatmu tidak mulai dari nol. Kamu sudah tahu banyak, karena kamu belajar saat orang lain cuma bekerja.</p>
HTML,
                        'action_text' => 'Tulis satu hal tentang cara kerja usaha tempatmu kerja yang bisa kamu tiru kalau buka usaha sendiri.',
                    ],
                    [
                        'title' => 'Sistem dan Orang: Supaya Usaha Jalan Tanpamu',
                        'body' => <<<'HTML'
<p>Banyak orang sudah punya usaha, tapi tidak pernah benar-benar bebas. Kenapa? Karena usahanya tidak bisa jalan tanpa dia. Dia bukan pemilik, dia jadi budak usahanya sendiri.</p>
<p>Kalau kamu harus ada di warung dari pagi sampai malam tiap hari, kamu cuma pindah jadi karyawan untuk dirimu sendiri. Sumurmu masih butuh kamu timba terus.</p>
<p>Naik kelas yang sebenarnya: bikin usaha yang bisa jalan walau kamu tidak ada. Caranya dua hal: <strong>sistem dan orang.</strong></p>
<p>Sistem artinya cara kerja yang jelas dan tertulis. Resep takarannya pasti, cara melayani sama, cara mencatat uang rapi. Sehingga siapa pun yang mengerjakan, hasilnya sama.</p>
<p>Orang artinya melatih karyawan yang bisa dipercaya untuk menjalankan sistem itu. Awalnya kamu yang ajari. Lama-lama mereka bisa jalan sendiri, dan kamu cuma mengawasi. Saat itu usahamu jadi sumur sejati, bukan timba.</p>
HTML,
                        'action_text' => 'Pikirkan usaha impianmu, lalu tulis satu hal yang harus jadi "sistem" supaya bisa jalan tanpamu.',
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
                        'title' => 'Hitung Angka Bebasmu',
                        'body' => <<<'HTML'
<p>Setiap orang punya satu angka ajaib: berapa besar aset yang dibutuhkan supaya hasilnya cukup menutupi hidup. Kita sebut ini <strong>angka bebasmu</strong>.</p>
<p>Cara hitung kasarnya begini. Ambil biaya hidupmu setahun. Lalu kalikan sekitar 25 kali. Hasilnya itu kira-kira aset yang kamu butuhkan supaya hasilnya saja cukup untuk hidup, tanpa mengambil pokoknya.</p>
<p>Contoh. Biaya hidupmu Rp3 juta sebulan, berarti Rp36 juta setahun. Dikali 25, sekitar <strong>Rp900 juta</strong>. Itulah angka bebasmu.</p>
<p>Kedengarannya besar dan bikin ciut. Tapi jangan kaget dulu. Angka itu dibangun pelan-pelan selama bertahun-tahun, dengan bunga berbunga membantu di belakang. Bukan dikumpulkan tunai sekaligus.</p>
<p>Yang penting kamu tahu arah dan ukuran tujuannya. Orang yang tahu angkanya bisa mengukur kemajuan. Orang yang tidak tahu cuma berjalan tanpa tujuan. Hitung angkamu, walau masih jauh.</p>
HTML,
                        'action_text' => 'Hitung angka bebasmu: biaya hidup setahun dikali 25. Tulis angkanya, sebesar apa pun.',
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
                        'title' => 'Pecah Jadi Target Tiap Tahun',
                        'body' => <<<'HTML'
<p>Tujuan besar seperti angka bebasmu bisa terasa mustahil kalau dilihat sekaligus. Caranya supaya tidak menyerah: <strong>pecah jadi target tahunan yang kecil.</strong></p>
<p>Gunung yang tinggi didaki satu langkah demi satu langkah. Begitu juga uang. Jangan lihat puncaknya terus, lihat anak tangga tahun ini.</p>
<p>Contoh. Tahun ini targetmu cukup sederhana: punya dana darurat Rp6 juta dan buka satu akun reksadana. Tahun depan: lunasi satu utang dan punya 2 kambing. Tahun berikutnya: tambah kambing dan naikkan setoran.</p>
<p>Tiap target tahunan yang tercapai memberi semangat untuk tahun berikutnya. Kamu melihat dirimu maju, bukan jalan di tempat.</p>
<p>Target tahunan yang jelas juga bikin keputusan harian lebih mudah. Saat tergoda boros, kamu ingat: "Ini mengganggu target tahun ini atau tidak?" Tujuan besar dimenangkan lewat target kecil yang dikejar satu per satu.</p>
HTML,
                        'action_text' => 'Tulis satu target uang yang realistis untuk dicapai dalam 12 bulan ke depan.',
                    ],
                    [
                        'title' => 'Cek Diri Tiap Bulan dan Tiap Tahun',
                        'body' => <<<'HTML'
<p>Rencana sebagus apa pun akan layu kalau tidak pernah ditengok. Kamu butuh kebiasaan mengevaluasi diri: tiap bulan dan tiap tahun.</p>
<p><strong>Cek bulanan.</strong> Sekali sebulan, lihat: bulan ini aku maju atau mundur? Tabungan nambah berapa? Ada bocor besar? Target tahun ini masih di jalur? Cukup sepuluh menit.</p>
<p><strong>Cek tahunan.</strong> Sekali setahun, lihat gambaran besar. Total asetmu sekarang berapa, dibanding tahun lalu? Target tahun ini tercapai? Apa pelajaran terbesar tahun ini? Lalu pasang target tahun depan.</p>
<p>Cek rutin ini seperti petani yang keliling kebun. Dia lihat mana tanaman yang subur, mana yang kena hama, mana yang perlu disiram. Tanpa keliling, kebun rusak tanpa ketahuan.</p>
<p>Yang diukur, akan membaik. Saat kamu rutin melihat angkamu, kamu otomatis lebih hati-hati dan lebih semangat. Kemajuan yang terlihat adalah bahan bakar untuk terus jalan.</p>
HTML,
                        'action_text' => 'Tentukan satu tanggal tiap bulan untuk cek dirimu, lalu pasang pengingat berulang di HP.',
                    ],
                    [
                        'title' => 'Kalau Gagal atau Mundur, Jangan Berhenti',
                        'body' => <<<'HTML'
<p>Jujur saja: jalan ini tidak akan mulus. Akan ada bulan kamu gagal nabung. Akan ada usaha yang rugi. Akan ada darurat yang menguras tabungan. Itu pasti terjadi.</p>
<p>Yang membedakan orang yang berhasil bukan tidak pernah jatuh. Tapi <strong>selalu bangun lagi setelah jatuh.</strong></p>
<p>Banyak orang gagal sekali, lalu merasa percuma, lalu berhenti total. Satu bulan bolong nabung, langsung menyerah seluruhnya. Itu kesalahan terbesar. Satu langkah mundur bukan alasan berhenti berjalan.</p>
<p>Kalau bulan ini gagal, mulai lagi bulan depan. Kalau satu usaha rugi, ambil pelajarannya dan coba lagi yang lebih kecil. Kalau dana darurat terkuras, isi lagi pelan-pelan.</p>
<p>Bayangkan anak belajar jalan. Dia jatuh puluhan kali, tapi tidak pernah berpikir untuk berhenti. Dia berdiri lagi, terus. Begitulah cara naik kelas: bukan tanpa jatuh, tapi tanpa berhenti.</p>
HTML,
                        'action_text' => 'Tulis janji untuk dirimu: "Kalau aku gagal satu bulan, aku mulai lagi bulan berikutnya, bukan berhenti."',
                    ],
                    [
                        'title' => 'Ajari Orang yang Kamu Sayang',
                        'body' => <<<'HTML'
<p>Ilmu yang kamu pelajari di sini terlalu berharga untuk disimpan sendiri. Salah satu cara terbaik memperkuatnya: <strong>mengajarkannya pada orang yang kamu sayang.</strong></p>
<p>Saat kamu menjelaskan ke orang lain, kamu sendiri jadi makin paham dan makin tertib menjalankannya. Mengajar adalah cara belajar yang paling kuat.</p>
<p>Lebih dari itu, kamu menolong orang di sekitarmu ikut naik. Ajari pasanganmu supaya satu arah mengatur uang rumah. Ajari adikmu supaya tidak terjebak pinjol. Ajari anakmu menabung sejak kecil.</p>
<p>Ingat awal cerita kita: banyak orang baik tetap miskin bukan karena malas, tapi karena tidak pernah diajari. Kamu sekarang bisa memutus rantai itu untuk keluargamu.</p>
<p>Bayangkan kalau anak-anakmu mengerti prinsip kambing sejak muda. Mereka mulai jauh lebih awal darimu. Satu generasi lagi, keluargamu bisa benar-benar berubah. Kamu yang memulainya.</p>
HTML,
                        'action_text' => 'Pilih satu orang yang kamu sayang, lalu ajari dia satu pelajaran sederhana dari kelas ini minggu ini.',
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
                    [
                        'title' => 'Penutup: Mesin yang Lambat tapi Pasti',
                        'body' => <<<'HTML'
<p>Kita sampai di akhir kelas. Mari rangkum dalam satu napas, supaya kamu bawa pulang inti dari semuanya.</p>
<p>Modal terbesarmu bukan uang, tapi <strong>waktu muda dan badan sehat</strong>. Pakai selagi ada. Catat uangmu supaya tidak bocor. Bayar dirimu sendiri dulu tiap gajian. Bedakan butuh dan ingin. Siapkan payung dana darurat. Jauhi utang yang memakanmu.</p>
<p>Lalu rahasia intinya: buat uangmu beranak seperti kambing, dan jangan pernah makan bibitnya. Tanam di tempat yang aman dan terdaftar, jauhi yang menjanjikan untung mustahil. Pelan-pelan ubah dirimu dari penimba air jadi penggali sumur.</p>
<p>Tidak ada satu pun dari ini yang cepat. Tidak ada jalan pintas yang jujur. Semua ini mesin yang <strong>lambat tapi pasti</strong>. Yang menang bukan yang paling pintar, tapi yang paling sabar dan tidak berhenti.</p>
<p>Mulai hari ini, dari yang kecil, dari yang ada. Beri makan mesinmu tiap gajian. Suatu hari nanti, saat umurmu 40, mesin-mesin itu yang menghidupimu. Dan kamu akan berterima kasih pada dirimu yang hari ini memilih untuk mulai. Selamat naik kelas.</p>
HTML,
                        'action_text' => 'Tulis satu kalimat untuk dirimu sendiri di masa depan, lalu simpan untuk dibaca lagi saat kamu hampir menyerah.',
                    ],
                ],
            ],

        ];
    }
}
