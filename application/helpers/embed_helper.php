<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('generate_video_embed')) {
    function generate_video_embed($input)
    {
        $input = trim($input);
        if (empty($input)) return '';

        // LOGIKA 1: Jika sudah berupa tag embed manual
        if (stripos($input, '<iframe') !== false || stripos($input, '<blockquote') !== false || stripos($input, '<script') !== false) {
            return $input;
        }

        // LOGIKA 2: Deteksi YouTube (Termasuk dukungan untuk /shorts/)
        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|shorts\/|watch\?v=|watch\?.+&v=))([\w-]{11})/i', $input, $match)) {
            $video_id = $match[1];
            return '<iframe src="https://www.youtube.com/embed/' . $video_id . '?autoplay=1&rel=0" width="100%" height="100%" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width: 100%; height: 100%; min-height: 400px; background: #000; border-radius: 4px;"></iframe>';
        }

        // LOGIKA 3: Deteksi Instagram
        if (preg_match('/instagram\.com\/(?:p|reel)\/([a-zA-Z0-9_\-]+)/i', $input, $match)) {
            $ig_id = $match[1];
            return '<iframe src="https://www.instagram.com/p/' . $ig_id . '/embed" width="100%" height="100%" frameborder="0" scrolling="no" allowtransparency="true" style="width: 100%; height: 100%; min-height: 520px; max-width: 500px; margin: 0 auto; display: block; background: #fff; border: 1px solid #dbdbdb; border-radius: 4px;"></iframe>';
        }

        // LOGIKA 4: Deteksi TikTok
        if (preg_match('/tiktok\.com\/@[\w.-]+\/video\/(\d+)/i', $input, $match)) {
            $tiktok_id = $match[1];
            return '<iframe src="https://www.tiktok.com/embed/v2/' . $tiktok_id . '" width="100%" height="100%" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width: 100%; height: 100%; min-height: 600px; max-width: 400px; margin: 0 auto; display: block; border-radius: 4px;"></iframe>';
        }

        if (preg_match('/vt\.tiktok\.com\/([a-zA-Z0-9]+)/i', $input, $match)) {
            $ch = curl_init($input);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_exec($ch);
            $final_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
            curl_close($ch);

            if (preg_match('/video\/(\d+)/i', $final_url, $sub_match)) {
                $tiktok_id = $sub_match[1];
                return '<iframe src="https://www.tiktok.com/embed/v2/' . $tiktok_id . '" width="100%" height="100%" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width: 100%; height: 100%; min-height: 600px; max-width: 400px; margin: 0 auto; display: block; border-radius: 4px;"></iframe>';
            }
        }

        // FALLBACK
        return '<video src="' . htmlspecialchars($input, ENT_QUOTES, 'UTF-8') . '" controls autoplay style="width:100%; max-height:80vh;"></video>';
    }
}
