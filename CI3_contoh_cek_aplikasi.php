<?php
// Contoh di application/core/MY_Controller.php atau hook CI3:
// wajibkan akses hanya dari aplikasi Exam Browser
$ua = $this->input->user_agent();
if (strpos($ua, 'ExamBrowserApp') === false) {
    show_error('Ujian hanya dapat diakses melalui aplikasi Exam Browser.', 403);
}
