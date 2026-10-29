# SATu — Finalisasi ERD Fisik (Tahap 1)

Versi rancangan: 1.1-draft  
Basis: PRD & ERD Aplikasi Ujian Sekolah v1.0 dan keputusan autentikasi SATu.  
Status: rancangan untuk ditinjau sebelum migration dibuat.

## 1. Evaluasi PRD

PRD sudah mendefinisikan domain sekolah, bank soal, pelaksanaan, pengerjaan, pengawasan, dan publikasi nilai. ERD konseptual belum siap langsung menjadi migration karena keputusan jadwal, penilaian isian singkat, ambang perpindahan tab, kewenangan pengawas, batas percobaan login/token, pemindahan siswa, kapasitas server, penerbitan ulang kartu, dan format impor masih terbuka.

### Keputusan yang dibawa dari PRD
- Satu judul ujian dapat memiliki banyak mapel dan kelas.
- Soal dimiliki oleh konteks mapel pada judul ujian; duplikasi menghasilkan record baru.
- Kredensial peserta berlaku untuk satu judul ujian.
- Peserta mengonfirmasi identitas sebelum melihat mapel.
- Token 5 karakter alfanumerik terikat pada ruang dan sesi, dirotasi setiap 30 menit.
- Jawaban mengacu ke snapshot attempt_questions; urutan soal/opsi tetap saat pemulihan.
- Nilai disembunyikan sampai guru berwenang memublikasikannya.
- Data sekolah siap untuk pemetaan identitas eksternal di masa depan.

### Rekomendasi untuk menutup gap
| Topik | Rekomendasi tahap 1 | Catatan |
|---|---|---|
| Jadwal | Jadwal dan durasi pada exam_subjects; validasi juga terhadap sesi/ruang | Konfirmasi apakah ruang dapat punya jam mulai berbeda |
| Username | Username unik global; satu assignment per ujian-siswa | Password tetap hanya berlaku pada satu judul ujian |
| Password kartu | Password acak dan di-hash; plaintext hanya saat penerbitan/reset terkendali | Password hash tidak bisa dicetak ulang |
| Penerbitan kartu | Simpan metadata batch dan audit, bukan password plaintext | Jaga rahasia kredensial |
| Rate limit | Terapkan pembatasan login/token sejak awal | Ambang final dapat dikonfigurasi |
| Insiden tab | Peringatan pertama; insiden kedua mengunci secara default | Ambang perlu persetujuan |
| Pemulihan | Pengawas yang ditugaskan dapat membuka sesi terkunci dengan alasan wajib dan audit | Admin memiliki pemulihan khusus |
| Pemindahan ruang | Simpan riwayat penempatan, jangan menimpa histori | Jawaban dan attempt tetap utuh |
| Isian singkat | Trim spasi tepi dan normalisasi huruf besar/kecil; dukung jawaban alternatif | Tanda baca/format angka perlu keputusan |
| Impor | CSV UTF-8 sebagai baseline, preview dan validasi sebelum commit | XLSX bisa menyusul |
| Kapasitas | Tetapkan setelah target peserta serentak dan uji beban | PRD belum punya target final |

## 2. Aturan data umum

1. Gunakan primary key BIGINT unsigned untuk ID internal.
2. Tabel domain sekolah memakai school_id langsung atau melalui relasi yang tervalidasi.
3. Waktu disimpan dengan timezone aplikasi/sekolah yang ditetapkan.
4. Gunakan foreign key dan unique index untuk aturan wajib; validasi aplikasi saja tidak cukup.
5. Nama bukan pengenal unik. Identitas eksternal unik berdasarkan sumber dan ID eksternal.
6. Snapshot pengerjaan tidak berubah ketika bank soal diedit.
7. Data historis yang terpakai sebaiknya dinonaktifkan/soft-delete, bukan cascade-delete.
8. Perubahan sensitif harus dicatat dalam audit/event log.

## 3. Rancangan tabel fisik

Tipe mengikuti konvensi Laravel dan MySQL/MariaDB; tipe akhir harus diverifikasi saat migration.

### Sekolah dan identitas
- schools: id PK, code UNIQUE, name, timezone, status, timestamps.
- users: pertahankan starter kit id, name, email UNIQUE, password hash, email verification, remember token, timestamps; tambahkan school_id FK dan status. Akun staf untuk admin/guru/pengawas, bukan siswa.
- roles: id, name UNIQUE, label, timestamps.
- permissions: id, name UNIQUE, label, timestamps.
- role_user: user_id FK, role_id FK, UNIQUE(user_id, role_id).
- permission_role: role_id FK, permission_id FK, UNIQUE(role_id, permission_id).
- classes: id, school_id FK, code, name, grade_level nullable, status, timestamps; UNIQUE(school_id, code).
- students: id, school_id FK, class_id FK nullable, nisn nullable, student_number nullable, name, external_source nullable, external_id nullable, status, timestamps. Jangan mengandalkan nama sebagai kunci; tetapkan aturan untuk NISN kosong/duplikat sebelum migration.
- subjects: id, school_id FK, code, name, status, timestamps; UNIQUE(school_id, code).

### Judul ujian dan bank soal
- exams: id, school_id FK, code, title, academic_year, period nullable, status, created_by FK users, timestamps; UNIQUE(school_id, code).
- exam_subjects: id, exam_id FK, subject_id FK, teacher_id FK users nullable, starts_at nullable, ends_at nullable, duration_minutes, status, results_published_at nullable, published_by FK users nullable, timestamps; UNIQUE(exam_id, subject_id).
- exam_class_subjects: id, exam_subject_id FK, class_id FK, timestamps; UNIQUE(exam_subject_id, class_id).
- questions: id, exam_subject_id FK, type, prompt LONGTEXT, options JSON nullable, answer_key JSON nullable, accepted_answers JSON nullable, score_weight DECIMAL(8,2), position nullable, copied_from_question_id FK questions nullable, status, timestamps. Index exam_subject_id/status/position. Jangan pernah kirim answer_key ke browser siswa.
- Duplikasi soal dilakukan dalam transaksi dan menghasilkan ID baru tanpa membawa attempt, jawaban, atau hasil dari ujian sumber.

### Pelaksanaan dan token
- exam_sittings: id, exam_id FK, code, name, starts_at, ends_at, status, timestamps; UNIQUE(exam_id, code).
- exam_rooms: id, exam_sitting_id FK, code, name, capacity nullable, timestamps; UNIQUE(exam_sitting_id, code).
- room_tokens: id, exam_room_id FK, token_hash, starts_at, expires_at, created_by FK users, revoked_at nullable, timestamps. Token plaintext hanya dikirim ke pengawas saat dibuat/rotasi; rate limit wajib karena token 5 karakter memiliki entropi terbatas.
- room_student_assignments: id, student_id FK, exam_room_id FK, assigned_by FK users, starts_at, ends_at nullable, reason nullable, timestamps. Perpindahan menutup penempatan sebelumnya dan membuat record baru; cegah dua penempatan aktif yang bertentangan melalui transaksi/service.

### Kredensial dan kartu peserta
- exam_assignments: id, exam_id FK, student_id FK, username VARCHAR(80) UNIQUE, password VARCHAR(255) berisi hash, status, issued_at nullable, issued_by FK users nullable, password_changed_at nullable, timestamps.
- Constraint wajib: UNIQUE(exam_id, student_id) dan UNIQUE(username).
- Password diverifikasi terhadap assignment untuk judul ujian terkait. Jangan simpan/log plaintext dan jangan letakkan password pada URL. Reset menerbitkan password baru dan membatalkan password lama.
- credential_issuance_batches: id, exam_id FK, batch_code UNIQUE, created_by FK users, printed_at nullable, recipient_count, notes nullable, timestamps. Metadata saja, tanpa password plaintext.
- Kartu menampilkan nama siswa, identitas sesuai kebijakan, judul ujian, username, password saat penerbitan, dan instruksi login. Password hanya ditampilkan melalui proses penerbitan terkendali.

### Attempt, snapshot, jawaban, audit
- student_exam_attempts: id, exam_assignment_id FK, exam_subject_id FK, room_student_assignment_id FK nullable, started_at nullable, deadline_at nullable, submitted_at nullable, closed_at nullable, status, score_total DECIMAL(10,2) nullable, timestamps. UNIQUE(exam_assignment_id, exam_subject_id) untuk satu attempt per mapel pada MVP.
- attempt_questions: id, student_exam_attempt_id FK, source_question_id FK questions nullable, question_snapshot JSON, position, score_weight_snapshot DECIMAL(8,2), timestamps. UNIQUE(student_exam_attempt_id, position). Snapshot memuat konten/opsi yang diperlukan, bukan kunci yang dikirim ke browser.
- answers: id, attempt_question_id FK UNIQUE, answer_payload JSON nullable, saved_at nullable, submitted_at nullable, grading_status, score_awarded DECIMAL(8,2) nullable, graded_by FK users nullable, graded_at nullable, timestamps.
- exam_session_events: id, student_exam_attempt_id FK nullable, exam_assignment_id FK nullable, actor_user_id FK users nullable, event_type, occurred_at, metadata JSON nullable, reason nullable, timestamps. Catat insiden tab/koneksi, penguncian/pembukaan, perubahan penempatan, reset kredensial, dan publikasi nilai. Jangan simpan password/token plaintext.
- import_batches: id, school_id FK, entity_type, file_name, status, total_rows, valid_rows, invalid_rows, created_by FK users, completed_at nullable, timestamps. Bila perlu, import_row_errors menyimpan nomor baris, kode, dan pesan kesalahan.

## 4. Indeks dan constraint wajib

Unique minimal: schools.code; classes(school_id, code); subjects(school_id, code); exams(school_id, code); exam_subjects(exam_id, subject_id); exam_class_subjects(exam_subject_id, class_id); exam_assignments(exam_id, student_id); exam_assignments.username; student_exam_attempts(exam_assignment_id, exam_subject_id); attempt_questions(student_exam_attempt_id, position); answers.attempt_question_id.

Pasang foreign key dan index untuk foreign key serta kolom status/jadwal yang sering dicari. Gunakan RESTRICT untuk data historis; CASCADE hanya untuk detail yang aman dihapus sebelum dipakai. Aturan lintas-relasi—misalnya assignment, mapel dan ruang harus berasal dari konteks ujian/sekolah yang cocok—wajib divalidasi di service transaction.

## 5. Kontrak impor MVP

Format baseline: CSV UTF-8 dengan header tetap, preview, dan validasi per baris.

- Siswa: nisn, student_number, name, class_code, status. Nama wajib; salah satu pengenal siswa harus tersedia sesuai kebijakan; class_code harus ada di sekolah yang dipilih.
- Guru/staf: name, email, role_code, status. Password awal melalui undangan/reset aman, bukan impor plaintext.
- Kelas: code, name, grade_level, status. Code unik dalam sekolah.
- Mata pelajaran: code, name, status. Code unik dalam sekolah.

Alur: upload → validasi format/header → preview → validasi baris → tampilkan ringkasan kesalahan → konfirmasi → commit → audit. Tidak ada data yang ditulis sebelum konfirmasi.

## 6. Autentikasi dan UI

- Staf memakai users dan autentikasi Laravel/Fortify yang sudah ada.
- Peserta memakai alur terpisah di /ujian/login dan diverifikasi terhadap exam_assignments, bukan users.
- Setelah kredensial valid, tampilkan identitas dari students untuk konfirmasi sebelum mapel tersedia.
- Bootstrap 5 menjadi satu-satunya framework UI; jangan mencampur class Flux/Tailwind dengan Bootstrap pada halaman/layout yang dimigrasikan.
- Karena kredensial berlaku per judul ujian, halaman login harus mengetahui judul ujian secara jelas. Rekomendasi: kode/judul ujian pada kartu atau URL khusus ujian; keputusan ini perlu disepakati sebelum route final.
- Peran awal: admin, guru penanggung jawab mapel, pengawas. Siswa adalah actor domain students/exam_assignments, bukan akun users.

## 7. Gate sebelum migration

- [ ] Setujui aturan jadwal antara exam_subjects, exam_sittings, dan exam_rooms.
- [ ] Putuskan cara halaman login mengetahui judul ujian.
- [ ] Setujui kewenangan pembukaan sesi terkunci dan ambang insiden.
- [ ] Setujui normalisasi jawaban isian singkat.
- [ ] Setujui sumber identitas resmi dan format impor.
- [ ] Tetapkan target peserta serentak serta rencana backup/restore.
- [ ] Setelah itu, buat migrations, model, factory, dan tes constraint.

## 8. Tahap berikutnya

Tahap 2 adalah fondasi Laravel: autentikasi staf, role/permission, sekolah, kelas, siswa, guru, dan mata pelajaran. UI menggunakan Bootstrap 5 secara konsisten; interaksi menggunakan Livewire 4. Login staf dan login peserta tetap dua alur terpisah.
