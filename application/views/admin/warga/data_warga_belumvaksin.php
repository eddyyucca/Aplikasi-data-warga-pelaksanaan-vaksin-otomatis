<div class="container-fluid">
    <!-- Page Heading -->
    <table>
        <tr align="left">
            <th rowspan="2"><img src="<?= base_url('assets/cop.png') ?>" width="300" height="128">
            </th>
        </tr>
    </table>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold ">Tabel Data Warga Belum Melakukan Vaksin</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="container">

                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Warga</th>
                            <th>TTL</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Telpon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        foreach ($data as $x) { ?>
                            <tr>
                                <td><?= $nomor++; ?></td>
                                <td><?= $x->nama; ?></td>
                                <td><?= $x->ttl; ?></td>
                                <td><?= $x->jk; ?></td>
                                <td><?= $x->alamat; ?></td>
                                <td><?= $x->telpon; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    window.print()
</script>