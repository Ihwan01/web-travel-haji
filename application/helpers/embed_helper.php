<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('generate_video_embed')) {
    function generate_video_embed($input)
    {
        $input = trim($input);
        if (empty($input)) return '';

        // ── LOGIKA 1: EKSTRAKSI TIKTOK ───────────────────────────────────────
        $tiktok_id = '';

        if (preg_match('/data-video-id="(\d+)"/i', $input, $match)) {
            $tiktok_id = $match[1];
        } elseif (preg_match('/tiktok\.com\/.*video\/(\d+)/i', $input, $match)) {
            $tiktok_id = $match[1];
        } elseif (preg_match('/(?:vt|vm)\.tiktok\.com\/([a-zA-Z0-9]+)/i', $input)) {
            $ch = curl_init($input);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);

            if (preg_match('/[Ll]ocation:\s*([^\r\n]+)/', $response, $loc_match)) {
                $redirect_url = trim($loc_match[1]);
                if (preg_match('/video\/(\d+)/i', $redirect_url, $sub_match)) {
                    $tiktok_id = $sub_match[1];
                }
            }
        }

        // KUNCI: Menggunakan data-src, bukan src. TikTok tidak akan crash karena belum dimuat.
        if (!empty($tiktok_id)) {
            return '<iframe class="nr-lazy-iframe" data-src="https://www.tiktok.com/embed/v2/' . $tiktok_id . '?lang=id-ID" width="100%" height="100%" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen style="width: 100%; height: 100%; min-height: 600px; max-width: 400px; margin: 0 auto; display: block; background: #000; border-radius: 8px;"></iframe>';
        }

        // ── LOGIKA 2: YOUTUBE ────────────────────────────────────────────────
        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|shorts\/|watch\?v=|watch\?.+&v=))([\w-]{11})/i', $input, $match)) {
            $video_id = $match[1];
            return '<iframe class="nr-lazy-iframe" data-src="https://www.youtube.com/embed/' . $video_id . '?autoplay=1&rel=0" width="100%" height="100%" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width: 100%; height: 100%; min-height: 400px; background: #000; border-radius: 8px;"></iframe>';
        }

        // ── LOGIKA 3: INSTAGRAM ──────────────────────────────────────────────
        if (preg_match('/instagram\.com\/(?:p|reel)\/([a-zA-Z0-9_\-]+)/i', $input, $match)) {
            $ig_id = $match[1];
            return '<iframe class="nr-lazy-iframe" data-src="https://www.instagram.com/p/' . $ig_id . '/embed" width="100%" height="100%" frameborder="0" scrolling="no" allowtransparency="true" style="width: 100%; height: 100%; min-height: 520px; max-width: 500px; margin: 0 auto; display: block; background: #fff; border: 1px solid #dbdbdb; border-radius: 8px;"></iframe>';
        }

        // ── LOGIKA 4: MANUAL EMBED TAG ───────────────────────────────────────
        if (stripos($input, '<iframe') !== false || stripos($input, '<blockquote') !== false || stripos($input, '<script') !== false) {
            return $input;
        }

        // ── FALLBACK: LOKAL VIDEO ────────────────────────────────────────────
        return '<video src="' . htmlspecialchars($input, ENT_QUOTES, 'UTF-8') . '" controls autoplay style="width:100%; max-height:80vh; background: #000; border-radius: 8px;"></video>';
    }
}
