<div style="overflow-x:auto;">
<table id="printTable" class="display" border="display">
    <thead>
        <tr>
            <th>NAMA PENUH</th>
            <?php $current = explode("/", $_SERVER['REQUEST_URI'])[2];
            if($current === 'admin' ): ?><th>CAWANGAN / DAERAH / UNIT / BAHAGIAN</th><?php endif; ?>
            <th>JAWATAN DAN GRED</th>
            <th>KAKITANGAN: NEGERI / PERSEKUTUAN</th>
            <th>JENIS KOMPUTER</th>
            <th>UMUR KOMPUTER</th>
            <th>JENIS PROCESSOR</th>
            <th>SAIZ RAM</th>
            <th>JENIS SISTEM</th>
            <th>ANTIVIRUS</th>
            <th>IPV4 ADDRESS</th>
            <th>CATATAN</th>
            <th>OPERASI</th>
        </tr>
    </thead>
    <tbody id="computerlist">
        <?php foreach (json_decode($PCs) as $pc): ?>

            <tr>
                <td><?php echo $pc->nama_penuh ?></td>
                <?php if($current === 'admin' ): ?><td><?php echo $pc->nama ?></td><?php endif; ?>
                <td><?php echo $pc->jawatan_gred ?></td>
                <td><?php echo $pc->jenis_kakitangan ?></td>
                <td><?php echo $pc->jenis_komputer ?></td>
                <td><?php echo $pc->umur_komputer ?></td>
                <td><?php echo $pc->jenis_processor ?></td>
                <td><?php echo $pc->saiz_ram ?></td>
                <td><?php echo $pc->jenis_sistem ?></td>
                <td><?php echo $pc->antivirus ?></td>
                <td><?php echo $pc->ipv4_address ?></td>
                <td><?php echo $pc->catatan ?></td>
                <td><a href="<?php echo $pages->spesifikasi->edit ?>?form=<?php echo $pc->pcID ?>">Edit</a><br><br>
                    <a href="delete" class="delete_details" data-nama="<?php echo $pc->nama_penuh ?>"
                        data-id="<?php echo $pc->pcID ?>" onclick="return false;">
                        <form hidden id="deleteForm" action="<?php echo $pages->spesifikasi->delete ?>" method="POST">
                            <input type="hidden" name="delete" value="<?php echo $pc->pcID ?>"></form>Delete
                    </a>
                </td>
            </tr>

        <?php endforeach; ?>
        <!-- <tr>
        <td>1</td>
    </tr> -->
    </tbody>
</table>
</div>