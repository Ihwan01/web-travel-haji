<div class="col-md-6 mb-3">
    <label class="form-label font-weight-bold">WhatsApp (Format Bebas)</label>
    <?php
    // Jika ada nomor di database, percantik tampilannya 
    $formatted_wa = isset($company->whatsapp) ? format_whatsapp($company->whatsapp) : '';
    ?>
    <input type="text" name="whatsapp" class="form-control" value="<?= htmlspecialchars($formatted_wa) ?>" placeholder="Contoh: 0812-3456-7890">
    <small class="text-muted">Sistem akan otomatis menormalisasinya menjadi format +62.</small>
</div>