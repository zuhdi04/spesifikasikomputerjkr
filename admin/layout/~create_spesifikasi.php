<div class="content">
    <!-- Form Section -->
    <form id="detailsform" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>"
        class="form-container">
        <input id="targetid" type="text" name="id" hidden>
        <label for="fullname">Nama Penuh :</label>
        <input type="text" name="NamaPenuh" id="fullname" placeholder="Masukkan nama penuh" required autofocus>

        <label for="bahagian">Bahagian / Cawangan / Daerah :</label>
        <!-- <input type="text" name="bahagian" id="bahagian" placeholder="Bahagian/Cawangan/Daerah"> -->
        <select name="cawangan">
            <?php include '../component/units.php'; ?>
        </select>

        <label for="jawatangred">Jawatan dan Gred :</label>
        <input type="text" name="jawatangred" id="jawatangred" placeholder="Jawatan dan gred">

        <!-- <label for="kakitangan">Kakitangan Persekutuan / Negeri :</label>
    <select name="kakitangan" id="kakitangan">
        <option value="NEGERI">Negeri</option>
        <option value="PERSEKUTUAN">Persekutuan</option>
    </select> -->
        <label>Kakitangan Persekutuan / Negeri:</label>
        <div class="radio-group">
            <input type="radio" name="kakitangan" value="NEGERI" id="negeri"><label for="negeri">Negeri</label>
            <input type="radio" name="kakitangan" value="PERSEKUTUAN" id="persekutuan"><label
                for="persekutuan">Persekutuan</label>
        </div>

        <label for="jenispc">Jenis Komputer :</label>
        <input type="text" name="jenispc" id="jenispc" placeholder="Jenis komputer">

        <label for="tahun">Umur Komputer (Tahun) :</label>
        <input type="number" name="tahun" id="tahun" placeholder="Umur komputer">

        <label>Jenis Processor :</label>
        <div class="radio-group">
            <input type="radio" name="proc" value="i3" id="i3"><label for="i3">i3</label>
            <input type="radio" name="proc" value="i5" id="i5"><label for="i5">i5</label>
            <input type="radio" name="proc" value="i7" id="i7"><label for="i7">i7</label>
            <input type="radio" name="proc" id="otherProcRadio" value=" ">
            <label for="otherProcRadio">Others:</label>
            <input type="text" id="otherProcTxtBox" disabled onkeyup="setOtherProcValue()">
        </div>

        <label for="ram">RAM :</label>
        <select name="ram" id="ram">
            <option value="2">2 GB</option>
            <option value="4">4 GB</option>
            <option value="6">6 GB</option>
            <option value="8">8 GB</option>
        </select>

        <label>System Type :</label>
        <div class="radio-group">
            <input type="radio" name="systemtype" value="32BIT" id="32bit"><label for="32bit">32 BIT</label>
            <input type="radio" name="systemtype" value="64BIT" id="64bit"><label for="64bit">64 BIT</label>
        </div>

        <label for="antivirus">Antivirus :</label>
        <input type="text" name="antivirus" id="antivirus" placeholder="Antivirus digunakan">

        <label for="ipaddress">IPv4 Address :</label>
        <input type="text" name="ipaddress" id="ipaddress" placeholder="Contoh: 192.168.0.1">

        <label for="catatan">Catatan :</label>
        <textarea name="catatan" id="catatan" placeholder="Tambahan informasi"></textarea>

        <input name="SAVE" class="button" type="submit" value="SAVE">
        <input type="reset" class="reset" type="reset" value="RESET">
    </form>
</div>