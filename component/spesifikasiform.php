<div class="content">
    <!-- Form Section - SPESIFIKASI -->
    <form id="detailsform" method="POST" action="ver.php"
        class="form-container" enctype="multipart/form-data">
        <input id="targetid" type="text" name="id" value="<?php echo htmlspecialchars($data['pcID']); ?>" hidden>

        <!-- NAMA -->
        <label for="fullname">Nama Penuh :</label>
        <input type="text" name="NamaPenuh" id="fullname" placeholder="Masukkan nama penuh" 
            value="<?php echo htmlspecialchars($data['nama_penuh']) ?>" required autofocus>
        
        <!-- BAHAGIAN -->
        <?php $current = explode("/", $_SERVER['REQUEST_URI']);
            if($current[2] === 'admin' ): ?>
        <label for="bahagian">Unit / Bahagian / Cawangan / Daerah :</label>
        <select name="cawangan">
            <?php include '../component/units.php'; ?>
        </select>
        <?php endif; ?>
        
        <!-- JAWATAN -->
        <label for="jawatangred">Jawatan dan Gred :</label>
        <input type="text" name="jawatangred" id="jawatangred" placeholder="Jawatan dan gred"
            value="<?php echo htmlspecialchars($data['jawatan_gred']); ?>">
        
        <!-- GAMBAR -->
        <label for="gambar">GAMBAR</label>
        <input type="file" id="gambar" name="gambar" accept="image/*">
    
        <!-- JENIS KAKITANGAN -->
        <label>Kakitangan Persekutuan / Negeri:</label>
        <div class="radio-group">
            <input type="radio" name="kakitangan" value="NEGERI" id="NEGERI" <?= $data['jenis_kakitangan'] == 'NEGERI' ? ' checked="true"' : ''; ?> >
            <label for="NEGERI">Negeri</label>
            <input type="radio" name="kakitangan" value="PERSEKUTUAN" id="PERSEKUTUAN" <?= $data['jenis_kakitangan'] == 'PERSEKUTUAN' ? ' checked="true"' : ''; ?> >
            <label for="PERSEKUTUAN">Persekutuan</label>
        </div>
    
        <!-- JENIS PC -->
        <label for="jenispc">Jenis Komputer :</label>
        <div class="">
            <input type="radio" name="jenispc" value="BAHAGIAN TEK" id="jenis1" <?= $data['jenis_komputer'] == 'BAHAGIAN TEK' ? 'checked="true"' : ''; ?> ><label for="jenis1">Bahagian Tek...</label><br>
            <input type="radio" name="jenispc" value="SEWAAN JKR" id="jenis2" <?= $data['jenis_komputer'] == 'SEWAAN JKR' ? 'checked="true"' : ''; ?> ><label for="jenis2">Sewaan JKR</label><br>
            <input type="radio" name="jenispc" value="SUK" id="jenis3" <?= $data['jenis_komputer'] == 'SUK' ? 'checked="true"' : ''; ?> ><label for="jenis3">SUK</label><br>
            <input type="radio" name="jenispc" value="PROJEK" id="projekRadio" <?= $data['jenis_komputer'] == 'PROJEK' ? 'checked="true"' : ''; ?>><label for="projekRadio">Projek</label>
            <input type="date" name="project_date" value="<?= $data['jenis_komputer'] == 'PROJEK' ? $data['tarikhtamat'] : ''; ?>" id="projekDateInput" <?= $data['jenis_komputer'] == 'PROJEK' ? '' : 'disabled'; ?> >
        </div>
        <!-- <input type="text" name="jenispc" id="jenispc" placeholder="Jenis komputer"
            value="<?=htmlspecialchars($data['jenis_komputer']); ?>"> -->
    
        <!-- UMUR PC -->
        <label for="tahun">Umur Komputer (Tahun) :</label>
        <input type="number" name="tahun" id="tahun" placeholder="Umur komputer"
            value="<?php echo htmlspecialchars($data['umur_komputer']); ?>">
    
        <!-- PROCESSOR -->
        <?php $otherproc = (
            $data['jenis_processor'] != '' and
            $data['jenis_processor'] != 'i3' and
            $data['jenis_processor'] != 'i5' and
            $data['jenis_processor'] != 'i7');?>
        <label>Jenis Processor :</label>
        <div class="radio-group">
            <input type="radio" name="proc" value="i3" id="i3" <?= $data['jenis_processor'] == 'i3' ? 'checked="true"' : ''; ?> ><label for="i3">i3</label>
            <input type="radio" name="proc" value="i5" id="i5" <?= $data['jenis_processor'] == 'i5' ? 'checked="true"' : ''; ?> ><label for="i5">i5</label>
            <input type="radio" name="proc" value="i7" id="i7" <?= $data['jenis_processor'] == 'i7' ? 'checked="true"' : ''; ?> ><label for="i7">i7</label>
            <input type="radio" name="proc" id="otherProcRadio" <?= $otherproc ? 'checked="true"' : ''; ?>  value=" ">
            <label for="otherProcRadio">Others:</label>
            <input type="text" name="otherproc" id="otherProcTxtBox" <?= $otherproc ? '' : 'disabled'; ?> value="<?= $otherproc ? $data['jenis_processor'] : ''; ?>" >
        </div>
    
        <!-- RAM -->
        <label for="ram">RAM :</label>
        <input type="number" name="ram" id="ram" placeholder="Saiz Ram" value="<?php echo htmlspecialchars($data['saiz_ram']); ?>">
    
        <!-- SISTEM -->
        <label>System Type :</label>
        <div class="radio-group">
            <input type="radio" name="systemtype" value="32BIT" id="32BIT" <?= $data['jenis_sistem'] == '32BIT' ? ' checked="true"' : ''; ?> ><label for="32BIT">32 BIT</label>
            <input type="radio" name="systemtype" value="64BIT" id="64BIT" <?= $data['jenis_sistem'] == '64BIT' ? ' checked="true"' : ''; ?> ><label for="64BIT">64 BIT</label>
        </div>
    
        <!-- ANTIVIRUS -->
        <label for="antivirus">Antivirus :</label>
        <input type="text" name="antivirus" id="antivirus" placeholder="Antivirus digunakan"
            value="<?php echo htmlspecialchars($data['antivirus']); ?>">
    
        <!-- IP -->
        <label for="ipaddress">IPv4 Address :</label>
        <input type="text" name="ipaddress" id="ipaddress" placeholder="Contoh: 192.168.0.1"
            value="<?php echo htmlspecialchars($data['ipv4_address']); ?>">
    
        <!-- NOTE -->
        <label for="catatan">Catatan :</label>
        <textarea name="catatan" id="catatan" placeholder="Tambahan informasi"><?php echo htmlspecialchars($data['catatan']); ?></textarea>
    
        <input name="SAVE" class="button" type="submit" value="SAVE">
        <input type="reset" class="reset" type="reset" value="RESET">
    </form>
</div>