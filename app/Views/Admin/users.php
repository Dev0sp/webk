<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
   <!-- Add Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+UPmUSVOJXQOqa1Je7GOmMaXZzZtoUAOaEvKFVpEEj0fzZt" crossorigin="anonymous">

<!-- Add Bootstrap JavaScript (and its dependencies, if required) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-Dziyf5hFm7P2qzFQUvEoC4KCZnQApFmCwG5wALv/O9vYzwxIka7jU2yG5FfJ4p8k" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-AbhknbwMfOiN4Q5mi8L8aB1iuXl8Ct6F9l8bX8IcfxiFz7dV8BGSX8T3l02oJr7F" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-1ss8GKvlzGYJlLPJW8mNEu6/s9CaQ3XqSl1n9Xw5d9iiRH6I8U8Htvu1Zi4fC73F" crossorigin="anonymous"></script>

<style>
    
    .about-content {
    max-width: 1117px;
    margin-inline: 0;
    
    
}

    
   .btn {
     background-color: beige;
    color: black;
    font-family: var(--ff-oswald);
    font-size: var(--fs-6);
    font-weight: var(--fw-500);
    letter-spacing: 1px;
    text-transform: uppercase;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    padding: 13px 34px;
    clip-path: var(--polygon-1);
    transition: var(--transition-1);
   }
</style>

<div class="section-wrapper">

        <!-- 
          - #ABOUT
        -->

        <section class="about" id="about">
         

           

          <div class="about-content">

              <p class="about-subtitle">Welcome Bro</p>

              <h2 class="about-title"> <strong>User Information</strong> </h2>

              <div class="card-body">
                <!-- <?php if ($user_list) : ?> -->

                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-hover text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="row">#</th>
                                <th>Username</th>
                                <th>Fullname</th>
                                <th>Level</th>
                                <th>Saldo</th>
                                <th>Status</th>
                                <th>Uplink</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- <?php endif; ?> -->

      
              <div class="card-body">
              
            </div>

              <p class="about-bottom-text">
                <ion-icon name="arrow-forward-circle-outline"></ion-icon>

                <span>Will sharpen your brain and focus</span>
              </p>

            </div>

          </div>
        </section>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<?= link_tag("https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css") ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js") ?>

<?= script_tag("https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js") ?>
<script>
    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [0, "desc"]
            ],
            ajax: "<?= site_url('admin/api/users') ?>",
            columns: [{
                    data: 'id',
                },
                {
                    data: 'username',
                },
                {
                    data: 'fullname',
                    render: function(data, type, row, meta) {
                        return (row.fullname ? row.fullname : '~');
                    }
                },
                {
                    data: 'level',
                },
                {
                    data: 'saldo',
                    render: function(data, type, row, meta) {
                        var textc = (row.level === 'Admin' ? 'primary' : 'dark');
                        var saldo = (row.level === 'Admin' ? '&mstpos;' : row.saldo);
                        return `<span class="badge text-${textc}">${saldo}</span>`;
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row, meta) {
                        var act = `<span class="text-success">Active</span>`;
                        var ban = `<span class="text-danger">Banned</span>`;
                        return (row.status == 1 ? act : ban);
                    }
                },
                {
                    data: 'uplink',
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return `<a href="${window.location.origin}/public/admin/user/${row.id}" class="btn btn-dark btn-sm">EDIT</a>`;
                    }
                }
            ]
        });
    });
</script>

<?= $this->endSection() ?>